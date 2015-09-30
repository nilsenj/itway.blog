<?php
/**
 * Created by PhpStorm.
 * User: nilsenj
 * Date: 9/22/2015
 * Time: 3:10 PM
 */

namespace Itway\Traits;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

trait Searchable
{

    /**
     * @var array
     */
    protected $search_bindings = [];

    /**
     * Creates the search scope.
     *
     * @param \Illuminate\Database\Eloquent\Builder $q
     * @param string $search
     * @param float|null $threshold
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $q, $search, $threshold = null, $entireText = false)
    {
        return $this->scopeSearchRestricted($q, $search, null, $threshold, $entireText);
    }

    public function scopeSearchRestricted(Builder $q, $search, $restriction, $threshold = null, $entireText = false)
    {
        $query = clone $q;
        $query->select($this->getTable() . '.*');
        $this->makeJoins($query);

        if ( ! $search)
        {
            return $q;
        }

        $search = mb_strtolower(trim($search));
        $words = explode(' ', $search);

        $selects = [];
        $this->search_bindings = [];
        $relevance_count = 0;

        foreach ($this->getColumns() as $column => $relevance)
        {
            $relevance_count += $relevance;
            $queries = $this->getSearchQueriesForColumn($query, $column, $relevance, $words);

            if ( $entireText === true )
            {
                $queries[] = $this->getSearchQuery($query, $column, $relevance, [$search], 30, '', '%');
            }

            foreach ($queries as $select)
            {
                $selects[] = $select;
            }
        }

        $this->addSelectsToQuery($query, $selects);

        // Default the threshold if no value was passed.
        if (is_null($threshold)) {
            $threshold = $relevance_count / 4;
        }

        $this->filterQueryWithRelevance($query, $selects, $threshold);

        $this->makeGroupBy($query);

        $this->addBindingsToQuery($query, $this->search_bindings);

        if(is_callable($restriction)) {
            $query = $restriction($query);
        }

        $this->mergeQueries($query, $q);

        return $q;
    }

    /**
     * Returns database driver Ex: mysql, pgsql, sqlite.
     *
     * @return array
     */
    protected function getDatabaseDriver() {
        $key = Config::get('database.default');
        return Config::get('database.connections.' . $key . '.driver');
    }

    /**
     * Returns the search columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        if (array_key_exists('columns', $this->searchable)) {
            return $this->searchable['columns'];
        } else {
            return DB::connection()->getSchemaBuilder()->getColumnListing($this->table);
        }
    }

    /**
     * Returns the table columns.
     *
     * @return array
     */
    public function getTableColumns()
    {
        return $this->searchable['table_columns'];
    }

    /**
     * Returns the tables that are to be joined.
     *
     * @return array
     */
    protected function getJoins()
    {
        return array_get($this->searchable, 'joins', []);
    }

    /**
     * Adds the sql joins to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function makeJoins(Builder $query)
    {
        foreach ($this->getJoins() as $table => $keys)
        {
            $query->leftJoin($table, $keys[0], '=', $keys[1]);
        }
    }

    /**
     * Makes the query not repeat the results.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    protected function makeGroupBy(Builder $query)
    {
        $driver = $this->getDatabaseDriver();
        if ($driver == 'sqlsrv') {
            $columns = $this->getTableColumns();
        } else {
            $id = $this->getTable() . '.' .$this->primaryKey;
            $joins = array_keys(($this->getJoins()));

            foreach ($this->getColumns() as $column => $relevance) {

                array_map(function($join) use ($column, $query){

                    if(Str::contains($column, $join)){
                        $query->groupBy("$column");
                    }

                }, $joins);

            }
        }
        $query->groupBy($id);
    }

    /**
     * Puts all the select clauses to the main query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $selects
     */
    protected function addSelectsToQuery(Builder $query, array $selects)
    {
        $selects = new Expression(implode(' + ', $selects) . ' as relevance');
        $query->addSelect($selects);
    }

    /**
     * Adds the relevance filter to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $selects
     * @param float $relevance_count
     */
    protected function filterQueryWithRelevance(Builder $query, array $selects, $relevance_count)
    {
        $comparator = $this->getDatabaseDriver() != 'mysql' ? implode(' + ', $selects) : 'relevance';

        $relevance_count=number_format($relevance_count,2,'.','');

        $query->havingRaw("$comparator > $relevance_count");
        $query->orderBy('relevance', 'desc');

        // add bindings to postgres
    }

    /**
     * Returns the search queries for the specified column.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param float $relevance
     * @param array $words
     * @return array
     */
    protected function getSearchQueriesForColumn(Builder $query, $column, $relevance, array $words)
    {
        $queries = [];

        $queries[] = $this->getSearchQuery($query, $column, $relevance, $words, 15);
        $queries[] = $this->getSearchQuery($query, $column, $relevance, $words, 5, '', '%');
        $queries[] = $this->getSearchQuery($query, $column, $relevance, $words, 1, '%', '%');

        return $queries;
    }

    /**
     *
     * Returns the sql string for the given parameters.
     * @param Builder $query
     * @param $column
     * @param $relevance
     * @param array $words
     * @param $relevance_multiplier
     * @param string $pre_word
     * @param string $post_word
     * @return string
     */
    protected function getSearchQuery(Builder $query, $column, $relevance, array $words, $relevance_multiplier, $pre_word = '', $post_word = '')
    {
        $like_comparator = $this->getDatabaseDriver() == 'pgsql' ? 'ILIKE' : 'LIKE';
        $cases = [];

        foreach ($words as $word)
        {
            $cases[] = $this->getCaseCompare($column, $like_comparator, $relevance * $relevance_multiplier);
            $this->search_bindings[] = $pre_word . $word . $post_word;
        }

        return implode(' + ', $cases);
    }

    /**
     * Returns the comparison string.
     *
     * @param string $column
     * @param string $compare
     * @param float $relevance
     * @return string
     */
    protected function getCaseCompare($column, $compare, $relevance) {
        $column = str_replace('.', '`.`', $column);
        $field = "LOWER(`" . $column . "`) " . $compare . " ?";
        return '(case when ' . $field . ' then ' . $relevance . ' else 0 end)';
    }

    /**
     * Adds the bindings to the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $bindings
     */
    protected function addBindingsToQuery(Builder $query, array $bindings) {
        $count = $this->getDatabaseDriver() != 'mysql' ? 2 : 1;
        for ($i = 0; $i < $count; $i++) {
            foreach($bindings as $binding) {
                $type = $i == 0 ? 'select' : 'having';
                $query->addBinding($binding, $type);
            }
        }
    }

    /**
     * Merge our cloned query builder with the original one.
     *
     * @param \Illuminate\Database\Eloquent\Builder $clone
     * @param \Illuminate\Database\Eloquent\Builder $original
     */
    protected function mergeQueries(Builder $clone, Builder $original) {
        $original->from(DB::raw("({$clone->toSql()}) as `{$this->getTable()}`"));
        $original->mergeBindings($clone->getQuery());
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 05.08.2015
 * Time: 1:03
 */

namespace Itway\Services\Social;

use itway\Post;
use RuntimeException;
use Illuminate\Config\Repository;
use Guzzle\Service\Client as GuzzleClient;
use Illuminate\Database\Eloquent\Collection;
use Guzzle\Http\Exception\BadResponseException;
use Guzzle\Http\Message\Request as GuzzleRequest;
use Guzzle\Http\QueryAggregator\DuplicateAggregator;


class Disqus
{

    /**
     * The curl client used for Disqus API interaction
     *
     * @var \Guzzle\Service\Client
     */
    protected $client;

    /**
     * Config repository.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * @param GuzzleClient $client
     * @param Repository $config
     */
    public function __construct(GuzzleClient $client, Repository $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * Get a config item.
     *
     * @param  mixed $key
     * @return mixed
     */
    protected function getConfig($key = null)
    {
        $key = is_null($key) ? '' : '.' . $key;

        return $this->config->get('social.disqus' . $key);
    }

    /**
     * Normalize the given trick(s) to an array of tricks.
     *
     * @param  mixed $tricks
     * @return array
     */
    protected function getValidTricks($posts)
    {
        if ($this->areInvalidTricks($posts)) {
            throw new RuntimeException('Invalid posts');
        }

        if ($posts instanceof Post) {
            $posts = [ $posts ];
        }

        return $posts;
    }

    /**
     * @param $posts
     * @return bool
     */
    protected function areInvalidTricks($posts)
    {
        return ! $posts instanceof Post &&
        ! ($posts instanceof Collection && $posts->count() > 0);
    }

    /**
     * Get a formatted list of the post ids.
     * @param $posts
     * @return array
     */

    protected function getThreadsArray($posts)
    {
        $threads = [];
        $format  = $this->getConfig('threadFormat');

        foreach ($posts as $post) {
            $threads[] = $format . $post->id;
        }

        return $threads;
    }

    /**
     * Prepare the query string before the API request.
     *
     * @param  \Guzzle\Http\Message\Request $request
     * @param  array $tricks
     * @return \Guzzle\Http\Message\Request
     */
    protected function prepareQuery(GuzzleRequest $request, $posts)
    {
        $threads = $this->getThreadsArray($posts);
        $aggregator = $this->getQueryAggregator();

        $request->getQuery()
            ->set('forum', $this->getConfig('forum'))
            ->set('thread', $threads)
            ->set('api_key', $this->getConfig('publicKey'))
            ->setAggregator($aggregator);

        return $request;
    }

    /**
     * @return DuplicateAggregator
     */
    protected function getQueryAggregator()
    {
        return new DuplicateAggregator;
    }

    /**
     * Get the response from the prepared request.
     *
     * @param  \Guzzle\Http\Message\Request $request
     * @return array
     */
    protected function getResponse($request)
    {
        try {
            $response = json_decode($request->send()->getBody(), true);

            return $response['response'];
        } catch (BadResponseException $bre) {
            return null;
        }
    }

    /**
     * Append the comment counts to the given tricks.
     * @param  mixed $tricks
     * @return mixed
     */
    public function appendCommentCounts($posts)
    {
        $posts = $this->getValidTricks($posts);

        $request = $this->prepareQuery($this->client->get(), $posts);
        $response = $this->getResponse($request);

        if (is_null($response)) {
            foreach ($posts as $post) {
                $post->comment_count = 0;
            }
        } else {
            foreach ($response as $comment) {
                foreach ($posts as $post) {
                    if ($post->id == $comment['identifiers'][0]) {
                        $post->comment_count = $comment['posts'];
                        break;
                    }
                }
            }
        }

        return $posts instanceof Collection ? $posts : $posts[0];
    }
}
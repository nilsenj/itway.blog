<?php namespace itway;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Cookie;
use \Illuminate\Http\Request;
use Itway\Contracts\Likeable\Likeable;
use Itway\Traits\Likeable as LikeableTrait;
use Auth;
use File;
use Itway\Traits\Searchable;

class Post extends Model implements SluggableInterface, Likeable{

    use SluggableTrait;
    use \Conner\Tagging\TaggableTrait;
    use \Itway\Traits\ViewCounterTrait;
    use LikeableTrait;
    use Searchable;


    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug'
    );
	protected $fillable = [
        'title',
        'user_id',
        'slug',
        'preamble',
        'image',
        'body',
        'published_at',
        'comment_count',
        'locale',
        'date'
    ];
    protected $searchable = [
        'columns' => [
            'title' => 120,
            'body' => 50000,
            'preamble' => 120,
            'users.Facebook' => 2,
            'users.Twitter' => 2,
            'users.Github' => 2,
            'users.Google' => 2,
            'users.name' => 2,
            'users.bio' => 2,
            'users.email' => 2,

        ],
        'joins' => [
            'users' => ['posts.user_id','users.id']
            ]

    ];
    protected $dates = ['published_at'];

    const imagePath =  'images/posts/';

    public function setPublishedAtAttribute ($date) {

        $this->attributes['published_at'] = Carbon::createFromFormat('Y-m-d', $date);

    }

    public function getLocaledAtAttribute (Request $request) {

        $this->attributes['locale'] = $request->getLocale();

    }

    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeLocaled($query) {

        $query->where('locale', '=', Lang::getLocale());
    }


    public function scopeUsers($query) {

        $query->where('user_id', '=', Auth::id());
    }

    public function scopeUnpublished($query) {
        $query->where('published_at', '>', Carbon::now());
    }

    public function scopeToday($query) {

        $query->where('date', '=', Carbon::today());

    }

    public function setRawAttribute($body) {

        $this->attributes['body'] = htmlspecialchars_decode($body);

    }

    public function user() {

        return $this->belongsTo('itway\User');

    }
    public function picture()
    {
        return $this->belongsToMany(Picture::class);

    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeDrafted($query)
    {
        return $query->where('published_at', '!=' , null);
    }
    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeBySlugOrId($query, $id)
    {
        return $query->where($id)->orWhere('slug', '=', $id);
    }

    /**
     * @param $file
     * @return bool
     */
    public static function deleteImage($file)
    {
        $filepath = self::image_path($file);

        if (file_exists($filepath)) {

            File::delete($filepath);
            return true;
        }
        return false;
    }

    /**
     * @param $file
     * @return string
     */
    public static function image_path($file)
    {
        $imagePath = self::imagePath;
        return public_path("{$imagePath}{$file}");
    }


}

<?php namespace itway\Commands;

use itway\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Auth;
use itway\Events\PostWasCreatedEvent;

class CreatePostCommand extends Command implements SelfHandling {


    public $title;
    public $preamble;
    public $body;
    public $tags_list;
    public $published_at;
    public $localed;

    /**
     * @param $title
     * @param $preamble
     * @param $body
     * @param $tags_list
     * @param $published_at
     * @param $localed
     */
    public function __construct(
            $title,
			$preamble,
            $body,
            $tags_list,
            $published_at,
            $localed)
	{
            $this->title = $title;
			$this->preamble = $preamble;
            $this->body = $body;
            $this->tags_list = $tags_list;
            $this->published_at = $published_at;
            $this->localed = $localed;
	}

    public function handle()

    {
        $post =  Auth::user()->posts()->create([
            'title' => $this->title,
            'preamble' => $this->preamble,
            'body' => $this->body,
            'tags_list' => $this->tags_list,
            'locale' => $this->localed,
            'published_at' => $this->published_at

        ]);

        $post->tag($this->tags_list);

        $post->save();

        event(new PostWasCreatedEvent($post, Auth::user()));

        return $post;
    }
}

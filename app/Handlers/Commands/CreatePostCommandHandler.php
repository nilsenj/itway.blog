<?php namespace itway\Handlers\Commands;

use Illuminate\Http\Request;
use itway\Commands\CreatePostCommand;
use Illuminate\Support\Facades\Auth;
use itway\Events\PostWasCreatedEvent;
use Event;
class CreatePostCommandHandler {


    /**
     * @param CreatePostCommand $command
     * @return mixed
     */
	public function handle(CreatePostCommand $command)

	{
		$post =  Auth::user()->posts()->create([
            'title' => $command->title,
            'preamble' => $command->preamble,
            'body' => $command->body,
            'tags_list' => $command->tags_list,
            'locale' => $command->localed,
            'published_at' => $command->published_at

        ]);

        $post->tag($command->tags_list);

        $post->save();

        $event = new PostWasCreatedEvent($post);

        Event::fire($event);

        return $post;
	}

}

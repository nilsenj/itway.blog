<?php 

namespace Itway\Components\Sidebar;

use Illuminate\Support\Collection;
use itway\Post;
use itway\Job;
use itway\Idea;
use itway\Quiz;
use itway\Team;

trait SidebarTrait {

    protected $posts;


    /**
     * @param Post $posts
     */
	public function __construct(
        Post $posts
    ) {
        $this->posts = $posts;


	}


    public function fetch() {
        return 5;
    }

	public function getLastPosts() {

        return $this->posts->latest('published_at')->published()->localed()->take($this->fetch())->get();


	}
	



	public function formLastModelsCollection() {

        $collection = collect(["posts" => $this->getLastPosts()]);

        return $collection;
	}
} 
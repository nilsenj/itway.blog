<span class="tags">
    <h3 class="text-center text-info">Tags Attached to All Posts</h3>
    @foreach($tags as $tag)
    <a class="tag-name" href="http://www.itway.io/en/blog/tags/{{$tag->name}}"><span>#</span>{{$tag->slug}} | <span class="text-warning">{{$tag->count}}</span></a>
    @endforeach
</span>

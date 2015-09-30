
@foreach($sidebar as $modelName => $modelElement)

    @if($modelName == "posts" && count($modelElement) > 0)
        <div class="sidebar-block">
        <div class="side-title">{{trans('sidebar.blog')}}</div>
        @foreach($modelElement as $post)

                <a href="{!! route('itway::posts::show', $post->id) !!}">{{$post->title}}</a>
            <div class="line"></div>
        @endforeach

        </div>
          @endif

@endforeach
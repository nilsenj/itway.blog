@extends('app')
@section('sitelocation')

    <?php  $name = "Bl"; ?>
    <?php  $msg = "Blog"; ?>

@endsection
@section('styles-add')
@endsection
@section('sidebar.buttons')
    @include('posts.site-btns')
@endsection
@section('content')


    <div class="single-post">
        <div class="head">
            <div class="first-line">
                <div class="l-4 m-4 s-4 xs-4">
                    <div class="post-author pull-left">
                        <img class="avatar" src="@include('includes.user-image', $user = $post->user)" alt=""/>

                        <div class="name"><a href="{{asset(App::getLocale().'/user/'.$post->user->id)}}"> {{ $post->user->name }} </a></div>
                    </div>
                </div>
                <div class="l-4 m-4 s-4 xs-4 text-center tags">
                                <span class="tags">
                                    @foreach($post->tagNames() as $tags)

                                        <a class="tag-name" href="{{url(App::getLocale().'/blog/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>

                                    @endforeach
                                </span>
                </div>
                <div class="l-4 m-4 s-4 xs-4" style=" ">

                    <?php $url = 'likeORdis' ?>
                    {!!Form::open(["id" => "like", "method" => "GET","url" => route($url, array('class_name' => 'post', 'object_id' => $post->id))])!!}
                    <button style="line-height: 40px;" class=" button button-rounded pull-right  tooltip tooltipstered"  @if($post->getLikeCount() !== 0) title="{{$post->getLikeCount()}}"@endif>@if($post->liked(Auth::user()))<i class="icon-heart  text-danger "></i>@else <i class="icon-heart"></i> @endif</button>
                    {!!Form::close()!!}
                    <div class="clearfix"></div>
                        @if($post->liked(Auth::user()))
                            <span class="like-message">{{trans("messages.liked")}}</span>
                        @endif
                </div>
            </div>
            <div class="header-title">
                <h4 class="text-center"><strong>{{$post->title}}</strong></h4>
            </div>

            <div class="time text-center">

                <span class="post-time"><i class="icon-clock-o"></i>{{$post->published_at->diffForHumans()}}</span>

            </div>
            <div class="l-12 m-12 s-12 xs-12 text-center">
                <nav class="button-nav-post button-group-horizontal">
                    <a class="button" href=""><i class="icon-vk text-vk"></i></a>
                    <a class="button" href=""><i class="icon-facebook text-facebook"></i></a>
                    <a class="button" href=""><i class="icon-google text-google"></i></a>
                </nav>
                @if($createdByUser === true)
                    <span class="your-post">{{trans('messages.yourPost')}}</span>
                    <a class="button button-primary" href="{{asset(App::getLocale().'/blog/edit/'.$post->id)}}">{{trans('messages.yourPostBTN')}}</a>
                    <span class="text-muted"> or </span>
                    @include('posts.destroy')

                @endif
            </div>
        </div>
        <div class="line clearfix"></div>
        <div class="image-area">
            <div class="presc-wrapper">
                @if($post->picture())
                    <div class="l-6 m-6 s-6 xs-10"  style="line-height: 1.875rem;
    padding-top: 0.83333rem;
    padding-bottom: 0.83333rem;">
                        <div class="thumbnail" style="border-color: transparent; background: transparent; max-height: 450px;padding: 0; overflow: hidden">
                            @foreach($post->picture()->get() as $picture)
                            <img  class="img-responsive" src="{!! asset('images/posts/' . $picture->path) !!}">
                                @endforeach
                            </div>
                        </div>
                    {{--</div>--}}
                @endif

                <div class="prescription l-6 m-6 s-6 xs-10">
                    <h3>{{$post->preamble}}</h3>
                </div>

            </div>

        </div>
        <div class="clearfix"></div>

        <div class="post-text">{!!$post->body!!}</div>

        <div class="clearfix"></div>
        <div class="counters">

        <span class="comments-count"><i class="icon-comment text-grey"></i>
            <a href="{{ url(App::getLocale().'/blog/post/'.$post->id.'#disqus_thread') }}" data-disqus-identifier="{{$post->id}}" >0</a>
        </span>
            <span class="text-left text-primary" style="">
                <i style="text-align: left; margin: 5px;" class="icon-eye text-grey"></i>
                <span>{{$post->views_count()}}</span>
            </span>
        </div>
    </div>

        <div id="post-author" class="l-12 m-12 s-12 xs-12 bg-white" style="margin-top:5px; margin-bottom: 10px;">
        <h5>{{trans('post-form.author')}}</h5>

        @include('user.user-partial', [$user = $post->user, $notFromProfile = true])

        </div>
    <div class="line"></div>
    <div class="clearfix"></div>
    @if($videos)
    <div id="post-videos" class="l-12 m-12 s-12 xs-12 bg-white" style=" display:block; height:auto; margin-top:5px; padding-bottom: 10px; margin-bottom: 10px;">
            <h5>{{trans('post-form.videos')}}</h5>
            @include('includes.videos', $videos)
        </div>
    <div class="clearfix"></div>
    @endif

    <div class="line"></div>

    <div class="row">
        <div class="l-12 m-12">
            <div id="disqus_thread" class="bg-white single-post"></div>
            <script type="text/javascript">
                var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';
                var disqus_identifier = '{{$post->id}}';
                var disqus_title = '{{ $post->title }}';
                var disqus_url = '{{ url(App::getLocale().'/blog/post/'.$post->id.'#disqus_thread') }}';

                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
            <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
        </div>
    </div>
    <script>
    /* * * DON'T EDIT BELOW THIS LINE * * */
    (function () {
    var s = document.createElement('script'); s.async = true;
    s.type = 'text/javascript';
    s.src = '//' + disqus_shortname + '.disqus.com/count.js';
    (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
    }());


    </script>
@endsection

@section('scripts-add')
    <script>
        var base_url = "{{ route($url, array('class_name' => 'post', 'object_id' => $post->id)) }}", buttonID = $('#like'),
                class_name = "post", object_id = "{{$post->id}}", redirectIFerror = "{{url('/auth/login')}}";

        initLikeORdis(buttonID, base_url,class_name, object_id, redirectIFerror);
    </script>
    @endsection

@stop
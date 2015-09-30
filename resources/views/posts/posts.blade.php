    {{--ul.posts>li*4>.title+img.post-image+nav.button-nav-post.button-group-vertical>a.button.button-info{share}*4+p.post-text{Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur deserunt eos facere quaerat repellat? A ad alias aspernatur cum, dicta in ipsum iusto labore maiores, optio recusandae sed, totam voluptatibus!}+a.read-post.button.button-dark{read-more}--}}

    @section('sidebar.buttons')
    @include('posts.site-btns')
    @endsection

    @if(count($posts)=== 0 )

    @include('errors.nothing')

    @else
            <div class="posts">
                @foreach(array_chunk($posts->getCollection()->all(), 2) as $row)
                    <div class="row" >
                        @foreach($row as $post)
                        <div class="l-6 m-12 s-12 xs-12">

                            <div class="post">
                                <div class="post-author l-6  m-6  s-6 xs-6">
                                    <img class="avatar" src="@include('includes.user-image', $user = $post->user)" alt=""/>
                                    <div class="name">
                                        <a href="{{asset(App::getLocale().'/user/'.$post->user->id)}}">{{ $post->user->name }}</a>
                                    </div>
                                </div>

                                <div class="tag-block  l-6  m-6  s-6 xs-6">
                                    @foreach($post->tagNames() as $tags)
                                        <li class="pull-right tags">
                                            <a class="tag-name" href="{{url(App::getLocale().'/blog/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>
                                        </li>
                                    @endforeach
                                </div>

                                <div class="clearfix"></div>

                                <div class="post-title ">{{str_limit($post->title, 120)}}</div>
<div class="clearfix"></div>

                                <div class="l-11 m-11 s-10 xs-10">
                                    @if($post->picture())
                                        <div class="col-sm-6 col-md-4" style="max-height: 450px; min-height: 300px; padding-top: 5px;">
                                            @foreach($post->picture()->get() as $picture)
                                                <div class="thumbnail" style="border-color: transparent; background: transparent; max-height: 450px;padding: 0; overflow: hidden;">
                                                <img  class="img-responsive" src="{!! asset('images/posts/' . $picture->path) !!}">
                                            </div>
                                            @endforeach
                                        </div>


                                    @endif

                                </div>
                                <nav class="button-nav-post button-group-vertical  l-1 m-1 s-2 xs-2">
                                    <span class="button">
                                        <span class="text-left text-primary" style="position: absolute;left: -10px;">{{$post->views_count()}}</span><i style="text-align: right; margin: -5px;" class="icon-eye"></i></span>
                                    <span class="button">
                                        <a class="text-left text-primary" href="{{ url(App::getLocale().'/blog/post/'.$post->id.'#disqus_thread') }}" data-disqus-identifier="{{$post->id}}" style="position: absolute;left: -10px;">0</a>
                                        <i  style="text-align: right; margin: -5px;"  class="icon-comment"></i>
                                    </span>
                                    <a class="button" href=""><i class="icon-facebook text-facebook"></i></a>
                                    <a class="button" href=""><i class="icon-google text-google"></i></a>
                                    <a class="button" href=""><i class="icon-bookmark text-grey"></i></a>
                                </nav>
                                <div class="clearfix"></div>
                                <p style="padding-top: 10px;" class="post-info">{{str_limit($post->preamble, 200)}}</p>

                                <a class="read-post button button-dark" href="{{url(App::getLocale().'/blog/post/'.$post->id)}}">read-more</a>
                                <span class="post-time pull-left"><i class="icon-clock-o text-warning"></i>{{$post->published_at->diffForHumans()}}</span>
                            </div>

                        </div>
                            @endforeach

                    </div>
<div style="margin-top: 10px;"></div>
                @endforeach
            </div>
    <div class="clearfix"></div>
    @if($posts->hasPages())
        <div class="pagination-wrapper">
            <div class="pagination-wrapper-inner">
                {!! (new itway\Pagination($posts))->render() !!}

            </div>
        </div>
    @endif

        @endif
    @section('scripts-add')
        <script>
            var disqus_shortname = '{{ Config::get("config.disqus_shortname") }}';

            /* * * DON'T EDIT BELOW THIS LINE * * */
            (function () {
                var s = document.createElement('script'); s.async = true;
                s.type = 'text/javascript';
                s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
            }());
        </script>
        @endsection

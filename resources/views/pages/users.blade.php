@extends('app')
@section('sitelocation')

    <?php  $name = 'U'; ?>
    <?php  $msg = "User";  ?>

@endsection
@include('user.site-btns')
@section('content')

    @if (!Auth::check())
        {{Redirect::to('auth/login')}}

    @else
        @foreach(array_chunk($users->getCollection()->all(), 2) as $row)
            <div class="row" >
                @foreach($row as $user)
                    <div class="l-6 m-6 s-12 xs-12">
                        <div class="user">

                            <div class="user-img l-6  m-6  s-6 xs-6">
                                <img class="avatar" src="@include('includes.user-image', $user)" title="{{ $user->name }}" alt="{{ $user->name }}"/>
                                <div class="name">
                                    <a href="{{asset(App::getLocale().'/user/'.$user->id)}}">{{ $user->name }}</a>
                                </div>
                            </div>

                            <div class="tag-block  l-12  m-12  s-12 xs-12">
                                @if(! empty($user->tagNames()))

                                @foreach($user->tagNames() as $tags)
                                    <li class="pull-left tags">
                                        <a class="tag-name" href="{{url(App::getLocale().'/user/tags/'.$tags)}}"><span>#</span>{{$tags}}</a>
                                    </li>
                                @endforeach
                                @else
                                    <h3 class="text-warning text-center">Скилы не указаны</h3>

                                @endif
                            </div>


            <div class="xs-12 s-12 m-12 ">

                <div class="row">
                    <span class="bg-white">
                        <div class="xs-12 s-12 m-12 ">
                            @if(! empty($user->Google) ||  ! empty($user->Facebook) || ! empty($user->Twitter) ||! empty($user->Github))
                                <span class="user-info-title  text-primary text-center">Пользователь в сетях</span>

                                <div class="links-user-block">

                                    @if(! empty($user->Google))

                                        <span class="text-primary">
                        <i class="icon-google text-google"></i>
                                            {{$user->Google}}
                    </span>
                                        <div class="clearfix"></div>
                                    @endif

                                    @if(! empty($user->Facebook))

                                        <span class="text-primary">
                        <i class="icon-facebook text-facebook"></i>
                                            {{$user->Facebook}}
                    </span>
                                        <div class="clearfix"></div>
                                    @endif


                                    @if(! empty($user->Twitter))

                                        <span class="text-primary">
                        <i class="icon-twitter text-twitter"></i>
                                            {{$user->Twitter}}
                    </span>
                                        <div class="clearfix"></div>
                                    @endif
                                    @if(! empty($user->Github))

                                        <span class="text-primary">
                        <i class="icon-github text-github"></i>
                                            {{$user->Github}}
                    </span>
                                    @endif
                                </div>

                                @else
                                <h3 class="text-warning text-center">У пользователя нет данных о его сетях</h3>


                            @endif
                        </div>
                        <div class="xs-12 s-12 m-12">
                            <span class="user-info-title text-primary text-center">Дополнительная информация</span>
                            <div class="additional-user-info">


                        <span>Email: <a href="mailto:{{$user->email}}" target="_top"><span class="text-info"><i class="icon-mail"></i> {{$user->email}}</span></a></span>
                                <div class="clearfix"></div>
                                <span>Последний вход на сайт: <span class="text-info">{{$user->updated_at}}</span></span>

                        </div>
                        </div>
                    </span>
                </div>
            </div>
        </div>
        </div>
                    @endforeach
        </div>
        @endforeach



@stop
@section('styles-add')
    {{--<link rel="stylesheet" href="{{asset('dist\components\tab.css')}}"/>--}}
@endsection
@section('scripts-add')
    {{--<script src="{{asset('dist/components/tab.min.js')}}"></script>--}}
    <script>
        //        $('.nav-tabs li a').tab();
    </script>
@endsection
@endif

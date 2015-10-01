@include('includes.head')

<body class="layout-boxed sidebar-mini skin-black">

@if(\Illuminate\Support\Facades\Auth::guest() || (\Illuminate\Support\Facades\Auth::user() && (\Illuminate\Support\Facades\Auth::user()->banned !== 1)))

@include('includes.navigation')

@if(URL::current() === 'http://'.$_SERVER['SERVER_NAME'].'/'.Lang::getLocale())
@include('pages.landing')
@endif


<div class="container wrapper">
    <div class="content-wrapper">

    @include('includes.notifier-panel')
    {{--<div class="container-fluid">--}}
        {{--@include('includes.subnavigation')--}}
    {{--</div>--}}

<div>
    {{--@include('includes.site-location')--}}
</div>

        <div class="clearfix"></div>

    <div class="container site-buttons">

        {{--@yield('site-btns')--}}
    </div>
        @include('includes.search')
<div  id="container"  class="container" style=" " >

    <div class="l-9 m-8 s-12 xs-12" style="padding-left: 0;">

    @include('flash::message')
    @include('includes.errors')
    @yield('content')
</div>
    @if(URL::current() !== 'http://'.$_SERVER['SERVER_NAME'].'/'.Lang::getLocale())
    <div class="l-3 m-4 hidden-s hidden-xs">
        <div class="row">
            <div class="sidebar">
                @include('includes.language-chooser')

                @yield('sidebar.buttons')

                @include('includes.sidebar')

                </div>
        </div>
    </div>
    @endif

</div>

</div>
</div>

@include('includes.footer')

@include('includes.bottom-navigation')
@else
    <h1 class="text-danger text-center">You are banned</h1>
@endif
</body>
</html>
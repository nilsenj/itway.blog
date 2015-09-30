@include('includes.head')
<body class="layout-boxed sidebar-mini skin-black">
@include('includes.navigation')

@if(URL::current() === 'http://'.$_SERVER['SERVER_NAME'].'/'.Lang::getLocale())
@include('pages.landing')
    @else

<div class="container wrapper">
    <div class="content-wrapper">
    @include('includes.notifier-panel')
    {{--<div class="container-fluid">--}}
        {{--@include('includes.subnavigation')--}}
    {{--</div>--}}

<div>
    {{--@include('includes.site-location')--}}
</div>
@endif
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

</body>
</html>
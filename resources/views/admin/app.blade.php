@include('admin.partials.head')

<body class="layout-boxed sidebar-mini skin-black">
@include('admin.partials.navigation')


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
            @include('includes.search')
            <div  id="container" style="overflow: visible;" class="container" >

                <div class="l-3 m-4 hidden-s hidden-xs">
                    <div class="row">
                        <div class="sidebar">

                            @include('admin.partials.sidebar')

                        </div>
                    </div>
                </div>
                <div class="l-9 m-8 s-12 xs-12" style="padding-right: 0;">

                    @include('flash::message')
                    @include('includes.errors')
                    @yield('content')
                </div>

            </div>

        </div>
    </div>

    @include('includes.footer')
    @include('includes.bottom-navigation')

</body>
</html>
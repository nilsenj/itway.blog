<div class="navigation">

<div class="navbar-fixed-bottom visible-s-inline-block visible-xs-inline-block bg-white">
    @if( Route::currentRouteName('blog'))
        <li><a href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}</a></li>
        <li><a href="{{ url(App::getLocale().'/blog/create') }}" ><i class="icon-pencil"></i> {{ trans('navigation.Create-Post') }}</a></li>
    @else
        <li><a href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}</a></li>
    @endif
   </div>
</div>
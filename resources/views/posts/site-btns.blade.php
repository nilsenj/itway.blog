    @if( Route::currentRouteName('blog'))
        <li><a class="button button-transparent-white" href="{{ url(App::getLocale().'/blog/create') }}" ><i class="icon-pencil"></i> {{ trans('navigation.Create-Post') }}</a></li>
        <li><a class="button button-transparent-white" href="{{ url(App::getLocale().'/blog/user-posts') }}" ><i class="icon-archive"></i> {{ trans('navigation.User-Posts') }} {{$countUserPosts}}</a></li>
    @endif

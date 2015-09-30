        <li><a class="button button-transparent-white" href="{{ url(App::getLocale().'/user/'.Auth::id()) }}" ><i class="icon-pencil"></i> {{ trans('navigation.Profile') }}</a></li>
        <li><a class="button button-transparent-white" href="{{ url(App::getLocale().'/user/settings/'.Auth::id()) }}" ><i class="icon-archive"></i> {{ trans('navigation.Settings') }}</a></li>

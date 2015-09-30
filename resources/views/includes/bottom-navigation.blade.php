<div class="navigation">

<div class="navbar-fixed-bottom visible-s-inline-block visible-xs-inline-block bg-white">
    @if( Route::currentRouteName('blog'))
        <li><a href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}</a></li>
        <li><a href="{{ url(App::getLocale().'/blog/create') }}" ><i class="icon-pencil"></i> {{ trans('navigation.Create-Post') }}</a></li>
    @else
        <li><a href="{{ url(App::getLocale().'/blog') }}" ><i class="icon-pencil-square"></i> {{ trans('navigation.Blog') }}</a></li>
    @endif
    <li><a href="{{ url(App::getLocale().'/inquirer') }}"><i class="icon-list-alt"></i> {{ trans('navigation.Inquirer') }}</a></li>
    <li><a href="{{ url(App::getLocale().'/job-hunting') }}"><i class="icon-briefcase text-right"></i> {{ trans('navigation.Job-Hunt') }}</a></li>
    <li><a href="{{ url(App::getLocale().'/teams') }}"><i class="icon-group text-right"></i>  {{ trans('navigation.Teams') }}</a></li>
    <li><a href="{{ url(App::getLocale().'/idea-show') }}"><i class="icon-bank"></i> {{ trans('navigation.Idea-Share') }}</a></li>
</div>
</div>
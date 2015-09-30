{!! Form::open(["class"=>"language-chooser pull-right l-2 m-2 s-3 xs-3", "style"=>"padding-right:0", "url"=> URL::route('language-chooser'), "method"=>"post"])!!}

    <select name="locale" class="button button-primary hidden" id="locale">

        <option class="button button-primary hidden" value="ru">Russian</option>
        <option class="button button-primary hidden" value="en" {{ Lang::locale() === 'en' ? '' : 'selected'}}>English</option>

    </select>
    <button class="button button-primary pull-right">
        <span class="pull-left language-info">{{ trans('navigation.LangInfo') }}</span>
        <i class="icon-language"></i>
        {{ Lang::locale() === 'en' ? 'ru' : 'en'}} version
    </button>
<?php
    $uri =$_SERVER['REQUEST_URI'];
    $uri = ltrim($uri, '/');
    ?>

    <input type="text" hidden name="url" value="{{$uri}}">

    {{--{!! Form::token() !!}--}}
{!! Form::close() !!}

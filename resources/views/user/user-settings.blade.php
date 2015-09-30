@extends('app')
@section('sitelocation')

    <?php  $name = 'U'; ?>
    <?php  $msg = "User";  ?>

@endsection

@section('sidebar.buttons')
    @include('user.site-btns')
@endsection

@section('content')

    @if (!Auth::check())
        {{Redirect::to(URL::previous())}}

    @else

            <div class="l-12 m-12 s-12 bg-white">

                <h3 class="text-capitalize text-center text-primary">Здесь ваши настройки профиля</h3>

            </div>

            <div class="l-12 m-12 s-12 bg-white">

                {!! Form::model($user,  ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeFullname', 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Полное Имя: {{Auth::user()->name}}</h4>
                        {!! Form::text('name',  $user->name  ,array( 'class' => 'input input-line', 'id' => 'fullname', 'placeholder' => 'пожалуйста введите имя и фамилию')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                        </div>
                    </div>
                </div>

                {!!Form::close()!!}

                {!! Form::model($user,  ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeEmail' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">

                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Email: </h4>


                        {!! Form::email('email', null, array( 'class' => 'input input-line', 'id' => 'email', 'placeholder' => 'введите ваш email')) !!}

                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                        </div>
                    </div>

                </div>
                {!!Form::close()!!}

                {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changePassword' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Пароль:</h4>

                        {!! Form::password('password' ,array( 'class' => 'input input-line', 'id' => 'password', 'placeholder' => 'введите ваш пароль')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
                {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeGoogle' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Google(email) Аккаунт:</h4>

                        {!! Form::text('Google', null, array( 'class' => 'input input-line', 'id' => 'linkToGoogle', 'placeholder' => 'введите ваш google аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                        </div>
                    </div>
                </div>

                {!!Form::close()!!}

                {!!  Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeTwitter' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">

                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Twitter Аккаунт: </h4>

                        {!! Form::text('Twitter',  null, array( 'class' => 'input input-line', 'id' => 'linkToTwitter', 'placeholder' => 'введите ваш twitter аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' ))!!}
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
                {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id],'id' => 'changeFacebook' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Facebook Аккаунт: </h4>

                        {!! Form::text('Facebook',  null, array( 'class' => 'input input-line', 'id' => 'linkToFacebook', 'placeholder' => 'введите ваш facebook аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}</div>
                    </div>

                </div>
                {!!Form::close()!!}


                {!! Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'changeGithub' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                        <h4 class="text-info ">Изменить Github Аккаунт: </h4>

                        {!! Form::text('Github', null, array( 'class' => 'input input-line', 'id' => 'linkToGithub', 'placeholder' => 'введите ваш github аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}

                        </div>

                    </div>
                </div>

                {!!Form::close()!!}

                {!!Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'tags' , 'class' => 'form', 'role' =>  'form'])!!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                        <h4 class="text-info ">Ваши скилы: </h4>
                    <div data-tags-input-name="tags_list" id="tagBox" ></div>
                        <div class="pull-right">

                            {!! Form::submit('Добавить', array( 'class' => 'button button-default' )) !!}
                        </div>
                </div>

                </div>
                </div>
            {!!Form::close()!!}

            <div class="l-12 m-12 s-12 bg-white">
            {!!Form::model($user, ['method' => 'PATCH', 'action' => ['UserController@update', $user->id], 'id' => 'about-user' , 'class' => 'form', 'role' =>  'form'])!!}

                <div class="form-group">

                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                        <h4 class="text-info ">Можете добавить данные о себе</h4>
                        <div class="pos-rel">
                            <div class="input-count">left <span id="counter1"></span> symbols.</div>
                        </div>
                        {!!Form::textarea('bio',  null, ['class'=>'input input-line', 'rows'=> '3',  'id'=>'about-yourself'])!!}

                        <span class="help-block">Все что вы здесь напишете будет представлено в простом текстовом виде</span>

                    <div class="pull-right">

                    {!! Form::submit('Добавить', array( 'class' => 'button button-default' )) !!}
                    </div>

                </div>
                </div>
                {!!Form::close()!!}
            </div>

            {{--<div class="row">--}}
                {{--<div class="l-10 l-offset-1 m-10 m-offset-1 s-10 s-offset-1 xs-11 xs-offset-1">--}}
                    {{--<div class="form-group">--}}
                        {{--{!!Form::model($user, [ 'id' => 'about-user' , 'class' => 'form', 'role' =>  'form'])!!}--}}

                        {{--<div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">--}}
                            {{--<h4>Можете добавить данные о себе</h4>--}}

                            {{--{!!Form::textarea('about-yourself',  null, ['class'=>'input input-line', 'rows'=> '3',  'id'=>'about-yourself'])!!}--}}
                            {{--<span class="help-block">Все что вы здесь напишете будет представлено в простом текстовом виде</span>--}}
                        {{--</div>--}}
                        {{--<div class="clearfix"></div>--}}
                        {{--{!! Form::submit('Добавить', array( 'class' => 'button button-primary' )) !!}--}}

                        {{--{!!Form::close()!!}--}}
                        {{--<div class="clearfix"></div>--}}

                    {{--</div>--}}

                    {{--<p class="post-article">--}}
                    {{--<h1></h1>--}}
                    {{--Я отличный разработчик интерфейсов, люблю Gulp, Sass, Laravel, Bootstrap--}}
                    {{--<h1></h1>--}}
                    {{--</p>--}}
                {{--</div>--}}

            {{--</div>--}}




@stop
@section('styles-add')
    {{--<link rel="stylesheet" href="{{asset('dist\components\tab.css')}}"/>--}}
@endsection
@section('scripts-add')
    {{--<script src="{{asset('dist/components/tab.min.js')}}"></script>--}}
    <script>
        $('#about-yourself').simplyCountable({
            counter:            '#counter1',
            countType:          'characters',
            maxCount:           450,
            strictMax:          true,
            countDirection:     'down',
            safeClass:          'safe',
            overClass:          'over',
            thousandSeparator:  ',',
            onOverCount:        function(count, countable, counter){},
            onSafeCount:        function(count, countable, counter){},
            onMaxCount:         function(count, countable, counter){}
        });
//        $('#preamble').simplyCountable({
//            counter:            '#counter2',
//            countType:          'characters',
//            maxCount:           300,
//            strictMax:          true,
//            countDirection:     'down',
//            safeClass:          'safe',
//            overClass:          'over',
//            thousandSeparator:  ',',
//            onOverCount:        function(count, countable, counter){},
//            onSafeCount:        function(count, countable, counter){},
//            onMaxCount:         function(count, countable, counter){}
//        });
        var tag_options = {
            "no-duplicate": true,
            "no-duplicate-callback": window.alert,
            "no-duplicate-text": "Duplicate tags",
            "type-zone-class": "type-zone",
            "tag-box-class": "tagging",
            "edit-on-delete": false,
            "forbidden-chars": [",", ".", "_", "?"]
        };
        var tagBox = $("#tagBox");
        tagBox.tagging(tag_options);
        $('.type-zone').attr('placeholder' ,'at least one tag');
        @if(Route::currentRouteName() === 'itway::user::settings')

        @include('user.updateFormScript')
        @endif
    </script>
@endsection
@endif

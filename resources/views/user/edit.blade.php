<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="profile">

        <div class="row">
            <div class="l-10 l-offset-1 m-10 m-offset-1 s-10 s-offset-1 xs-11 xs-offset-1">
                <h4>Можете добавить данные о себе</h4>
                <div class="form-group">
                    {!!Form::model($user, [ 'id' => 'about-user' , 'class' => 'form', 'role' =>  'form'])!!}

                    <div class="l-12">

                        {!!Form::textarea('about-yourself',  null, ['class'=>'input input-line', 'rows'=> '3',  'id'=>'about-yourself'])!!}
                        <span class="help-block">Все что вы здесь напишете будет представлено в простом текстовом виде</span>
                    </div>
                    <div class="clearfix"></div>
                    {!! Form::submit('Добавить', array( 'class' => 'button button-primary' )) !!}

                    {!!Form::close()!!}
                    <div class="clearfix"></div>

                </div>

                <p class="post-article">
                <h1></h1>
                Я отличный разработчик интерфейсов, люблю Gulp, Sass, Laravel, Bootstrap
                <h1></h1>
                </p>
            </div>

        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="settings">
        <fieldset>
            <div class="l-12 m-12 s-12">

                <h3 class="text-capitalize text-center text-warning">Здесь ваши настройки профиля</h3>

            </div>

            <div class="l-12 m-12 s-12 ">

                {!! Form::model($user,  ['class' => 'form card-material-lightgrey', 'method' => 'PATCH',  'role' =>  'form', 'route' => ['itway::user::update', $user->id]]) !!}

                <div class="form-group">



                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info">Изменить nickname: {{$user->slug}}</h4>



                        {!! Form::text('nickname', $user->slug, ['class' => 'input input-line', 'placeholder' => 'пожалуйста введите свой nick']) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                        </div>

                    </div>
                </div>

                {!!Form::close()!!}

                {!! Form::model($user,  [ 'id' => 'changeFullname' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Полное Имя: {{Auth::user()->name}}</h4>
                        {!! Form::text('fullname',  $user->name  ,array( 'class' => 'input input-line', 'id' => 'fullname', 'placeholder' => 'пожалуйста введите имя и фамилию')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                        </div>
                    </div>
                </div>

                {!!Form::close()!!}
                {!! Form::model($user,  [ 'id' => 'changeEmail' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

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

                {!! Form::model([ 'id' => 'changePassword' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

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
                {!! Form::model([ 'id' => 'changeGoogle' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Google Аккаунт:</h4>

                        {!! Form::text('linkToGoogle', null, array( 'class' => 'input input-line', 'id' => 'linkToGoogle', 'placeholder' => 'введите ваш google аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}
                        </div>
                    </div>
                </div>

                {!!Form::close()!!}

                {!!  Form::model($user, [ 'id' => 'changeTwitter' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">

                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Twitter Аккаунт: </h4>

                        {!! Form::text('linkToTwitter',  null, array( 'class' => 'input input-line', 'id' => 'linkToTwitter', 'placeholder' => 'введите ваш twitter аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' ))!!}
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
                {!! Form::model($user, [ 'id' => 'changeFacebook' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1">
                        <h4 class="text-info ">Изменить Facebook Аккаунт: </h4>

                        {!! Form::text('linkToFacebook',  null, array( 'class' => 'input input-line', 'id' => 'linkToFacebook', 'placeholder' => 'введите ваш facebook аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}</div>
                    </div>

                </div>
                {!!Form::close()!!}
                {!! Form::model($user, [ 'id' => 'changeGithub' , 'class' => 'form card-material-lightgrey', 'role' =>  'form']) !!}

                <div class="form-group">
                    <div class="s-10 xs-10 l-offset-1 m-offset-1 s-offset-1 xs-offset-1 ">
                        <h4 class="text-info ">Изменить Github Аккаунт: </h4>

                        {!! Form::text('linkToGithub', null, array( 'class' => 'input input-line', 'id' => 'linkToGithub', 'placeholder' => 'введите ваш github аккаунт')) !!}
                        <div class="pull-right">
                            {!! Form::submit('Изменить', array( 'class' => 'button button-default' )) !!}

                        </div>

                    </div>
                </div>

                {!!Form::close()!!}



            </div>
        </fieldset>

    </div>
</div>
{!!Form::model($user, [ 'id' => 'changeImage' , 'class' => 'form', 'role' =>  'form','files' => true, 'route' => ['itway::user::photo']])!!}
<div class="">
    {{--<span for="inputFile" class="l-12 control-span">Найти файл</span><br/>--}}
    <div class="l-12">
        <input type="text" readonly="" class="hidden" >
        <div class="clearfix"></div>
        <label for="file">
        {{trans('profile.user_press_to_down')}}
        </label>
        {!! Form::file('photo', ['id' => 'file', 'class' => 'text-primary', 'placeholder' => 'insert your post image here      (max: 1 )',  'multiple'=>'false' , 'hidden']) !!}

    </div>
</div>
<div class="clearfix"></div>
{!!Form::submit(trans('profile.user_download'), ['class' => 'button button-primary button-block'])!!}
{!!Form::close()!!}
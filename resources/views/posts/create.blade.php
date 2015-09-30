@extends('app')
@section('sitelocation')

    <?php  $name = 'CP'; ?>
    <?php  $msg = "CreatePost";  ?>

@endsection
@section('sidebar.buttons')
    @include('posts.site-btns')
@endsection
@section('content')


    <div class="bg-white" style="  display: flex;">

    {!! Form::model( $postInstance = new itway\Post, ['url' => App::getLocale().'/blog/store', 'class' => 'form', 'id' => 'post-form', 'files' => true ] ) !!}

    @include('includes.post-form', ['submitButton' => 'Create Post'])

    {!! Form::close() !!}
</div>

@endsection

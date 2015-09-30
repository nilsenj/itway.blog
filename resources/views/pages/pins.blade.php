@extends('app')
@section('title')

@endsection

@section('meta_description')

@endsection

@section('meta_keywords')

@endsection

@section('sitelocation')

    <?php  $name = 'Pn'; ?>
    <?php  $msg = "Pins";  ?>

@endsection


@section('content')

    @include('posts.posts', $posts)


@endsection
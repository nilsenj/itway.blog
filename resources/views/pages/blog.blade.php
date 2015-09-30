
@extends('app')
@section('sitelocation')

    <?php  $name = 'Bl'; ?>
    <?php  $msg = "Blog";  ?>

@endsection



@section('content')

    @include('posts.posts')

@endsection


@stop

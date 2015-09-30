
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

{{--{{dd($user)}}--}}
        <div class="l-12 bg-white">
@include('user.user-partial')
        </div>


@stop
@section('styles-add')
    {{--<link rel="stylesheet" href="{{asset('dist\components\tab.css')}}"/>--}}
    @endsection
@section('scripts-add')
    {{--<script src="{{asset('dist/components/tab.min.js')}}"></script>--}}
    <script>
//        $('.nav-tabs li a').tab();
    </script>
    @endsection
@endif

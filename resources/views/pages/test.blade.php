{{--@extends('app')--}}
{{--@section('sitelocation')--}}

    {{--<?php  $name = 'Jb'; ?>--}}
    {{--<?php  $msg = "Job";  ?>--}}

{{--@endsection--}}


{{--@section('content')--}}
    <p id="power">0</p>
{{--@endsection--}}
@section('scripts-add')
    <script src="{{ asset('dist/vendor/socket.io-client/socket.io.js') }}"></script>
    <script>
        //var socket = io('http://localhost:3000');
        var socket = io('http://www.itway.io:6378');
        socket.on("test-channel:itway\\Events\\EventName", function(message){
            // increase the power everytime we load test route
            $('#power').text(parseInt($('#power').text()) + parseInt(message.data.power));
        });
    </script>
    @endsection
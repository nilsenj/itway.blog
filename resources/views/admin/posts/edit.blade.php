@extends('admin/app')

<h1>
    @section('contentheader_title')
        Изменить пост
        &middot;
    @endsection

    @section('contentheader_description')

        <b>{!! link_to_route('admin::posts::index', 'Назад') !!}</b>

    @endsection
</h1>
@section('main-content')

    <div>

        @include('admin.posts.form')

    </div>
@endsection
@stop
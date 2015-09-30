@extends('admin/app')

<h1>
    @section('contentheader_title')
        Добавить новую привилегию
        &middot;
    @endsection

    @section('contentheader_description')

        <b>{!! link_to_route('admin::permissions::index', 'Назад') !!}</b>

    @endsection
</h1>
@section('main-content')

    <div>

@if(isset($model))

    {!! Form::model($model, ['method' => 'PUT', 'files' => true, 'route' => ['admin::permissions::update', $model->id]]) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'admin::permissions::store']) !!}
@endif

@include('admin.permissions.form')
{!! Form::close() !!}
    </div>
@endsection
@stop
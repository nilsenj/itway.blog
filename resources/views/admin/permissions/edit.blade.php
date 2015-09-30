@extends('admin/app')

<h1>

    @section('contentheader_title')
        Изменить Роль
        &middot;
    @endsection
    @section('contentheader_description')

        <b>{!! link_to_route('admin::permissions::index', 'Назад') !!}</b>
    @endsection
</h1>

@section('main-content')

    <div>

        @if(isset($permission))

            {!! Form::model($permission, ['method' => 'PATCH', 'files' => true, 'action' => ['PermissionsController@update', $permission->slug]]) !!}

        @else
            {!! Form::open(['files' => true, 'route' => 'admin::permissions::store']) !!}
        @endif

        @include('admin.permissions.form')
        {!! Form::close() !!}
    </div>
@endsection
@stop
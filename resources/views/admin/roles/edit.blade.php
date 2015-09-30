@extends('admin/app')

<h1>

    @section('contentheader_title')
        Изменить Роль
        &middot;
    @endsection
    @section('contentheader_description')

        <b>{!! link_to_route('admin::roles::index', 'Назад') !!}</b>
    @endsection
</h1>

@section('main-content')

    <div>

        @if(isset($role))

            {!! Form::model($role, ['method' => 'PATCH', 'files' => true, 'action' => ['RolesController@update', $role->slug]]) !!}

        @else
            {!! Form::open(['files' => true, 'route' => 'admin::roles::store']) !!}
        @endif

        @include('admin.roles.form')
        {!! Form::close() !!}
    </div>
@endsection
@stop
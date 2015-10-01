@extends('admin/app')


@section('content')
    <span class="admin-head-title">
        Change user settings
        &middot;
        <b>{!! link_to_route('admin::users::index', 'Back') !!}</b>
    </span>
    <div class="admin-block">
        @include('admin.users.form', array('model' => $user) + compact('role'))
    </div>

@endsection
@stop
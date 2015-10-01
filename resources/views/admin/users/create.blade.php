@extends('admin/app')


@section('content')
    <span  class="admin-head-title">
        Create new user
        &middot;
        <b>{!! link_to_route('admin::users::index', 'Back') !!}</b>

    </span>
    <div class="admin-block">
        @include('admin.users.form')
    </div>

@endsection
@stop
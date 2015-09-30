@extends("admin/app")

@section("main-content")

@section('breadcrumb')

    {!! Breadcrumbs::render('admin') !!}


@endsection

@include("admin.partial._dash")

@endsection
@section("scripts-add")



@endsection
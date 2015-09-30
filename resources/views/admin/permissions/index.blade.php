@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('permissions', 'Привилегии') !!}
    @endsection
    @section('contentheader_title')

        Количество привилегий ({!! \App\Permission::all()->count() !!})
        &middot;
    @endsection
    @section('contentheader_description')
        <b>{!! link_to_route('admin::permissions::create', 'Добавить новую привилегию') !!}</b>
    @endsection
</h1>

@section('main-content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список привилегий товара</h3>
                    <div class="box-tools">
                        <form action="#" method="get" class="input-group" style="width: 150px;">
                            <input type="text" name="q" class="form-control input-sm pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </form>

                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
        <thead>
        <th>№</th>
        <th>Название</th>
        <th>Alias</th>
        <th>Описание</th>
        <th>Создана</th>
        <th class="text-center">Действия</th>
        </thead>
        <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td>{!! $no !!}</td>
                <td>{!! $permission->name !!}</td>
                <td>{!! $permission->slug !!}</td>
                <td>{!! $permission->description !!}</td>
                <td>{!! $permission->created_at !!}</td>
                <td class="text-center">
                    <a href="{!! route('admin::permissions::edit', $permission->slug) !!}">Edit</a>
                    &middot;
                    {{--@include('admin::partials.modal', ['data' => $role, 'name' => 'roles'])--}}
                </td>
            </tr>
            <?php $no++ ;?>
        @endforeach
        </tbody>
    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <div class="text-center">
        {!! (new App\Pagination($permissions))->render() !!}
        {{--{!! pagination_links($categories) !!}--}}
    </div>


@endsection

@stop
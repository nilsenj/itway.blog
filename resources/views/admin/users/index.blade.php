@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('users', 'Пользователи') !!}
    @endsection
    @section('contentheader_title')

        Количество пользователей ({!! \App\User::all()->count() !!})
        &middot;
    @endsection
    @section('contentheader_description')
        <b>{!! link_to_route('admin::users::create', 'Добавить нового пользователя') !!}</b>
    @endsection
</h1>

@section('main-content')

    @if(isset($search))
        @include('admin::users.search-form')
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Список пользователей магазина</h3>
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
        <th>Имя</th>
        <th>Email</th>
        <th>Создан</th>
        <th>Роль</th>
        <th class="text-center">Действия</th>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{!! $no !!}</td>
                <td>{!! $user->name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->created_at !!}</td>
                <td>
                    @foreach ($user->roles()->get() as $role)
                        {{ $role->name }}
                    @endforeach</td>
                <td class="text-center">
                    <a href="{!! route('admin::users::edit', $user->slug) !!}">Изменить</a>
                    &middot;
                    {{--@include('admin::partials.modal', ['data' => $user, 'name' => 'users'])--}}
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
        {!! (new App\Pagination($users))->render() !!}
    </div>
    @endsection
@stop
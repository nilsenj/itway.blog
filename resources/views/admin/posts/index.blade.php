@extends('admin/app')
<h1>
    @section('breadcrumb')
        {{--{!! Breadcrumbs::render('admin') !!}--}}

        {!! Breadcrumbs::render('goods', 'Товар') !!}
    @endsection
    @section('contentheader_title')

        Количество товаров ({!! \App\Good::all()->count() !!})
        &middot;
    @endsection
    @section('contentheader_description')

        <b>{!! link_to_route('admin::goods::create', 'Добавить новый товар') !!}</b>

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
        <th>No</th>
        <th>Title</th>
        <th>Author</th>
        <th>Category</th>
        <th>Price</th>
        <th>Created At</th>
        <th class="text-center">Action</th>
        </thead>
        <tbody>
        @foreach ($goods as $good)


            <tr>
                <td>{!! $no !!}</td>
                <td>{!! $good->title !!}</td>
                <td>{!! $good->user->name !!}</td>
                <td>
                    @foreach ($good->category()->get() as $category)
                        {{ $category->name }}
                    @endforeach
                    {{--{!!$good->category()->get('name')!!}--}}
                </td>
                <td>{!! $good->price ? $good->price : null !!}</td>
                <td>{!! $good->created_at !!}</td>
                <td class="text-center">
                        <a href="{!! route('admin::goods::edit', $good->id) !!}">Edit</a>
                        &middot;
                        {{--@include('admin::partials.modal', ['data' => $good, 'name' => 'goods'])--}}

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
        {!! (new App\Pagination($goods))->render() !!}
        {{--{!! pagination_links($categories) !!}--}}
    </div>
@endsection
@stop
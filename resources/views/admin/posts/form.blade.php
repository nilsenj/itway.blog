
    @if(isset($post))
        {!! Form::model($post, ['method' => 'PATCH', 'files' => true, 'route' => ['admin::goods::update', $post->id]]) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'admin::goods::store']) !!}
    @endif
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
    {!! $errors->first('title', '<div class="text-danger">:message</div>') !!}
</div>

    <div class="form-group">
        {!! Form::label('fileupload', 'Нажмите загрузить фото',['class' => 'filelabel']) !!}
        @if(isset($pictures))
            {!! Form::file('image[]', ['id' => 'fileupload' ,'value'=> $pictures,'class' => 'file-input', 'multiple'=>'true']) !!}
        @else
            {!! Form::file('image[]', ['id' => 'fileupload', 'class' => 'file-input', 'multiple'=>'true']) !!}
        @endif
        {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}
    </div>
    <div class="form-group p">
    @if(isset($post))

            @if($post->picture())
                @foreach ($pictures as $picture)
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">

                            <img class="img-responsive" src="{!! asset('images/goods/' .  $picture->path) !!}">


                        </div>
                    </div>
                @endforeach

            @endif

    @endif
    </div>
    <div class="clearfix"></div>
<div class="form-group">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
    {!! $errors->first('slug', '<div class="text-danger">:message</div>') !!}
</div>
    <div class="form-group">
        {!! Form::label('category_id', 'Category:') !!}
        {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        {!! $errors->first('category_id', '<div class="text-danger">:message</div>') !!}
    </div>

<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control', 'id' => 'ckeditor']) !!}
    {!! $errors->first('body', '<div class="text-danger">:message</div>') !!}
</div>
    <div class="form-group">
        {!! Form::label('price', 'Price:') !!}
        {!! Form::text('price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<div class="text-danger">:message</div>') !!}
    </div>

<div class="form-group">
    {!! Form::submit(isset($post) ? 'Изменить' : 'Сохранить', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
    <style>
        #fileupload::-webkit-file-upload-button {
            visibility: hidden;
            content: '';
            -webkit-appearance: none!important;
        }

        .filelabel::before {
            display: inline-block;
            background:transparent;
            border-radius: 3px;
            outline: none;
            content: '';
            white-space: nowrap;
            -webkit-user-select: none;
            cursor: pointer;
            text-shadow: 1px 1px #fff;
            font-weight: 700;
            -webkit-appearance: none!important;
            font-size: 10pt;
        }
        .filelabel::after {
            content: '';
            padding-bottom: 10px;

        }
        .filelabel:hover::before {
            border-color: black;
        }
        .filelabel:active {
            background:  #dddddd;
        }
        .filelabel {
            width: 100%;
            background: #ffffff;
            -webkit-appearance: none!important;
            padding: 10px 8px;
            margin: 10px auto!important;
            text-align: center;
        }

        #fileupload {
            width: 100%;
            background: #ffffff;
            -webkit-appearance: none!important;
            visibility: hidden;
            height: 0;
        }
    </style>
    @section('scripts-add')
        <script>
            // render the image in our view
            function renderImage(file) {

                // generate a new FileReader object
                var reader = new FileReader();
                var image = new Image();

                reader.onload = function (_file) {
                    image.src = _file.target.result;              // url.createObjectURL(file);
                    image.onload = function () {
                        var w = this.width,
                                h = this.height,
                                t = file.type,                           // ext only: // file.type.split('/')[1],
                                n = file.name,
                                s = ~~(file.size / 1024)/1024;
                        console.log(s);
                        $('.p').append("<div class='col-sm-6 col-md-4'><div class='thumbnail'><img src='" + image.src + "' /><div class='caption'> <h4>"+ s.toFixed(2) +" Mb </h4></div></div> </div>");
                    };
                    image.onerror = function () {
                        alert('Invalid file type: ' + file.type);
                    };
                };
                reader.readAsDataURL(file);

            };
                // when the file is read it triggers the onload event above.

            // handle input changes
            $("#fileupload").change(function(e) {

                console.log(this.files)

                $('.p').html('');
                if(this.disabled) return alert('File upload not supported!');
                var F = this.files;
                if(F && F[0]) for(var i=0; i<F.length; i++) renderImage( F[i] );

            });

</script>
        @endsection
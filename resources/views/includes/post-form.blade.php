<div class="l-12 m-12 s-12">
    <h3 class="label titl">{{trans('post-form.title')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        {!! Form::text('title', null, ['class' => 'input input-line', 'id' => 'title','placeholder' => 'insert your title here      (max:120)'])!!}
    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="counter1"></span> symbols.</div>
    </div>
    <h3 class="label titl">{{trans('post-form.preamble')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        {!! Form::textarea('preamble', null, ['class' => 'input input-line', 'id' => 'preamble','rows' => '3', 'placeholder' => 'insert your preamble here      (max:300)'])!!}
    </div>
    <div class="pos-rel">
        <div class="input-count">left <span id="counter2"></span> symbols.</div>
    </div>
    <h3 class="label titl">{{trans('post-form.img')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        <label for="fileupload" class="filelabel custom-file-input button button-primary button-block" style="margin: 0 auto!important;">
            <i class="icon-file"></i>
        </label>
        {!! Form::file('image', ['id' => 'fileupload','class' => 'file-input',  'placeholder' => 'insert your post image here      (max: 1 )']) !!}
    </div>


    <div class="clearfix"></div>

    {!! $errors->first('image', '<div class="text-danger">:message</div>') !!}

    <div class="row">
        <div class="form-group p">
            @if(isset($post))

                @if($post->picture())
                        <div class="s-12 m-10 l-10 l-offset-1 m-offset-1">
                            <div class="thumbnail" style='background: #ffffff'>
                                @foreach($picture as $pic)
                                    <img  class="img-responsive" style="" src="{!! asset('images/posts/' . $pic->path) !!}">
                                @endforeach

                            </div>
                        </div>

                @endif

            @endif

        </div>

    </div>


    <h3 class="label">{{trans('post-form.post body')}}</h3>
    <div class="clearfix"></div>
    <div class="form-group">
        {!! Form::textarea('body', null, [ 'cols' => '80', 'rows'=>'10',  'id' => 'editor', 'class' => 'ckeditor input input-line',  'placeholder' => 'Please write your post!'])!!}
    </div>

    <h3 class="label">{{trans('post-form.publish on')}}</h3>
    <div class="clearfix"></div>
    @if(isset($postInstance))
        <div class="form-group">
{{--{{--}}
{{--$dateIn = explode(" ", $post->published_at)--}}
{{--}}--}}
            {!! Form::input('date', 'published_at', $postInstance->published_at ?  explode(" ",$postInstance->published_at)[0]: date('Y-m-d') , ['class'=> 'input input-line'])!!}
        </div>
    @else
        <div class="form-group">
            {!! Form::input('date', 'published_at', $post->published_at ? explode(" ", $post->published_at)[0] : date('Y-m-d') , ['class'=> 'input input-line'])!!}
        </div>
    @endif
    <h3 class="label">{{trans('post-form.tags')}}</h3>
    <div class="clearfix"></div>

    <div class="form-group">
        {{--{!! Form::select('tags_list[]', $tags, null, ['id' => 'tag_select', 'class'=> 'form input input-line l-12 hidden','style'=>'width:100%', 'multiple'])!!}--}}
        {{--{{dd($post)}}--}}
        {{--@if(isset($tags))--}}

       {{--<div data-tags-input-name="tags_list" id="tagBox" >@for($i = 0; $i < count($tags); $i++)--}}
               {{--{{$tags[$i]}}--}}
               {{--</div>--}}
           {{--@endfor</div>--}}
        {{--@else--}}
            <div data-tags-input-name="tags_list" id="tagBox" ></div>
    {{--@endif--}}
    </div>

    <div class="form-group">
        {!! Form::submit($submitButton, ['class' => 'confirm button button-primary'])!!}
    </div>



</div>
@section('styles-add')
    <link rel="stylesheet" href="{{ asset('vendor/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
@endsection
@section('scripts-add')
    <script src="{{ asset('dist/vendor/pickadate/lib/picker.js') }}"></script>
    <script src="{{ asset('dist/vendor/pickadate/lib/picker.date.js') }}"></script>
    <script src="{{ asset('dist/vendor/pickadate/lib/picker.time.js') }}"></script>
    <script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
    {{--<script src="{{asset('vendor/ckeditor/config.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('vendor/ckeditor/adapters/jquery.js')}}"></script>
    <script>
//        $(function() {
//            $('#fileupload').imgPreview();
//        });
            $('#title').simplyCountable({
                counter:            '#counter1',
                countType:          'characters',
                maxCount:           120,
                strictMax:          true,
                countDirection:     'down',
                safeClass:          'safe',
                overClass:          'over',
                thousandSeparator:  ',',
                onOverCount:        function(count, countable, counter){},
                onSafeCount:        function(count, countable, counter){},
                onMaxCount:         function(count, countable, counter){}
            });
            $('#preamble').simplyCountable({
                counter:            '#counter2',
                countType:          'characters',
                maxCount:           300,
                strictMax:          true,
                countDirection:     'down',
                safeClass:          'safe',
                overClass:          'over',
                thousandSeparator:  ',',
                onOverCount:        function(count, countable, counter){},
                onSafeCount:        function(count, countable, counter){},
                onMaxCount:         function(count, countable, counter){}
            });
        var tag_options = {
            "no-duplicate": true,
            "no-duplicate-callback": window.alert,
            "no-duplicate-text": "Duplicate tags",
            "type-zone-class": "type-zone",
            "tag-box-class": "tagging",
            "edit-on-delete": false,
            "forbidden-chars": [",", "_", "?"]
        };
        var tagBox = $("#tagBox");
        tagBox.tagging(tag_options);
       $('.type-zone').attr('placeholder' ,'at least one tag');
@if(url(App::getLocale().'/blog/create') !== Request::url())
@include('posts.updateFormScript')
@endif
    $('.datepicker').pickadate();

        //        var config = {
        //
        //        };
        //
        //      config.extraPlugins = 'codesnippet';
        //      config.extraPlugins = 'autosave';
        //      config.codeSnippet_theme = 'mono-blue';
        //      config.uiColor = 'transparent';
        //      config.width = '100%';
        //      config.resize_enabled  = true;
        //      config.placeholder = 'Please write your post!';
        //      config.skin = 'minimalist';
        //      config.allowedContent = true;
        //      config.height = 400;

        var config = {
            language: '{{App::getLocale()}}'
        };
        CKEDITOR.replace('editor',config);

        $('form').on('submit', function(){

            var editor_data = CKEDITOR.instances.editor.getData();
            $('#editor').val(editor_data);

        });
        CKEDITOR.on('instanceReady', function(){
            $.each( CKEDITOR.instances, function(instance) {

                CKEDITOR.instances[instance].on("instanceReady", function() {
                    this.document.on("keyup", CK_jQ);
                    this.document.on("paste", CK_jQ);
                    this.document.on("keypress", CK_jQ);
                    this.document.on("blur", CK_jQ);
                    this.document.on("change", CK_jQ);
                });
            });

        });

        function CK_jQ() {
            for ( instance in CKEDITOR.instances ) { CKEDITOR.instances[instance].updateElement(); }
        }


    </script>

@endsection
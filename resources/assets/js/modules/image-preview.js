(function($) {

    //$.fn.imgPreview = function(options) {
    //
    //    var settings = $.extend({
    //        thumbnail_size:460,
    //        thumbnail_bg_color:"#ddd",
    //        thumbnail_border:"1px solid #fff",
    //        thumbnail_shadow:"0 0 0px rgba(0, 0, 0, 0.5)",
    //        label_text:"",
    //        warning_message:"Not an image file.",
    //        warning_text_color:"#f00",
    //        input_class:'custom-file-input button button-primary button-block'
    //    },options);
    //
    //    $(this).each(function() {
    //        if(typeof FileReader == "undefined") return true;
    //
    //        var elem = $(this);
    //        var scaleWidth = settings.thumbnail_size * 1;
    //        var fileInput = $('<input>').attr({
    //            type:"file",
    //            name:elem.attr("name")
    //        }).bind('change', function(e) {
    //            doImgPreview(e);
    //        });
    //        var form = elem.parent();
    //
    //        while(!form.is("form")) {
    //            form = form.parent();
    //        }
    //
    //        form.bind('submit', function(e) {
    //            e.stopImmediatePropagation();
    //            if($('.image-error', form).length > 0) {
    //                alert("Please select a valid image file.");
    //                return false;
    //            }
    //        });
    //
    //        if(elem.prev().is("label")) {
    //            var labelText = elem.prev().text();
    //            elem.prev().remove();
    //        } else {
    //            var labelText = settings.label_text;
    //        }
    //
    //        var newFileInput = $('<div>')
    //            .addClass('image-preview-wrapper')
    //            .css({
    //                "box-sizing": "border-box",
    //                "position": "relative",
    //                "-moz-box-sizing": "border-box",
    //                "-webkit-box-sizing": "border-box",
    //                "padding":"0.5em 2em",
    //                "overflow": "hidden",
    //                "margin":"0 auto"
    //            })
    //            .append($('<div>')
    //                .addClass('image-preview').css({
    //                    "box-sizing": "border-box",
    //                    "position": "relative",
    //                    "-moz-box-sizing": "border-box",
    //                    "-webkit-box-sizing": "border-box",
    //                    "background-color":settings.thumbnail_bg_color,
    //                    "border":settings.thumbnail_border,
    //                    "box-shadow":settings.thumbnail_shadow,
    //                    "-moz-box-shadow":settings.thumbnail_shadow,
    //                    "-webkit-box-shadow":settings.thumbnail_shadow,
    //                    "width":100 + "%",
    //                    "height":settings.thumbnail_size + "px",
    //                    "background-size":scaleWidth + "px, auto",
    //                    "background-position":"50%, 50%",
    //                    "display":"none",
    //                    "margin":"5px auto",
    //                    "background-repeat" : "no-repeat"
    //                })
    //        )
    //            .prepend($('<div>').addClass('clearfix'))
    //
    //            .prepend($('<span>')
    //                .addClass('label' +
    //                ' titl')
    //                .text(labelText)
    //        ).prepend(fileInput.css({
    //                "box-sizing": "border-box",
    //                "position": "relative",
    //                "-moz-box-sizing": "border-box",
    //                "-webkit-box-sizing": "border-box",
    //                "display":"block",
    //                "margin" : "5px auto"
    //            })
    //                .addClass(settings.input_class)
    //                .attr('accept', 'image/jpeg,image/png,image/gif')
    //        );
    //
    //        elem.replaceWith(newFileInput);
    //
    //        var doImgPreview = function(e) {
    //            var files = e.target.files;
    //            $('span > small', newFileInput).remove();
    //
    //            for (var i=0, file; file=files[i]; i++) {
    //                if (file.type.match('image.*')) {
    //                    var reader = new FileReader();
    //                    reader.onload = (function(theFile) {
    //                        return function(e) {
    //                            var image = e.target.result;
    //                            previewDiv = $('.image-preview', newFileInput);
    //                            previewDiv.css({
    //                                "background-image":"url("+image+")",
    //                                "display":"block"
    //                            });
    //                        };
    //                    })(file);
    //                    reader.readAsDataURL(file);
    //                } else {
    //                    $('span', newFileInput).append(
    //                        $('<small>').addClass('image-error')
    //                            .text(settings.warning_message)
    //                            .css({
    //                                "font-size":"80%",
    //                                "color":settings.warning_text_color,
    //                                "display":"inline-block",
    //                                "font-weight":"normal",
    //                                "margin-left":"1em",
    //                                "font-style":"italic"
    //                            })
    //                    );
    //                }
    //            }
    //        };
    //       // doImgPreview(fileInput);
    //        //console.log(fileInput.val());
    //
    //    });
    //};
     //render the image in our view
    var fileinput = $("#fileupload")
        .attr('accept', 'image/jpeg,image/png,image/gif');
    var settings = {
        thumbnail_size:460,
        thumbnail_bg_color:"#ddd",
        thumbnail_border:"1px solid #fff",
        thumbnail_shadow:"0 0 0px rgba(0, 0, 0, 0.5)",
        label_text:"",
        warning_message:"Not an image file.",
        warning_text_color:"#f00",
        input_class:'custom-file-input button button-primary button-block'
    };
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
                var scaleWidth = settings.thumbnail_size ;
                $('.p').append("<div class='s-12 m-10 l-10 l-offset-1 m-offset-1'><div class='thumbnail' style='background: #ffffff'><img src='" + image.src + "' /><div class='caption' style='position: absolute;right: 10px;top:10px;'> <h4  style='background: black;padding: 4px; color: white'>"+ s.toFixed(2) +" Mb </h4></div></div> </div> ")

            };
            image.onerror = function () {
                alert('Invalid file type: ' + file.type);
                fileinput.val(null);
            };
        };
        reader.readAsDataURL(file);

    };
    // when the file is read it triggers the onload event above.

    // handle input changes
    fileinput.change(function(e) {
        console.log(this.files)

        $('.p').html('');
        if(this.disabled) return alert('File upload not supported!');
        var F = this.files;
        if(F && F[0]) for(var i=0; i<F.length; i++) {
            if (F[i].type.match('image.*')) {
                if($('.image-error'))
                {
                    $('.image-error').remove();
                }
                renderImage(F[i]);
            }
            else{
                $('.filelabel').append(
                    $('<small>').addClass('image-error')
                        .text(settings.warning_message)
                        .css({
                            "font-size":"100%",
                            "color":settings.warning_text_color,
                            "display":"inline-block",
                            "font-weight":"normal",
                            "margin-left":"1em",
                            "font-style":"normal"
                        })
                );
            }
        }

    });


    var fileinput = $("#file")
        .attr('accept', 'image/jpeg,image/png,image/gif');
    var settings = {
        thumbnail_size:100,
        thumbnail_bg_color:"#ddd",
        thumbnail_border:"3px solid white",
        thumbnail_border_radius: "3px",
        label_text:"",
        warning_message:"Not an image file.",
        warning_text_color:"#f00",
        input_class:'custom-file-input button button-primary button-block'
    };



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
                var scaleWidth = settings.thumbnail_size ;
                $('.profile-img-block').append("<img class=\"img profile-img\" align=\"center\" src='" + image.src + "' /> ").css({position:"relative"});
                $('#changeImage .button.button-primary.button-block').val('to download press').addClass('text-success');
            };
            image.onerror = function () {
                alert('Invalid file type: ' + file.type);
                fileinput.val(null);
            };
        };
        reader.readAsDataURL(file);

    };
    // when the file is read it triggers the onload event above.

    // handle input changes
    fileinput.change(function(e) {

        $('.profile-img-block').html('');
        if(this.disabled) return alert('File upload not supported!');
        var F = this.files;
        if(F && F[0]) for(var i=0; i<F.length; i++) {
            if (F[i].type.match('image.*')) {
                if($('.image-error'))
                {
                    $('.image-error').remove();
                }
                renderImage(F[i]);
            }
            else{
                $('.profile-img-block').append(
                    $('<small>').addClass('image-error')
                        .text(settings.warning_message)
                        .css({
                            "font-size":"100%",
                            "color":settings.warning_text_color,
                            "display":"inline-block",
                            "font-weight":"normal",
                            "margin-left":"1em",
                            "font-style":"normal"
                        })
                );
            }
        }

    });
})(jQuery);
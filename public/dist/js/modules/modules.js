
;(function() {

    var nav = document.getElementById('nav'),
        anchor = nav.getElementsByTagName('a'),
        path = window.location,
        current = window.location.pathname;

    for (var i = 0; i < anchor.length; i++) {

        var definedLinks = anchor[i].pathname;
        if(definedLinks === current) {
            anchor[i].className = "active";
        }
    }

})();
;(function() {
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });

})();

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

    var initLikeORdis = function (buttonID, base_url, class_name, object_id, redirectIFerror) {
        if (buttonID.length !== 0) {
            $("document").ready(function () {
                buttonID.submit(function (e) {
                    e.preventDefault();
                    var button = $(this).find("button"),
                        buttonI = $(this).find("button i");

                    $.ajax({
                        type: "GET",
                        url: base_url,
                        data: {'class_name': class_name, 'object_id': object_id},
                        success: function (data) {
                            console.log("success" + "   " + data);

                            if (data === "error") {
                                window.location.href = redirectIFerror;
                            }
                            if (data[0] === "liked") {

                                buttonI.addClass('text-danger');
                                button.tooltipster('content', data[1]);
                                buttonID.parent().append($("<span/>", {
                                    "text": data[2],
                                    "class": "like-message"
                                }));
                            $("span .like-message").animate({
                                    opacity: 0.25,
                                    left: "+=50",
                                    height: "toggle"}, 200);
                            }
                            else {

                                buttonI.removeClass('text-danger');
                                button.tooltipster('content', data[1]);
                                buttonID.parent().find(".like-message").remove();
                            }

                        },
                        error: function (data) {
                            console.log("error" + "   " + data);
                        }
                    }, "html");

                });

            });
        }
    };
!(function(){
    //
    //
    //$(document).ready(function(){
    //    var panelObj = {
    //        button: $('.notify-button'),
    //        panel: $('.panel'),
    //        init: function() {
    //            if (!(this.panel.is(':hidden') &&  this.button.hasClass('active'))) {
    //                this.panel.fadeOut(0);
    //                this.button.removeClass('active')
    //
    //            }
    //            else
    //            {
    //                this.panel.fadeIn(100);
    //            }
    //        }};
    //        panelObj.init();
    //
    //        panelObj.button.on('click', function(){
    //            $(this).addClass('active');
    //             panelObj.init();
    //        });
    //
    //})


})();
/* ========================================================================
 * Bootstrap: tab.js v3.3.5
 * http://getbootstrap.com/javascript/#tabs
 * ========================================================================
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 * ======================================================================== */


+function ($) {
    'use strict';

    // TAB CLASS DEFINITION
    // ====================

    var Tab = function (element) {
        // jscs:disable requireDollarBeforejQueryAssignment
        this.element = $(element)
        // jscs:enable requireDollarBeforejQueryAssignment
    }

    Tab.VERSION = '3.3.5'

    Tab.TRANSITION_DURATION = 150

    Tab.prototype.show = function () {
        var $this    = this.element
        var $ul      = $this.closest('ul:not(.dropdown-menu)')
        var selector = $this.data('target')

        if (!selector) {
            selector = $this.attr('href')
            selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
        }

        if ($this.parent('li').hasClass('active')) return

        var $previous = $ul.find('.active:last a')
        var hideEvent = $.Event('hide.bs.tab', {
            relatedTarget: $this[0]
        })
        var showEvent = $.Event('show.bs.tab', {
            relatedTarget: $previous[0]
        })

        $previous.trigger(hideEvent)
        $this.trigger(showEvent)

        if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented()) return

        var $target = $(selector)

        this.activate($this.closest('li'), $ul)
        this.activate($target, $target.parent(), function () {
            $previous.trigger({
                type: 'hidden.bs.tab',
                relatedTarget: $this[0]
            })
            $this.trigger({
                type: 'shown.bs.tab',
                relatedTarget: $previous[0]
            })
        })
    }

    Tab.prototype.activate = function (element, container, callback) {
        var $active    = container.find('> .active')
        var transition = callback
            && $.support.transition
            && ($active.length && $active.hasClass('fade') || !!container.find('> .fade').length)

        function next() {
            $active
                .removeClass('active')
                .find('> .dropdown-menu > .active')
                .removeClass('active')
                .end()
                .find('[data-toggle="tab"]')
                .attr('aria-expanded', false)

            element
                .addClass('active')
                .find('[data-toggle="tab"]')
                .attr('aria-expanded', true)

            if (transition) {
                element[0].offsetWidth // reflow for transition
                element.addClass('in')
            } else {
                element.removeClass('fade')
            }

            if (element.parent('.dropdown-menu').length) {
                element
                    .closest('li.dropdown')
                    .addClass('active')
                    .end()
                    .find('[data-toggle="tab"]')
                    .attr('aria-expanded', true)
            }

            callback && callback()
        }

        $active.length && transition ?
            $active
                .one('bsTransitionEnd', next)
                .emulateTransitionEnd(Tab.TRANSITION_DURATION) :
            next()

        $active.removeClass('in')
    }


    // TAB PLUGIN DEFINITION
    // =====================

    function Plugin(option) {
        return this.each(function () {
            var $this = $(this)
            var data  = $this.data('bs.tab')

            if (!data) $this.data('bs.tab', (data = new Tab(this)))
            if (typeof option == 'string') data[option]()
        })
    }

    var old = $.fn.tab

    $.fn.tab             = Plugin
    $.fn.tab.Constructor = Tab


    // TAB NO CONFLICT
    // ===============

    $.fn.tab.noConflict = function () {
        $.fn.tab = old
        return this
    }

    // TAB DATA-API
    // ============

    var clickHandler = function (e) {
        e.preventDefault()
        Plugin.call($(this), 'show')
    }

    $(document)
        .on('click.bs.tab.data-api', '[data-toggle="tab"]', clickHandler)
        .on('click.bs.tab.data-api', '[data-toggle="pill"]', clickHandler)

}(jQuery);
// JavaScript source code
$(document).ready(function () {

    $('.tooltip-bottom').tooltipster
    ({
        animation: 'fade',
        delay: 200,
        theme: 'tooltipster-light',
        touchDevices: true,
        trigger: 'hover',
        position: "bottom"
    });

    $('.tooltip-left').tooltipster
    ({
        animation: 'fade',
        delay: 200,
        theme: 'tooltipster-light',
        touchDevices: true,
        trigger: 'hover',
        position: "left"
    });
    $('.tooltip-right').tooltipster
  ({
      animation: 'fade',
      delay: 200,
      theme: 'tooltipster-light',
      touchDevices: true,
      trigger: 'hover',
      position: "right"
  });


    $('.tooltip').tooltipster({

        animation: 'fade',
        delay: 200,
        theme: 'tooltipster-light',
        touchDevices: true,
        trigger: 'hover'

    });
});

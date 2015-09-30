<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','AIzaSyBsdsBWhL3GtAtnc6_5pKzM5RIC3_fFAA8','auto');ga('send','pageview');
</script>

<script src="{{ asset('dist/vendor/jquery/dist/jquery.min.js') }}"></script>
<script  src="{{asset('/dist/vendor/tooltipster/js/jquery.tooltipster.min.js')}}"></script>
<script src="{{asset('vendor/highlight.pack.js')}}"></script>

<script src="{{ asset('dist/js/modules/modules.min.js') }}"></script>
<script src="{{ asset('dist/vendor/taggingJS/tagging.js') }}"></script>
<script src="{{ asset('dist/vendor/jquery-simply-countable/jquery.simplyCountable.js') }}"></script>
<script src="{{asset('dist/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{ asset('/plugins/fastclick/fastclick.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/plugins/slimScroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('dist/vendor/socket.io-client/socket.io.js') }}"></script>
<script src="{{ asset('/dist/js/app.js') }}" type="text/javascript"></script>

<script>hljs.initHighlightingOnLoad();</script>
<script>


$('.notification .close').click(function(e) {
        e.preventDefault();
        $(this).closest('.notification').animate({
            opacity: 0.25,
            left: "+=50",
             height: "toggle"
         }, 100);
    });
    $('.error .close').click(function(e) {
        e.preventDefault();
        $(this).closest('.error').animate({
            opacity: 0.25,
            left: "+=50",
             height: "toggle"
         }, 100);
    });

</script>

        {!! Toastr::render() !!}
        {!! Toastr::clear() !!}

@yield('scripts-add')
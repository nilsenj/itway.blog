@foreach($videos as $video)
    <div class="l-4 m-4 s-6 xs-12" style=" margin-bottom: 5px!important;">

    <div class="embed-responsive embed-responsive-4by3">
<iframe width="1280" height="720" src="https://www.youtube.com/embed/{!!$video!!}" frameborder="0" allowfullscreen></iframe>

    </div>
    </div>
    @endforeach
<div id="search">
    <button type="button" class="close">x</button>

    {!!Form::open(['method'=>'post','url'=>route('search'),'style'=>'width: 100%; text-align:center'])!!}
        <input type="search"  name="q" class="search-input width100" placeholder="Search for..." >

        <div class="clearfix"></div>

    <li class="tag-line-btn">
        <a class="button button-primary tag-search " href="/"><i class="icon-tags"></i> {{ trans('navigation.tag_search') }}</a>
    </li>
    <button type="submit" class="button  button-lg button-primary rounded"><i class="icon-search"></i> Search</button>
    {!! Form::close() !!}
    <div class="clearfix"></div>
    <div class="l-12 m-12 s-12 xs-12">
        <div class="search-result"></div>
    </div>
</div>
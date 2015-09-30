<div class="container-fluid panel shadow-z-1" >

    @yield('sitelocation')
    <div class="row">

        <div class="l-12 m-12 s-12 xs-12" >

<div class="location">
    <p class="location-info text-left">
        <small class="text-white"> "{{ Lang::get('messages.'.$msg.'') }}"
        </small>

    </p>

    <span class="location-title text-primary pull-left">{{ Lang::get('messages.'.$name.'') }}</span>

</div>

        </div>
</div>

</div>
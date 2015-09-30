
<div class="notification faded" >

    {{--<button type="button" class="close">--}}
        {{--<span aria-hidden="true">x</span>--}}
    {{--</button>--}}

@if (Session::has('flash_notification.message'))
        <div class="close"><div class="icon-close"></div></div>
    @if (Session::has('flash_notification.overlay'))
        @include('flash::modal', ['modalClass' => 'flash-modal', 'title' => Session::get('flash_notification.title'), 'body' => Session::get('flash_notification.message')])
    @else
        <div class="{{ Session::get('flash_notification.level') }}">
         {{--   {{ $faded ? '' : '<div class="close"><span class="icon-close"></span></div>'}}--}}


            <ul class="inline text-center">

                    <li>
                        <strong >
                        {{ Session::get('flash_notification.message') }}
                        </strong>
                    </li>

                </ul>
        </div>
    @endif
    <div class="hidden">
        {{Session::remove('flash_notification.message')}}
        {{Session::remove('flash_notification.level')}}
    </div>
    @endif

</div>
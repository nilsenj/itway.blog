@if(!empty($user->picture()->get()->all()))
    <?php $picture = $user->picture()->get()->first()->path ?>
    {!! url('images/users/' . $picture) !!}
@else
    @if($user->photo)
        {!! $user->photo !!}
    @else
        {!!url('dist/images/50-50.jpg')!!}
    @endif

@endif
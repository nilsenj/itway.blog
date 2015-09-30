@if(isset($tags) && count($tags) !==0 )
    tagBox.tagging( "add", [@if(isset($tags) && count($tags) !==0 )@for($i = 0; $i < count($tags); $i++)"{{$tags[$i]}}"@if(count($tags) === $i)@else,@endif @endfor @endif] );
@endif
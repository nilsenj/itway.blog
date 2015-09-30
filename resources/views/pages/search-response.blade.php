@if(!$search->isEmpty())
<ul>
@foreach($search->all() as $item)

        <li>
            <a href="{{route('itway::posts::show',$item->id)}}">
            <span class="title">{{$item->title}}</span>
                <span class="clearfix"></span>
                <span class="time pull-left"><i class="icon-clock-o text-warning"></i>{{$item->published_at->diffForHumans()}}</span>
                <span class="author pull-right"> {{$item->user->name}} </span> <span class="text-muted pull-right"> created by </span>
            </a>

        </li>

    @endforeach
</ul>
    @else
    <ul>
        <li class="text-warning">Nothing found</li>
    </ul>
    @endif
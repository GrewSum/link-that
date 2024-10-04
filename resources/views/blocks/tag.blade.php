<a href="{{route('links.index', ['tag' => $tag->id])}}" class="inline-block">
@switch($tag->color)
    @case('red')
        <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">{{$tag->name}}</span>
        @break
    @case('orange')
        <span class="inline-flex items-center rounded-md bg-orange-50 px-2 py-1 text-xs font-medium text-orange-800 ring-1 ring-inset ring-orange-600/20">{{$tag->name}}</span>
        @break
    @case('yellow')
        <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">{{$tag->name}}</span>
        @break
    @case('green')
        <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$tag->name}}</span>
        @break
    @case('teal')
        <span class="inline-flex items-center rounded-md bg-teal-50 px-2 py-1 text-xs font-medium text-teal-700 ring-1 ring-inset ring-teal-700/10">{{$tag->name}}</span>
        @break
    @case('cyan')
        <span class="inline-flex items-center rounded-md bg-cyan-50 px-2 py-1 text-xs font-medium text-cyan-700 ring-1 ring-inset ring-cyan-700/10">{{$tag->name}}</span>
        @break
    @case('sky')
        <span class="inline-flex items-center rounded-md bg-sky-50 px-2 py-1 text-xs font-medium text-sky-700 ring-1 ring-inset ring-sky-700/10">{{$tag->name}}</span>
        @break
    @case('indigo')
        <span class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">{{$tag->name}}</span>
        @break
    @case('rose')
        <span class="inline-flex items-center rounded-md bg-rose-50 px-2 py-1 text-xs font-medium text-rose-700 ring-1 ring-inset ring-rose-700/10">{{$tag->name}}</span>
        @break
    @default
        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">{{$tag->name}}</span>
        @break
@endswitch
</a>

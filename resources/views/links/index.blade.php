@extends('layout', ['title' => 'Links'])

@section('content')

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-7 text-gray-900">{{__('links.index.page_title')}}</h1>
            <p class="mt-2 text-sm text-gray-700">{{__('links.index.page_description')}}</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{route('links.create')}}"
               class="block rounded-md bg-emerald-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">{{__('links.index.add_button')}}</a>
        </div>
    </div>

    <div class="my-4">
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">{{__('links.index.tabs_label')}}</label>
            <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
            <select id="tabs" name="tabs"
                    class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-emerald-500 focus:outline-none focus:ring-emerald-500 sm:text-sm"
                    onchange="window.location.href = event.target.value">
                <option value="{{route('links.index')}}" {{!request()->has('tag') ? 'selected' : ''}}>{{__('links.index.all')}}</option>
                @foreach($tags as $tag)
                    <option value="{{route('links.index', ['tag' => $tag->id])}}" {{request()->get('tag') == $tag->id ? 'selected' : ''}}>{{$tag->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="hidden sm:block">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 -mb-px" aria-label="Tabs" x-data="{open: false}">
                    <div class="flex-1 flex space-x-8">
                        <a href="{{route('links.index')}}" class="{{!request()->has('tag') ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:border-gray-200 hover:text-gray-700'}} flex whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                            {{__('links.index.all')}}
                            <span class="{{!request()->has('tag') ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-900'}} ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{$total_links}}</span>
                        </a>
                        @foreach($tags->sortByDesc('links_count')->take(5) as $tag)
                            <a href="{{route('links.index', ['tag' => $tag->id])}}" class="{{request()->get('tag') == $tag->id ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:border-gray-200 hover:text-gray-700'}} flex whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium">
                                {{$tag->name}}
                                <span class="{{request()->get('tag') == $tag->id ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-900'}} ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{$tag->links_count}}</span>
                            </a>
                        @endforeach
                    </div>

                    @if($tags->count() > 5)
                        <div x-data="{open: false}">
                            <button type="button" @click="open = !open" class="justify-self-end -m-2.5 block p-2.5 text-gray-500 hover:text-gray-900" id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">{{__('links.index.show_more_tags')}}</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                                </svg>
                            </button>

                            <div :class="open ? 'relative' : 'hidden'" x-cloak class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                <div
                                    x-show="open"
                                    x-transition:enter="ease-out duration-300"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

                                <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                                    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                                        <div
                                            @click.away="open = false"
                                            x-show="open"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                            class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-sm sm:p-6">
                                            <div>
                                                <div>
                                                    <div class="px-4 mb-4">
                                                        <div class="flex items-start justify-between">
                                                            <h2 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">{{__('links.index.select_tag')}}</h2>
                                                            <div class="ml-3 flex h-7 items-center">
                                                                <button type="button"
                                                                        class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                                                                        @click="open = !open">
                                                                    <span class="absolute -inset-2.5"></span>
                                                                    <span class="sr-only">{{__('links.index.close_panel')}}</span>
                                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="flex flex-col space-y-2">
                                                        <a href="{{route('links.index')}}" class="hover:bg-gray-50 block rounded-md p-2 pl-4 text-sm leading-6 font-semibold text-gray-700">
                                                            {{__('links.index.all')}}
                                                            <span class="{{request()->get('tag') == $tag->id ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-900'}} ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{$total_links}}</span>
                                                        </a>
                                                        @foreach($tags->sortByDesc('links_count') as $tag)
                                                            <a href="{{route('links.index', ['tag' => $tag->id])}}" class="hover:bg-gray-50 block rounded-md p-2 pl-4 text-sm leading-6 font-semibold text-gray-700">
                                                                {{$tag->name}}
                                                                <span class="{{request()->get('tag') == $tag->id ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-900'}} ml-3 hidden rounded-full py-0.5 px-2.5 text-xs font-medium md:inline-block">{{$tag->links_count}}</span>
                                                            </a>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endif
                </nav>
            </div>
        </div>
    </div>

    <ul role="list" class="divide-y divide-gray-100 mt-4 flow-root mb-8">

        @forelse($links as $link)
        <li class="flex items-center justify-between gap-x-6 py-5">
            <div class="min-w-0">
                <div class="flex flex-col md:flex-row items-start gap-x-3">
                    <a href="{{route('links.show', $link->id)}}" class="text-sm font-semibold leading-6 text-gray-900 hover:underline">
                        {{$link->title}}
                    </a>
                    @if($link->tags->count() > 0)
                        <div class="my-1 md:my-0 flex-wrap">
                            @foreach($link->tags as $tag)
                                @include('blocks.tag', ['tag' => $tag])
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                    <p class="whitespace-nowrap">{{__('links.index.added_on')}} <time datetime="{{$link->added_at->toDateTimeString()}}Z">{{$link->added_at->format('d-m-Y')}}</time></p>
                </div>
            </div>
            <div class="flex flex-none items-center gap-x-4">
                <a href="{{route('links.show', $link->id)}}" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">{{__('links.index.view_button')}}</a>
                <div class="relative flex-none" x-data="{open: false}" @click.away="open = false">
                    <button type="button" @click="open = !open" class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900" id="options-menu-0-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">{{__('links.index.open_options')}}</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        x-cloak
                        class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button" tabindex="-1">
                        <a href="{{route('links.edit', $link->id)}}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="options-menu-0-item-0">{{__('links.index.edit_button')}}<span class="sr-only">, {{$link->title}}</span></a>

                        <form action="{{route('links.destroy', $link->id)}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="options-menu-0-item-2">{{__('links.index.delete_button')}}<span class="sr-only">, {{$link->title}}</span></button>
                        </form>
                    </div>
                </div>
            </div>
        </li>
        @empty
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">{{__('links.index.empty_title')}}</h3>
                <p class="mt-1 text-sm text-gray-500">{{__('links.index.empty_description')}}</p>
                <div class="mt-6">
                    <a href="{{route('links.create')}}"
                       class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                        </svg>
                        {{__('links.index.empty_add_button')}}
                    </a>
                </div>
            </div>
        @endforelse
    </ul>

    {!! $links->links() !!}

@endsection

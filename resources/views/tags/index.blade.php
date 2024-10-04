@extends('layout', ['title' => 'Tags'])

@section('content')

    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">{{__('tags.index.page_title')}}</h1>
            <p class="mt-2 text-sm text-gray-700">{{__('tags.index.page_description')}}</p>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{route('tags.create')}}"
               class="block rounded-md bg-emerald-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">{{__('tags.index.add_button')}}</a>
        </div>
    </div>

    <ul role="list" class="divide-y divide-gray-100 mt-4 flow-root mb-8">

        @forelse($tags as $tag)
            <li class="flex items-center justify-between gap-x-6 py-5">
                <div class="min-w-0">
                    <div class="flex items-center space-x-2">
                        @include('blocks.tag', ['tag' => $tag])
                        <span class="text-sm">{{__('tags.index.links_count', ['count' => $tag->links_count])}}</span>
                    </div>
                </div>
                <div class="flex flex-none items-center gap-x-4">
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
                            <a href="{{route('tags.edit', $tag->id)}}" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="options-menu-0-item-0">{{__('tags.index.edit_button')}}<span class="sr-only">, {{$tag->name}}</span></a>

                            <form action="{{route('tags.destroy', $tag->id)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="block px-3 py-1 text-sm leading-6 text-gray-900" role="menuitem" tabindex="-1" id="options-menu-0-item-2">{{__('tags.index.delete_button')}}<span class="sr-only">, {{$tag->name}}</span></button>
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
                <h3 class="mt-2 text-sm font-semibold text-gray-900">{{__('tags.index.empty_title')}}</h3>
                <p class="mt-1 text-sm text-gray-500">{{__('tags.index.empty_description')}}</p>
                <div class="mt-6">
                    <a href="{{route('tags.create')}}"
                       class="inline-flex items-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                            <path d="M10.75 4.75a.75.75 0 0 0-1.5 0v4.5h-4.5a.75.75 0 0 0 0 1.5h4.5v4.5a.75.75 0 0 0 1.5 0v-4.5h4.5a.75.75 0 0 0 0-1.5h-4.5v-4.5Z" />
                        </svg>
                        {{__('tags.index.empty_add_button')}}
                    </a>
                </div>
            </div>
        @endforelse
    </ul>

    {!! $tags->links() !!}

@endsection

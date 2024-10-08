@extends('layout')

@section('content')

    <form method="POST" action="{{route('assign.store', $tag->id)}}">
        @csrf
        <div class="space-y-12">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">{{__('tags.assign.page_title', ['name' => $tag->name])}}</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">{{__('tags.assign.page_description')}}</p>

                <div class="mt-10 columns-1 md:columns-2">
                    @foreach($links as $link)
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input type="hidden" name="links[{{$link->id}}]" value="0">
                                <input
                                    id="{{$link->id}}"
                                    aria-describedby="{{$link->id}}-description"
                                    name="links[{{$link->id}}]"
                                    type="checkbox"
                                    value="1"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                    {{in_array($link->id, $tag->links->pluck('id')->toArray()) ? 'checked' : ''}}
                                >
                            </div>
                            <div class="ml-3 text-sm leading-6 whitespace-nowrap flex items-center">
                                <label for="{{$link->id}}" class="font-medium text-ellipsis overflow-hidden text-gray-900 inline-block max-w-[250px] xl:max-w-[500px]">{{$link->title}}</label>
                                <a href="{{route('links.show', $link)}}" class="ml-2 text-sky-600 hover:underline">{{__('links.index.view_button')}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($links->hasPages())
            <nav class="flex items-center justify-between border-t border-gray-200 py-3" aria-label="Pagination">
                <div class="hidden sm:block">
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{$links->firstItem()}}</span>
                        to
                        <span class="font-medium">{{$links->lastItem()}}</span>
                        of
                        <span class="font-medium">{{$links->total()}}</span>
                        results
                    </p>
                </div>
                <div class="flex flex-1 justify-between sm:justify-end">
                    @if(!$links->onFirstPage())
                        <button type="submit"
                                name="toPage"
                                value="{{$links->previousPageUrl()}}"
                                class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0"
                        >Previous</button>
                    @endif
                    @if(!$links->onLastPage())
                        <button type="submit"
                                name="toPage"
                                value="{{$links->nextPageUrl()}}"
                                class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0"
                        >Next</button>
                    @endif
                </div>
            </nav>
            @endif
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{route('tags.index')}}"
               class="text-sm font-semibold leading-6 text-gray-900">{{__('forms.cancel')}}</a>
            <button type="submit"
                    class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">{{__('forms.save')}}</button>
        </div>
    </form>

@endsection

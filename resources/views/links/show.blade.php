@extends('layout')

@section('content')

    <div class="bg-white">
        <div class="mx-auto max-w-7xl">
            <div class="mx-auto max-w-2xl lg:mx-0 lg:max-w-none">

                @foreach($link->tags as $tag)
                    @include('blocks.tag', ['tag' => $tag])
                @endforeach

                <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{$link->title}}</h1>
                <div class="mt-4 grid max-w-xl grid-cols-1 gap-8 text-base leading-7 text-gray-700 lg:max-w-none lg:grid-cols-2">
                    <div>
                        <p>{{$link->description}}</p>
                    </div>
                </div>
                <div class="mt-6 flex space-x-2">
                    <a href="{{$link->url}}"
                       class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">{{__('links.show.visit')}}</a>
                    <a href="{{route('links.edit', $link->id)}}"
                       class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">{{__('links.show.edit')}}</a>
                </div>
            </div>
        </div>
    </div>

@endsection




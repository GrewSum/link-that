@extends('layout', ['title' => 'Links'])

@section('content')

    <form method="POST" action="{{route('links.store')}}">
        @csrf
        <div class="space-y-12">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">{{__('links.create.page_title')}}</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">{{__('links.create.page_description')}}</p>

                @if($tags->count() == 0)
                    <div class="max-w-2xl my-4">
                        <div class="rounded-md bg-yellow-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-yellow-800">{{__('links.create.no_tags_title')}}</h3>
                                    <div class="mt-2 text-sm text-yellow-700">
                                        <p>{{__('links.create.no_tags_description')}}</p>
                                    </div>
                                    <div class="mt-4">
                                        <div class="-mx-2 -my-1.5 flex">
                                            <a href="{{route('tags.create')}}"
                                               class="rounded-md bg-yellow-50 px-2 py-1.5 text-sm font-medium text-yellow-800 hover:bg-yellow-100 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 focus:ring-offset-yellow-50">{{__('links.create.create_tag')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">{{__('links.create.title_label')}}</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-600 sm:max-w-md {{$errors->has('url') ? 'ring-red-700' : 'ring-gray-300'}}">
                                <input type="text"
                                       name="title"
                                       id="title"
                                       class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                       value="{{old('title')}}"
                                       placeholder="Link That!">
                            </div>
                        </div>
                        @error('title')
                        <p class="mt-3 text-sm leading-6 text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-4">
                        <label for="url" class="block text-sm font-medium leading-6 text-gray-900">{{__('links.create.url_label')}}</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-600 sm:max-w-md {{$errors->has('url') ? 'ring-red-700' : 'ring-gray-300'}}">
                                <input type="text"
                                       name="url"
                                       id="url"
                                       class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                       value="{{old('url')}}"
                                       placeholder="https://link-that.com">
                            </div>
                        </div>
                        @error('url')
                        <p class="mt-3 text-sm leading-6 text-red-700">{{ $message }}</p>
                        @enderror
                    </div>

                    @foreach($errors as $error) {{$error}}@endforeach

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">{{__('links.create.description_label')}}</label>
                        <div class="mt-2">
                            <textarea id="description"
                                      name="description"
                                      rows="3"
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6 {{$errors->has('description') ? 'ring-red-700' : 'ring-gray-300'}}"
                            >{{old('description')}}</textarea>
                        </div>
                        @error('description')
                        <p class="mt-3 text-sm leading-6 text-red-700">{{ $message }}</p>
                        @else
                            <p class="mt-3 text-sm leading-6 text-gray-600">{{__('links.create.description_help')}}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-4">
                        <label for="added_at" class="block text-sm font-medium leading-6 text-gray-900">{{__('links.create.added_at_label')}}</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-600 sm:max-w-md">
                                <input type="datetime-local"
                                       name="added_at"
                                       id="added_at"
                                       class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                       value="{{old('added_at', now()->format("Y-m-d\TH:i")) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($tags->count() > 0)
                <div class="border-b border-gray-900/10 pb-12 space-y-10">
                    <fieldset>
                        <legend class="text-sm font-semibold leading-6 text-gray-900">{{__('links.create.tags')}}</legend>
                        <div class="mt-6 space-y-6">
                            @foreach($tags as $tag)
                                <div class="relative flex gap-x-3">
                                    <div class="flex h-6 items-center">
                                        <input id="tags[{{$tag->id}}]" name="tags[]" type="checkbox" value="{{$tag->id}}" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    </div>
                                    <div class="text-sm leading-6">
                                        <label for="tags[{{$tag->id}}]" class="font-medium text-gray-900">{{$tag->name}}</label>
                                        <p class="text-gray-500">{{$tag->description}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </fieldset>
                </div>
            @endif

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{route('links.index')}}"
               class="text-sm font-semibold leading-6 text-gray-900">{{__('forms.cancel')}}</a>
            <button type="submit"
                    class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">{{__('forms.save')}}</button>
        </div>
    </form>

@endsection

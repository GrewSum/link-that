@extends('layout', ['title' => 'Links'])

@section('content')

    <form method="POST" action="{{route('links.store')}}">
        @csrf
        <div class="space-y-12">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">Add new link</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Create a new entry for an interesting link.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-600 sm:max-w-md">
                                <input type="text"
                                       name="title"
                                       id="title"
                                       class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                       value="{{old('title')}}"
                                       placeholder="Link That!">
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="url" class="block text-sm font-medium leading-6 text-gray-900">URL</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-600 sm:max-w-md">
                                <input type="text"
                                       name="url"
                                       id="url"
                                       class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                       value="{{old('url')}}"
                                       placeholder="https://link-that.com">
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                        <div class="mt-2">
                            <textarea id="description"
                                      name="description"
                                      rows="3"
                                      class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6"
                            >{{old('description')}}</textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">Why is it interesting? What did you learn?</p>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="added_at" class="block text-sm font-medium leading-6 text-gray-900">Date added</label>
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

            <div class="border-b border-gray-900/10 pb-12 space-y-10">
                <fieldset>
                    <legend class="text-sm font-semibold leading-6 text-gray-900">Tags</legend>
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

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{route('links.index')}}" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <button type="submit" class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Save</button>
        </div>
    </form>

@endsection

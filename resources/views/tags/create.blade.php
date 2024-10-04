@extends('layout')

@section('content')

    <form method="POST" action="{{route('tags.store')}}">
        @csrf
        <div class="space-y-12">
            <div>
                <h2 class="text-base font-semibold leading-7 text-gray-900">{{__('tags.create.page_title')}}</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">{{__('tags.create.page_description')}}</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{__('tags.create.name_label')}}</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-600 sm:max-w-md">
                                <input type="text"
                                       name="name"
                                       id="name"
                                       class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                       placeholder="Home automation">
                            </div>
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="color" class="block text-sm font-medium leading-6 text-gray-900">{{__('tags.create.color_label')}}</label>
                        <div class="mt-2">
                            <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-emerald-600 sm:max-w-md">
                                <select name="color" id="color" class="block flex-1 border-0 bg-transparent py-1.5 pl-3 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6">
                                    @foreach($colors as $color)
                                        <option value="{{$color}}">{{$color}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label for="description" class="block text-sm font-medium leading-6 text-gray-900">{{__('tags.create.description_label')}}</label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-emerald-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                        <p class="mt-3 text-sm leading-6 text-gray-600">{{__('tags.create.description_help')}}</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="{{route('tags.index')}}"
               class="text-sm font-semibold leading-6 text-gray-900">{{__('forms.cancel')}}</a>
            <button type="submit"
                    class="rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">{{__('forms.save')}}</button>
        </div>
    </form>

@endsection

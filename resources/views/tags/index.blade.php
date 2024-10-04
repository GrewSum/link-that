@extends('layout', ['title' => 'Tags'])

@section('content')

    <div>
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Tags</h1>
                <p class="mt-2 text-sm text-gray-700">A list of tags to assign to links</p>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a href="{{route('tags.create')}}" class="block rounded-md bg-emerald-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Add</a>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block w-full py-2 sm:px-6 lg:px-8">
                    <table class="w-full divide-y divide-gray-300">
                        <thead>
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        @foreach($tags as $tag)
                        <tr>
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0 flex justify-between">
                                @include('blocks.tag', ['tag' => $tag])
                                <span>({{$tag->links_count}} links)</span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                <a href="{{route('tags.edit', $tag->id)}}" class="text-emerald-600 hover:text-emerald-900">Edit<span class="sr-only">, {{$tag->name}}</span></a>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0 table-cell">
                                <form action="{{route('tags.destroy', $tag->id)}}" method="POST" class="w-[50px]">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="block px-3 py-1 text-sm leading-6 text-emerald-600" role="menuitem" tabindex="-1" id="options-menu-0-item-2">Delete<span class="sr-only">, {{$tag->name}}</span></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {!! $tags->links() !!}

@endsection

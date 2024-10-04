<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Links app</title>

        <link rel="apple-touch-icon" sizes="57x57" href="{{asset('icon/apple-icon-57x57.png')}}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{asset('icon/apple-icon-60x60.png')}}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{asset('icon/apple-icon-72x72.png')}}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{asset('icon/apple-icon-76x76.png')}}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{asset('icon/apple-icon-114x114.png')}}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{asset('icon/apple-icon-120x120.png')}}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{asset('icon/apple-icon-144x144.png')}}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{asset('icon/apple-icon-152x152.png')}}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('icon/apple-icon-180x180.png')}}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('icon/android-icon-192x192.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('icon/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{asset('icon/favicon-96x96.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('icon/favicon-16x16.png')}}">
        <link rel="manifest" href="{{asset('icon/manifest.json')}}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{asset('icon/ms-icon-144x144.png')}}">
        <meta name="theme-color" content="#ffffff">

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="h-full">
    <div class="min-h-full">
        <div class="bg-emerald-600 pb-32">
            <nav class="border-b border-emerald-300 border-opacity-25 bg-emerald-600 lg:border-none" x-data="{open: false}">
                <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
                    <div class="relative flex h-16 items-center justify-between lg:border-b lg:border-emerald-400 lg:border-opacity-25">
                        <div class="flex items-center px-2 lg:px-0">
                            <div class="hidden lg:block">
                                <div class="flex space-x-4">
                                    <a href="{{route('links.index')}}"
                                       class="{{str_starts_with(request()->route()->getName(), 'links') ? 'bg-emerald-700 text-white' : 'text-white hover:bg-emerald-500 hover:bg-opacity-75'}} rounded-md py-2 px-3 text-sm font-medium" aria-current="page">Links</a>
                                    <a href="{{route('tags.index')}}"
                                       class="{{str_starts_with(request()->route()->getName(), 'tags') ? 'bg-emerald-700 text-white' : 'text-white hover:bg-emerald-500 hover:bg-opacity-75'}} rounded-md py-2 px-3 text-sm font-medium">Tags</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-1 justify-center px-2 lg:ml-6 lg:justify-end">
                            <form class="w-full max-w-lg lg:max-w-xs" action="{{route('links.index')}}" method="GET">
                                <label for="search" class="sr-only">Search</label>
                                <div class="relative text-gray-400 focus-within:text-gray-600">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input id="search"
                                           class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-600 sm:text-sm sm:leading-6"
                                           placeholder="Search"
                                           type="search"
                                           value="{{request()->get('search')}}"
                                           name="search">
                                    @if(request()->has('search'))
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <a href="{{route('links.index')}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-400">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                        <div class="flex lg:hidden">
                            <button type="button" @click="open = !open" class="relative inline-flex items-center justify-center rounded-md bg-emerald-600 p-2 text-emerald-200 hover:bg-emerald-500 hover:bg-opacity-75 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-emerald-600" aria-controls="mobile-menu" aria-expanded="false">
                                <span class="absolute -inset-0.5"></span>
                                <span class="sr-only">Open main menu</span>
                                <svg :class="open ? 'hidden' : 'block'" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                                <svg :class="open ? 'block' : 'hidden'" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div x-show="open" class="lg:hidden" id="mobile-menu" x-cloak>
                    <div class="space-y-1 px-2 pb-3 pt-2">
                        <a href="{{route('links.index')}}" class="{{str_starts_with(request()->route()->getName(), 'links') ? 'bg-emerald-700 text-white' : 'text-white hover:bg-emerald-500 hover:bg-opacity-75'}} block rounded-md py-2 px-3 text-base font-medium" aria-current="page">Links</a>
                        <a href="{{route('tags.index')}}" class="{{str_starts_with(request()->route()->getName(), 'tags') ? 'bg-emerald-700 text-white' : 'text-white hover:bg-emerald-500 hover:bg-opacity-75'}} block rounded-md py-2 px-3 text-base font-medium">Tags</a>
                    </div>
                </div>
            </nav>
            <header class="py-10">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold tracking-tight text-white">{{$title ?? 'Links app'}}</h1>
                </div>
            </header>
        </div>

        <main class="-mt-32">
            <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
                <div class="rounded-lg bg-white px-5 py-6 shadow sm:px-6">
                    <!-- Content -->

                    @if(session()->has('alert-success'))
                        <div class="rounded-md bg-green-50 p-4 mb-8">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{session()->get('alert-success')}}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session()->has('alert-danger'))
                        <div class="rounded-md bg-red-50 p-4 mb-8">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-800">{{session()->get('alert-danger')}}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @yield('content')

                </div>
            </div>
        </main>
    </div>
    </body>
</html>

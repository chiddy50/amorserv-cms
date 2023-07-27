<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Website</title>

    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/website.css'])
    @yield('facebook_meta')

</head>
<body>
    <div>
        <!--- HEADER START --->
        <header class="website__header bg-white flex items-center">
            <div class="layout-width flex items-center justify-between">
                <h1 class="text-3xl">Amorserv</h1>
                <div class="flex items-center gap-5">
                    @if (count($pages) > 0)
                        @foreach ($pages as $page)
                            <a href="{{ route('dynamic.pages', $page->slug) }}" class="capitalize">{{ $page->title }}</a>
                        @endforeach
                    @else
                        <a href="/">Blog</a>
                    @endif
                </div>
            </div>
        </header>
        <!--- HEADER START --->

        <!--- CONTENT START --->
        @yield('content')
        <!--- CONTENT END --->


        <!--- FOOTER START --->
        <footer class="py-20 bg-gray-200">

            <div class="w-4/6 mx-auto flex items-center justify-center gap-10">
                @if (count($pages) > 0)
                    @foreach ($pages as $page)
                        <a href="{{ route('dynamic.pages', $page->slug) }}" class="capitalize">{{ $page->title }}</a>
                    @endforeach
                @else
                    <a href="/">Blog</a>
                @endif
            </div>
            <div class="w-4/6 mx-auto flex items-center justify-center mt-7">
                <p class="text-xs text-gray-500">Copyright {{ date('Y') }}, Designed & Developed by Chidi Michael. All right reserved</p>
            </div>
        </footer>
        <!--- FOOTER END --->

    </div>
</body>
</html>

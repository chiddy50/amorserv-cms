<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home Page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


    <!-- Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/css/admin.css'])

</head>
<body>
    <div class="min-h-screen">

        {{-- SIDEBAR --}}
        <div id="sidebar" class="admin__sidenav h-full top-0 left-0 overflow-x-hidden pt-5 px-5 fixed bg-gray-600">

            <div class="flex flex-col justify-between h-full text-white">

                <div>
                    <div class="sidebar__logo mt-2">
                        <h1 class="
                        xxs:text-xl
                        xs:text-xl
                        sm:text-xl
                        md:text-xl
                        lg:text-xl
                        xl:text-2xl
                        xxl:text-2xl
                        ">Amorserv</h1>
                        <i id="close-menu-btn" class='bx bx-x text-4xl text-white cursor-pointer'></i>
                    </div>


                    <div class="flex flex-col gap-4 mt-7">

                        <a href="{{ route('admin.dashboard') }}" >
                            <p class="flex items-center gap-2 cursor-pointer">
                                <i class='bx bxs-tachometer text-sm'></i>
                                <span class="text-sm">Dashboard</span>
                            </p>
                        </a>

                        <a href="{{ route('page.add') }}" >
                            <p class="flex items-center gap-2 cursor-pointer">
                                <i class='bx bxs-book-open text-sm' ></i>
                                <span class="text-sm">Pages</span>
                            </p>
                        </a>

                        <a href="{{ route('posts.view') }}" >
                            <p class="flex items-center gap-2 cursor-pointer">
                                <i class='bx bxl-blogger text-sm'></i>
                                <span class="text-sm">Posts</span>
                            </p>
                        </a>

                        <a href="{{ route('categories.view') }}">
                            <p class="flex items-center gap-2 cursor-pointer">
                                <i class='bx bxs-category text-sm'></i>
                                <span class="text-sm">Categories</span>
                            </p>
                        </a>

                        <a href="{{ route('tags.view') }}">
                            <p class="flex items-center gap-2 cursor-pointer">
                                <i class='bx bxs-purchase-tag-alt text-sm'></i>
                                <span class="text-sm">Tags</span>
                            </p>
                        </a>

                        <a href="{{ route('users.view') }}" >
                            <p class="flex items-center gap-2 cursor-pointer">
                                <i class='bx bxs-user text-sm'></i>
                                <span class="text-sm">Users</span>
                            </p>
                        </a>

                    </div>



                </div>

                <div class="mb-7">

                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="flex items-center justify-center rounded-lg bg-transparent border border-white py-1 px-3 w-5/6 mx-auto">
                            <i class='bx bx-chevron-left text-xl'></i>
                            <span class="text-xs">Logout</span>
                        </button>
                    </form>

                </div>
            </div>

        </div>
        {{-- SIDEBAR --}}

        <div class="admin__main relative ">

            {{-- HEADER --}}
            <div class="navbar shadow-sm px-10 flex items-center bg-white">
                <i id="mobile-menu-btn" class='
                    bx bx-menu-alt-left
                    cursor-pointer
                    text-4xl
                    sidemenu__control
                    hover:text-blue-500
                '></i>

                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2 cursor-pointer">
                        <i class='bx bx-user-circle text-3xl'></i>
                        <p class="text-xs font-bold">{{ Auth::user()->name }}</p>
                    </div>

                </div>
            </div>
            {{-- HEADER --}}

            <div class="p-5 admin__content " style="margin-top: 80px;">

                @yield('content')
            </div>

        </div>

    </div>
    @stack('script')

    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        mobileMenuBtn.addEventListener('click', (e) => {
            let sidebar = document.querySelector('#sidebar')
            sidebar.classList.toggle('show');
        });

        const closeMenuBtn = document.getElementById('close-menu-btn');
        closeMenuBtn.addEventListener('click', (e) => {
            let sidebar = document.querySelector('#sidebar')
            sidebar.classList.remove('show');
        });


    </script>
</body>
</html>

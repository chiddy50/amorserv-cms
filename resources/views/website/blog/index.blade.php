@extends('layouts.website')

@section('content')

<div style="margin-top: 80px;">

    <div class="hero py-20 bg-gray-800 flex flex-col gap-4 items-center text-white">
        <h1 class="text-4xl">Blog</h1>
    </div>

    @if (count($latestPosts) > 0)

    <section class="layout-width mt-5 grid grid-cols-6 gap-10 mb-10">
        <div class="col-span-4">

            @foreach ($latestPosts as $post)

                <div class="my-20">
                    <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>

                    <div class="flex items-center gap-5 text-gray-400 text-xs mb-7">
                        <p class="flex items-center gap-1">
                            <i class='bx bx-calendar-alt'></i>
                            <span>
                                {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->publish_date)->format('d, M Y') }}
                            </span>
                        </p>
                        <p class="flex items-center gap-1">
                            <i class='bx bxs-user'></i>
                            <p class="capitalize">Posted By {{ $post->author->name }}</p>
                        </p>

                    </div>

                    <p class="text-xs mb-7 leading-5">
                        {!! $post->description !!}
                        {{-- Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo officia autem, sunt aut pariatur sed corrupti maxime, cumque optio eligendi blanditiis, culpa a? Molestiae pariatur dolorum quod tempore voluptate tempora.
                        Sed illo tempore velit quidem culpa, sint id omnis minus optio doloremque odio tenetur atque dolor sapiente quas quis in maxime, similique voluptate qui rem nobis. Sequi enim excepturi quam?
                        Sunt inventore libero blanditiis nobis cupiditate? Officia, eligendi. Suscipit, vitae magni. Mollitia iure quos perspiciatis, illum blanditiis id odit nobis ut, modi quae ea, repellendus vitae suscipit vero maxime? Veritatis? --}}
                    </p>

                    <div class="mt-5">
                        <a href="{{ route('singleBlog', $post->id) }}">
                            <button class="blog__btn">CONTINUE READING</button>
                        </a>
                    </div>
                </div>


            @endforeach

            {!! $latestPosts->links() !!}

        </div>


        <div class="col-span-2">
            <div class="mt-10">
                <h1 class="text-lg font-bold pb-3 border-b border-gray-200">Latest Posts</h1>
                <div>

                    @foreach ($latestPosts as $post)
                        <div class="my-4">
                            <h1 class="font-bold text-gray-700 text-sm">{{ $post->title }}</h1>
                            <p class="text-xs text-gray-500">
                                {!! Str::limit($post->description, $limit = 30, $end = '...') !!}
                            </p>
                        </div>
                    @endforeach
                    {!! $latestPosts->links() !!}

                </div>
            </div>

        </div>
    </section>
    @else
        <div class="p-3 bg-gray-400 text-white gap-3 rounded-lg flex items-center justify-center">
            <i class='bx bxs-error-alt text-4xl'></i>
            <p class="text-sm">No post added yet</p>
        </div>
    @endif

</div>
@endsection

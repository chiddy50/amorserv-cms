@extends('layouts.website')

@section('content')
<div style="margin-top: 80px;">

    <div class="hero py-20 bg-gray-800 flex flex-col gap-4 items-center text-white">
        <h1 class="text-4xl">Single Blog</h1>
    </div>


    <section class="layout-width mt-5 mb-10">
        <div class="">
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
                        <span class="capitalize">Posted By {{ $post->author->name }}</span>
                    </p>
                </div>

                <p class="text-xs mb-7 leading-5">
                    {!! $post->description !!}
                </p>

            </div>

        </div>
    </section>

</div>
@endsection

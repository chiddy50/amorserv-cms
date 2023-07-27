
@extends('layouts.website')

@section('content')
    <div class="min-h-screen" style="margin-top: 80px;">
        <div class="hero py-20 bg-gray-800 capitalize  flex flex-col gap-4 items-center text-white">
            <h1 class="text-4xl">{{ $page->title }}</h1>
        </div>

        <div class="layout-width mt-4 flex items-center gap-1">
            <i class='bx bxs-purchase-tag-alt text-gray-500'></i>
            <p class="flex items-center gap-1">
                @foreach($page->tags as $tag)
                    <p class="capitalize"> {{ $tag->name }}</p>
                @endforeach
            </p>
        </div>

        <section class="layout-width mt-5 mb-10 grid gap-3
        xxs:grid-cols-1
        xs:grid-cols-1
        sm:grid-cols-1
        md:grid-cols-1
        lg:grid-cols-2
        xl:grid-cols-2
        xxl:grid-cols-2
        ">
            @if ($page->image)
                <img id="preview" src="{{url('/images/'. $page->image )}}" alt="your image" class="mt-3 rounded-2xl w-full" />
            @else

            @endif

            <div>{!! $page->content !!}</div>
        </section>
    </div>
@endsection

@section('facebook_meta')
    <meta property="og:description" content="{{ $page->meta_description }}">
    <meta property="og:title" content="{{ $page->meta_title }}">
    <meta property="og:keywords" content="{{ $page->meta_keywords }}">
@endsection

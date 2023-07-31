@extends('layouts.auth')

@section('content')

    <div class="
    grid
    xxs:grid-cols-1
    xs:grid-cols-1
    sm:grid-cols-1
    md:grid-cols-2
    lg:grid-cols-3
    xl:grid-cols-3
    xxl:grid-cols-3
    gap-5">
        <div class="p-5 bg-white shadow flex items-center justify-between">
            <p class="text-3xl font-bold">Pages</p>
            <p class="text-gray-400 text-2xl">{{ $page_count }}</p>
        </div>
        <div class="p-5 bg-white shadow flex items-center justify-between">
            <p class="text-3xl font-bold">Categories</p>
            <p class="text-gray-400 text-2xl">{{ $category_count }}</p>
        </div>
        <div class="p-5 bg-white shadow flex items-center justify-between">
            <p class="text-3xl font-bold">Tags</p>
            <p class="text-gray-400 text-2xl">{{ $tag_count }}</p>
        </div>
        <div class="p-5 bg-white shadow flex items-center justify-between">
            <p class="text-3xl font-bold">Admins</p>
            <p class="text-gray-400 text-2xl">{{ $admin_count }}</p>
        </div>
        <div class="p-5 bg-white shadow flex items-center justify-between">
            <p class="text-3xl font-bold">Editors</p>
            <p class="text-gray-400 text-2xl">{{ $editor_count }}</p>
        </div>
        <div class="p-5 bg-white shadow flex items-center justify-between">
            <p class="text-3xl font-bold">Posts</p>
            <p class="text-gray-400 text-2xl">{{ $post_count }}</p>
        </div>
    </div>
@endsection

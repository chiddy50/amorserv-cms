@extends('layouts.auth')

@section('content')
    <div class="grid grid-cols-6 gap-5 ">
        <section class="col-span-3">
            <h1 class="text-xl mb-5 font-bold">Edit Post</h1>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="mb-1 text-xs text-red-500">:message</div>')) !!}
            @endif

            <form class="mt-5" action="{{ route('posts.update') }}" method="post">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                <div class="mb-4 flex flex-col gap-1">
                    <label for="title" class="text-xs">Title</label>
                    <input type="text" value="{{ $post->title }}" name="title" class="py-2 px-4 rounded outline-none border border-gray-400 text-xs" placeholder="Title here...">
                </div>

                <div class="mb-4">
                    <label class="text-xs">Description</label>
                    <textarea class="ckeditor form-control" name="description">
                        {{ $post->description }}
                    </textarea>
                </div>

                <button type="submit" value="draft" name="type" class="outline-none mb-10 py-2 px-5 rounded-md bg-gray-500 text-white text-sm">Draft Post</button>
                <button type="submit" value="publish" name="type" class="outline-none mb-10 py-2 px-5 rounded-md bg-blue-500 text-white text-sm">Publish Post</button>

            </form>

        </section>

        <x-post-list :posts="$posts"></x-post-list>

    </div>

@endsection

@push('script')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

@endpush

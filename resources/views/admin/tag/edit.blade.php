@extends('layouts.auth')

@section('content')
    <div>
        <section class="mb-7">
            <h1 class="text-xl mb-5 font-bold">Edit Tag</h1>
            <form action="{{ route('tags.update') }}" method="post">
                @csrf

                <input type="hidden" name="tag_id" value="{{ $tag->id }}">

                <div class="mb-4 flex flex-col gap-1">
                    <label for="name" class="text-xs">Name</label>
                    <input type="text" name="name" value="{{ $tag->name }}" class="py-2 px-4 w-3/6 rounded outline-none border border-gray-400 text-xs" placeholder="Name here...">

                    @if (session('status'))
                        <div class="text-xs text-red-600">{{ session('status') }}</div>
                    @endif
                </div>
                <button class="outline-none mb-10 py-2 px-5 rounded-md bg-blue-600 text-white text-sm">Update</button>

            </form>
        </section>

        <section class="mb-7">
            <h1 class="text-xl mb-5 font-bold">Tags</h1>

            @if (count($tags) > 0)

            <div class="flex flex-wrap gap-2 mt-2">

                @foreach ($tags as $tag)
                <div class="border border-gray-300 bg-white rounded-xl py-2 px-4 text-gray-500 text-xs flex items-center gap-5">
                    <span>
                        {{ $tag->name }}
                    </span>
                    <div class="flex items-center gap-1">
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class='bx bx-trash cursor-pointer text-lg text-red-500'></i>
                            </button>
                        </form>

                        <a href="{{ route('tags.edit', $tag->id) }}">
                            <i class='bx bxs-edit cursor-pointer text-lg text-green-500'></i>
                        </a>
                    </div>
                </div>
                @endforeach

            </div>
            @else
                <div class="p-3 bg-gray-400 text-white gap-3 rounded-lg w-3/6 flex items-center justify-center">
                    <i class='bx bxs-error-alt text-4xl'></i>
                    <p class="text-sm">No tag added</p>
                </div>
            @endif

        </section>
    </div>
@endsection

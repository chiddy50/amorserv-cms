<section class="col-span-1">
    <h1 class="text-xl mb-5 font-bold">Posts</h1>

    @if (count($posts) > 0)
        <div class="flex flex-col">
            @foreach ($posts as $post)
                <div class="py-3 px-4 text-sm bg-white border border-gray-300 flex items-center justify-between mb-1 rounded-lg">
                    <p>{{ $post->slug }}</p>

                    <div class="flex items-center gap-3">

                        @if ($post->is_published == '0')

                        <form action="{{ route('posts.publish') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button class="rounded-md py-2 px-4 bg-green-500 text-white outline-none text-xs">
                                Publish
                            </button>
                        </form>

                        @endif

                        <form action="{{ route('post.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class='bx bx-trash cursor-pointer text-lg text-red-500'></i>
                            </button>
                        </form>

                        <a href="{{ route('posts.edit', $post->id) }}">
                            <i class='bx bxs-edit cursor-pointer text-lg text-green-500'></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        {!! $posts->links() !!}
    @else
        <div class="p-3 bg-gray-400 text-white gap-3 rounded-lg flex items-center justify-center">
            <i class='bx bxs-error-alt text-4xl'></i>
            <p class="text-sm">No post added yet</p>
        </div>
    @endif
</section>

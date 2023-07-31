<section class="col-span-1">
    <h1 class="text-xl mb-5 font-bold">Pages</h1>

    @if (count($pages) > 0)
        <div class="flex flex-col">
            @foreach ($pages as $page)
                <div class="py-3 px-4 text-sm bg-white border border-gray-300 flex items-center justify-between mb-1 rounded-lg">
                    <p>{{ $page->slug }}</p>

                    @if ($page->slug !== 'blog')
                    <div class="flex items-center gap-3">

                        @if ($page->is_published == '0')

                        <form action="{{ route('pages.publish') }}" method="post">
                            @csrf
                            <input type="hidden" name="page_id" value="{{ $page->id }}">
                            <button class="rounded-md py-2 px-4 bg-green-500 text-white outline-none text-xs">
                                Publish
                            </button>
                        </form>

                        @endif

                        <form action="{{ route('pages.destroy', $page->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <i class='bx bx-trash cursor-pointer text-lg text-red-500'></i>
                            </button>
                        </form>

                        <a href="{{ route('pages.edit', $page->id) }}">
                            <i class='bx bxs-edit cursor-pointer text-lg text-green-500'></i>
                        </a>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    @else
        <h4 class="text-muted text-center">No page added yet</h4>
    @endif
</section>

@extends('layouts.auth')

@section('content')
    <div class="
    grid
    xxs:grid-cols-1
    xs:grid-cols-1
    sm:grid-cols-1
    md:grid-cols-1
    lg:grid-cols-2
    xl:grid-cols-2
    xxl:grid-cols-2
    gap-5">
        <section class="col-span-1">
            <h1 class="text-xl mb-5 font-bold">Create Page</h1>

            @if($errors->any())
                {!! implode('', $errors->all('<div class="mb-1 text-xs text-red-500">:message</div>')) !!}
            @endif
            <form class="mt-5" action="{{ route('pages.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 flex flex-col gap-1">
                    <label for="title" class="text-xs">Title</label>
                    <input type="text" name="title" class="py-2 px-4 rounded outline-none border border-gray-400 text-xs" placeholder="Title here...">
                </div>

                <div class="mb-4">
                    <label class="text-xs">Content</label>
                    <textarea class="ckeditor form-control" name="content"></textarea>
                </div>

                <div class="mb-5">
                    <label class="text-sm mb-4">Upload Image:</label>
                    <div class="">
                      <input type="file" class="text-xs" name="image" @error('image') is-invalid @enderror id="selectImage">
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <img id="preview" src="{{ url('/images/avatar.png') }}" alt="your image" style="max-height: 100px" class="mt-3 rounded-2xl" />
                </div>

                <div class="mb-4 grid grid-cols-2">
                    <div>
                        <label for="tags" class="text-xs font-bold">Select Tags:</label>
                        <br>
                        @foreach ($tags as $tag)
                            <div class="flex items-center gap-1">
                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">

                                <label for="tag_{{ $tag->id }}" class="text-xs">{{ $tag->name }}</label>
                                <br>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        <label for="categories" class="text-xs font-bold">Select Categories:</label>
                        <br>
                        @foreach ($categories as $category)
                            <div class="flex items-center gap-1">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" id="category_{{ $category->id }}">
                                <label for="category_{{ $category->id }}" class="text-xs">{{ $category->name }}</label>
                                <br>
                            </div>
                        @endforeach
                    </div>
                </div>


                <div class="mb-4 flex flex-col gap-1">
                    <label for="meta_title" class="text-xs">Meta title</label>
                    <input type="text" name="meta_title" class="py-2 px-4 rounded outline-none border border-gray-400 text-xs" placeholder="Title here...">
                </div>
                <div class="mb-4 flex flex-col gap-1">
                    <label for="meta_description" class="text-xs">Meta description</label>

                    <textarea name="meta_description" id="meta_description"
                    class="py-2 px-4 rounded outline-none border border-gray-400 text-xs" placeholder="Meta description here..."
                    cols="30" rows="5"></textarea>
                </div>
                <div class="mb-4 flex flex-col gap-1">
                    <label for="meta_keywords" class="text-xs">Meta keywords</label>
                    <input type="text" name="meta_keywords" class="py-2 px-4 rounded outline-none border border-gray-400 text-xs" placeholder="Title here...">
                </div>

                <button type="submit" value="draft" name="type" class="outline-none mb-10 py-2 px-5 rounded-md bg-gray-500 text-white text-sm">Draft Page</button>
                <button type="submit" value="publish" name="type" class="outline-none mb-10 py-2 px-5 rounded-md bg-blue-500 text-white text-sm">Publish Page</button>

            </form>

        </section>

        <x-page-list :pages="$pages"></x-page-list>

    </div>

@endsection

@push('script')
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>

    <script>
        const selectImage = document.getElementById('selectImage');
        selectImage.onchange = (evt) => {

            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush

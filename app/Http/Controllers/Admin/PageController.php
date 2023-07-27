<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Tag;
use App\Models\Category;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function show($slug)
    {
        // Fetch the page content based on the slug
        $page = Page::with(['tags'])->where('slug', $slug)->first();

        if (!$page) {
            // Page not found, handle the error or redirect to a 404 page
            abort(404);
        }

        $pages = Page::where('is_published', 1)->get();

        if ($slug === 'blog') {
            return redirect('/');
        }

        // Pass the page content to the view
        return view('website.page')->with([
            'page' => $page,
            'pages' => $pages,
        ]);
    }

    /**
     * Publish drafted pages
     */
    public function publish(Request $request)
    {
        $request->validate([
            'page_id' => 'required|integer'
        ]);
        $user = auth()->user();

        $page = Page::find($request->page_id);

        $page = $page->update([
            'published_by' => $user->id,
            'is_published' => 1,
            'publish_date' => now()->format('Y-m-d H:i:s')
        ]);

        return back();
    }

    /**
     * View create page form
     */
    public function viewCreatePageForm(Request $request){
        $pages = Page::all();
        $tags = Tag::all();
        $categories = Category::all();

        return view('admin.page.createPage')->with([
            'pages' => $pages,
            'tags' => $tags,
            'categories' => $categories,
        ]);
    }

    /**
     * Create a Page
     */
    public function store(Request $request){
        $tagIds = $request->input('tags', []);
        $categoryIds = $request->input('categories', []);

        $tags_validator = Validator::make(
            ['categories' => $categoryIds],
            [
                'categories' => 'array',
                'categories.*' => 'exists:categories,id',
            ],
            [
                'categories.*.exists' => 'One or more selected categories are invalid.',
            ]
        );

        $categories_validator = Validator::make(
            ['tags' => $tagIds],
            [
                'tags' => 'array',
                'tags.*' => 'exists:tags,id',
            ],
            [
                'tags.*.exists' => 'One or more selected tags are invalid.',
            ]
        );

        $request->validate([
            'tags' => $tags_validator->fails() ? 'bail' : 'array', // Use 'bail' to stop validation on failure
            'categories' => $categories_validator->fails() ? 'bail' : 'array', // Use 'bail' to stop validation on failure
            'title' => 'required|string',
            'type' => 'required|string',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = auth()->user();

        $image = null;
        if ($request->image) {
            $image = $this->uploadImage($request->image);
        }

        $page = Page::create([
            'title'             => $request->input('title'),
            'content'           => $request->input('content'),
            'slug'              => Str::slug($request->input('title')),
            'meta_title'        => $request->input('meta_title'),
            'meta_description'  => $request->input('meta_description'),
            'meta_keywords'     => $request->input('meta_keywords'),
            'created_by'        => $user->id,
            'published_by'      => $request->type === 'publish' ? $user->id : null,
            'is_published'      => $request->type === 'publish' ? 1 : 0,
            'publish_date'      => $request->type === 'publish' ? now()->format('Y-m-d H:i:s') : null,
            'image'             => $image ? $image : null
        ]);

        // 'image_id',
        // 'order',

        if ($page) {
            $tags = Tag::whereIn('id', $tagIds)->get();
            $page->tags()->sync($tags);

            $categories = Category::whereIn('id', $categoryIds)->get();
            $page->categories()->sync($categories);
            return back();
        }

        return back()->with('status', 'Unable to create page');
    }


    /**
     * View create page form
     */
    public function viewEditPageForm($id){
        $page = Page::with(['categories', 'tags'])->where('id', $id)->first();
        if (!$page) {
            return back();
        }

        $pages = Page::all();
        $tags = Tag::all();
        $categories = Category::all();

        $pageTags = $page->tags->pluck('id')->toArray();
        $pageCategories = $page->categories->pluck('id')->toArray();

        return view('admin.page.editPage')->with([
            'page' => $page,
            'pages' => $pages,
            'tags' => $tags,
            'categories' => $categories,
            'pageTags' => $pageTags,
            'pageCategories' => $pageCategories,
        ]);
    }

    public function update(Request $request){
        $tagIds = $request->input('tags', []);
        $categoryIds = $request->input('categories', []);

        $tags_validator = Validator::make(
            ['categories' => $categoryIds],
            [
                'categories' => 'array',
                'categories.*' => 'exists:categories,id',
            ],
            [
                'categories.*.exists' => 'One or more selected categories are invalid.',
            ]
        );

        $categories_validator = Validator::make(
            ['tags' => $tagIds],
            [
                'tags' => 'array',
                'tags.*' => 'exists:tags,id',
            ],
            [
                'tags.*.exists' => 'One or more selected tags are invalid.',
            ]
        );

        $request->validate([
            'tags' => $tags_validator->fails() ? 'bail' : 'array',
            'categories' => $categories_validator->fails() ? 'bail' : 'array', // Use 'bail' to stop validation on failure
            'page_id' => 'required',
            'type' => 'required',
            'title' => 'required',
            'content' => 'required',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = auth()->user();

        $page = Page::findOrFail($request->page_id);

        $image = null;

        // dd($request->image);

        if ($request->image) {

            // Upload new image
            if ($request->image) {
                $image = $this->uploadImage($request->image);
            }

            if ($page->image) {
                // delete previous image
                if(file_exists(public_path('images/'.$page->image))){
                    unlink(public_path('images/'.$page->image));
                }
            }
        }

        $updated = $page->update([
            'title'             => $request->input('title'),
            'content'           => $request->input('content'),
            'slug'              => Str::slug($request->input('title')),
            'meta_title'        => $request->input('meta_title'),
            'meta_description'  => $request->input('meta_description'),
            'meta_keywords'     => $request->input('meta_keywords'),
            'published_by'      => $request->type === 'publish' ? $user->id : null,
            'is_published'      => $request->type === 'publish' ? 1 : 0,
            'publish_date'      => $request->type === 'publish' ? now()->format('Y-m-d H:i:s') : null,
            'image'             => $image ? $image : $page->image
        ]);

        if ($updated) {
            $tags = Tag::whereIn('id', $tagIds)->get();
            $page->tags()->sync($tags);

            $categories = Category::whereIn('id', $categoryIds)->get();
            $page->categories()->sync($categories);

            return redirect()->route('page.add');
        }

        return back();
    }

    public function destroy($id)
    {
        $page = Page::find($id);

        if(file_exists(public_path('images/'.$page->image))){
            unlink(public_path('images/'.$page->image));
        }

        $page->delete();

        return redirect()->route('page.add');
    }
}

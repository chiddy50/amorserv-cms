<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function viewPosts(){
        $posts = Post::paginate(10);
        $test = Post::all();

        return view('admin.post.add')->with([
            'posts' => $posts
        ]);
    }

    public function addPost(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string'
        ]);

        $user = auth()->user();

        $post = Post::create([
            'title'             => $request->input('title'),
            'description'       => $request->input('description'),
            'slug'              => Str::slug($request->input('title')),
            'published_by'      => $request->type === 'publish' ? $user->id : null,
            'is_published'      => $request->type === 'publish' ? 1 : 0,
            'publish_date'      => $request->type === 'publish' ? now()->format('Y-m-d H:i:s') : null,
        ]);

        return back();
    }

    /**
     * Publish drafted post
     */
    public function publish(Request $request)
    {
        $request->validate([
            'post_id' => 'required|integer'
        ]);
        $user = auth()->user();

        $post = Post::find($request->post_id);

        $post = $post->update([
            'published_by' => $user->id,
            'is_published' => 1,
            'publish_date' => now()->format('Y-m-d H:i:s')
        ]);

        return back();
    }

    public function editPost($id){
        $post = Post::find($id);
        $posts = Post::paginate(10);

        return view('admin.post.edit')->with([
            'post' => $post,
            'posts' => $posts
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'post_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string'
        ]);

        $title_name_exists = Post::where('title', $request->title)->where('id', '!=', $request->post_id)->first();
        if ($title_name_exists) {
            return back()->with('status', 'Title exists already');
        }

        $post = Post::find($request->post_id);

        $updated = $post->update([
            'title'             => $request->input('title'),
            'description'       => $request->input('description'),
            'slug'              => Str::slug($request->input('title')),
            'published_by'      => $request->type === 'publish' ? $user->id : $post->published_by,
            'is_published'      => $request->type === 'publish' ? 1 : 0,
            'publish_date'      => $request->type === 'publish' ? now()->format('Y-m-d H:i:s') : $post->publish_date
        ]);

        return redirect()->route('posts.view');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect()->route('posts.view');
    }
}


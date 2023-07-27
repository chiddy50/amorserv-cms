<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Post;

class HomeController extends Controller
{
    public function home(){
        $pages = Page::where('is_published', 1)->get();

        $latestPosts = Post::where('is_published', 1)->orderBy('publish_date', 'desc')->limit(5)->paginate(3);

        return view('website.blog.index')->with([
            'pages' => $pages,
            'latestPosts' => $latestPosts
        ]);
    }

    public function singleBlog($id){
        $post = Post::where('id', $id)->first();
        $pages = Page::where('is_published', 1)->get();

        return view('website.blog.single')->with([
            'pages' => $pages,
            'post' => $post
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Page;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Post;

class AdminController extends Controller
{
    public function viewDashboard()
    {
        $page_count = Page::count();
        $admin_count = User::where('role_id', 1)->count();
        $editor_count = User::where('role_id', 2)->count();
        $category_count = Category::count();
        $tag_count = Tag::count();
        $post_count = Post::count();

        return view('auth.dashboard')->with([
            'page_count' => $page_count,
            'admin_count' => $admin_count,
            'editor_count' => $editor_count,
            'category_count' => $category_count,
            'tag_count' => $tag_count,
            'post_count' => $post_count
        ]);
    }

}

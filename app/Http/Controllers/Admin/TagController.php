<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function view(){
        $tags = Tag::all();

        return view('admin.tag.create')->with([
            'tags' => $tags
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $tag_lower_case = strtolower($request->name);
        $name_taken = Tag::where('name', $tag_lower_case)->first();
        if ($name_taken) {
            return back()->with('status', 'Tag name exists already');
        }

        $tag = Tag::create([
            'name' => $tag_lower_case
        ]);

        return back();
    }

    public function viewEditTagForm($id){
        $tag = Tag::find($id);
        if (!$tag) {
            return back();
        }

        $tags = Tag::all();

        return view('admin.tag.edit')->with([
            'tag' => $tag,
            'tags' => $tags
        ]);
    }

    public function update(Request $request){
        $request->validate([
            'tag_id' => 'required|integer',
            'name' => 'required|string'
        ]);

        $tag_lower_case = strtolower($request->name);
        $tag_name_exists = Tag::where('name', $tag_lower_case)->where('id', '!=', $request->tag_id)->first();
        if ($tag_name_exists) {
            return back()->with('status', 'Tag name exists already');
        }

        $tag = Tag::find($request->tag_id);

        $updated = $tag->update([
            'name' => $tag_lower_case
        ]);

        return redirect()->route('tags.view');
    }

    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();

        return redirect()->route('tags.view');
    }
}

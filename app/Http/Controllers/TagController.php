<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){}

    public function create(){}

    public function store(StoreTagRequest $request)
    {
        $tag = new Tag();
        $tag->tag_name = $request->input('tag_name');
        $tag->save();

        return redirect()->back()->with('message', __('Tag successfully created'));
    }

    public function show(Tag $tag){}

    public function edit(Tag $tag){}

    public function update(Request $request, Tag $tag){}

    public function destroy(Tag $tag){}
}

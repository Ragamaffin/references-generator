<?php

namespace App\Http\Controllers;

use App\Http\Requests\Resource\StoreResourceRequest;
use App\Models\Reference;
use App\Models\Resource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::orderBy('resource_id', 'desc')->paginate(20);
        $tags = Tag::all();

        return view('resources.index', compact(['resources', 'tags']));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('resources.create', compact(['tags']));
    }

    public function store(StoreResourceRequest $request)
    {
        $resource = new Resource();

        $resource->resource_name = $request->input('resource_name');
        $resource->resource_type = $request->input('resource_type');
        $resource->description = $request->input('description');
        $resource->year = $request->input('year');
        $resource->resource_url = $request->input('resource_url');
        $resource->created_by = Auth()->user()->user_id;

        if ($request->hasFile('file_input')) {
            $file = $request->file('file_input');
            $fileName = $file->getClientOriginalName();
            $fileNameData = pathinfo($fileName);

            $randomName = $fileNameData['filename'].'-'.now()->timestamp.'.'.$fileNameData['extension'];
            File::put(public_path('uploads/resources/'.$randomName), $file->getContent());

            $resource->file_path = $randomName;
        }
        $resource->save();

        if ($request->tags) {
            foreach ($request->tags as $tag) {
                $resource->tags()->attach($tag);
            }
        }

        return redirect()->route('resources.show', $resource)->with('message', __('Resource successfully created'));
    }

    public function show(Resource $resource)
    {
        $references = Reference::getReferencesCreatedByCurrentUser();

        return view('resources.show', compact(['resource', 'references']));
    }


    public function edit(Resource $resource){
        $selectedTags = $resource->tags->pluck('tag_id');
        $tags = Tag::all();
        return view('resources.edit', compact(['resource', 'tags', 'selectedTags']));
    }


    public function update(StoreResourceRequest $request, Resource $resource)
    {
        $resource->resource_name = $request->input('resource_name');
        $resource->resource_type = $request->input('resource_type');
        $resource->description = $request->input('description');
        $resource->year = $request->input('year');
        $resource->resource_url = $request->input('resource_url');


        return redirect()->route('resources.show', $resource)->with('message', __('Resource successfully updated'));
    }

    public function destroy(Resource $resource){}

    public function downloadFile(Resource $resource)
    {
        return response()->download('uploads/resources/'.$resource->file_path);
    }

    public function search(Request $request)
    {
        $resourceName = $request->input('search_name');
        $selectedTags = $request->tags;
        $query = Resource::query();
        if ($resourceName) {
            $query->where('resource_name', 'LIKE', "$resourceName%");
        }
        if ($selectedTags) {
            $query->whereHas('tags', function($query) use($selectedTags) {
                $query->whereIn('tags.tag_id', $selectedTags);
            });
        }
        $resources = $query->orderBy('resource_name')->paginate(10);
        $tags = Tag::all();

        return view('resources.index', compact(['resources', 'tags', 'selectedTags']));
    }
}

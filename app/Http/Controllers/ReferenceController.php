<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reference\StoreReferenceRequest;
use App\Models\Reference;
use App\Models\Resource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;

class ReferenceController extends Controller
{
    public function index()
    {
        $references = Reference::orderBy('reference_id', 'desc')->paginate(20);
        $tags = Tag::query()->get();

        return view('references.index', compact(['references', 'tags']));
    }

    public function create()
    {
        return view('references.create');
    }

    public function store(StoreReferenceRequest $request)
    {
        $reference = new Reference();

        $reference->reference_name = $request->input('reference_name');

        $reference->save();

        return redirect()->route('references.show', $reference)->with('message', __('Reference successfully created. Please fill it using resources.'));
    }

    public function show(Reference $reference)
    {
        return view('references.show', compact(['reference']));
    }

    public function edit(Reference $reference)
    {
        //
    }

    public function update(Request $request, Reference $reference)
    {
        //
    }

    public function destroy(Reference $reference)
    {
        //
    }

    public function search(Request $request)
    {
        $referenceName = $request->input('search_name');
        $selectedTags = $request->tags;
        $query = Reference::query();
        if ($referenceName) {
            $query->where('reference_name', 'LIKE', "$referenceName%");
        }
        if ($selectedTags) {
            $query->whereHas('tags', function($query) use($selectedTags) {
                $query->whereIn('tags.tag_id', $selectedTags);
            });
        }
        $references = $query->orderBy('reference_name')->paginate(10);
        $tags = Tag::query()->get();

        return view('references.index', compact(['references', 'tags', 'selectedTags']));
    }

    public function removeResource(Reference $reference, Resource $resource)
    {
        if ($reference->resources()->detach($resource->resource_id)) {
            return Redirect::back()->with('message', sprintf(__("Resource %s removed from current reference"), $resource->resource_name));
        }

        return Redirect::back()->with('error', sprintf(__("This reference does not have resource %s"), $resource->resource_name));
    }
}

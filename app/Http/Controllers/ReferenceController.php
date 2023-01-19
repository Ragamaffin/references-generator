<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\Reference\StoreReferenceRequest;
use App\Models\Reference;
use App\Models\Resource;
use App\Models\Tag;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{
    public function index()
    {
        $references = Reference::orderBy('reference_id', 'desc')->paginate(20);
        $tags = Tag::all();

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
        $reference->created_by = Auth()->user()->user_id;

        $reference->save();

        Helper::setTags($reference, $request);

        return redirect()->route('references.show', $reference)->with('message', __('Reference successfully created. Please fill it using resources.'));
    }

    public function show(Reference $reference)
    {
        return view('references.show', compact(['reference']));
    }

    public function edit(Reference $reference)
    {
        $selectedTags = $reference->tags->pluck('tag_id');
        $tags = Tag::all();

        return view('references.edit', compact(['reference', 'tags', 'selectedTags']));
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
        $tags = Tag::all();

        return view('references.index', compact(['references', 'tags', 'selectedTags']));
    }

    public function removeResource(Reference $reference, Resource $resource)
    {
        if ($reference->resources()->detach($resource->resource_id)) {
            return redirect()->back()->with('message', sprintf(__("Resource %s successfully removed from current reference"), $resource->resource_name));
        }

        return redirect()->back()->with('error', sprintf(__("This reference does not have resource %s"), $resource->resource_name));
    }

    public function addResourceToReference(Request $request, Resource $resource)
    {
        $reference = (new Reference)->find($request->reference);
        $relatedResource = $reference->resources()->where('resources.resource_id', $resource->resource_id)->first();

        if (!$relatedResource) {
            $reference->resources()->attach($resource->resource_id);

            return redirect()->back()->with('message', sprintf(__("Resource %s successfully attached to reference %s"), $resource->resource_name, $reference->reference_name));
        }

        return redirect()->back()->with('error', sprintf(__("Resource %s already attached to reference %s"), $resource->resource_name, $reference->reference_name));
    }
}

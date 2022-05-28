<label for="search_by_name" class="col-auto">{{ __('Search by name') }}</label>
<div class="col mb-2">
    <input type="text" class="form-control" id="search_name" name="search_name">
</div>

<label for="search_by_tags" class="col-auto">{{ __('Search by tags') }}</label>
<div class="col mb-2">
    <select class="form-control tags-select" name="tags[]" multiple>
        @foreach ($tags as $tag)
            @if (isset($selectedTags) && in_array($tag->tag_id, $selectedTags))
                <option value="{{ $tag->tag_id}}" selected>{{ $tag->tag_name }}</option>
            @else
                <option value="{{ $tag->tag_id}}">{{ $tag->tag_name }}</option>
            @endif
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-primary">
    {{ __('Search') }}
</button>

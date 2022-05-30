<form action="{{route('tags.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade text-left" id="ModalCreateTag" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Create new tag') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="tag_name" class="col-md-4 col-form-label text-md-end">{{ __('Tag name') }}</label>

                        <div class="col-md-6">
                            <input id="tag_name" type="text" class="form-control @error('tag_name') is-invalid @enderror" name="tag_name" value="{{ old('tag_name') }}" required autocomplete="tag_name" autofocus>

                            @error('tag_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btn grey btn-outline-secondary" data-bs-dismiss="modal">{{ __('Back') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('Save') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

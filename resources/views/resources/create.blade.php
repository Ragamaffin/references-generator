@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create new resource') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="resource_name" class="col-md-4 col-form-label text-md-end">{{ __('Resource name') }}</label>

                                <div class="col-md-6">
                                    <input id="resource_name" type="text" class="form-control @error('resource_name') is-invalid @enderror" name="resource_name" value="{{ old('resource_name') }}" required autocomplete="resource_name" autofocus>

                                    @error('resource_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="resource_type" class="col-md-4 col-form-label text-md-end">{{ __('Resource type') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control @error('resource_type') is-invalid @enderror" name="resource_type" id="resource_type" onchange="changeFormByResourceType()">
                                        @foreach (\App\Models\Resource::getAllTypes() as $key => $value)
                                            @if (old('resource_type') == $key)
                                                <option value="{{ $key }}" selected>{{ $value }}</option>
                                            @else
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('resource_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="year" class="col-md-4 col-form-label text-md-end">{{ __('Year') }}</label>

                                <div class="col-md-6">
                                    <input id="year" type="number" maxlength="4" max="{{ now()->year }}" oninput="maxLengthCheck(this)" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ old('year') }}" autocomplete="year" autofocus>

                                    @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3" id="resource_url" hidden>
                                <label for="resource_url" class="col-md-4 col-form-label text-md-end">{{ __('Resource URL') }}</label>

                                <div class="col-md-6">
                                    <input id="resource_url" type="text" class="form-control @error('resource_url') is-invalid @enderror" name="resource_url" value="{{ old('resource_url') }}" autocomplete="resource_url">

                                    @error('resource_url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3" id="file_input">
                                <label for="file_input" class="col-md-4 col-form-label text-md-end">{{ __('File upload') }}</label>

                                <div class="col-md-6">
                                    <input id="file_input" type="file" class="form-control @error('file_input') is-invalid @enderror" name="file_input">

                                    @error('file_input')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3" id="description">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description">{{ old('description') }}</textarea>

                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit reference') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('references.update', [$reference]) }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-3">
                                <label for="reference_name" class="col-md-4 col-form-label text-md-end">{{ __('Reference name') }}</label>

                                <div class="col-md-6">
                                    <input id="reference_name" type="text" class="form-control @error('reference_name') is-invalid @enderror" name="reference_name" value="{{ old('reference_name', $reference->reference_name) }}" required autocomplete="reference_name" autofocus>

                                    @error('reference_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
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

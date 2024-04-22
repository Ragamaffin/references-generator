@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Resource details') }}
                        @if (Helper::isUserHasAccess($resource))
                            <a href="{{ route('resources.edit', [$resource]) }}"
                               class="btn btn-warning float-end mx-2">{{ __('Edit') }}</a>
                        @endif
                            <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal"
                               data-bs-target="#ModalAddToReference">{{ __('Add to reference') }}</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3"><h6 class="mb-0">{{ __('Resource name') }}</h6></div>
                            <div class="col-9">{{ $resource->resource_name }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3"><h6 class="mb-0">{{ __('Resource type') }}</h6></div>
                            <div class="col-9">{{ $resource->getTypeName() }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3"><h6 class="mb-0">{{ __('Year') }}</h6></div>
                            <div class="col-9">{{ $resource->year }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3"><h6 class="mb-0">{{ __('Tags') }}</h6></div>
                            <div class="col-9">{{Helper::getRelatedTagsToString($resource) }}</div>
                        </div>
                        <hr>
                        @if ($resource->resource_url)
                            <div class="row">
                                <div class="col-3"><h6 class="mb-0">{{ __('Resource URL') }}</h6></div>
                                <a class="btn btn-primary col-auto" target="_tab" rel="noopener noreferrer"
                                   href="{{ $resource->resource_url }}">{{ __('Open URL') }}</a>
                            </div>
                            <hr>
                        @endif
                        @if ($resource->file_path)
                            <div class="row">
                                <div class="col-3"><h6 class="mb-0">{{ __('File') }}</h6></div>
                                <a class="btn btn-primary col-auto"
                                   href="{{ route('resources.download', $resource) }}">{{ __('Download') }}</a>
                            </div>
                            <hr>
                        @endif
                        <div class="row">
                            <div class="col-3"><h6 class="mb-0">{{ __('Created by') }}</h6></div>
                            <a class="btn btn-primary col-auto">{{ $resource->user->last_name . ' ' . $resource->user->first_name . ' ' . $resource->user->patronymic }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modals.add_resource_to_reference')
@endsection

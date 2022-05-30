@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header container-fluid">
                        {{ __('Resources') }}
                        <a href="{{ route('resources.create') }}" class="btn btn-primary float-end mx-2">{{ __('Create new resource') }}</a>
                        <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#ModalCreateTag">{{ __('Create new tag') }}</a>
                    </div>
                    <div class="card-body">
                        <form method="get" action="{{ route('resources.search') }}" class="col-12 mb-3 container-fluid" role="search">
                            <div class="row">
                                @include('layouts.filter_form')
                            </div>
                        </form>

                        <table class="table table-striped resource-table">
                            <thead>
                                <tr>
                                    <th class="col-auto" scope="col">{{ __('Resource name') }}</th>
                                    <th class="col-auto" scope="col">{{ __('Resource type') }}</th>
                                    <th class="col-auto" scope="col">{{ __('Tags') }}</th>
                                    <th class="col-auto" scope="col">{{ __('Created by') }}</th>
                                    <th class="col-auto" scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resources as $resource)
                                <tr>
                                    <td>{{ $resource->resource_name }}</td>
                                    <td>{{ $resource->getTypeName() }}</td>
                                    <td>{{ \App\Models\Helper::getRelatedTagsToString($resource) }}</td>
                                    <td>{{ $resource->user->getFullName() }}</td>
                                    <td>
                                        <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-secondary">{{ __('Details') }}</a>
                                        @if (\App\Models\Helper::isCreatedByUser($resource) || \App\Models\Helper::isAdmin())
                                            <a href="{{ route('resources.edit', $resource) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $resources->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    @include('modals.create_tag')
@endsection

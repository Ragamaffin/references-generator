@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Reference details') }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3"> <h6 class="mb-0">{{ __('Reference name') }}</h6> </div>
                            <div class="col-9">{{ $reference->reference_name }}</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-3"> <h6 class="mb-0">{{ __('Tags') }}</h6> </div>
                            <div class="col-9">{{ \App\Models\Helper::getRelatedTagsToString($reference) }}</div>
                        </div>
                        <hr>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="col-auto" scope="col">{{ __('Resource name') }}</th>
                                <th class="col-auto" scope="col">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reference->resources as $resource)
                                <tr>
                                    <td>{{ $resource->resource_name }}</td>
                                    <td>
                                        <a href="{{ route('resources.show', $resource) }}" class="btn btn-sm btn-secondary">{{ __('Details') }}</a>
                                        <a href="{{ route('references.removeResource', [$reference, $resource]) }}" class="btn btn-sm btn-danger delete-confirm" onclick="confirm({{ __('Are you sure you want to remove this resource from reference?') }})">
                                            {{ __('Remove') }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.delete-confirm').on('click', function (event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: '{{ __('Are you sure you want to remove this resource from reference?') }}',
                icon: 'warning',
                buttons: ["{{ __('Cancel') }}", "{{ __('Remove') }}"],
            }).then(function(value) {
                if (value) {
                    window.location.href = url;
                }
            });
        });
    </script>
@endsection

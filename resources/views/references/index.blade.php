@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('References') }}
                        <a href="{{ route('references.create') }}" class="btn btn-primary float-end">{{ __('Create new reference') }}</a>
                    </div>

                    <div class="card-body">
                        <form method="get" action="{{ route('references.search') }}" class="col-12 mb-3 container-fluid" role="search">
                            <div class="row">
                                @include('layouts.filter_form')
                            </div>
                        </form>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-auto" scope="col">{{ __('Reference name') }}</th>
                                    <th class="col-auto" scope="col">{{ __('Tags') }}</th>
                                    <th class="col-auto" scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($references as $reference)
                                <tr>
                                    <td>{{ $reference->reference_name }}</td>
                                    <td>{{ \App\Models\Helper::getRelatedTagsToString($reference) }}</td>
                                    <td>
                                        <a href="{{ route('references.show', $reference) }}" class="btn btn-sm btn-secondary">{{ __('Details') }}</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $references->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

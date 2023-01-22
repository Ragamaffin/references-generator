@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Users') }}
                    </div>

                    <div class="card-body">
                        <form method="get" action="{{ route('users.search') }}" class="col-12 mb-3 container-fluid"
                              role="search">
                            <div class="row">
                                @include('layouts.users_filter_form')
                            </div>
                        </form>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="col-auto" scope="col">{{ __('Full name') }}</th>
                                <th class="col-auto" scope="col">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->getFullName() }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user) }}"
                                           class="btn btn-sm btn-secondary">{{ __('Check resources/references') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $users->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection

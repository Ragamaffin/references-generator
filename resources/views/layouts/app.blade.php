<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url(\App\Providers\RouteServiceProvider::HOME) }}">
                    <img src="{{ asset('icons/main-icon.png') }}" width="64">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                        <li class="nav-item px-2">
                            <a class="nav-link link-dark" href="{{ route('resources.index') }}">
                                <img src="{{ asset('icons/resources-icon.png') }}" width="32">
                                {{ __('Resources') }}
                            </a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link link-dark" href="{{ route('references.index') }}">
                                <img src="{{ asset('icons/references-icon.png') }}" width="32">
                                {{ __('References') }}
                            </a>
                        </li>
                            <li class="nav-item px-2">
                                <a class="nav-link link-dark" href="{{ route('users.index') }}">
                                    <img src="{{ asset('icons/users-icon.png') }}" width="32">
                                    {{ __('Users') }}
                                </a>
                            </li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item mx-2">
                                    <a class="btn btn-primary" href="{{ route('login') }}">{{ __('Auth') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="btn btn-primary" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->getFullName() }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script>
        function maxLengthCheck(object)
        {
            if (object.value.length > object.maxLength || object.value > object.max)
                object.value = object.max;
        }
    </script>

    <script>
        function changeFormByResourceTypeWithExistingModel(value)
        {
            const resourceType = $("#resource_type option:selected");
            const divURL = $("div#resource_url");
            const divFile = $("div#file_input");
            const inputURL = $("input#resource_url");
            const inputFile = $("input#file_input");

            if (resourceType.val() === "{{ \App\Models\Resource::RESOURCE_TYPE_FILE }}") {
                divFile.removeAttr("hidden");
                divURL.attr("hidden", true);
                if (value !== "{{ \App\Models\Resource::RESOURCE_TYPE_URL }}" && inputFile.val().length > 0) {
                    inputURL.val('');
                }
            }

            if (resourceType.val() === "{{ \App\Models\Resource::RESOURCE_TYPE_URL }}") {
                divURL.removeAttr("hidden");
                divFile.attr("hidden", true);
                if (value !== "{{ \App\Models\Resource::RESOURCE_TYPE_FILE }}" && inputURL.val().length > 0) {
                    inputFile.val('');
                }
            }
        }
    </script>

    <script>
        function changeFormByResourceType()
        {
            const resourceType = $("#resource_type option:selected");
            const divURL = $("div#resource_url");
            const divFile = $("div#file_input");
            const inputURL = $("input#resource_url");
            const inputFile = $("input#file_input");

            if (resourceType.val() === "{{ \App\Models\Resource::RESOURCE_TYPE_FILE }}") {
                divFile.removeAttr("hidden");
                divURL.attr("hidden", true);
                inputURL.val('');
            }

            if (resourceType.val() === "{{ \App\Models\Resource::RESOURCE_TYPE_URL }}") {
                divURL.removeAttr("hidden");
                divFile.attr("hidden", true);
                inputFile.val('');
            }
        }
    </script>

    <script>
        $('.tags-select').select2();
    </script>

    <script>
        @if(session('message'))
        swal({
            title: '{{ session('message') }}',
            icon: 'success',
            button: '{{ __('Confirm') }}'
        })
        @endif

        @if(session('error'))
        swal({
            title: '{{ session('error') }}',
            icon: 'error',
            button: '{{ __('Confirm') }}'
        })
        @endif
    </script>

    <script>
        window.onresize = function(event) {
            $('.tags-select').select2();
        }
    </script>
    @yield('scripts')
</body>
</html>

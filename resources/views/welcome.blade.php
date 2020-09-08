<!doctype html>
<html style="height:100%;" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="d-flex h-100">
    <div class="jumbotron jumbotron-fluid m-auto bg-transparent">
        <div class="container">
            <h1 class="display-4 text-center">
                <a class="nav-link" href="{{ url('/redirect') }}">
                    {{ __('To the balls of men') }}
                    <br>
                    <small style="font-size:1rem">click to login</small>
                </a>
            </h1>
        </div>
    </div>
</body>

</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-primary h-100 w-100 position-fixed d-flex align-items-center">

<div class="container ">

    <!-- Outer Row -->
    <div class="row justify-content-center w-100">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image" style="min-height: 660px"></div>
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="p-5 w-100">
                                <!-- Nested Row within Card Body -->
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">{{ env('APP_NAME') }}</h1>
                                </div>

                                @yield('content')
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/admin/app.js') }}" defer></script>

</body>

</html>

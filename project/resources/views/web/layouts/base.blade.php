<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>
        @if(isset($title))
            {{ $title }} |
        @endif
        {{ config('app.name') }}
    </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(isset($meta_keywords))
        <meta name="keywords" content="{{ $meta_keywords }}">
    @endif

    @if(isset($meta_description))
        <meta name="description" content="{{ $meta_description }}">
    @endif

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <link href="{{asset('css/web/app.css')}}" rel="stylesheet">
</head>

<body id="page-top" data-aos-easing="ease" data-aos-duration="600" data-aos-delay="0">
@include('web.layouts.header')

@yield('content')

@include('web.layouts.footer')
</body>

<script type="text/javascript" src="{{ asset('js/web/app.js') }}"></script>

</html>

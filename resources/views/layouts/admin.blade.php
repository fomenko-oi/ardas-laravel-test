<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name'))</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>

<div id="app">
    @include('layouts._partials.header')

    <main role="main" class="container pt-3">
        @section('breadcrumbs', Breadcrumbs::render())
        @yield('breadcrumbs')

        @include('layouts._partials.flash')

        @yield('content')
    </main>

    @include('layouts._partials.footer')
</div>

<script src="{{ asset('js/app.js') }}"></script>

@yield('js')

</body>
</html>

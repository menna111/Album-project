<head>
    <title>@yield('title',env('APP_NAME'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">


{{--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}

    <style>
        body{
            background-color:#d3cccc}
    </style>
</head>

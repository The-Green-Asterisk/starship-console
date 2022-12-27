<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? env('APP_NAME') }}</title>
    <link rel="icon" href="{{ url('/img/valkur-favicon.svg') }}">
    <link href="{{ url('/css/app.css') }}" rel="stylesheet">

</head>

<body id="body" class="fadein">
    @yield('content')
    <script src="https://js.pusher.com/7.0.3/pusher.min.js"></script>
    <script src="{{ url('/js/app.js') }}"></script>
    @if (session()->has('success'))
        <script type="text/javascript">
            success('{{ session()->get('success') }}');
        </script>
    @endif
</body>

</html>

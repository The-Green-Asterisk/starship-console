<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? env("APP_NAME") }}</title>
        <link rel="icon" href="{{ url('/img/valkur-favicon.svg') }}">
        <link href="{{ url('/css/app.css') }}" rel="stylesheet">
        <script src="https://cdn.tiny.cloud/1/o51weqkkyqtt9zegndzt9c8khol7waxhxpcmbfmjg8o5nr82/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
        <script>
            tinymce.init({
              selector: 'textarea',
              plugins: 'a11ychecker advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
              toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
              toolbar_mode: 'floating',
              tinycomments_mode: 'embedded',
              tinycomments_author: 'Author name',
            });
          </script>
    </body>
</html>

<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset("public/images/karaoke.jpg") }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Karaoke - Soulmaster</title>
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('public/css/all.css') }}">
        <script src="{{ asset('public/js/top.js') }}"></script>
        <style type="text/css" media="screen">
            .s-styles {
                background-color: #ffffff;
                padding-top: 18rem;
                padding-bottom: 14.8rem;
            }
        </style>
        <script>
            window.trans = @php
                $lang_files = \Illuminate\Support\Facades\File::allFiles(resource_path() . '/lang/' . App()->getLocale());
                $trans = [];
                foreach ($lang_files as $f) {
                    $filename = pathinfo($f)['filename'];
                    $trans[$filename] = trans($filename);
                }
                echo json_encode($trans);
            @endphp;
        </script>
    </head>
    <body id="top">
        <div id="app">
            <app></app>
        </div>
        <script src="{{ asset('public/js/app.js') }}"></script>
        <script src="{{ asset('public/js/vendor/plugins.js') }}"></script>
        <script src="{{ asset('public/js/vendor/main.js') }}"></script>
        @yield('js')
    </body>
</html>

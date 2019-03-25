<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset("images/karaoke.jpg") }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Karaoke - Soulmaster</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/base.css') }}">
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
    <body>
        <div id="app" class="container-fluid">
            <app></app>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/base.js') }}"></script>
        @yield('js')
    </body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset("public/images/karaoke.jpg") }}" type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Karaoke - Soulmaster</title>
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
        {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}
        {{--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>--}}
        {{--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
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
        <div class="container" id="app">
            <app></app>
        </div>
        <script src="{{ asset('public/js/app.js') }}"></script>
        @yield('js')
    </body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/svg" sizes="16x16" href="{{ asset('dist/images/tg.svg') }}">

    <title>@yield('title','|')</title>
    <meta name="description" content="@yield('meta_description')">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
        integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css"
        integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw=="
        crossorigin="anonymous" />
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('dist/css/main.css') }}">
    <link rel=stylesheet href=https://pro.fontawesome.com/releases/v5.10.0/css/all.css
        integrity=sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p crossorigin=anonymous>
    @yield('css')
         <script type="text/javascript">
            var capcha1 = false;
            var capcha2 = false;
            var capcha3 = false;
            var capcha4 = false;

            var correctCaptcha1 = function(response) {
                capcha1 = true
            };
            var correctCaptcha2 = function(response) {
                capcha2 = true
            };
            var correctCaptcha3 = function(response) {
                capcha3 = true
            };
            var correctCaptcha4 = function(response) {
                capcha4 = true
            };

            var onloadCallback = function() {
                grecaptcha.render('recaptcha1', {
                    'sitekey': '6LeP7VQaAAAAAG5i7k66YweYhQh8ee604-GWrbDI',
                    'callback': correctCaptcha1,
                });
                grecaptcha.render('recaptcha2', {
                    'sitekey': '6LeP7VQaAAAAAG5i7k66YweYhQh8ee604-GWrbDI',
                    'callback': correctCaptcha2,
                });
                grecaptcha.render('recaptcha3', {
                    'sitekey': '6LeP7VQaAAAAAG5i7k66YweYhQh8ee604-GWrbDI',
                    'callback': correctCaptcha3,
                });
                grecaptcha.render('recaptcha4', {
                    'sitekey': '6LeP7VQaAAAAAG5i7k66YweYhQh8ee604-GWrbDI',
                    'callback': correctCaptcha4,
                });
                // grecaptcha.render(document.getElementById('recaptcha3'), {
                //     'sitekey': '6LeP7VQaAAAAAG5i7k66YweYhQh8ee604-GWrbDI',
                //     'callback': correctCaptcha3,
                // });
                // grecaptcha.render(document.getElementById('recaptcha3'), {
                //     'sitekey': '6LeP7VQaAAAAAG5i7k66YweYhQh8ee604-GWrbDI',
                //     'callback': correctCaptcha3
                // });
                // grecaptcha.render(document.getElementById('recaptcha4'), {
                //     'sitekey': '6LeP7VQaAAAAAG5i7k66YweYhQh8ee604-GWrbDI',
                //     'callback': correctCaptcha4
                // });
            };
    </script>
</head>

<body>
    <div id="app">
        @include('layouts.header')

        <main>
            @yield('content')
        </main>
        @include('layouts.footer')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
        integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
        integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js"
        integrity="sha512-nUuQ/Dau+I/iyRH0p9sp2CpKY9zrtMQvDUG7iiVY8IBMj8ZL45MnONMbgfpFAdIDb7zS5qEJ7S056oE7f+mCXw=="
        crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery.maskedinput@1.4.1/src/jquery.maskedinput.min.js" type="text/javascript"></script>
        <script src="{{ asset('dist/js/jquery.inputmask.js') }}"></script>
        <script src="https://maps.api.2gis.ru/2.0/loader.js"></script>
        <script src="https://yastatic.net/share2/share.js" async></script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>
    <script src="{{ asset('dist/js/main.bundle.js') }}"></script>

</body>

</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .text {
            font-size: 30px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('home') }}">{{ __('welcome.home') }}</a>
            @else
                <a href="{{ route('login') }}">{{ __('welcome.login') }}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{ __('welcome.register') }}</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            {{ env('APP_NAME', 'Laravel') }}
        </div>
        <div class="text">{{ __('welcome.created-by') }}: <a href="https://www.srajpal.com" target="_blank">Sunny Rajpal</a> </div>
        <br><br>

    @auth
        <a href="{{ route('home') }}">{{ __('welcome.go-to-home') }}</a>
    @else
        <a href="{{ route('login') }}">{{ __('welcome.login-to-begin') }}</a>
    @endauth

        <br><br><a href="https://github.com/srajpal/laravel-7-crud-demo/blob/master/README.md" target="_blank">{{ __('welcome.view-readme') }}</a>

        <p>
            <br><br><a href="{{ route('welcome',$lang=='en'?'es':'en') }}">{{ __('welcome.switch-lang') }}</a>
        </p>

    </div>
</div>
</body>
</html>

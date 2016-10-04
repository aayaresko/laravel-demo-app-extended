<!DOCTYPE html>
<html>
<head>
    <title>@lang('content.not_found')</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 63px;
            margin: 10px auto;
        }

        h1 {
            font-size: 350px;
            margin: 10px auto;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div>
            <h1>404</h1>
        </div>
        <div class="title">
            <p>
                @lang('content.not_found')
                <br>
                <a href="{{ route('frontend.index') }}">@lang('content.go_home')</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>

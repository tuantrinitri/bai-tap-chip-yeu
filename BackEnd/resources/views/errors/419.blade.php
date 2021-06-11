<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>419 | Page Expired</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        a {
            text-decoration: none;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .position-ref {
            position: relative;
        }

        .code {
            font-size: 10rem;
            text-align: center;
            font-weight: 700
        }

        .message {
            font-size: 18px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="code">419</div>
        <div class="message">
            {!! $exception->getMessage() !!}
            <br>
            Redirecting after <strong><span id="seconds">5</span></strong> seconds.
            <br>
            <a href="{{ url()->previous() }}">&larr; Back</a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var seconds = 5;
            setInterval(() => {
                if(seconds == 0){
                    window.location.href = "{{ url()->previous() }}";
                } else {
                    document.getElementById('seconds').innerHTML = seconds--;
                }
            }, 1000);
        });
    </script>
</body>

</html>

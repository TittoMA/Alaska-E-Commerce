<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') Alaska</title>
    {{-- Icons --}}
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- Fonts Icon -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
        #page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        #main-content {
            flex: 1;
        }

        .text-header {
            font-size: 14px;
        }

        .text-footer,
        .footer-desc {
            color: #575757;
            font-size: 13px;
            text-decoration: none;
            font-size: 10pt;
        }

        .text-footer:hover {
            color: #FE615A;
        }

        .footer-icon {
            color: #FE615A;
        }

        .footer-icon:hover {
            color: #b62424;
        }

        .notif-icon {
            position: relative;
        }

        .notif-text {
            width: 6px;
            height: 6px;
            background-color: #ef144a;
            position: absolute;
            top: 6px;
            right: 4px;
            border-radius: 50px;
            border: 2.5px solid #fff;
            box-sizing: content-box;
        }
    </style>

    @yield('head')

</head>

<body>

    <div id="page-container">
        @include('layouts.header')

        <div id="main-content">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('/js/app.js') }}"></script>
    {{-- <script>
        function sendMarkRequest(id) {
            return $.ajax("{{ route('markNotification') }}", {
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                }
            });
        }
        $(function() {
            $('.mark-as-read').click(function() {
                let request = sendMarkRequest($(this).data('id'));
                request.done(() => {
                    window.location = ('/' + $(this).data('navigate'));
                });
            });
        });
    </script> --}}
    @yield('script')

</body>

</html>
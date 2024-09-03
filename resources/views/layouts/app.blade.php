<!--Author: W3layouts Author URL: http://w3layouts.com-->
<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Forum</title>

    <link href="//fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="//fonts.googleapis.com/css2?family=Libre+Baskerville:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style-starter.css') }}">

</head>
<body>

    <x-header/>

    <main>
    @yield('content')
    </main>

    <x-footer/>

    <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('assets/js/move-top.js') }}"></script>

    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>

    <script src="{{ asset('assets/js/theme-change.js') }}"></script>

    <script src="{{ asset('assets/js/load-topics.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    @yield('script')

</body>
</html>


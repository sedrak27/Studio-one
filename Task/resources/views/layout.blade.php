<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/jquery.js')
{{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <title>Task</title>
</head>
<body>
<header>
    @include('blocks.header')
</header>

<main>
    @yield('content')
</main>

<footer>
{{--    @include('blocks.footer')--}}
</footer>
{{--@vite('resources/js/jquery.js')--}}

<script>
    const url = '{{ url('') }}'
    const csrf = '{{ csrf_token() }}'
    const userId = '{{ \Illuminate\Support\Facades\Auth::id() }}'
</script>
@vite('resources/js/app.js')
</body>
</html>

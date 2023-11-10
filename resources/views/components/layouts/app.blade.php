<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@isset($title){{ $title }}@endisset</title>
    <link rel="stylesheet" href="{{ url('build/assets/app-1acfdf10.css')}}">
    <script type="module" src="{{ url('build/assets/app-2cd38862.js')}}"></script>
</head>
<body>
    <x-navbar></x-navbar>

    {{
        $slot
    }}
</body>
</html>
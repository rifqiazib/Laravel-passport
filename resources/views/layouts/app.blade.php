<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="flex font-montserrat">
        @include('layouts.include.sidebar')
        
        @yield('content')
    </div>
</body>
</html>

@yield('extra-js')

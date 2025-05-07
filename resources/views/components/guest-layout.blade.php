<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <div class="font-sans text-gray-900 antialiased">
        {{ $slot }}
    </div>
</body>
</html>

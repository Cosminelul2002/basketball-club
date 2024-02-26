<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <script>
        window.settings = {
            images: "{{ asset('/images') }}",
        };
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Basketball Web App</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">



    @routes
    @vite('resources/css/app.css')
    @inertiaHead


</head>

<body>
    @vite('resources/js/app.js')
    @inertia
</body>

</html>
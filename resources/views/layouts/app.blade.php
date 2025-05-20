<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contacts App</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<section class="container">
    @if (session('success'))
        <div class="alert alert-success">
                {{ session('success') }}
            </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
                {{ session('error') }}
            </div>
    @endif

    @yield('content')
</section>
    
</body>
</html>
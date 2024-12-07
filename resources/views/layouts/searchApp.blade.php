<!-- Layouts are basically reusable templates for an application's structure -->
<!-- You'd use a layout when a page would have, well, different layouts -->
<!-- This makes it easier to dynamically update the same page without having to make duplicate ones -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title> 
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>My Application</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/products">Refresh</a>
        </nav>
    </header>

    <main>
        @yield('content') <!-- This defines the placeholder for sections that the child view will fill (searchHTML.blade.php) -->
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Aryan Kora's Searrch application</p>
    </footer>
</body>
</html>

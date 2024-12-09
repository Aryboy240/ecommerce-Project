<!--
    Developer: Aryan Kora
    university ID: 230059030
    function: Search page backend
-->

<!-- Layouts are basically reusable templates for an application's structure -->
<!-- You'd use a layout when a page would have, well, different layouts -->
<!-- This makes it easier to dynamically update the same page without having to make duplicate ones -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- JS -->
    <script defer src="/js/theme.js"></script>
    <script defer src="/js/addToCart.js"></script>
    <script src="js/scrollBar.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>@yield('title', 'Laravel App')</title> 
</head>
<body>
    <!-- Search Header -->
    <header class="search-header" style="padding-top: 50px">
        <h1>Find Your Perfect Product</h1>
    </header>

    <main>
        @yield('content') <!-- This defines the placeholder for sections that the child view will fill (searchTest.blade.php) -->
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Aryan Kora's test searrch application </p>
    </footer>
</body>
</html>

<!--
    Developer: Aryan Kora
    university ID: 230059030
    function: Adds navigation bar and footer to each page that extends this layout
-->

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- JS -->
  <script defer src="{{ asset('/js/theme.js') }}"></script>
  <script defer src="{{ asset('js/scrollReveal.js') }}"></script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="{{ asset('js/scrollBar.js') }}"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
  <link rel="stylesheet" href="{{ asset('css/product_Card.css') }}">

  @yield('extra-head')

  <!-- Tab Icon -->
  <link rel="icon" href="{{ asset('Images/circleLogo.png') }}" type="image/x-icon">

  <title>@yield('title', 'Laravel App')</title>
</head>

<body>
  <!-- Navigation  Bar:: Aryan Kora -->
  <section class="nav-section">
    <!--Left nav-->
    <nav class="navbar-left">
      <ul class="navbar-nav">

        <!--Home-->
        <li class="nav-item">
          <a href="{{ route('welcome') }}" class="nav-link">
            <div class="nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
              </svg>
              <span class="link-text">Home</span>
            </div>
          </a>
        </li>

        <!--About-->
        <li class="nav-item">
          <a href="{{ route('about') }}" class="nav-link">
            <div class="nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304l0 128c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-223.1L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6l29.7 0c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9 232 480c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-128-16 0z" />
              </svg>
              <span class="link-text">About</span>
            </div>
          </a>
        </li>

        <!--Store-->
        <li class="nav-item">
          <a href="{{ route('search') }}" class="nav-link">
            <div class="nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M118.6 80c-11.5 0-21.4 7.9-24 19.1L57 260.3c20.5-6.2 48.3-12.3 78.7-12.3c32.3 0 61.8 6.9 82.8 13.5c10.6 3.3 19.3 6.7 25.4 9.2c3.1 1.3 5.5 2.4 7.3 3.2c.9 .4 1.6 .7 2.1 1l.6 .3 .2 .1c0 0 .1 0 .1 0c0 0 0 0 0 0s0 0 0 0L247.9 288s0 0 0 0l6.3-12.7c5.8 2.9 10.4 7.3 13.5 12.7l40.6 0c3.1-5.3 7.7-9.8 13.5-12.7l6.3 12.7s0 0 0 0c-6.3-12.7-6.3-12.7-6.3-12.7s0 0 0 0s0 0 0 0c0 0 .1 0 .1 0l.2-.1 .6-.3c.5-.2 1.2-.6 2.1-1c1.8-.8 4.2-1.9 7.3-3.2c6.1-2.6 14.8-5.9 25.4-9.2c21-6.6 50.4-13.5 82.8-13.5c30.4 0 58.2 6.1 78.7 12.3L481.4 99.1c-2.6-11.2-12.6-19.1-24-19.1c-3.1 0-6.2 .6-9.2 1.8L416.9 94.3c-12.3 4.9-26.3-1.1-31.2-13.4s1.1-26.3 13.4-31.2l31.3-12.5c8.6-3.4 17.7-5.2 27-5.2c33.8 0 63.1 23.3 70.8 56.2l43.9 188c1.7 7.3 2.9 14.7 3.5 22.1c.3 1.9 .5 3.8 .5 5.7l0 6.7 0 41.3 0 16c0 61.9-50.1 112-112 112l-44.3 0c-59.4 0-108.5-46.4-111.8-105.8L306.6 352l-37.2 0-1.2 22.2C264.9 433.6 215.8 480 156.3 480L112 480C50.1 480 0 429.9 0 368l0-16 0-41.3L0 304c0-1.9 .2-3.8 .5-5.7c.6-7.4 1.8-14.8 3.5-22.1l43.9-188C55.5 55.3 84.8 32 118.6 32c9.2 0 18.4 1.8 27 5.2l31.3 12.5c12.3 4.9 18.3 18.9 13.4 31.2s-18.9 18.3-31.2 13.4L127.8 81.8c-2.9-1.2-6-1.8-9.2-1.8zM64 325.4L64 368c0 26.5 21.5 48 48 48l44.3 0c25.5 0 46.5-19.9 47.9-45.3l2.5-45.6c-2.3-.8-4.9-1.7-7.5-2.5c-17.2-5.4-39.9-10.5-63.6-10.5c-23.7 0-46.2 5.1-63.2 10.5c-3.1 1-5.9 1.9-8.5 2.9zM512 368l0-42.6c-2.6-.9-5.5-1.9-8.5-2.9c-17-5.4-39.5-10.5-63.2-10.5c-23.7 0-46.4 5.1-63.6 10.5c-2.7 .8-5.2 1.7-7.5 2.5l2.5 45.6c1.4 25.4 22.5 45.3 47.9 45.3l44.3 0c26.5 0 48-21.5 48-48z" />
              </svg>
              <span class="link-text">Store</span>
            </div>
          </a>
        </li>
      </ul>
    </nav>

    <!--MIDDLE LOGO-->
    <a id="themeButton">
      <div class="navbar-middle">
        <img src="{{ asset('Images/circleLogo.png') }}">
      </div>
    </a>

    <!--Rigth nav-->
    <nav class="navbar-rigth">
      <ul class="navbar-nav">

        <!--Account-->
        <li class="nav-item">
          <a href="{{ auth()->check() ? route('account') : route('login') }}" class="nav-link">
            <div class="nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 256l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L80 384c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
              </svg>
              <span class="link-text">Account</span>
            </div>
          </a>
        </li>

        <!--Order-->
        <li class="nav-item">
          <a href="{{ route('cart.view') }}" class="nav-link">
            <div class="nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
              </svg>
              <span class="link-text">Orders</span>
            </div>
          </a>
        </li>

        <!--Search-->
        <li class="nav-item">
          <a href="{{ route('contact') }}" class="nav-link">
            <div class="nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c0 0 0 0 0 0s0 0 0 0s0 0 0 0c0 0 0 0 0 0l.3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/></svg>              <span class="link-text">Contact</span>
            </div>
          </a>
        </li>
      </ul>
    </nav>
  </section>
  <!-- Navigation  Bar End -->

  <!-- MOBILE Navigation  Bar:: Aryan Kora -->
  <section class="mobile-nav-section">
    <nav class="mobile-navbar">
      <ul class="mobile-nav">

        <!--Home-->
        <li class="mobile-nav-item">
          <a href="{{ route('welcome') }}" class="mobile-nav-link">
            <div class="mobile-nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
              </svg>
            </div>
          </a>
        </li>

        <!--About-->
        <li class="mobile-nav-item">
          <a href="{{ route('about') }}" class="mobile-nav-link">
            <div class="mobile-nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M112 48a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm40 304l0 128c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-223.1L59.4 304.5c-9.1 15.1-28.8 20-43.9 10.9s-20-28.8-10.9-43.9l58.3-97c17.4-28.9 48.6-46.6 82.3-46.6l29.7 0c33.7 0 64.9 17.7 82.3 46.6l58.3 97c9.1 15.1 4.2 34.8-10.9 43.9s-34.8 4.2-43.9-10.9L232 256.9 232 480c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-128-16 0z" />
              </svg>
            </div>
          </a>
        </li>

        <!--Store-->
        <li class="mobile-nav-item">
          <a href="{{ route('search') }}" class="mobile-nav-link">
            <div class="mobile-nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M118.6 80c-11.5 0-21.4 7.9-24 19.1L57 260.3c20.5-6.2 48.3-12.3 78.7-12.3c32.3 0 61.8 6.9 82.8 13.5c10.6 3.3 19.3 6.7 25.4 9.2c3.1 1.3 5.5 2.4 7.3 3.2c.9 .4 1.6 .7 2.1 1l.6 .3 .2 .1c0 0 .1 0 .1 0c0 0 0 0 0 0s0 0 0 0L247.9 288s0 0 0 0l6.3-12.7c5.8 2.9 10.4 7.3 13.5 12.7l40.6 0c3.1-5.3 7.7-9.8 13.5-12.7l6.3 12.7s0 0 0 0c-6.3-12.7-6.3-12.7-6.3-12.7s0 0 0 0s0 0 0 0c0 0 .1 0 .1 0l.2-.1 .6-.3c.5-.2 1.2-.6 2.1-1c1.8-.8 4.2-1.9 7.3-3.2c6.1-2.6 14.8-5.9 25.4-9.2c21-6.6 50.4-13.5 82.8-13.5c30.4 0 58.2 6.1 78.7 12.3L481.4 99.1c-2.6-11.2-12.6-19.1-24-19.1c-3.1 0-6.2 .6-9.2 1.8L416.9 94.3c-12.3 4.9-26.3-1.1-31.2-13.4s1.1-26.3 13.4-31.2l31.3-12.5c8.6-3.4 17.7-5.2 27-5.2c33.8 0 63.1 23.3 70.8 56.2l43.9 188c1.7 7.3 2.9 14.7 3.5 22.1c.3 1.9 .5 3.8 .5 5.7l0 6.7 0 41.3 0 16c0 61.9-50.1 112-112 112l-44.3 0c-59.4 0-108.5-46.4-111.8-105.8L306.6 352l-37.2 0-1.2 22.2C264.9 433.6 215.8 480 156.3 480L112 480C50.1 480 0 429.9 0 368l0-16 0-41.3L0 304c0-1.9 .2-3.8 .5-5.7c.6-7.4 1.8-14.8 3.5-22.1l43.9-188C55.5 55.3 84.8 32 118.6 32c9.2 0 18.4 1.8 27 5.2l31.3 12.5c12.3 4.9 18.3 18.9 13.4 31.2s-18.9 18.3-31.2 13.4L127.8 81.8c-2.9-1.2-6-1.8-9.2-1.8zM64 325.4L64 368c0 26.5 21.5 48 48 48l44.3 0c25.5 0 46.5-19.9 47.9-45.3l2.5-45.6c-2.3-.8-4.9-1.7-7.5-2.5c-17.2-5.4-39.9-10.5-63.6-10.5c-23.7 0-46.2 5.1-63.2 10.5c-3.1 1-5.9 1.9-8.5 2.9zM512 368l0-42.6c-2.6-.9-5.5-1.9-8.5-2.9c-17-5.4-39.5-10.5-63.2-10.5c-23.7 0-46.4 5.1-63.6 10.5c-2.7 .8-5.2 1.7-7.5 2.5l2.5 45.6c1.4 25.4 22.5 45.3 47.9 45.3l44.3 0c26.5 0 48-21.5 48-48z" />
              </svg>
            </div>
          </a>
        </li>

        <!--Account-->
        <li class="mobile-nav-item">
          <a href="{{ auth()->check() ? route('account') : route('login') }}" class="mobile-nav-link">
            <div class="mobile-nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l448 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 256l64 0c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16L80 384c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zm256-32l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-128 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z" />
              </svg>
            </div>
          </a>
        </li>

        <!--Order-->
        <li class="mobile-nav-item">
          <a href="{{ route('cart.view') }}" class="mobile-nav-link">
            <div class="mobile-nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                  d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
              </svg>
            </div>
          </a>
        </li>

        <!--Search-->
        <li class="mobile-nav-item">
          <a href="{{ route('contact') }}" class="mobile-nav-link">
            <div class="mobile-nav-item-wrapper">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c0 0 0 0 0 0s0 0 0 0s0 0 0 0c0 0 0 0 0 0l.3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/></svg>
            </div>
          </a>
        </li>
      </ul>
    </nav>
  </section>
  <!-- MOBILE Navigation  Bar End -->

  <main>
    @yield('content')

    <!-- Admin icon -->
    @auth
      @if(auth()->user()->is_admin)
          <div class="admin-access">
              <a href="{{ route('adminpanel') }}">
                  <img src="{{ asset('Images/adminPanel.png') }}">
              </a>
          </div>
      @endif
    @endauth

  </main>

  <!-- Footer Section:: Esta -->
  <div class="footer">
    <div>
      <h3>Customer Support</h3>
      <p>
        <img src="{{ asset('Images/svg/phone-line-svgrepo-com.svg') }}" alt="Phone Icon" />
        07777777777
      </p>
      <p>
        <img src="{{ asset('Images/svg/email-svgrepo-com.svg') }}" alt="email Icon" />
        <a href="mailto:optique.team28@gmail.com">optique.team28@gmail.com</a>
      </p>
      <p>
        <img src="{{ asset('Images/svg/contact-details-svgrepo-com.svg') }}" alt="email Icon" />
        <a href="{{ route('contact') }}">Contact Us!</a>
      </p>
    </div>
    <div>
      <h3>Shop</h3>
      <a href="#">Glasses</a>
      <a href="#">Sunglasses</a>
      <a href="#">Accessories</a>
      <a href="#">Contact Lenses</a>
    </div>
    <div>
      <h3>About Optique</h3>
      <a href="{{ route('OurStory') }}">Our Story</a>
      <a href="{{ route('Testimonials') }}">Testimonials</a>
      <a href="{{ route('Careers') }}">Careers</a>
      <a href="#">Store Locator</a>
    </div>
    <div class="social-icons">
      <h3>Follow Us</h3>
      <a href="https://www.facebook.com/profile.php?id=61573793477027" id="social-footer-span">
        <img src="{{ asset('Images/svg/facebook-svgrepo-com.svg') }}" alt="email Icon" />
        <span>Facebook</span>
      </a>
      <a href="https://www.instagram.com/optique.team28/" id="social-footer-span">
        <img src="{{ asset('Images/svg/instagram-svgrepo-com.svg') }}" alt="email Icon" />
        <span>Instagram</span>
      </a>
      <a href="https://x.com/OptiqueTeam28" id="social-footer-span">
        <img src="{{ asset('Images/svg/twitter-svgrepo-com.svg') }}" alt="email Icon" />
        <span>Twitter</span>
      </a>
      <a href="https://uk.pinterest.com/optiqueteam28/" id="social-footer-span">
        <img src="{{ asset('Images/svg/pinterest-180-svgrepo-com.svg') }}" alt="email Icon" />
        <span>Pintrest</span>
      </a>
    </div>
    <div class="powered-by">
      <p>© Optique. Crafted for Visionaries.</p>
      <div class="QR">
          <img src="{{ asset('Images/smallQR.png') }}" alt="">
          <div class="QR-over">
              <img src="{{ asset('Images/QR.png') }}" alt="">
          </div>
      </div>
    </div>
    <div class="wishlist">
      <a href="{{ route('wishlist.index') }}" class="wishlist-heart">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="32" height="32">
            <path
                d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"
                fill="currentColor" />
        </svg>
      </a>
    </div>
  </div>
  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const qrButton = document.querySelector(".QR");
      const qrPopup = document.querySelector(".QR-over");

      // Toggle visibility when clicking the QR code
      qrButton.addEventListener("click", function () {
          if (qrPopup.style.display === "flex") {
              qrPopup.style.display = "none";
          } else {
              qrPopup.style.display = "flex";
          }
      });

      // Hide the popup when clicking anywhere outside the QR image
      qrPopup.addEventListener("click", function (event) {
          if (event.target !== qrPopup && event.target === qrPopup) {
              qrPopup.style.display = "none";
          }
      });
  });
  </script>
</body>

</html>
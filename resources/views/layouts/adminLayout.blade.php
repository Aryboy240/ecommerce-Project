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

  <!-- CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin/panel.css') }}">
  <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">

  @yield('extra-head')

  <!-- Tab Icon -->
  <link rel="icon" href="{{ asset('Images/circleLogo.png') }}" type="image/x-icon">

  <title>@yield('title', 'Laravel App')</title>
</head>

<body>

  <!-- Bubble Background 🫧 --> 
  @php
    $selectedWallpaper = \App\Models\Wallpaper::where('is_selected', true)->first();
  @endphp

  <video class="background-video" autoplay loop muted playsinline>
      <source src="{{ asset($selectedWallpaper->video_path ?? 'Images/Videos/Bubbles.mp4') }}" type="video/mp4">
  </video>


  <div class="container">

    <!-- Navigation bar -->
    <nav class="sidebar">
        <div class="logo">
            <img src="{{ asset('Images/logo.png') }}" alt="Logo">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('adminpanel') }}"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('productadmin') }}"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="{{ route('customers') }}"><i class="fas fa-users"></i> Customers</a></li>
            <li><a href="{{ route('AdminOrders') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="{{ route('adminreport') }}"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="{{ route('admin.reviews') }}" class="active"><i class="fas fa-star"></i> Reviews</a></li>
            <li><a href="{{ route('admin.coupons') }}"><i class="fas fa-tag"></i> Coupons</a></li>
            <li><a href="{{ route('wallpapers') }}" class="active"><i class="fas fa-gear"></i> Settings</a></li>
            <li><a href="{{ route('welcome') }}" class="active"><i class="fa-solid fa-arrow-right-from-bracket"></i> Exit</a></li>
        </ul>
    </nav>
    
    <!-- Main content Yeild -->
    @yield('content')

  </div>

</body>

</html>
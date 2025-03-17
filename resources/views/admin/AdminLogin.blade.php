<!--
    Developer: man kwok angus
	  University ID: 
    Function: Front end for the admin login page

    Developer: Nikhil Kainth
	  University ID: 230069888
    Function: Back-end and final edits on front-end for the new backend features integrations

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- JS -->
  <!-- CSS -->
  <link rel="stylesheet" href={{  asset('css/main.css') }}>
  <link rel="stylesheet" href={{  asset('css/aryansExtras.css') }}>
  <link rel="stylesheet" href={{  asset('css/admin/adminlogin.css') }}>
  <title>Admin Login | Optique</title>
</head>

<body>


  <div class="top-level">
    <div class="top-icons">
      <img src="{{ asset('Images/Logo.png') }}" alt="logo">
      <a href="{{ route('welcome') }}">
        <svg
        aria-hidden="true"
        focusable="false"
        data-prefix="fas"
        data-icon="home"
        class="home"
        role="img"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 576 512"
      >
        <path
          fill="currentColor"
          d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"
        ></path>
        </svg>
      </a>
    </div>
  </div>

    <div class="form-wrapper">
      <div class="login-container">
        <h1>ADMIN LOGIN</h1>
        @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    @if ($errors->has('loginError'))
        <p class="error-message">{{ $errors->first('loginError') }}</p>
    @endif

    <form class="form" method="POST" action="{{ route('adminlogin') }}">
        @csrf
        <div class="form-group">
            <label for="username">Admin Name</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button class="form-submit-btn" type="submit">Login</button>
    </form>
</div>
</div>
</body>
</html>
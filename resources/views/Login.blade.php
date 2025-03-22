<!--
    Developer: Aryan Kora
	  University ID: 230059030
    Function: Front end for the login page

    Developer: Hussen Ahmed
	  University ID: 230177600
    Function: Added the backend for logins

    Developer: Nikhil Kainth
	  University ID: 230069888
    Function: Backend and frontend for vaidation messages and reset password feature
-->

<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- JS -->
  <script defer src="/js/theme.js"></script>
  <!--CSS-->
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
  <!--Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+P+One&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&family=Merriweather:ital,wght@1,300&family=Noto+Sans&family=Pacifico&family=Raleway&display=swap"
    rel="stylesheet"
  />
  <!--Meta-->
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1,
    user-scalable=0"
  />

  <link rel="icon" href="{{ asset('Images/circleLogo.png') }}" type="image/x-icon">
</head>

<body>
  <!--Log in Section-->
  <section>
    <div class="login-img">
      <img src="Images/loginBackground.jpg" />
    </div>
    <div class="login-content">
      <div class="form">
        <div class="HomeIcon">
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
        <div class="AdminIcon">
          <a href="{{ route('adminlogin') }}">
          <svg 
            xmlns="http://www.w3.org/2000/svg" 
            viewBox="0 0 512 512" 
            fill="currentColor" 
            class="admin-icon"
          >
              <path d="M78.6 5C69.1-2.4 55.6-1.5 47 7L7 47c-8.5 8.5-9.4 22-2.1 31.6l80 104c4.5 5.9 11.6 9.4 19 9.4l54.1 0 109 109c-14.7 29-10 65.4 14.3 89.6l112 112c12.5 12.5 32.8 12.5 45.3 0l64-64c12.5-12.5 12.5-32.8 0-45.3l-112-112c-24.2-24.2-60.6-29-89.6-14.3l-109-109 0-54.1c0-7.5-3.5-14.5-9.4-19L78.6 5zM19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L233.7 374.3c-7.8-20.9-9-43.6-3.6-65.1l-61.7-61.7L19.9 396.1zM512 144c0-10.5-1.1-20.7-3.2-30.5c-2.4-11.2-16.1-14.1-24.2-6l-63.9 63.9c-3 3-7.1 4.7-11.3 4.7L352 176c-8.8 0-16-7.2-16-16l0-57.4c0-4.2 1.7-8.3 4.7-11.3l63.9-63.9c8.1-8.1 5.2-21.8-6-24.2C388.7 1.1 378.5 0 368 0C288.5 0 224 64.5 224 144l0 .8 85.3 85.3c36-9.1 75.8 .5 104 28.7L429 274.5c49-23 83-72.8 83-130.5zM56 432a24 24 0 1 1 48 0 24 24 0 1 1 -48 0z"/>
            </svg>
          </a>
        </div>


        <div class="img-con">
          <img src="Images/logo.png" class="login-logo" />
        </div>
        <h2>Login</h2>

        <form action="/login" method="POST">
          @csrf <!-- Extra protection against cookies -->

          <!-- Error message for invalid credentials -->
          @if ($errors->has('loginError'))
            <div style="color: red; margin-bottom: 10px">
                {{ $errors->first('loginError') }}
            </div>
          @endif

          <!-- Username -->
          <div class="input">
            <span>Username</span>
            <input type="text" name="loginUsername" value="{{ old('loginUsername') }}" />
            @error('loginUsername')
              <span id="error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Password -->
          <div class="input">
            <span>Password</span>
            <input type="password" name="loginPassword" />
            @error('loginPassword')
              <span id="error">{{ $message }}</span>
            @enderror
          </div>

          <!-- Remember -->
          <div class="remember">
            <label><input type="checkbox" name="Remember" />Remember Me</label>
          </div>

          <!-- Sign in Button -->
          <div class="input">
            <button>Login</button>
          </div>

          <!-- Register -->
          <div class="input">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up!</a></p>
          </div>

          <!-- Forgot Password -->
          <div class="input">
            <p>Forgot your Password? <a href="{{ route('password.request') }}">Reset it!</a></p>
          </div>

        </form>

        <!-- Socials -->
        <div id="socials">
          <h3>Follow us on social media!</h3>
        </div>
        <ul class="login-socials">
          <li>
            <a href="https://www.instagram.com/optique.team28/" target="_blank">
              <img src="Images/socials/instagram.png"/>
            </a>
          </li>
          <li>
            <a href="https://www.youtube.com/@Optique.Team28" target="_blank">
              <img src="Images/socials/youtube.png"/>
            </a>
          </li>
          <li>
            <a href="https://x.com/OptiqueTeam28" target="_blank">
              <img src="Images/socials/twitter.png"/>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!--Log in Section End-->
</body>

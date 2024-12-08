<!--
    Developer: Aryan Kora
	  University ID: 230059030
    Function: Front end for the login page

    Developer: Hussen Ahmed
	  University ID: 230177600
    Function: Added the backend for logins
-->

<head>
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
</head>

<body>
  <!--Log in Section-->
  <section>
    <div class="login-img">
      <img src="Images/song_it.jpeg" />
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
        <div class="img-con">
          <img src="Images/logo.png" class="login-logo" />
        </div>
        <h2>Login</h2>

        <form action="/login" method="POST">
          @csrf <!-- Extra protection against cookies -->

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

        </form>

        <!-- Socials -->
        <div id="socials">
          <h3>Follow us on social media!</h3>
        </div>
        <ul class="login-socials">
          <li>
            <a href="https://www.instagram.com" target="_blank">
              <img src="Images/socials/instagram.png"/>
            </a>
          </li>
          <li>
            <a href="https://www.youtube.com" target="_blank">
              <img src="Images/socials/youtube.png"/>
            </a>
          </li>
          <li>
            <a href="https://www.twitter.com" target="_blank">
              <img src="Images/socials/twitter.png"/>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!--Log in Section End-->
</body>

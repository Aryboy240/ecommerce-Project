<!DOCTYPE html>
<head>
  <title>Login</title>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--CSS-->
  <link rel="stylesheet" href="{{ asset('css/login.css') }}"> 
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
        @if($errors->any())
            <div style="color: red; margin-bottom: 10px;">
                {{$errors->first()}}
            </div>
        @endif
        <form method="POST" action="{{ route('login.submit') }}">
          @csrf
          <div class="input">
            <span>Username</span>
            <input type="text" name="name" required />
          </div>
          <div class="input">
            <span>Password</span>
            <input type="password" name="password" required />
          </div>
          <div class="remember">
            <label><input type="checkbox" name="remember" />Remember Me</label>
          </div>
          <div class="input">
            <button type="submit" class="submit-btn" style="width: 100%; padding: 10px; background: var(--mint); color: white; border: none; border-radius: 5px; cursor: pointer;">Sign in</button>
          </div>
          <div class="input">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up!</a></p>
          </div>
        </form>
        <div id="socials">
          <h3>Follow us on social media!</h3>
        </div>
        <ul class="login-socials">
          <li>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              ><img src="Images/socials/instagram.png"
            /></a>
          </li>
          <li>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              ><img src="Images/socials/youtube.png"
            /></a>
          </li>
          <li>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              ><img src="Images/socials/twitter.png"
            /></a>
          </li>
        </ul>
      </div>
    </div>
  </section>
</body>
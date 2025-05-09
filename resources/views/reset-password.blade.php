<!--
    Developer: Nikhil Kainth
	  University ID: 230069888
    Function: Backend and fronted for the page
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/forgot-password.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
</head>
<body>
    <section>
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
                    <img src="{{ asset('Images/logo.png') }}" class="login-logo" />
                </div>
                <h2>Reset Password</h2>

                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}" />

                    <div class="input">
                        <span>Email Address</span>
                        <input type="email" name="email" required />
                    </div>

                    <div class="input">
                        <span>New Password</span>
                        <input type="password" name="password" required />
                    </div>

                    <div class="input">
                        <span>Confirm Password</span>
                        <input type="password" name="password_confirmation" required />
                    </div>

                    <div class="input">
                        <button type="submit">Reset Password</button>
                    </div>
                </form>

                <div class="input">
                    <p><a href="{{ route('login') }}">Back to Login</a></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
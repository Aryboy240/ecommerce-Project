<!--
    Developer: Aryan Kora
	  University ID: 230059030
    Function: Front end for the register page

    Developer: Nikhil Kainth
	  University ID: 230069888
    Function: Backend for registeration and front end modifications for backend
-->

<head>
  <title>Register</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- JS -->
  <script defer src="/js/theme.js"></script>
  <!--CSS-->
  <link rel="stylesheet" href="css/register.css" />
  <link rel="stylesheet" href="css/aryansExtras.css" />
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
  <!-- Register Section -->
  <section>
    <div class="login-img">
      <img src="Images/registerBackground.jpg" alt="Skater Girl" />
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
          <img src="Images/logo.png" class="login-logo" alt="Logo" />
        </div>
        <h2>REGISTER</h2>
        <form action="/register" method="POST">
          
          @csrf <!-- Extra protection against cookies -->

          <!-- name --> 
          <div class="input"> 
              <label for="name">Username</label>
              <input type="text" id="name" name="name" value="{{ old('name') }}" />  <!-- Stores the current name in field if other validations fail -->
              <!-- name validation checks: look at UserController.php in app/Http/Controllers for list of validations -->
              @error('name')
                  <span>{{ $message }}</span>
              @enderror
          </div>

          <!-- Full Name --> 
          <div class="input"> 
            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" value="{{ old('fullName') }}" />  <!-- Stores the current fullName in field if other validations fail -->
            @error('fullName')
                <span>{{ $message }}</span>
            @enderror
          </div>

          
          <!-- Email -->
          <div class="input">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" /> <!-- Stores the current email in field if other validations fail -->
              <!-- Email validation checks -->
              @error('email')
                  <span>{{ $message }}</span>
              @enderror
          </div>
          
          <!-- Password -->
          <div class="input">
              <label for="password">Password</label>
              <input type="password" id="password" name="password" />
              <!-- Password validation checks -->
              @error('password')
                  <span>{{ $message }}</span>
              @enderror
          </div>
          
          <div class="input">
            <!-- The confirm password field-->
              <label for="confirm_password">Confirm Password</label>
              <input type="password" id="confirm_password" name="confirmPassword" />
              <!-- Confirm password validation checks -->
              @error('confirmPassword')
                  <span>{{ $message }}</span>
              @enderror
          </div>
          
          <div class="input">
            <!-- The birthday field-->
              <label for="birthday">Birthday</label>
              <input type="date" id="birthday" name="birthday" />
              <!-- Birthday validation checks -->
              @error('birthday')
                  <span>{{ $message }}</span>
              @enderror
          </div>
          
          <!-- Submission button -->
          <div class="input">
            <button>Register</button>
          </div>

          <div class="input">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in!</a></p>
          </div>

        </form>
        <div id="socials">
          <h3>Follow us on social media!</h3>
        </div>
        <ul class="login-socials">
          <li>
            <a href="https://www.instagram.com" target="_blank">
              <img src="Images/socials/instagram.png" alt="Instagram" />
            </a>
          </li>
          <li>
            <a href="https://www.youtube.com" target="_blank">
              <img src="Images/socials/youtube.png" alt="YouTube" />
            </a>
          </li>
          <li>
            <a href="https://www.twitter.com" target="_blank">
              <img src="Images/socials/twitter.png" alt="Twitter" />
            </a>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- Register Section End -->
</body>

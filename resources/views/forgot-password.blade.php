<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>
<body>
    <section>
        <div class="login-img">
            <img src="Images/loginBackground.jpg" />
        </div>
        <div class="login-content">
            <div class="form">
                <h2>Forgot Password</h2>

                @if (session('status'))
                    <p style="color: green;">{{ session('status') }}</p>
                @endif

                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="input">
                        <span>Email Address</span>
                        <input type="email" name="email" required />
                    </div>

                    <div class="input">
                        <button type="submit">Send Reset Link</button>
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
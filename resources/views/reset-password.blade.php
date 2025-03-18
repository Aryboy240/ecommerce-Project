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
        <div class="login-img">
            <img src="Images/loginBackground.jpg" />
        </div>
        <div class="login-content">
            <div class="form">
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
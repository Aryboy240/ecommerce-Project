<!--
    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Front end for the User Account page (for logged-in users)

    Developer: Aryan Kora
    University ID: 230059030
    Function: Front end improvements
-->

<html lang="en">

<head>
    <link rel="stylesheet" href={{  asset('css/account.css') }}>
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Welcome')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

<!-- Account page -->
<section class="main-account-section">
    <div class="account-wrapper">
        <div class="subheading">
            <h3>Update Your Information</h3>
            @if(@session('success'))
            <div style=" color: green;">{{ session('success')}}</div>
            @endif
            @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <div class="acc-info">
            <!-- User Info -->
            <section class="account-section">
                <div class="username-heading">
                    <!--Displays users name-->
                    <h1> Welcome, {{ auth()->user()->name}} </h1>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-button">Logout</button>
                    </form>
                </div>
                <div class="subheading">
                    <h3>Your Account Details</h3>
                </div>
                <div class="user-info">
                    <!--Displays user information-->
                    <p><strong>Username:</strong> {{ auth()->user()->name}}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email}}</p>
                    <p><strong>D.O.B:</strong> {{ date('d/m/Y', strtotime(auth()->user()->birthday))}}</p>
                </div>
            </section>

            <!-- Update Details Forms -->
            <section class="update-details">
                <div class="update-details-forms">
                    <!-- Update Username Form -->
                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Username</h4>
                        </div>
                        <div class="form-content">
                            <form action="{{ route('update.username') }}" method="POST" id="errorProne">
                                @csrf
                                <div class="input">
                                    <input type="text" id="new-username" name="new_username" placeholder="New username"
                                        value="{{ old('new_username') }}">
                                    @error('new_username')
                                    <span style="color: rgb(255, 0, 0);">{{ $message }}</span>
                                    @enderror
                                    <br><br>
                                    <input type="password" id="password" name="password" placeholder="Password">
                                    @error('password')
                                    <span style="color: rgb(255, 0, 0);">{{ $message }}</span>
                                    @enderror
                                    <br><br>
                                    <button type="submit">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password Form -->
                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Password</h4>
                        </div>
                        <div class="form-content">
                            <form action="{{ route('update.password') }}" method="POST" id="errorProne">
                                @csrf
                                <div class="input">
                                    <input type="password" id="current-password" name="current_password"
                                        placeholder="Current password">
                                    @error('current_password')
                                    <span style="color: rgb(255, 0, 0);">{{ $message }}</span>
                                    @enderror
                                    <br><br>
                                    <input type="password" id="new-password" name="new_password"
                                        placeholder="New password">
                                    @error('new_password')
                                    <span style="color: rgb(255, 0, 0);">{{ $message }}</span>
                                    @enderror
                                    <br><br>
                                    <input type="password" id="confirm-new-password" name="new_password_confirmation"
                                        placeholder="Confirm new password">
                                    @error('new_password_confirmation')
                                    <span style="color: rgb(255, 0, 0);">{{ $message }}</span>
                                    @enderror
                                    <br><br>
                                    <button type="submit">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Update Email Form -->
                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Email</h4>
                        </div>
                        <div class="form-content">
                            <form action="{{ route('update.email') }}" method="POST" id="errorProne">
                                @csrf
                                <div class="input">
                                    <input type="email" id="new-email" name="new_email" placeholder="New email"
                                        value="{{ old('new_email') }}">
                                    @error('new_email')
                                    <span style="color: rgb(255, 0, 0);">{{ $message }}</span>
                                    @enderror
                                    <br><br>
                                    <input type="password" id="password" name="password" placeholder="Password">
                                    @error('password')
                                    <span style="color: rgb(255, 0, 0);">{{ $message }}</span>
                                    @enderror
                                    <br><br>
                                    <button type="submit">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </section>
        </div>
    </div>
</section>
@endsection
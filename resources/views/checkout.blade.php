<!--
    Developer: Oyinlola Arowolo
	University ID: 230402373
    Function: Front end for the checkout page

    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Front end for the checkout page
-->

<html lang="en">

<head>
    <script defer src="{{ asset('js\checkout_page.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Checkout')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

<!-- Checkout Content -->
<section class="hero" style="padding: 40px 20px;">
    <div class="hero-content">
        <h1 class="page-title">Checkout</h1>
    </div>
</section>
<section class="container">
    <div class="form-section">
        <h2>Payment information</h2>
        <p>Please select your payment method.</p>
        <div class="payment-methods">
            <button class="payment-method" id="card">
                Credit/Debit Card
                <div class="payment-logos">
                    <img src="{{ asset('Images/brands/mastercard.png') }}" alt="Mastercard" class="payment-brand">
                    <img src="{{ asset('Images/brands/visa.png') }}" alt="Visa" class="payment-brand">
                </div>
            </button>
            <button class="payment-method" id="paypal" onclick="goToPayPal()">
                PayPal
                <div class="payment-logos">
                    <img src="{{ asset('Images/brands/paypal.png') }}" alt="Mastercard" class="payment-brand">
                </div>
            </button>
            <button class="payment-method" id="wallet" onclick="goToWallet()">
                Apple Pay
                <div class="payment-logos">
                    <img src="{{ asset('Images/brands/applepay.png') }}" alt="Mastercard" class="payment-brand">
                </div>
            </button>
        </div>
        <div id="payment-card" class="form-grid payment-section">
            <div class="form-group full">
                <label for="card-name">Card Name</label>
                <input type="text" id="card-name" name="card-name" required>
            </div>
            <div class="form-group full">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card-number" required>
            </div>
            <div class="form-group">
                <label for="expiry-date">Expiry Date</label>
                <input type="text" id="expiry-date" name="expiry-date" required>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <button id="confirm-details">Confirm Card Details</button>
        </div>
        <div id="payment-paypal" class="payment-section">
            <p> You will be redirected to PayPal to complete your purchase. </p>
        </div>
        <div id="payment-wallet" class="payment-section">
            <p> Use Apple Pay to complete your purchase. </p>
        </div>
    </div>
    <div class="checkout-grid">
        <div class="checkout-form">
            <div class="form-section">
                <h2>Shipping information</h2>
                <p>Please fill in the following details so we can ship your order to you.</p>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" required>
                    </div>
                    <div class="form-group full">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <div class="form-group full">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-summary">
            <h2>Order Summary</h2>
            <div class="summary-items">
                @foreach($cartItems as $item)
                    <div class="summary-item">
                        <!-- Product Image -->
                        <img src="{{ $item->product->images->first()?->image_path ?? asset('Images/default-product.png') }}"
                            alt="{{ $item->product->name }}">
                        <div class="summary-item-details">
                            <!-- Product Name -->
                            <h3>{{ $item->product->name }}</h3>
                            <!-- Product Quantity -->
                            <p class="quantity">Qty: {{ $item->quantity }}</p>
                            <!-- Product Price (total for that item) -->
                            <p class="price">£{{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="summary-total">
                <div class="summary-row">
                    <!-- Display the subtotal -->
                    <p>Subtotal</p>
                    <p>£{{ number_format($total, 2) }}</p>
                </div>
            </div>
            <!-- Button to place the order -->
            <button type="submit" class="checkout-btn">
                Place Order
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M20.5 7.2H16V4.1c0-.6-.5-1.1-1.1-1.1H9.1C8.5 3 8 3.5 8 4.1v3.1H3.5c-.6 0-1.1.5-1.1 1.1v11.5c0 .6.5 1.1 1.1 1.1h17c.6 0 1.1-.5 1.1-1.1V8.3c0-.6-.5-1.1-1.1-1.1zm-6.4 0H9.9V4.9h4.2v2.3z" />
                </svg>
            </button>
        </div>
    </div>
</section>
@endsection
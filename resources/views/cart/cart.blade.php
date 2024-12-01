<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- CSS -->
   <link rel="stylesheet" href="{{ asset('css/main.css') }}">
   <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
   <link rel="stylesheet" href="{{ asset('css/product_Card.css') }}">
   <title>Shopping Cart - Optique</title>
</head>
<body>
   <!-- Navigation Bar -->
   <header class="header">
       <div class>
           <nav class="navbar">
               <div class="navbar-links">
                   <img class="logo" src="{{ asset('Images/nav_Logo.png') }}" alt="logo">
                   <ul>
                       <li><a class="nav-link" href="">Home</a></li>
                       <li><a class="nav-link" href="">About</a></li>
                       <li><a class="nav-link" href="">Product</a></li>
                       <li><a class="nav-link" href="">Contact</a></li>
                       <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                   </ul>
                   <div class="search-bar">
                       <input type="text" placeholder="Search An Item" />
                       <div class="search-icon">
                           <img src="{{ asset('Images/svg/magnifying-glass-solid.svg') }}">
                       </div>
                   </div>
               </div>
           </nav>
       </div>
   </header>

   <!-- Hero Section -->
   <section class="hero" style="padding: 40px 20px;">
       <div class="hero-content">
           <h1 style="font-size: 80px; margin-bottom: 20px; text-shadow: 0px 10px 10px rgba(0, 0, 0, 1);">YOUR CART</h1>
       </div>
   </section>

   <!-- Cart Content -->
   <section class="container">
       @if(isset($items) && count($items) > 0)
           <div class="product-card-con">
               @foreach($items as $item)
                   <div class="product-card" style="width: 100%; max-width: 800px; margin: 20px auto;">
                       <div class="card-circle"></div>
                       <div class="product-card-content" style="width: 70%; left: 0;">
                           <h2>{{ $item->product_name }}</h2>
                           <p style="margin: 10px 0;">Quantity: {{ $item->quantity }}</p>
                           <p style="color: var(--mint); font-size: 1.2em;">£{{ number_format($item->price, 2) }}</p>
                           <div style="margin-top: 20px;">
                               <a href="#" onclick="updateQuantity()" style="margin-right: 20px;">Update</a>
                               <a href="#" onclick="removeItem()" style="color: #ff4444;">Remove</a>
                           </div>
                       </div>
                       <img class="imageSize-1" src="{{ asset('Images/product-placeholder.png') }}" style="height: 100px;">
                   </div>
               @endforeach
           </div>

           <!-- Cart Summary -->
           <div class="product-card" style="width: 100%; max-width: 800px; margin: 40px auto; padding: 30px;">
               <div style="text-align: right;">
                   <h2 style="color: var(--text-primary); margin-bottom: 20px;">Cart Summary</h2>
                   <p style="color: var(--text-secondary); margin-bottom: 10px;">Subtotal: £{{ number_format($total, 2) }}</p>
                   <p style="color: var(--text-secondary); margin-bottom: 20px;">Shipping: Calculated at checkout</p>
                   <h3 style="color: var(--mint); font-size: 1.5em; margin-bottom: 30px;">Total: £{{ number_format($total, 2) }}</h3>
                   <a href="{{ route('checkout') }}" class="btn-order" style="font-size: 1.1em;">Proceed to Checkout</a>
               </div>
           </div>
       @else
           <div style="text-align: center; padding: 100px 20px;">
               <div style="margin-bottom: 40px;">
                   <img src="{{ asset('Images/gifs/glasses.gif') }}" style="width: 120px; filter: drop-shadow(0px 0px 20px rgba(0, 191, 174, 0.3));">
               </div>
               <h2 style="color: var(--text-primary); margin-bottom: 20px; font-size: 2em; text-shadow: 0px 10px 10px rgba(0, 0, 0, 1);">Your cart is empty</h2>
               <p style="color: var(--text-secondary); margin-bottom: 40px;">Looks like you haven't added any items yet</p>
               <a href="{{ route('welcome') }}" class="btn-order">Continue Shopping</a>
           </div>
       @endif
   </section>

   <script>
       function updateQuantity() {
           // Add quantity update logic
       }

       function removeItem() {
           // Add remove item logic
       }
   </script>
</body>
</html>
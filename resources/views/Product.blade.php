<!--
    Developer: Oyinlola Arowolo
	  University ID: 230402373
    Function: Front end for the Products page
-->

<html lang="en">

<head>
  <!-- Add meta description for SEO -->
  <meta name="description" content="Shop Optique's collection of glasses, sunglasses, and contact lenses">
  <script defer src="{{ asset('js/product_page.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Welcome')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

<!-- Main Content -->
<section class="main">
  <!-- Sidebar -->
  <aside>
    <section class="categories">
      <h2>Categories</h2>
      <ul>
        <li><a href="">Glasses</a></li>
        <li><a href="">Contact Lenses</a></li>
        <li><a href="">Miscellaneous</a></li>
        <li><a href="">Sunglasses</a></li>
      </ul>
    </section>
    <section class="price-range">
      <h2>Price Range</h2>
      <div class="price-inputs">
        <div class="price-wrapper">
          <span class="min-price">£0</span>
          <input type="range" class="price-range-slider" min="0" max="1000" value="500" step="10">
          <span class="max-price">£500</span>
        </div>
      </div>
    </section>

    <section class="active-filters">
      <!-- Active filters will be displayed here -->
    </section>
  </aside>

  <!-- Product Section -->
  <section class="products">
    <h1>Our Collection</h1>
    <div class="product-grid">
      <div class="product-card">
        <a href="{{ route('sproduct') }}">
          <img src="{{ asset('Images/products/glasses1.jpeg') }}" alt="Classic Round Glasses">
          <h3>Square Frame Glasses</h3>
          <p>Price: $199.99</p>
          <button class="add-to-cart-btn">Add to Cart</button>
        </a>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/sun1.jpeg') }}" alt="Aviator Sunglasses">
        <h3>Aviator Sunglasses</h3>
        <p>Price: $159.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/case1.jpeg') }}" alt="Premium Leather Case">
        <h3>Hard Shell Case</h3>
        <p>Price: $39.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/glasses2.png') }}" alt="Square Frame Glasses">
        <h3>Classic Round Glasses</h3>
        <p>Price: $179.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/sun2.jpeg') }}" alt="Cat Eye Sunglasses">
        <h3>Square Sunglasses</h3>
        <p>Price: $149.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/case2.png') }}" alt="Hard Shell Case">
        <h3>Premium Leather Case</h3>
        <p>Price: $29.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/glasses3.png') }}" alt="Oval Frame Glasses">
        <h3>Oval Frame Glasses</h3>
        <p>Price: $189.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/sun3.png') }}" alt="Sport Sunglasses">
        <h3>Sport Sunglasses</h3>
        <p>Price: $169.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/case3.jpeg') }}" alt="Travel Case">
        <h3>Travel Case</h3>
        <p>Price: $59.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/glasses cleaner.jpg') }}" alt="Product 10">
        <h3>Glasses Cleaner</h3>
        <p>Price: $29.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/contacts cleaner.jpg') }}" alt="Product 11">
        <h3>Contacts Cleaner</h3>
        <p>Price: $19.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
      <div class="product-card">
        <img src="{{ asset('Images/products/case4.jpg') }}" alt="Travel Case">
        <h3>Travel Case</h3>
        <p>Price: $109.99</p>
        <button class="add-to-cart-btn">Add to Cart</button>
      </div>
    </div>
    <!-- Pagination -->
    <div class="pagination">
      <a href="#">&laquo; Previous</a>
      <a href="?page=1" class="active">1</a>
      <a href="?page=2">2</a>
      <a href="?page=3">3</a>
      <a href="#">Next &raquo;</a>
    </div>
  </section>
</section>

@endsection
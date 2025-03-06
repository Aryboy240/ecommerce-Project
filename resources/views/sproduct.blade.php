<!--
    Developer: Oyinlola Arowolo
	  University ID: 230402373
    Function: Front end for the Products page
-->

<html lang="en">
<head>
    <!-- Add meta description for SEO -->
    <meta name="description" content="Shop Optique's collection of glasses, sunglasses, and contact lenses">
    <!-- JS -->
    <script defer src="{{ asset('js/product_page.js') }}"></script>
    <script defer src="{{ asset('js/addToCart.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/product_page.css') }}"> 
</head>
</html>


<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Product Information')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

  <!-- Main Content:: Esta -->
  <section class="prodetails">
    <div class="single-pro-image">
        <img src="{{ asset($product->images->first()->image_path) }}" width="100%" id="MainImg" alt="{{ $product->name }}">

        <div class="small-img-group">
            @foreach ($product->images as $image)
              @if (!empty($image->image_path) && file_exists(public_path($image->image_path)))
                <div class="small-img-col">
                    <img src="{{ asset($image->image_path) }}" width="100%" class="small-img" alt="{{ $product->name }}">
                </div>
              @endif
            @endforeach
        </div>
      </div>

    <div class="single-pro-details">
        <h6>Home / {{ $product->category->name }}</h6>
        <h4>{{ $product->name }}</h4>
        <h2>£{{ $product->price }}</h2>

        <select>
            <option>Select Frame Size</option>
            <option>Small</option>
            <option>Medium</option>
            <option>Large</option>
        </select>

        <div class="quantity">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" value="1" min="1">
        </div>

        <form class="add-to-cart-form" onsubmit="addToCart(event, {{ $product->id }})">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="add-to-cart">Add to Cart</button>
        </form>

        <h4 id="prod-margin">Product Details</h4>
        <p>{{ $product->description }}</p>

        <div class="product-features">
            <h4>Features</h4>
            <ul>
                <li>Premium acetate frame</li>
                <li>Anti-reflective coating</li>
                <li>Scratch-resistant lenses</li>
                <li>Adjustable nose pads</li>
                <li>UV protection</li>
            </ul>
        </div>
    </div>
  </section>

  <!-- Related Products Section:: Esta -->
  <section class="related-products">
      <div class="product-pairs">
          <h2>Complete Your Look</h2>
          
          <!-- Paired Products -->
          <div class="product-container">
              <div class="product-card">
                  <img src="{{ asset('Images/products/case1.jpeg') }}" alt="Matching Case">
                  <h3>Matching Case</h3>
                  <p>Price: $39.99</p>
                  <button class="add-to-cart-btn">Add to Cart</button>
              </div>
              <div class="product-card">
                  <img src="{{ asset('Images/products/glasses cleaner.jpg') }}" alt="Product 10">
                  <h3>Glasses Cleaner</h3>
                  <p>Price: $29.99</p>
                  <button class="add-to-cart-btn">Add to Cart</button>
              </div>
          </div>
      </div>
  </section>
@endsection

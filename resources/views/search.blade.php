<!--
    Developer: Nikhil Kainth
	University ID: 230069888
    Function: Front end for the search page

    Developer: Abdulrahman Muse
    university ID: 230228946
    function: Search page front end

    Developer: Aryan Kora
    university ID: 230059030
    function: Search page backend
-->

<html lang="en">
<head>
    <!-- JS -->
    <script defer src="/js/theme.js"></script>
    <script defer src="/js/addToCart.js"></script>
    <script src="js/scrollBar.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
</html>

<!-- This is a child of the "views/layouts/searchApp.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Product Search')

<!-- The @yeild in searchApp's main is filled by everything in this section -->
@section('content')

<section class="search-header" style="padding-top: 50px">
    <h1>Find Your Perfect Product</h1>
</section>

<!-- Search Form -->
<section class="search-bar">
    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('products.index') }}" style="margin-left: 10px;">Clear</a>
    </form>
</section>

<!-- Category Filters -->
<section class="category-filters">
    <form method="GET" action="{{ route('products.index') }}">
        <button type="submit" name="category" value="all" class="category-btn active">All</button>
        <button type="submit" name="category" value="Adidas" class="category-btn">Adidas</button>
        <button type="submit" name="category" value="Barbour" class="category-btn">Barbour</button>
        <button type="submit" name="category" value="Comfit" class="category-btn">Comfit</button>
        <button type="submit" name="category" value="Disney" class="category-btn">Disney</button>
        <button type="submit" name="category" value="DKNY" class="category-btn">DKNY</button>
        <button type="submit" name="category" value="Harry Potter" class="category-btn">Harry Potter</button>
        <button type="submit" name="category" value="HUGO" class="category-btn">HUGO</button>
        <button type="submit" name="category" value="Jeff Banks" class="category-btn">Jeff Banks</button>
        <button type="submit" name="category" value="Karen Millen" class="category-btn">Karen Millen</button>
    </form>
    <!-- <button class="category-btn" data-category="glasses">Brands</button> -->
    <!-- Preferably make a dropdown menu for each brand you can filter from -->
    <!-- But if time is short, then forget it -->
</section>


<!-- Product Grid -->
<section class="search-product-grid" id="search-product-grid">
    @foreach ($products as $product)
        <div class="search-product-card" data-category="{{ $product->category->name }}">
            <!-- Display Only Front Image -->
            @foreach($product->images as $image)
                @if($image->imageType && $image->imageType->name == 'front')
                    <a href="{{ route('product.details', ['id' => $product->id]) }}" class="search-product-link">
                        <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front">
                    </a>
                    @break
                    <!-- Break after showing the front image -->
                @endif
            @endforeach
            <a href="{{ route('product.details', ['id' => $product->id]) }}" class="search-product-link" style="text-decoration: none !important">
                <h3>{{ $product->name }}</h3>
                <p >Price: £{{ $product->price }}</p>
            </a>
            <form class="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="add-to-cart-button">Add to Cart</button>
            </form>
        </div>
    @endforeach
</section>
@endsection
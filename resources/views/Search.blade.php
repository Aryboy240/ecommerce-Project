<!--
    Developer: Nikhil Kainth
	  University ID: 230069888
    Function: Front end for the search page
-->
<!--
    Developer: Abdulrahman Muse
    university ID: 230228946
    function: search page front end
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>
<body>
    <!-- Search Header -->
    <header class="search-header">
        <h1>Find Your Perfect Product</h1>
    </header>

    <!-- Search Bar Section -->
    <section class="search-bar">
        <input type="text" id="search-input" placeholder="Search for products...">
        <button id="search-button">Search</button>
    </section>

    <!-- Category Filters -->
    <section class="category-filters">
        <button class="category-btn active" data-category="all">All</button>
        <button class="category-btn" data-category="glasses">Glasses</button>
        <button class="category-btn" data-category="cases">Cases</button>
        <button class="category-btn" data-category="accessories">Accessories</button>
        <button class="category-btn" data-category="sunglasses">Sunglasses</button>
    </section>

    <!-- Product Grid -->
    <section class="product-grid" id="product-grid">
        @foreach ($products as $product)
        <div class="product-card" data-category="{{ $product->category->name }}">
            <!-- Display Product Image -->
            @if ($product->images->first())
                <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="{{ $product->name }}">
            @else
                <img src="/path/to/default-image.jpg" alt="Default Image">
            @endif
             <h3>{{ $product->name }}</h3>
             <p>Price: ${{ $product->price }}</p>
             <button>Add to Cart</button>
        </div>
        @endforeach
    </section>

    <!-- Include JavaScript -->
    <script src="{{ asset('js/search.js') }}"></script>
</body>
</html>
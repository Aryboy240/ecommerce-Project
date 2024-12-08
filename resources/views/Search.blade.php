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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->
    <script defer src="/js/theme.js"></script>
    <script src="js/scrollBar.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">

    <title>Search</title>
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
        <button class="category-btn" data-category="glasses">Adidas</button>
        <button class="category-btn" data-category="glasses">Barbour</button>
        <button class="category-btn" data-category="glasses">Comfit</button>
        <button class="category-btn" data-category="glasses">Disney</button>
        <button class="category-btn" data-category="glasses">DKNY</button>
        <button class="category-btn" data-category="glasses">Harry Potter</button>
        <button class="category-btn" data-category="glasses">HUGO</button>
        <button class="category-btn" data-category="glasses">Jeff Banks</button>
        <button class="category-btn" data-category="glasses">Karen Millen</button>

        <!-- <button class="category-btn" data-category="glasses">Brands</button> -->
        <!-- Preferably make a dropdown menu for each brand you can filter from -->
        <!-- But if time is short, then forget it -->
    </section>

    <!-- Product Grid -->
    <section class="product-grid" id="product-grid">
      @foreach ($products as $product)
      <div class="product-card" data-category="{{ $product->category->name }}">
          <!-- Display Only Front Image -->
          @foreach($product->images as $image)
              @if($image->imageType && $image->imageType->name == 'front')
                  <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front">
                  @break  <!-- Break after showing the front image -->
              @endif
          @endforeach
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
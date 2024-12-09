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

@extends('layouts.searchApp') <!-- This is a child of the "views/layouts/searchApp.balde.php" -->

@section('title', 'Optique | Product Search') <!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->

@section('content') <!-- The @yeild in searchApp's main is filled by everything in this section -->

    <!-- Home Icon -->
    <div class="HomeIcon">
        <a href="{{ route('welcome') }}">
        <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="home"
            class="home"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 576 512"
        >
            <path
            fill="currentColor"
            d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z"
            ></path>
        </svg>
        </a>
    </div>

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
            <form class="add-to-cart-form" action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="add-to-cart-button">Add to Cart</button>
            </form>
      </div>
      @endforeach
    </section>

    <!-- Include JavaScript -->
    <script src="{{ asset('js/search.js') }}"></script>
@endsection
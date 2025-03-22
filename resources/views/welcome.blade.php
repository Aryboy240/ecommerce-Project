<!--
    Developer: Aryan Kora
    university ID: 230059030
    function: Landing page Frontend and backend
-->

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Any extra head content for this page in specific -->
@section('extra-head')
  <script defer src="/js/addToCart.js"></script>
  <link rel="stylesheet" href="{{ asset('css/find_my_fit.css') }}">
  <script defer src="js/ProductSlider.js"></script>
@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Welcome')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

<!-- Intro Title (Frame your world):: Aryan Kora -->
<section class="hero">
  <div class="hero-content">
    <div>
      <h1>FRAME YOUR WORLD<br>define your style</h1>
      <img class="world" src="{{ asset('Images/gifs/globe.gif') }}">
      <p>
        This is a premium collection designed for those who want to<br>
        elevate their eye-wear style and enchance their vision<br><br>
        <em>A digital solution for Opticians</em>
      </p>
      <a href="{{ route('search') }}" class="btn-order">Order</a>
      <div class="pointer-wrapper">
        <img src="{{ asset('Images/arrow.png') }}">
        <p>Order from<br> here</p>
      </div>
    </div>
  </div>
</section>
<!-- Intro title End -->

<!-- Test for floating cards under hero content:: Aryan Kora -->
<section class="container">
  <div class="floater-body">
    <div class="floater-containter">
      <div class="floaters">
        <image src="{{ asset('Images/gifs/fire.gif') }}">
          <p>Hot Deals</p>
      </div>
      <div class="floaters">
        <image src="{{ asset('Images/gifs/glasses.gif') }}">
          <p>Glasses</p>
      </div>
      <div class="floaters">
        <image src="{{ asset('Images/gifs/sunglasses.gif') }}">
          <p>Sunglasses</p>
      </div>
    </div>
  </div>
</section>
<!-- Floating cards End -->

<!-- FMF-special feature:: Abdul -->
<section>
  <div class="fit-button-con">
    <button class="find-my-fit-btn" onclick="resetAndShowModal()">Find My Fit</button>
  </div>

  <!-- Initial Popup -->
  <div id="initialPopup" class="initial-popup">
      <span class="close-modal" onclick="closeInitialPopup()">&times;</span>
      <h2>Find glasses based on your face shape</h2>
      <button class="continue-btn" onclick="showModal()">Continue</button>
  </div>

  <!-- Modal -->
  <div id="findMyFitModal" class="modal">
      <span class="close-modal" onclick="closeModal()">&times;</span>
      <h2>Select Your Face Shape</h2>
      <div class="face-options">
          <div class="face-item" onclick="showFaceShape('Round')">
              <img src="{{ asset('Images/round.png') }}" alt="Round">
              <div class="face-label">Round</div>
          </div>
          <div class="face-item" onclick="showFaceShape('Square')">
              <img src="{{ asset('Images/square.png') }}" alt="Square">
              <div class="face-label">Square</div>
          </div>
          <div class="face-item" onclick="showFaceShape('Oval')">
              <img src="{{ asset('Images/oval.png') }}" alt="Oval">
              <div class="face-label">Oval</div>
          </div>
          <div class="face-item" onclick="showFaceShape('Heart')">
              <img src="{{ asset('Images/heart.png') }}" alt="Heart">
              <div class="face-label">Heart</div>
          </div>
          <div class="face-item" onclick="showFaceShape('Diamond')">
              <img src="{{ asset('Images/diamond.png') }}" alt="Diamond">
              <div class="face-label">Diamond</div>
          </div>
          <div class="face-item" onclick="showFaceShape('Triangular')">
              <img src="{{ asset('Images/triangle.png') }}" alt="Triangular">
              <div class="face-label">Triangular</div>
          </div>
      </div>
  </div>

  <!-- Recommendations Section -->
  <div id="recommendations" style="display: none;">
    <h2>Recommended Glasses</h2>
    <div id="faceShapeSections">
        @foreach (['Round', 'Square', 'Oval', 'Heart', 'Diamond', 'Triangular'] as $shape)
            <section class="search-product-grid face-shape-section" id="section-{{ $shape }}" style="display: none;">
                @php
                    $filteredProducts = $products->filter(function ($product) use ($shape) {
                        return $product->face_shape === $shape; // Ensure face_shape matches
                    });
                @endphp
                
                @foreach ($filteredProducts as $product)
                    <div class="search-product-card" data-category="{{ $product->category->name }}">
                        @foreach($product->images as $image)
                            @if($image->imageType && $image->imageType->name == 'front')
                                <a href="{{ route('product.details', ['id' => $product->id]) }}" class="search-product-link">
                                    <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front" width="100px">
                                </a>
                                @break
                            @endif
                        @endforeach
                        <a href="{{ route('product.details', ['id' => $product->id]) }}" class="search-product-link">
                            <h3>{{ $product->name }}</h3>
                            <p>Price: £{{ number_format($product->price, 2) }}</p>
                        </a>
                        <form class="add-to-cart-form" onsubmit="addToCart(event, {{ $product->id }})">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="add-to-cart">Add to Cart</button>
                        </form>
                    </div>
                @endforeach
            </section>
        @endforeach
    </div>
  </div>

</section>
<!-- FMF end -->

<!-- Featured Products Section:: Aryan Kora -->
<section style="margin-top: 100px;">
  <h2 class="section-title">Featured Products</h2>
  <!--SECTION 1-->
  <section class="product-card-con" style="padding-bottom: 50px">
    <!--ADIDAS-->
    <div class="product-card">
      <div class="card-circle"></div>
      <div class="product-card-content">
        <h2>ADIDAS</h2>

        <p>
          Discover the perfect blend of performance and style with Adidas eyewear. Designed for athletes and fashion enthusiasts alike, these frames offer durability and comfort, ensuring you look great while staying active.
        </p>
        <a href="/products?category=Adidas">Starting from £100</a>
      </div>
      <img class="imageSize-1" src="{{ asset('Images/brands/adidas_Logo.png') }}" />
    </div>
    <!--HUGO-->
    <div class="product-card">
      <div class="card-circle"></div>
      <div class="product-card-content">
        <h2>HUGO</h2>
        <p>
          HUGO eyewear combines contemporary design with high-quality materials. Perfect for those who appreciate modern aesthetics, these frames are a statement piece that enhances any outfit.
        </p>
        <a href="/products?category=HUGO">Starting from £100</a>
      </div>
      <img class="imageSize-2" src="{{ asset('Images/brands/hugo.png') }}" />
    </div>
    <!--DKNY-->
    <div class="product-card">
      <div class="card-circle"></div>
      <div class="product-card-content">
        <h2>DKNY</h2>
        <p>
          Embrace urban sophistication with DKNY eyewear. These stylish frames are designed for the modern individual, offering a chic look that is perfect for both casual and formal occasions.
        </p>
        <a href="/products?category=DKNY">Starting from £100</a>
      </div>
      <img class="imageSize-3" src="{{ asset('Images/brands/dnky.png') }}" />
    </div>
  </section>
  <!--SECTION 2-->
  <section class="product-card-con" style="padding-bottom: 50px">
    <!--Disney-->
    <div class="product-card">
      <div class="card-circle-2"></div>
      <div class="product-card-content">
        <h2>Disney</h2>
        <p>
          Bring a touch of magic to your eyewear collection with Disney frames. Perfect for kids and adults alike, these fun and colorful designs are sure to delight fans of all ages.
        </p>
        <a href="/products?category=Disney">Starting from £100</a>
      </div>
      <img class="imageSize-4" src="{{ asset('Images/brands/disney.png') }}" />
    </div>
    <!--Karen Millen-->
    <div class="product-card">
      <div class="card-circle-2"></div>
      <div class="product-card-content">
        <h2>Karen Millen</h2>
        <p>
          Karen Millen eyewear is synonymous with elegance and sophistication. These frames are crafted for those who appreciate timeless style and high-quality craftsmanship.
        </p>
        <a href="/products?category=Karen+Millen">Starting from £100</a>
      </div>
      <img class="imageSize-5" src="{{ asset('Images/brands/karen_Millen.png') }}" />
    </div>
    <!--Jeff Banks-->
    <div class="product-card">
      <div class="card-circle-2"></div>
      <div class="product-card-content">
        <h2>Jeff Banks</h2>
        <p>
          Jeff Banks eyewear offers a unique blend of classic and contemporary styles. Ideal for those who want to make a statement, these frames are designed to stand out while providing comfort and durability.
        </p>
        <a href="/products?category=Jeff+Banks">Starting from £100</a>
      </div>
      <img class="imageSize-6" src="{{ asset('Images/brands/jeff_Banks.png') }}" />
    </div>
  </section>
  <!--SECTION 3-->
  <section class="product-card-con" style="padding-bottom: 50px">
    <!--Harry Potter-->
    <div class="product-card">
      <div class="card-circle-3"></div>
      <div class="product-card-content">
        <h2>Harry Potter</h2>
        <p>
          Step into the wizarding world with Harry Potter eyewear. These frames are perfect for fans of all ages, combining magical designs with high-quality materials for a comfortable fit.
        </p>
        <a href="/products?category=Harry+Potter">Starting from £100</a>
      </div>
      <img class="imageSize-7" src="{{ asset('Images/brands/harry_Potter.png') }}" />
    </div>
    <!--Barbour-->
    <div class="product-card">
      <div class="card-circle-3"></div>
      <div class="product-card-content">
        <h2>Barbour</h2>
        <p>
          Barbour eyewear reflects the brand's heritage of quality and craftsmanship. These frames are designed for those who appreciate classic British style and outdoor adventure.
        </p>
        <a href="/products?category=Barbour">Starting from £100</a>
      </div>
      <img class="imageSize-8" src="{{ asset('Images/brands/barbour.png') }}" />
    </div>
    <!--Comfit-->
    <div class="product-card">
      <div class="card-circle-3"></div>
      <div class="product-card-content">
        <h2>Comfit</h2>
        <p>
          Comfit eyewear is designed for ultimate comfort and style. Perfect for everyday wear, these frames provide a lightweight feel without compromising on durability.
        </p>
        <a href="/products?category=Comfit">Starting from £100</a>
      </div>
      <img class="imageSize-9" src="{{ asset('Images/brands/comfit.png') }}" />
    </div>
  </section>
</section>
<!-- Product Cards End -->

<!-- Products Slider:: Aryan Kora -->
<section class="f-product">
  <h2 class="section-title">Popular Products</h2>
  <button class="pre-btn"><img src="{{ asset('Images/PSArrow.png') }}" alt=""></button>
  <button class="nxt-btn"><img src="{{ asset('Images/PSArrow.png') }}" alt=""></button>
  
  <div class="f-product-container">
      @foreach($products as $product)
          <div class="f-product-card">
              <div class="f-product-image">
                @foreach($product->images as $image)
                    @if($image->imageType && $image->imageType->name == 'front')
                    <a href="{{ route('product.details', ['id' => $product->id]) }}">
                      <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front" class="f-product-thumb">
                    </a>
                      @break
                    @endif
                @endforeach
                  <button class="add-to-cart card-btn" data-product-id="{{ $product->id }}" data-quantity="1">
                      Add to Cart
                  </button>
              </div>
              <div class="f-product-info">
                  <h2 class="f-product-brand">{{ $product->category->name }}</h2>
                  <p class="f-product-short-description">ID: {{ $product->id }}</p>
                  <span class="price">£{{ number_format($product->price, 2) }}</span>
                  
                  @if($product->discount_price)
                      <span class="actual-price">£{{ number_format($product->discount_price, 2) }}</span>
                  @endif
              </div>
          </div>
      @endforeach
  </div>
</section>

<!-- About Section:: Aryan Kora -->
<section class="about-section">
  <div class="about-wrapper">
    <div class="about-content">
      <h2>Learn about us and what sets us apart</h2>
      <p>
        At Optique, we are dedicated to revolutionizing the eyewear industry by providing innovative solutions that combine style and functionality. Our journey began with a simple vision: to make high-quality eyewear accessible to everyone. We believe that eyewear is not just a necessity but a fashion statement that reflects your personality.
        <br><br>
        Our team of experts is passionate about curating a diverse range of eyewear that caters to various styles and preferences. We prioritize quality, ensuring that every product meets our high standards. Our commitment to customer satisfaction drives us to continuously improve our offerings and services.
        <br><br>
        We also believe in sustainability and are committed to using eco-friendly materials in our products. By choosing Optique, you are not only enhancing your vision but also contributing to a more sustainable future.
        <br><br>
        Join us on this journey to redefine eyewear. Explore our collection today and discover the perfect blend of vision and style.
      </p>
      <a class="about-button" href="{{ route('about') }}">Learn More</a>
    </div>
    <div class="about-image">
      <div class="image-grid">
        <img src="{{ asset('Images/About/Goggle Box.png') }}" alt="About Image 1">
        <img src="{{ asset('Images/About/LumiLens.png') }}" alt="About Image 2">
        <img src="{{ asset('Images/About/Optivision.png') }}" alt="About Image 3">
        <img src="{{ asset('Images/About/Optquie.png') }}" alt="About Image 4">
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", function() {
  // Hide the initial popup by default when the page loads
  document.getElementById('initialPopup').style.display = 'none';
  });

function resetAndShowModal() {
  closeModal();
  closeInitialPopup();
  document.getElementById('initialPopup').style.display = 'block';
}

  function showModal() {
      document.getElementById('initialPopup').style.display = 'none';
      document.getElementById('findMyFitModal').style.display = 'block';
  }

  function closeModal() {
      document.getElementById('findMyFitModal').style.display = 'none';
      document.getElementById('initialPopup').style.display = 'none';
      document.getElementById('recommendations').style.display = 'none';
  }

  function closeInitialPopup() {
      document.getElementById('initialPopup').style.display = 'none';
  }

  function showFaceShape(shape) {
    document.getElementById('findMyFitModal').style.display = 'none';
    document.getElementById('recommendations').style.display = 'block';

    // Hide all sections first
    document.querySelectorAll('.face-shape-section').forEach(section => {
        section.style.display = 'none';
    });

    // Fetch products dynamically via AJAX
    fetch(`/get-products-by-face-shape?shape=${shape}`)
        .then(response => response.json())
        .then(products => {
            const section = document.getElementById(`section-${shape}`);
            section.innerHTML = ''; // Clear previous products
            
            if (products.length === 0) {
                section.innerHTML = '<p>No products available for this face shape.</p>';
            } else {
                products.forEach(product => {
                    section.innerHTML += `
                        <div class="search-product-card" data-category="${product.category?.name || 'Unknown'}">
                            <a href="/sproduct/${product.id}" class="search-product-link">
                                <img src="${product.image_url}" alt="${product.name} - Front">
                            </a>
                            <a href="/sproduct/${product.id}" class="search-product-link">
                                <h3>${product.name}</h3>
                                <p>Price: £${parseFloat(product.price).toFixed(2)}</p>
                            </a>
                            <a href="/sproduct/${product.id}">
                              <button type="submit">View</button>
                            </a>
                        </div>
                    `;
                });
            }

            section.style.display = 'grid'; // Show updated section
        })
        .catch(error => console.error('Error fetching products:', error));
}

</script>

@endsection

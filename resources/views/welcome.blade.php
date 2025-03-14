<!--
    Developer: Aryan Kora
    university ID: 230059030
    function: Landing page Frontend
-->

<html lang="en">

<head>
  <script defer src="/js/addToCart.js"></script>
  <script defer src="js/ProductSlider.js"></script>
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet?
          Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime
          delectus eveniet iusto tenetur.
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
                      <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front" class="f-product-thumb">
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
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sint nostrum harum laudantium laborum,
        voluptatem repudiandae. Architecto incidunt quis facere. Voluptatibus, quod illo! Provident suscipit
        labore animi aspernatur quisquam tempora ipsam deleniti dolor doloremque, magni adipisci voluptatem
        ullam vel. Provident, sed. Harum, veniam iure! Quasi rerum itaque quis modi enim fugiat ex? Atque
        dolorum delectus omnis incidunt quia! Perferendis architecto consectetur sint pariatur repellendus,
        deleniti inventore fugit, similique veritatis laborum voluptatibus! Placeat totam, aliquid adipisci
        fugit veniam quas fugiat tempora rem quidem nam laudantium blanditiis cupiditate debitis qui
        voluptate expedita. Nam recusandae velit vero architecto sunt, ab sapiente ullam possimus.
        <br><br>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil tempora perspiciatis minus dicta
        numquam blanditiis qui earum, rem excepturi veniam eum quibusdam, eos quidem ipsa accusantium
        aliquid ipsam, fugit quas! Tenetur fugiat itaque, eveniet eligendi atque harum eos repellendus
        tempora laborum corporis natus sit pariatur excepturi ab sed possimus eius non similique ut quae
        veniam? Corrupti mollitia nesciunt nostrum voluptatem, quia aliquid hic illum expedita excepturi
        similique voluptates, beatae sed? Laudantium quam, praesentium molestias itaque reiciendis hic
        commodi accusantium, aperiam dolorem quibusdam ipsa suscipit cupiditate soluta deleniti fugiat modi.
        Odio similique animi doloremque nihil adipisci, rem quidem. Doloremque, dignissimos blanditiis?
        <br><br>
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

@endsection
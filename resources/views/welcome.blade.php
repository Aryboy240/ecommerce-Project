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

<!-- Find My Fit Feature Start -->
<div class="overlay" onclick="closeModal()"></div> <!-- Overlay to cover the entire screen when modal is active -->

<button class="find-my-fit-btn" onclick="resetAndShowModal()">Find My Fit</button>

<!-- Initial Popup -->
<div id="initialPopup" class="initial-popup">
  <span class="close-modal" onclick="closeInitialPopup()">&times;</span>
  <h2>Find glasses based on your face shape</h2>
  <button class="continue-btn" onclick="showModal()">Continue</button>
</div>

<!-- Modal for Selecting Face Shape -->
<div id="findMyFitModal" class="modal">
  <span class="close-modal" onclick="closeModal()">&times;</span>
  <h2>Select Your Face Shape</h2>
  <div class="face-options">
    <div class="face-item">
      <img src="{{ asset('images/round.png') }}" alt="Round" onclick="showRecommendations('Round')">
      <div class="face-label">Round</div>
    </div>
    <div class="face-item">
      <img src="{{ asset('images/square.png') }}" alt="Square" onclick="showRecommendations('Square')">
      <div class="face-label">Square</div>
    </div>
    <div class="face-item">
      <img src="{{ asset('images/oval.png') }}" alt="Oval" onclick="showRecommendations('Oval')">
      <div class="face-label">Oval</div>
    </div>
    <div class="face-item">
      <img src="{{ asset('images/heart.png') }}" alt="Heart" onclick="showRecommendations('Heart')">
      <div class="face-label">Heart</div>
    </div>
    <div class="face-item">
      <img src="{{ asset('images/diamond.png') }}" alt="Diamond" onclick="showRecommendations('Diamond')">
      <div class="face-label">Diamond</div>
    </div>
    <div class="face-item">
      <img src="{{ asset('images/triangle.png') }}" alt="Triangular" onclick="showRecommendations('Triangular')">
      <div class="face-label">Triangular</div>
    </div>
  </div>
</div>

<!-- Recommendations Section -->
<div id="recommendations" style="display: none;">
  <h2>Recommended Glasses</h2>
  <div id="glasses-options" class="glasses-options"></div>
</div>
<!-- Find My Fit Feature End -->


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

<script>
const basePath = "{{ asset('images') }}/"; // Define the base path for images

function resetAndShowModal() {
    closeModal();
    closeInitialPopup();
    document.getElementById('initialPopup').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block'; // Show overlay
}

function showModal() {
    document.getElementById('initialPopup').style.display = 'none';
    document.getElementById('findMyFitModal').style.display = 'block';
    document.querySelector('.overlay').style.display = 'block'; // Show overlay
}

function closeModal() {
    document.getElementById('findMyFitModal').style.display = 'none';
    document.getElementById('initialPopup').style.display = 'none';
    document.getElementById('recommendations').style.display = 'none';
    document.querySelector('.overlay').style.display = 'none'; // Hide overlay
}

function closeInitialPopup() {
    document.getElementById('initialPopup').style.display = 'none';
    document.querySelector('.overlay').style.display = 'none'; // Hide overlay
}
function showRecommendations(shape) {
    document.getElementById('findMyFitModal').style.display = 'none';
    document.getElementById('recommendations').style.display = 'block';

    const glassesData = {
      "Round":[
        { id: "32859935", image: "Adidas/32859935/32859935-front-2000x1125.jpg", name: "Adidas: Product 32859935", price: "100.00" },
        { id: "32859928", image: "Adidas/32859928/32859928-front-2000x1125.jpg", name: "Adidas: Product 32859928", price: "100.00" },
        { id: "33039947", image: "DKNY/33039947/33039947-front-2000x1125.jpg", name: "DKNY: Product 33039947", price: "100.00" }
      ],
      "Square":[
        { id: "33137490", image: "Barbour/33137490/33137490-front-2000x1125.jpg", name: "Barbour: Product 33137490", price: "100.00" },
        { id: "33135175", image: "Karen Millen/33135175/33135175-front-2000x1125.jpg", name: "Karen Millen: Product 33135175", price: "100.00" },
        { id: "33155449", image: "Harry Potter/33155449/33155449-front-2000x1125.jpg", name: "Harry Potter: Product 33155449", price: "100.00" },
        ],
      "Oval":[
        { id: "33087542", image: "Disney/33087542/33087542-front-2000x1125.jpg", name: "Disney: Product 33087542", price: "100.00" },
        { id: "32860634", image: "Jeff Banks/32860634/32860634-front-2000x1125.jpg", name: "Jeff Banks: Product 32860634", price: "100.00" },
        { id: "33137346", image: "HUGO/33137346/33137346-front-2000x1125.jpg", name: "HUGO: Product 33137346", price: "100.00" },
      ],
      "Heart":[
        { id: "33039633", image: "Karen Millen/33039633/33039633-front-2000x1125.jpg", name: "Karen Millen: Product 33039633", price: "100.00" },
        { id: "33145006", image: "Comfit/33145006/33145006-front-2000x1125.jpg", name: "Comfit: Product 33145006", price: "100.00" },
        { id: "33137353", image: "HUGO/33137353/33137353-front-2000x1125.jpg", name: "HUGO: Product 33137353", price: "100.00" },   
      ],
      "Diamond":[
      { id: "33039640", image: "Karen Millen/33039640/33039640-front-2000x1125.jpg", name: "Karen Millen: Product 33039640", price: "100.00" },
      { id: "33040011", image: "DKNY/33040011/33040011-front-2000x1125.jpg", name: "DKNY: Product 33040011", price: "100.00" },
      { id: "33145013", image: "Comfit/33145013/33145013-front-2000x1125.jpg", name: "Comfit: Product 33145013", price: "100.00" },
      ],
      "Triangular":[
      { id: "32677959", image: "DKNY/32677959/32677959-front-2000x1125.jpg", name: "DKNY: Product 32677959", price: "100.00" },
      { id: "32859942", image: "Adidas/32859942/32859942-front-2000x1125.jpg", name: "Adidas: Product 32859942", price: "100.00" },
      { id: "32908640", image: "Harry Potter/32908640/32908640-front-2000x1125.jpg", name: "Harry Potter: Product 32908640", price: "100.00" },
          
      ],
    };

    const glassesContainer = document.getElementById('glasses-options');
    glassesContainer.innerHTML = ''; // Clear previous entries

    if (glassesData[shape]){
      glassesData[shape].forEach(product =>{
        glassesContainer.innerHTML += `
                <div class="glasses-card">
                    <img src="{{ asset('Images/products/Featured/') }}/${product.image}" alt="${product.name}">
                    <h3>${product.name}</h3>
                    <p>£${product.price}</p>
                    <button>Add to Cart</button>
                </div>`;
      });
    }

    // // Ensure only three recommendations are displayed
    // glassesData[shape].slice(0, 3).forEach(img => {
    //     glassesContainer.innerHTML += `
    //         <div class="glasses-card">
    //             <img src="${basePath + img}" alt="Recommended Glasses">
    //             <p>Glasses Model ${img}</p>
    //             <button>Add to Cart</button>
    //         </div>`;
    // });
}
// Prevent clicks inside the modal from closing it
document.getElementById('findMyFitModal').addEventListener('click', function(event) {
    event.stopPropagation();
});

document.getElementById('initialPopup').addEventListener('click', function(event) {
    event.stopPropagation();
});

document.getElementById('recommendations').addEventListener('click', function(event) {
    event.stopPropagation();
});

// Close modal when clicking on the overlay
document.querySelector('.overlay').addEventListener('click', function(event) {
    if (event.target === this) {
        closeModal();
    }
});
</script>

@endsection

<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <!-- JS -->
   <script defer src="js/scrollReveal.js"></script>
   <script src="js/scrollreveal.min.js"></script>
   <!-- CSS -->
   <link rel="stylesheet" href="{{ asset('css/main.css') }}">
   <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}"> 
   <link rel="stylesheet" href="{{ asset('css/product_Card.css') }}">
   <title>Optique</title>
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
              <a href="{{ url('/search') }}">
               <img src="{{asset( 'Images/svg/magnifying-glass-solid.svg') }}">
            </div>
           </div>
           <div class="cart-icon">
           <a href="{{ route('cart.view') }}">
           <img src="{{ asset('Images/svg/cart-shopping-solid.svg') }}" alt="Cart Icon">
             <div class="cart-item-number">
               <p>1</p>
              </div>
            </div>
         </div>
       </nav>
     </div>
   </header>

  <!-- Intro Title (Frame your world) -->
<section class="hero">
  <div class="hero-content">
    <div>
      <h1 style="color: white; text-shadow: 0px 10px 10px rgba(0, 0, 0, 1);">FRAME YOUR WORLD<br>define your style</h1>
      <img class="world" src="{{ asset('Images/gifs/globe.gif') }}">
      <p style="color: white;">
        This is a premium collection designed for thise who want to<br>
        eleveate their eye-wear style and enchance their vision<br><br>
        <em>A digital solution for Opticians</em>
      </p>
      <a href="" class="btn-order">Order</a>
      <div class="pointer-wrapper">
        <img src="{{ asset('Images/arrow.png') }}">
        <p>Order from<br> here</p>
      </div>
    </div>
  </div>
</section>

   <!-- Floating Cards Section -->
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

   <!-- Featured Products Section -->
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
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
                @csrf
                <input type="hidden" name="return_to" value="{{ url()->current() }}">
                <input type="hidden" name="product_id" value="1">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
            </form>
         </div>
         <img class="imageSize-1" src="{{ asset('Images/brands/adidas_Logo.png') }}"/>
       </div>

       <!--HUGO-->
       <div class="product-card">
         <div class="card-circle"></div>
         <div class="product-card-content">
           <h2>HUGO</h2>
           <p>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="2">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-2" src="{{ asset('Images/brands/hugo.png') }}"/>
       </div>

       <!--DKNY-->
       <div class="product-card">
         <div class="card-circle"></div>
         <div class="product-card-content">
           <h2>DKNY</h2>
           <p>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="3">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-3" src="{{ asset('Images/brands/dnky.png') }}"/>
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
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="4">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-4" src="{{ asset('Images/brands/disney.png') }}"/>
       </div>

       <!--Karen Millen-->
       <div class="product-card">
         <div class="card-circle-2"></div>
         <div class="product-card-content">
           <h2>Karen Millen</h2>
           <p>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="5">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-5" src="{{ asset('Images/brands/karen_Millen.png') }}"/>
       </div>

       <!--Jeff Banks-->
       <div class="product-card">
         <div class="card-circle-2"></div>
         <div class="product-card-content">
           <h2>Jeff Banks</h2>
           <p>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="6">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-6" src="{{ asset('Images/brands/jeff_Banks.png') }}"/>
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
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="7">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-7" src="{{ asset('Images/brands/harry_Potter.png') }}"/>
       </div>

       <!--Barbour-->
       <div class="product-card">
         <div class="card-circle-3"></div>
         <div class="product-card-content">
           <h2>Barbour</h2>
           <p>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="8">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-8" src="{{ asset('Images/brands/barbour.png') }}"/>
       </div>

       <!--Comfit-->
       <div class="product-card">
         <div class="card-circle-3"></div>
         <div class="product-card-content">
           <h2>Comfit</h2>
           <p>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt voluptatum itaque nemo amet? Neque voluptatibus ad pariatur modi esse impedit id, laborum, molestias quam dolor maxime delectus eveniet iusto tenetur.
           </p>
           <a href="#">Starting from £100</a>
           <form action="{{ route('cart.add') }}" method="POST" style="margin-top: 10px;">
               @csrf
               <input type="hidden" name="customer_id" value="1">
               <input type="hidden" name="product_id" value="9">
               <input type="hidden" name="quantity" value="1">
               <button type="submit" style="width: 100%; padding: 15px; background: rgba(0, 191, 174, 0.1); border: none; border-radius: 25px; cursor: pointer;">Add to Cart</button>
           </form>
         </div>
         <img class="imageSize-9" src="{{ asset('Images/brands/comfit.png') }}"/>
       </div>
     </section>
   </section>

   <!-- Categories Section -->
   <section class="container">
     <div class="container">
       <h2 class="section-title">View our range of categories</h2>
       <div class="category-grid">
         <div class="category">
           <a href="">
             <img
               src="{{ asset('Images/filler.webp') }}"
               class="category-img"
               alt="Glasses"
             />
             <h5 class="category-title">Glasses</h5>
           </a>
         </div>
         <div class="category">
           <a href="">
             <img
               src="{{ asset('Images/filler.webp') }}"
               class="category-img"
               alt="Sunglasses"
             />
             <h5 class="category-title">Sunglasses</h5>
           </a>
         </div>
         <div class="category">
           <a href="">
             <img
               src="{{ asset('Images/filler.webp') }}"
               class="category-img"
               alt="Contact Lenses"
             />
             <h5 class="category-title">Contact Lenses</h5>
           </a>
         </div>
         <div class="category">
           <a href="">
             <img src="{{ asset('Images/filler.webp') }}" class="category-img" alt="Frames" />
             <h5 class="category-title">Frames</h5>
           </a>
         </div>
         <div class="category">
           <a href="">
             <img
               src="{{ asset('Images/filler.webp') }}"
               class="category-img"
               alt="Glasses Accessories"
             />
             <h5 class="category-title">Glasses Accessories</h5>
           </a>
         </div>
       </div>
     </div>
   </section>
 </body>
</html>
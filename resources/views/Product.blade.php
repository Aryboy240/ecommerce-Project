<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Add meta description for SEO -->
        <meta name="description" content="Shop Optique's collection of glasses, sunglasses, and contact lenses">
        <!-- JS -->
        <script defer src="js/scrollReveal.js"></script>
        <script defer src="{{ asset('js/product_page.js') }}"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
        <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
        <title>Optique</title>
    </head>
    <body>
        <!-- Navigation Bar -->
        <header class="header">
            <div>
                <nav class="navbar">
                    <div class="navbar-links">
                        <img class="logo" src="{{ asset('Images/nav_Logo.png') }}" alt="logo">
                        <ul>
                            <li><a class="nav-link" href="{{ route('welcome') }}">Home</a></li>
                            <li><a class="nav-link" href="">About</a></li>
                            <li><a class="nav-link" href="{{ route('product') }}">Product</a></li>
                            <li><a class="nav-link" href="">Contact</a></li>
                            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        </ul>
                        <div class="search-bar">
                            <input type="text" placeholder="Search An Item" />
                            <div class="search-icon">
                                <img src="{{ asset('Images/svg/magnifying-glass-solid.svg') }}" alt="Search Icon">
                            </div>
                        </div>
                        <div class="cart-icon">
                            <img src="{{ asset('Images/svg/cart-shopping-solid.svg') }}" alt="Cart Icon">
                            <div class="cart-item-number">
                                <p>1</p>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Sidebar -->
            <aside>
                <section class="categories">
                    <h2>Categories</h2>
                    <ul>
                        <li><a href="">Lenses for Glasses</a></li>
                        <li><a href="">Frames for Glasses</a></li>
                        <li><a href="">Contact Lenses</a></li>
                        <li><a href="">Miscellaneous</a></li>
                        <li><a href="">Sunglasses</a></li>
                    </ul>
                </section>
                <section class="price-range">
                    <h2 id="price-range-heading">Price Range</h2>
                    <label for="price-slider" class="visually-hidden">Select price range</label>
                    <input type="range" id="price-slider" min="0" max="1000" value="500" class="price-range-slider" aria-labelledby="price-range-heading">
                </section>    
            </aside>
            
            <!-- Product Section -->
            <section class="products">
                <h1>Our Collection of Products</h1>
                <div class="product-grid">
                    <div class="product-card">
                        <img src="{{ asset('Images/products/glasses1.jpeg') }}" alt="Product 1">
                        <h3>Product 1</h3>
                        <p>Price: $19.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun1.jpeg') }}" alt="Product 2">
                        <h3>Product 2</h3>
                        <p>Price: $29.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/case1.jpeg') }}" alt="Product 7">
                        <h3>Product 7</h3>
                        <p>Price: $59.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/glasses2.png') }}" alt="Product 3">
                        <h3>Product 3</h3>
                        <p>Price: $39.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun2.jpeg') }}" alt="Product 4">
                        <h3>Product 4</h3>
                        <p>Price: $49.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/case2.png') }}" alt="Product 8">
                        <h3>Product 8</h3>
                        <p>Price: $69.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div> 
                    <div class="product-card">
                        <img src="{{ asset('Images/products/glasses3.png') }}" alt="Product 5">
                        <h3>Product 5</h3>
                        <p>Price: $49.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun3.png') }}" alt="Product 6">
                        <h3>Product 6</h3>
                        <p>Price: $49.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/case3.jpeg') }}" alt="Product 9">
                        <h3>Product 9</h3>
                        <p>Price: $79.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun5.png') }}" alt="Product 10">
                        <h3>Product 10</h3>
                        <p>Price: $89.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/glasses6.png') }}" alt="Product 11">
                        <h3>Product 11</h3>
                        <p>Price: $99.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun6.png') }}" alt="Product 12">
                        <h3>Product 12</h3>
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
        </main>

        <!-- Footer Section -->
        <footer class="footer">
            <div>
                <h3>Customer Support</h3>
                <p>
                    <img src="{{ asset('Images/svg/phone-line-svgrepo-com.svg') }}" alt="Phone Icon">
                    1 (800) 555-OPTQ
                </p>
                <p>
                    <img src="{{ asset('Images/svg/email-svgrepo-com.svg') }}" alt="Email Icon"> 
                    <a href="mailto:support@optique.com">support@optique.com</a>
                </p>
                <p>Live Chat Available</p>
            </div>
            <div>
                <h3>Shop</h3>
                <a href="#">Glasses</a>
                <a href="#">Sunglasses</a>
                <a href="#">Accessories</a>
                <a href="#">Contact Lenses</a>
            </div>
            <div>
                <h3>About Optique</h3>
                <a href="#">Our Story</a>
                <a href="#">Testimonials</a>
                <a href="#">Careers</a>
                <a href="#">Store Locator</a>
            </div>
            <div class="social-icons">
                <h3>Follow Us</h3>
                <a href="#"><img src="{{ asset('Images/svg/facebook-svgrepo-com.svg') }}" alt="email Icon" /> </a>
                <a href="#"><img src="{{ asset('Images/svg/instagram-svgrepo-com.svg') }}" alt="email Icon" /> </a>
                <a href="#"><img src="{{ asset('Images/svg/twitter-svgrepo-com.svg') }}" alt="email Icon" /> </a>
                <a href="#"><img src="{{ asset('Images/svg/pinterest-180-svgrepo-com.svg') }}" alt="email Icon" /> </a>
            </div>
            <div class="powered-by">
                <p>© Optique. Crafted for Visionaries.</p>
            </div>
        </footer>
    </body>
</html>
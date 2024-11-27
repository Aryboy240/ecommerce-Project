<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Add meta description for SEO -->
        <meta name="description" content="Shop Optique's collection of glasses, sunglasses, and contact lenses">
        <!-- JS -->
        <script defer src="js/scrollReveal.js"></script>
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
                        <li><a href="">Glasses</a></li>
                        <li><a href="">Sunglasses</a></li>
                        <li><a href="">Contact Lenses</a></li>
                        <li><a href="">Frames</a></li>
                    </ul>
                </section>
                <section class="price-range">
                    <h2>Price Range</h2>
                    <input type="range" min="0" max="1000" value="500" class="price-range-slider">
                    <div class="price-range-values">
                        <span class="min-price">£0</span>                   
                        <span class="max-price">£1000</span>
                    </div>
                </section>    
            </aside>
            
            <!-- Product Section -->
            <section class="products">
                <h1>Our Collection of Products</h1>
                <input type="text" placeholder="Search Products" class="search-input">
                <div class="product-grid">
                    <div class="product-card">
                        <img src="{{ asset('Images/filler.webp') }}" alt="Product 1">
                        <h3>Product 1</h3>
                        <p>Price: $19.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/filler.webp') }}" alt="Product 2">
                        <h3>Product 2</h3>
                        <p>Price: $29.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/filler.webp') }}" alt="Product 3">
                        <h3>Product 3</h3>
                        <p>Price: $39.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/filler.webp') }}" alt="Product 4">
                        <h3>Product 4</h3>
                        <p>Price: $49.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div> 
                    <div class="product-card">
                        <img src="{{ asset('Images/filler.webp') }}" alt="Product 4">
                        <h3>Product 5</h3>
                        <p>Price: $49.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/filler.webp') }}" alt="Product 4">
                        <h3>Product 6</h3>
                        <p>Price: $49.99</p>
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
                <a href="#">🔵 Facebook</a>
                <a href="#">📸 Instagram</a>
                <a href="#">🐦 Twitter</a>
                <a href="#">📌 Pinterest</a>
            </div>
            <div class="powered-by">
                <p>© Optique. Crafted for Visionaries.</p>
            </div>
        </footer>
    </body>
</html>
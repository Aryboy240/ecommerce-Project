/* Oyinlola Arowolo
id= 230402373*/
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
        <title>Optique - Products</title>
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
                            <li><a class="nav-link" href="{{ route('product') }}">Shop</a></li>
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
                        <li><a href="">Contact Lenses</a></li>
                        <li><a href="">Miscellaneous</a></li>
                        <li><a href="">Sunglasses</a></li>
                    </ul>
                </section>
                <section class="price-range">
                    <h2>Price Range</h2>
                    <div class="price-inputs">
                        <div class="price-wrapper">
                            <span class="min-price">£0</span>
                            <input type="range" 
                                   class="price-range-slider" 
                                   min="0" 
                                   max="1000" 
                                   value="500"
                                   step="10">
                            <span class="max-price">£500</span>
                        </div>
                    </div>
                </section>

                <section class="active-filters">
                    <!-- Active filters will be displayed here -->
                </section>
            </aside>
            
            <!-- Product Section -->
            <section class="products">
                <h1>Our Collection</h1>
                <div class="product-grid">
                    <div class="product-card">
                        <a href="{{ route('sproduct') }}">
                            <img src="{{ asset('Images/products/glasses1.jpeg') }}" alt="Classic Round Glasses">
                            <h3>Square Frame Glasses</h3>
                            <p>Price: $199.99</p>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </a>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun1.jpeg') }}" alt="Aviator Sunglasses">
                        <h3>Aviator Sunglasses</h3>
                        <p>Price: $159.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/case1.jpeg') }}" alt="Premium Leather Case">
                        <h3>Hard Shell Case</h3>
                        <p>Price: $39.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/glasses2.png') }}" alt="Square Frame Glasses">
                        <h3>Classic Round Glasses</h3>
                        <p>Price: $179.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun2.jpeg') }}" alt="Cat Eye Sunglasses">
                        <h3>Square Sunglasses</h3>
                        <p>Price: $149.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/case2.png') }}" alt="Hard Shell Case">
                        <h3>Premium Leather Case</h3>
                        <p>Price: $29.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/glasses3.png') }}" alt="Oval Frame Glasses">
                        <h3>Oval Frame Glasses</h3>
                        <p>Price: $189.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/sun3.png') }}" alt="Sport Sunglasses">
                        <h3>Sport Sunglasses</h3>
                        <p>Price: $169.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/case3.jpeg') }}" alt="Travel Case">
                        <h3>Travel Case</h3>
                        <p>Price: $59.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/glasses cleaner.jpg') }}" alt="Product 10">
                        <h3>Glasses Cleaner</h3>
                        <p>Price: $29.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/contacts cleaner.jpg') }}" alt="Product 11">
                        <h3>Contacts Cleaner</h3>
                        <p>Price: $19.99</p>
                        <button class="add-to-cart-btn">Add to Cart</button>
                    </div>
                    <div class="product-card">
                        <img src="{{ asset('Images/products/case4.jpg') }}" alt="Travel Case">
                        <h3>Travel Case</h3>
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
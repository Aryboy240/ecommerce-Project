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
                            <li><a class="nav-link" href="{{ route('product') }}">product</a></li>
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
            <section class="prodetails">
                <div class="single-pro-image">
                    <img src="{{ asset('Images/products/glasses1.jpeg') }}" width="100%" id="MainImg" alt="Product 1">
                    
                    <div class="small-img-group">
                        <div class="small-img-col">
                            <img src="{{ asset('Images/products/glasses1.jpeg') }}" width="100%" class="small-img" alt="Product 1 View 1">
                        </div>
                        <div class="small-img-col">
                            <img src="{{ asset('Images/products/glasses2.png') }}" width="100%" class="small-img" alt="Product 1 View 2">
                        </div>
                        <div class="small-img-col">
                            <img src="{{ asset('Images/products/glasses3.png') }}" width="100%" class="small-img" alt="Product 1 View 3">
                        </div>
                    </div>
                </div>

                <div class="single-pro-details">
                    <h6>Home / Shop</h6>
                    <h4>Square Frame Glasses</h4>
                    <h2>$199.99</h2>
                    
                    <select>
                        <option>Select Frame Size</option>
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                    </select>
                    
                    <div class="quantity">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" value="1" min="1">
                    </div>
                    
                    <button class="add-to-cart">Add to Cart</button>
                    
                    <h4>Product Details</h4>
                    <p>Experience timeless elegance with our Classic Round Frame Glasses. 
                       Crafted from premium materials, these versatile frames offer both 
                       style and comfort. Features include anti-reflective coating, 
                       scratch-resistant lenses, and adjustable nose pads for the perfect fit.</p>
                    
                    <div class="product-features">
                        <h4>Features</h4>
                        <ul>
                            <li>Premium acetate frame</li>
                            <li>Anti-reflective coating</li>
                            <li>Scratch-resistant lenses</li>
                            <li>Adjustable nose pads</li>
                            <li>UV protection</li>
                        </ul>
                    </div>
                </div>
            </section>

            <!-- Related Products Section -->
            <section class="related-products">
                <div class="product-pairs">
                    <h2>Complete Your Look</h2>
                    
                    <!-- Paired Products -->
                    <div class="product-container">
                        <div class="product-card">
                            <img src="{{ asset('Images/products/case1.jpeg') }}" alt="Matching Case">
                            <h3>Matching Case</h3>
                            <p>Price: $39.99</p>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                        <div class="product-card">
                            <img src="{{ asset('Images/products/glasses cleaner.jpg') }}" alt="Product 10">
                            <h3>Glasses Cleaner</h3>
                            <p>Price: $29.99</p>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
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
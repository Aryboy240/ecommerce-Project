<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- CSS -->>
      <link rel="stylesheet" href="contect.css">
      <link rel="stylesheet" href="aryansExtras.css">
      <link rel="stylesheet" href="main.css">
      <title>Contact Us | Optique</title>
    </head>
  <body>

        <!-- Navigation Bar -->
        <header class="header">
            <div>
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
                            <input type="text"placeholder="Search An Item" />
                            <div class="search-icon">
                                <img src="{{asset( 'Images/svg/magnifying-glass-solid.svg') }}">
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

    <!-- CONTECT-->>
    <section class="contact-section">
      <div class="contact-us">
        <h1>Contact Us</h1>
        <p>We’d love to hear from you! Please reach out with any questions or feedback.</p>
      </div>
      
    
    
      <!-- Contact Details -->
      <div class="contact-container">
        <div class="map-location">
        <a href="https://maps.app.goo.gl/AEP5HRkij4LH9n2c9">
          <img src="location.jpg"  width="100%" height="100%" >
        </a>
        </div>

        <div class="contact-detail">
          <h2>Where we are</h2>
          <p>84 Bibb St, Birmingham, B9 8QQ</p>
          <p><strong>office hour</strong> 10AM - 6PM</p>
          <br>
          <h2>Meeting us</h2>
          <p><strong>Phone</strong> +440246813579</p>
          <p><strong>Email</strong> support@optique.com</p>
        </div>

        <div class="contact-form">
          <h2>Get in touch</h2>
          <form action="/submit-question" method="POST">
              
                <p>Name</p>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
              
              
                <p>Email</p>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
              
              
                <p>order number(if apply)</p>
                <input type="number"  id="order" name="order" placeholder="Your order number" >
              
                
                <p>select your situational</p>
                <select id="situational" name="situational" >
                  <option value="Product-damage">Product damage</option>
                  <option value="Returns-and-refunds">Returns and refunds</option>
                  <option value="Suggestion">Suggestion</option>
                  <option value="Other">Other</option>
                </select>
                
                <p>Message</p>
                <textarea id="message" name="message" rows="5" placeholder=" Please enter your message" required></textarea>
              
            <button type="submit">Submit</button>
          </form>
        </div>

      </div>

    </section>

    <section class="socials-mediar">
      <ul class="login-socials">
        <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="Images/socials/instagram.png"/></a></li>
        <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="Images/socials/youtube.png"/></a></li>
        <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"><img src="Images/socials/twitter.png"/></a></li>
      </ul>
    </section>

  </body>
</html>

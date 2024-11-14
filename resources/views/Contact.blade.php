<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <!--Meta-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS -->>
        <link rel="stylesheet" href="thecss.css">
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
    
      <img src="Cat.jpg" width="100%" height="400">


    <h1>Contact Us</h1>
    <p>We love to hear from you! Please reach out with any questions or feedback.</p>

    <!-- Contact Details -->
    <div class="contact-container">
      <img src="location.jpg" style="float:left;width:500px;height:500px;">
      <!-- Contact Details -->
      <div class="contact-info">
        <h2>Meet us</h2>
        <p><strong>Address:</strong> 84 Bibb St, Birmingham, B9 8QQ</p>
        <p><img src="pngimg.com - phone_PNG48919.png"style="float:right;width:15px;height:15px;">+440246813579</p>
        <p><strong>Email:</strong> support@optique.com</p>
        


        <ul class="login-socials">
          <li>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              ><img src="Images/socials/instagram.png"
            /></a>
          </li>
          <li>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              ><img src="Images/socials/youtube.png"
            /></a>
          </li>
          <li>
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ"
              ><img src="Images/socials/twitter.png"
            /></a>
          </li>
        </ul>
      </div>

    </div>
  </section>

</body>
</html>

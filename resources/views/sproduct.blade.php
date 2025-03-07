<!--
    Developer: Oyinlola Arowolo
	University ID: 230402373
    Function: Front end for the Products page

    Developer: Aryan Kora
    university ID: 230059030
    function: Remastering and Reviews
-->

<html lang="en">

<head>
    <!-- Add meta description for SEO -->
    <meta name="description" content="Shop Optique's collection of glasses, sunglasses, and contact lenses">
    <!-- JS -->
    <script defer src="{{ asset('js/product_page.js') }}"></script>
    <script defer src="{{ asset('js/addToCart.js') }}"></script>
    <script src="{{ asset('js/scrollBar.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feedback.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>

</html>


@extends('layouts.mainLayout')

@section('title', 'Product Information')

@section('content')

    <!-- Main Content:: Esta -->
    <section class="prodetails">
        <div class="single-pro-image">
            <img src="{{ asset($product->images->first()->image_path) }}" width="100%" id="MainImg"
                alt="{{ $product->name }}">

            <div class="small-img-group">
                @foreach ($product->images as $image)
                    @if (!empty($image->image_path) && file_exists(public_path($image->image_path)))
                        <div class="small-img-col">
                            <img src="{{ asset($image->image_path) }}" width="100%" class="small-img" alt="{{ $product->name }}">
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="single-pro-details">
            <h6>Home / {{ $product->category->name }}</h6>
            <h4>{{ $product->name }}</h4>
            <h2>£{{ $product->price }}</h2>

            <select>
                <option>Select Frame Size</option>
                <option>Small</option>
                <option>Medium</option>
                <option>Large</option>
            </select>

            <form class="add-to-cart-form" onsubmit="addToCart(event, {{ $product->id }})">
                @csrf
                <div class="quantity">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                </div>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="add-to-cart">Add to Cart</button>
            </form>

            <h4 id="prod-margin">Product Details</h4>
            <p>{{ $product->description }}</p>

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


    <!-- Feedback Comments:: Aryan Kora -->
    <section id="testimonials">
        <!--Heading--->
        <div class="testimonial-heading">
            <span>Comments</span>
            <h1>Customer Feedback</h1>
        </div>
        <!--Testimonials Box Container------>
        <div class="testimonial-box-container">
            <!--BOX 1-------------->
            <div class="testimonial-box">
                <!--Top------------------------->
                <div class="box-top">
                    <!--Profile----->
                    <div class="profile">
                        <!--Image---->
                        <div class="profile-img">
                            <img src={{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }} />
                        </div>
                        <!--Name And Username-->
                        <div class="name-user">
                            <strong>User1</strong>
                            <span>@DefaultUser</span>
                        </div>
                    </div>
                    <!--Reviews------>
                    <div class="reviews">
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <!--Star Ratings-->
                    </div>
                </div>
                <!--Comments---------------------------------------->
                <div class="client-comment">
                    <p>
                        These are some pretty amazing glasses. They're lightweight, durable and really comfortable to
                        wear!
                    </p>
                </div>
            </div>
            </a>
            <!--BOX 2-------------->
            <div class="testimonial-box">
                <!--Top------------------------->
                <div class="box-top">
                    <!--Profile----->
                    <div class="profile">
                        <!--Image---->
                        <div class="profile-img">
                            <img src={{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }} />
                        </div>
                        <!--Name And Username-->
                        <div class="name-user">
                            <strong>User1</strong>
                            <span>DefaultUser</span>
                        </div>
                    </div>
                    <!--Reviews------>
                    <div class="reviews">
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star"></b>
                        <b class="fas fa-star"></b>
                        <b class="fas fa-star"></b>
                        <!--Star Ratings-->
                    </div>
                </div>
                <!--Comments---------------------------------------->
                <div class="client-comment">
                    <p>
                        The glasses straight up just fell apart, tripped me over into a ditch and now I've been stuck here
                        for the past 17 years.
                    </p>
                </div>
            </div>
            <!--BOX 3-------------->
            <div class="testimonial-box">
                <!--Top------------------------->
                <div class="box-top">
                    <!--Profile----->
                    <div class="profile">
                        <!--Image---->
                        <div class="profile-img">
                            <img src={{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }} />
                        </div>
                        <!--Name And Username-->
                        <div class="name-user">
                            <strong>User1</strong>
                            <span>DefaultUser</span>
                        </div>
                    </div>
                    <!--Reviews------>
                    <div class="reviews">
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star"></b>
                        <!--Star Ratings-->
                    </div>
                </div>
                <!--Comments---------------------------------------->
                <div class="client-comment">
                    <p>
                        These glasses just saved my life! Here I was, minding my own business when a bug flies into my
                        lense. I take them off to clean them and I saw a guy's glasses fall apart and trip them over into a
                        ditch. I would have fallen in instead if I didn't stop to clean my glasses!
                    </p>
                </div>
            </div>
            <!--BOX 4-------------->
            <div class="testimonial-box">
                <!--Top------------------------->
                <div class="box-top">
                    <!--Profile----->
                    <div class="profile">
                        <!--Image---->
                        <div class="profile-img">
                            <img src={{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }} />
                        </div>
                        <!--Name And Username-->
                        <div class="name-user">
                            <strong>User1</strong>
                            <span>DefaultUser</span>
                        </div>
                    </div>
                    <!--Reviews------>
                    <div class="reviews">
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star"></b>
                        <b class="fas fa-star"></b>
                        <!--Star Ratings-->
                    </div>
                </div>
                <!--Comments---------------------------------------->
                <div class="client-comment">
                    <p>
                        I wanted to see how durable my glasses were, so I threw a small rock at someone who was wearing the
                        same pair. They broke on impact and tripped the poor lad into a ditch. What poor quality glasses.
                    </p>
                </div>
            </div>
            <!--BOX 5-------------->
            <div class="testimonial-box">
                <!--Top------------------------->
                <div class="box-top">
                    <!--Profile----->
                    <div class="profile">
                        <!--Image---->
                        <div class="profile-img">
                            <img src={{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }} />
                        </div>
                        <!--Name And Username-->
                        <div class="name-user">
                            <strong>User1</strong>
                            <span>DefaultUser</span>
                        </div>
                    </div>
                    <!--Reviews------>
                    <div class="reviews">
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <b class="fas fa-star">⭐</b>
                        <!--Star Ratings-->
                    </div>
                </div>
                <!--Comments---------------------------------------->
                <div class="client-comment">
                    <p>
                        I dropped these glasses into a nuclear reactor by accident ater it started melting down. To my
                        suprise, it was a superb control rod and managed to stop the nuclear fission all together! Saved my
                        entire country from a nuclear meltdown!
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Feedback Comments End -->

    <div class="testimonial-heading">
        <span>Please review our products!</span>
    </div>

    <!-- Contact Form:: Aryan Kora -->
    <section id="formSection">
        <form class="formCon">
            <div class="contactInfo">
                <div>
                <h2>Contact Info</h2>
                <ul class="info">
                    <li>
                    <span><img src="{{ asset('Images/svg/location-svgrepo-com.svg') }}"></span>
                    <span>Aston St, Birmingham B4 7ET</span>
                    </li>
                    <li>
                    <span><img src="{{ asset('Images/svg/email-svgrepo-com.svg') }}"></span>
                    <span>support@optique.com</span>
                    </li>
                    <li>
                    <span><img src="{{ asset('Images/svg/phone-line-svgrepo-com.svg') }}"></span>
                    <span>1 (800) 555-OPTQ</span>
                    </li>
                </ul>
                </div>
                <ul class="sci">
                <li><a href="https://www.facebook.com" target="_blank"><img
                        src="{{ asset('Images/svg/facebook-svgrepo-com.svg') }}"></a></li>
                <li><a href="https://twitter.com" target="_blank"><img
                        src="{{ asset('Images/svg/twitter-svgrepo-com.svg') }}"></a></li>
                <li><a href="https://www.instagram.com" target="_blank"><img
                        src="{{ asset('Images/svg/instagram-svgrepo-com.svg') }}"></a></li>
                <li><a href="https://uk.pinterest.com/" target="_blank"><img
                        src="{{ asset('Images/svg/pinterest-180-svgrepo-com.svg') }}"></a></li>
                </ul>
            </div>
            <div class="contactForm">
                <h2>Send a Message</h2>
                <div class="formBox">
                <div class="inputBox w50">
                    <input type="text" id="fname" required>
                    <span>First Name</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" id="lname" required>
                    <span>Last Name</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" id="email" required>
                    <span>Email Address</span>
                </div>
                <div class="inputBox w50">
                    <input type="text" id="pNumber" required>
                    <span>Mobile Number</span>
                </div>
                <div class="inputBox w100">
                    <textarea id="desc" required></textarea>
                    <span>Write you message here...</span>
                </div>
                <div class="inputBox w100">
                    <input type="button" value="Send">
                </div>
                </div>
            </div>
        </form>
    </section>
    <!--Contact Form End-->
    
@endsection
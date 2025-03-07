<!--
    Developer: Oyinlola Arowolo
	  University ID: 230402373
    Function: Front end for the Products page
-->

<html lang="en">

<head>
    <!-- Add meta description for SEO -->
    <meta name="description" content="Shop Optique's collection of glasses, sunglasses, and contact lenses">
    <!-- JS -->
    <script defer src="{{ asset('js/product_page.js') }}"></script>
    <script defer src="{{ asset('js/addToCart.js') }}"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/feedback.css') }}">
</head>

</html>


<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Product Information')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
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

            <div class="quantity">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" value="1" min="1">
            </div>

            <form class="add-to-cart-form" onsubmit="addToCart(event, {{ $product->id }})">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
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


    <!-- Feedback Comments -->
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
                <a>
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

@endsection
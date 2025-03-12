<!--
    Developer: Oyinlola Arowolo
	University ID: 230402373
    Function: Front end for the Products page

    Developer: Aryan Kora
    university ID: 230059030
    function: Frontend reworks and Review system
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


@extends('layouts.mainLayout')

@section('title', 'Product Information')

@section('content')

    <!-- Main Content:: Esta && Aryan Kora -->
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
        <!-- Heading -->
        <div class="testimonial-heading">
            <span>Comments</span>
            <h1>Customer Feedback</h1>
        </div>

        <!-- Testimonials Box Container -->
        <div class="testimonial-box-container">
            @if($product->reviews->isEmpty())
                <div class="no-reviews">
                    <p>There are no reviews for this product yet. Be the first to review it!</p>
                </div>
            @else
                @foreach($product->reviews as $review)
                <!-- BOX -->
                <div class="testimonial-box">
                    <!-- Top -->
                    <div class="box-top">
                        <!-- Profile -->
                        <div class="profile">
                            <!-- Image -->
                            <div class="profile-img">
                                <img src="{{ asset('Images/Users/Profile_Pics/' . ($review->user->profile_pic ?? 'Default/default_pf.png')) }}" />
                            </div>
                            <!-- Name And Username -->
                            <div class="name-user">
                                <strong>{{ $review->user->name }}</strong>
                                <span>{{ $review->user->email }}</span>
                            </div>
                        </div>
                        <!-- Reviews -->
                        <div class="reviews">
                            @for ($i = 1; $i <= 5; $i++)
                                <b class="fas fa-star">{{ $i <= $review->rating ? '⭐' : '☆' }}</b>
                            @endfor
                        </div>
                    </div>
                    <!-- Comments -->
                    <div class="client-comment">
                        <p>{{ $review->comment }}</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </section>
    <!-- Feedback Comments End -->

    <div class="testimonial-heading">
        <span>Please review our products!</span>
    </div>


    <!-- Review Form:: Aryan Kora -->
    <section id="formSection">
        <form class="formCon" action="{{ route('review.store', $product->id) }}" method="POST" id="reviewForm">
            @csrf

            <!-- Current Product Information -->
            <div class="contactInfo">
                <div>
                    <h2>Product Info</h2>
                    <img src="{{ asset($product->images->first()->image_path) }}" width="100%" id="MainImg" alt="{{ $product->name }}">
                    <ul class="info">
                        <li>
                            <strong>Product Name:&nbsp;</strong> {{ $product->name }}
                        </li>
                        <li>
                            <strong>Category:&nbsp;</strong> {{ $product->category->name }}
                        </li>
                        <li>
                            <strong>Price:&nbsp;</strong> {{ '£' .$product->price }}
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Review Form -->
            <div class="contactForm">
                <h2 style="margin-bottom: 50px">Write your own review!</h2>
                
                <!-- Profile Section -->
                <div class="profile">
                    <div class="profile-img">
                        @auth
                            <img src="{{ asset('Images/Users/Profile_Pics/' . (Auth::user()->profile_pic ?? 'Default/default_pf.png')) }}" id="userProfilePic" />
                        @else
                            <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}" id="userProfilePic" />
                        @endauth
                    </div>
                    <div class="name-user">
                        @auth
                            <strong>{{ Auth::user()->name }}</strong>
                            <span>{{ Auth::user()->email }}</span>
                        @else
                            <strong>Guest</strong>
                            <span>@GuestUser</span>
                        @endauth
                    </div>
                </div>

                <!-- Rating Section -->
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" style="display:none" required>
                    <label for="star5" class="star" data-value="5">&#9733;</label>

                    <input type="radio" id="star4" name="rating" value="4" style="display:none">
                    <label for="star4" class="star" data-value="4">&#9733;</label>

                    <input type="radio" id="star3" name="rating" value="3" style="display:none">
                    <label for="star3" class="star" data-value="3">&#9733;</label>

                    <input type="radio" id="star2" name="rating" value="2" style="display:none">
                    <label for="star2" class="star" data-value="2">&#9733;</label>

                    <input type="radio" id="star1" name="rating" value="1" style="display:none">
                    <label for="star1" class="star" data-value="1">&#9733;</label>
                </div>



                <!-- Comment Section -->
                <div class="formBox">
                    <div class="inputBox w100">
                        <textarea name="comment" required></textarea>
                        <span>Write your message here...</span>
                    </div>
                    <div class="inputBox w100">
                        @auth
                            <!-- Show Submit Button for Logged-in Users -->
                            <input type="submit" value="Submit Review">
                        @else
                            <!-- Show Login Button for Guests -->
                            <input type="button" value="Login to Review" onclick="redirectToLogin()">
                        @endauth
                    </div>
                </div>
            </div>
        </form>
    </section>
    <!-- Review Form End -->


    <!-- Script for the review system:: Aryan Kora  -->
    <script>

        function redirectToLogin() {
            window.location.href = "{{ route('login') }}"; // Redirect to login page
        }

        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            let currentRating = 0;

            // Handle hover effect
            stars.forEach(star => {
                star.addEventListener('mouseover', function() {
                    const value = parseInt(star.getAttribute('data-value'));
                    updateStars(value);
                });

                star.addEventListener('mouseout', function() {
                    updateStars(currentRating); // Revert to the selected rating
                });

                star.addEventListener('click', function() {
                    currentRating = parseInt(star.getAttribute('data-value')); // Set the selected rating
                    updateStars(currentRating);
                    document.querySelector(`input[name="rating"][value="${currentRating}"]`).checked = true;
                });
            });

            // Update the stars based on the current rating
            function updateStars(rating) {
                stars.forEach(star => {
                    const value = parseInt(star.getAttribute('data-value'));
                    if (value <= rating) {
                        star.style.color = '#f39c12'; // Highlight selected stars
                    } else {
                        star.style.color = '#ccc'; // Default unselected stars
                    }
                });
            }
        });

        document.getElementById("reviewForm").addEventListener("submit", function(event) {
            const ratingChecked = document.querySelector('input[name="rating"]:checked');
            if (!ratingChecked) {
                event.preventDefault(); // Stop form submission
                alert("Please select a rating before submitting your review.");
            }
        });

    </script>

@endsection
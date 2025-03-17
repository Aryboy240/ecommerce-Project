<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

@section('extra-head')

  <!-- JS -->
  <script src="js/testimonials.js"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">

@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Testimonials')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

   <!--Testimonials : Man Kwok -->
  <section class="Testimonials-section">

    <!-- Big Title: Man Kwok-->
    <div id="our-Testimonials-info">
        <h1>Testimonials</h1>
    </div>
    <!-- Big Title End-->

    <!-- Testimonials Section -->
    <div id="our-Testimonials-section">
        <!-- Dynamic Testimonials will be here -->
    </div>

    <!-- Button to switch testimonials -->
    <button onclick="changeTestimonials()">Next</button>

    <div class="testimonial-form-container">
      <div id="testimonial-form">
        <h3>Add Your Testimonial</h3>
        <form id="addTestimonialForm">
            <input type="text" id="userName" placeholder="Your Name" required />
            <textarea id="userMessage" placeholder="Your Testimonial" required></textarea>
            <button type="submit">Submit</button>
        </form>
      </div>
    </div>
  </section>
  
@endsection
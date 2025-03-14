<!--
    Developer: Angus
	  University ID: 
    Function: Front end for the contacts page

    Developer: Aryan Kora
	  University ID: 230059030
    Function: Frontend improvements && contact form
-->

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

@section('extra-head')

  <link rel="stylesheet" href={{  asset('css/contact.css') }}>

@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Contact')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

<!-- CONTECT-->
<section class="container">
  <div class="contact-us">
    <h1>Contact Us</h1>
  </div>
</section>

<!-- Embedded Map:: Aryan Kora-->
<section>
  <div id="map" class="map-rev">
    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1GSi1kD5UQeAz0wKjJCJm6kttwARrlf4&ehbc=2E312F"
      allow="geolocation" width="95%" height="750px" frameborder="0" scrolling="no" allowfullscreen
      style="border: 1px solid var(--mint); box-shadow: 0 0 20px var(--mint); border-radius: 15px"></iframe>
  </div>
</section>
<!-- Embedded Map End -->

<!-- Page information-->
<div class="contact-page-text">
  <div class="contact-text-box">
    <p>
      At Optique, we value your feedback and inquiries. Whether you have questions about our products, need assistance with your order, or want to learn more about our services, we are here to help. Our dedicated team is committed to providing you with the best customer service experience possible. Please feel free to reach out to us through the contact form below or via our social media channels. We look forward to hearing from you!
    </p>
    <p>
      Our mission is to provide you with high-quality eyewear solutions that not only enhance your vision but also reflect your personal style. We believe that every customer deserves exceptional service and support, and we are here to ensure that your experience with Optique is nothing short of excellent.
    </p>
  </div>
</div>

<!--Info Cards-->
<section>
  <div class="card-body">
    <div class="social-cards">
      <a href="https://www.instagram.com" target="_blank" class="hyper-hider">
        <div class="card-con">
          <div class="cards">
            <div class="card-image">
              <img src="{{ asset('Images/socials/instagram.png') }}" width="100px" />
            </div>
            <div class="card-detail">
              <h1>Instagram</h1>
              <p>Follow us on Instagram!</p>
            </div>
          </div>
        </div>
      </a>
      <a href="https://www.youtube.com" target="_blank" class="hyper-hider">
        <div class="card-con">
          <div class="cards">
            <div class="card-image">
              <img src="{{ asset('Images/socials/youtube.png') }}" width="100px" />
            </div>
            <div class="card-detail">
              <h1>YouTube</h1>
              <p>Follow us on YouTube!</p>
            </div>
          </div>
        </div>
      </a>
      <a href="https://twitter.com" target="_blank" class="hyper-hider">
        <div class="card-con">
          <div class="cards">
            <div class="card-image">
              <img src="{{ asset('Images/socials/twitter.png') }}" width="100px" />
            </div>
            <div class="card-detail">
              <h1>Twitter</h1>
              <p>Follow us on Twitter!</p>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</section>
<!--Info Cards End-->

<div class="contact-page-text">
  <div class="contact-text-box">
    <p>
      Our team is available to assist you with any inquiries you may have. You can contact us via email at support@optique.com or call us at 1 (800) 555-OPTQ. We strive to respond to all inquiries within 24 hours. Thank you for choosing Optique, where we are dedicated to providing you with exceptional eyewear solutions and customer service.
    </p>
    <p>
      Additionally, we encourage you to follow us on our social media platforms to stay updated on the latest trends, promotions, and new product launches. Your satisfaction is our priority, and we are always looking for ways to improve our services and offerings.
    </p>
  </div>
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
          <a id="mailto-link" onclick="updateMailtoLink()">
            <input type="button" value="Send">
          </a>
        </div>
      </div>
    </div>
  </form>
</section>
<!--Contact Form End-->
@endsection
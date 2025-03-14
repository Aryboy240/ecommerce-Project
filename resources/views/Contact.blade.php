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
      Lorem, ipsum dolor sit amet consectetur adipisicing elit. Veniam sapiente cumque dolores incidunt beatae
      laudantium, eum asperiores porro inventore alias soluta voluptate et enim. Nam adipisci, facilis doloribus
      nulla velit error ducimus illum. Expedita possimus voluptatibus, non nesciunt asperiores saepe aperiam
      architecto illo earum odit nisi commodi iste iusto est cum laboriosam excepturi atque cupiditate optio
      laudantium? Quibusdam deleniti, nulla optio maxime consectetur in doloribus nobis vel! Autem temporibus,
      distinctio quibusdam beatae, magni et tempore nesciunt optio exercitationem error officiis id aliquid?
      Labore, tempora quod natus numquam quidem magni maiores similique! Debitis consectetur accusamus dolorem
      ipsa deleniti distinctio! Saepe, corporis.
    </p>
  </div>
</div>

<!--Info Cards-->
<section>
  <div class="card-body">
    <a href="https://www.instagram.com" target="_blank" class="hyper-hider">
      <div class="card-con">
        <div class="cards">
          <div class="card-image">
            <img src="{{ asset('Images/socials/instagram.png') }}" width="200px" />
          </div>
          <div class="card-detail" style="margin-top: -50px; font-size: 20px; color: white">
            <h1>Instagram</h1>
            <p>
              Follow us on Instagram!
            </p>
          </div>
        </div>
    </a>
  </div>
  <a href="https://www.youtube.com" target="_blank" class="hyper-hider">
    <div class="card-con">
      <div class="cards">
        <div class="card-image">
          <img src="{{ asset('Images/socials/youtube.png') }}" width="220px" />
        </div>
        <div class="card-detail" style="margin-top: -50px; font-size: 20px; color: white">
          <h1>YouTube</h1>
          <p>
            Follow us on YouTube!
          </p>
        </div>
      </div>
  </a>
  </div>
  <a href="https://twitter.com" target="_blank" class="hyper-hider">
    <div class="card-con">
      <div class="cards">
        <div class="card-image">
          <img src="{{ asset('Images/socials/twitter.png') }}" width="190px" />
        </div>
        <div class="card-detail" style="margin-top: -50px; font-size: 20px; color: white">
          <h1>Twitter</h1>
          <p>
            Follow us on Twitter!
          </p>
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
      Lorem ipsum, dolor sit amet consectetur adipisicing elit. Incidunt facilis dolorum quo dolore illo
      praesentium illum temporibus sed facere aliquam, asperiores pariatur odio atque, commodi placeat itaque
      eligendi cumque saepe soluta? Similique, quaerat. Necessitatibus perspiciatis adipisci ratione vel iure
      beatae error incidunt obcaecati aspernatur, officiis laboriosam consequatur consectetur facere ad non
      praesentium rem. Eos, voluptatum ipsam iusto quod quos consequatur nam maiores dicta quasi, ea quaerat
      sequi, non quae qui perspiciatis. Nobis vitae fuga impedit numquam culpa dolorum amet blanditiis
      exercitationem vero? Voluptates aut dolorum molestias dolorem enim fugiat unde. In repudiandae
      necessitatibus animi non vero eius explicabo consectetur delectus!
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
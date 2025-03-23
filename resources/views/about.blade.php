<!--
    Developer: Aryan Kora
    University ID: 230228946
    Function: About page front end
-->

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

@section('extra-head')

  <link href="{{ asset('css/about.css') }}" rel="stylesheet">

@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | About Us')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')


  <!-- About Hero Section -->
  <section class="hero about-hero">
    <div class="hero-content">
    <div>
      <h1>OUR VISION<br>our story</h1>
      <img class="world" src="{{ asset('Images/gifs/glasses.gif') }}">
      <p>
      We're passionate about helping you see the world clearly<br>
      through stylish and quality eyewear solutions<br><br>
      <em>Premium service since 2024</em>
      </p>
    </div>
    </div>
  </section>
  <!-- About Hero End -->

  <!-- Mission Values Section with Floaters -->
  <section class="container mission-section">
    <div class="floater-body">
    <div class="floater-containter">
      <div class="floaters">
      <image src="{{ asset('Images/gifs/target.gif') }}">
        <p>Quality First</p>
      </div>
      <div class="floaters">
      <image src="{{ asset('Images/gifs/innovation.gif') }}">
        <p>Innovation</p>
      </div>
      <div class="floaters">
      <image src="{{ asset('Images/gifs/focus-2651_256.gif') }}">
        <p>Customer Focus</p>
      </div>
    </div>
    </div>
    <div class="mission-box-con">
    <div class="mission-box">
      <p>At Optique, our mission is to transform the eyewear industry by providing opticians with a streamlined
      digital platform that offers premium products, exceptional service, and innovative solutions. We're
      committed to
      helping people express their unique style while improving their vision with quality eyewear that exceeds
      expectations.</p>
    </div>
    </div>
  </section>
  <!-- Mission Values Section End -->

  <!-- Our Story Section -->
  <section class="about-story-section">
    <div class="about-wrapper">
    <div class="about-content">
      <h2>Our Story</h2>
      <p>
      Optique - where vision and style come together with innovation. To the outside world, Optique is an
      organization that is fully devoted to offering the best eyeglasses that address not only your vision but
      also your fashion sense. If you are interested in the newest trends or classics, our glasses' selection
      is created to meet every customer's needs and preferences.
      It is our goal to make the decision to purchase a pair of glasses as easy, fun, and beneficial as
      possible. Whether you browse our site from the comfort of your own home or visit our store, we are
      here to assist you in choosing the right frames and lenses for you. Welcome to a new world of
      glasses-welcome to Optique.
      <br><br>
      We are Optique, a group of professionals who are inspired by a common mission to change people's
      lives with the help of proper eyewear. We have paid much attention to the quality, appearance, and
      attitude towards customers, which made us a reputable company in the sphere of selling
      eyeglasses. Our specialization includes selecting beautiful frames, choosing the best lenses, and
      making sure that every client sees clearly and feels good.
      Optique is not just a brand but a group of people who are interested in vision, style, and relations.
      We're here to help you make sense of the world and communicate your ideas more effectively.
      Optique is your home - where every eyeglasses is not just an optical accessory but a window to the
      world.
      <br><br>
      We want to Revolutionize Eyewear Shopping. To revolutionize the way people buy their eyeglasses by
      offering the latest technology
      and friendly services.Combine Functionality with Style: Design various models of sunglasses that provide
      utility with functional perspectives of
      taste and personality. Prioritize Customer Satisfaction: The goal is to build trust and long-term
      relationships with customers, and to achieve it,
      make sure that each of them leaves with something they would like. Commit to Quality: Offer good quality
      frames and lenses that are well made, well fitted, and long lasting.
      Embrace Sustainability: The incorporation of environment-friendly materials and work processes to
      minimize our impact
      on the biophysical environment during the provision of quality optical solutions.
      <br><br>
      <b>
        <h3>Join us on this journey to revolutionize eyewear. Explore our collection today and discover the
        perfect blend of vision and style.</h3>
      </b>
      </p>
    </div>
    <div class="about-image">
      <div class="image-grid">
      <img src="{{ asset('Images/portrait-7909587_1280.jpg') }}">
      <img src="{{ asset('Images/glass-3097577_1280.jpg') }}">
      <img src="{{ asset('Images/plans-1867745_1280.jpg') }}">
      <img src="{{ asset('Images/smiling-4654734_1280.jpg') }}">
      </div>
    </div>
    </div>
  </section>
  <!-- Our Story Section End -->

  <!-- Company Logo Section -->
  <section class="logo-section">
    <div class="logo-container">
    <div class="logo-wrapper">
      <div class="company-image">
      <img src="{{ asset('Images/logo.png') }}" alt="Company Logo" class="company-logo">
      </div>
      <div class="logo-text">
      <h2>We Are Here To<br> Frame Your World</h2>
      <p>A digital solution for opticians providing premium eyewear collections</p>
      </div>
    </div>
    </div>
  </section>
  <!-- Company Logo Section End -->

  <!-- Meet the Team Section -->
  <section class="team-section">
    <h1>Meet The Team</h1>

    <div class="team-tree">
    <!-- First Layer -->
    <div class="tree-level level-1">
      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image" id="first-member">
        <img src="{{ asset('Images/MOT/Aryan.png') }}">
        </div>
      </div>
      <div class="member-card" id="first-card">
        <h3 class="member-name">Aryan Kora</h3>
        <p class="member-title">Team Leader</p>
        <p class="member-bio">I worked on both the frontend and backend of a website, focusing on the
        frontend with tasks such as creating the landing page, developing user registration, login, and
        account management systems, designing the navigation bar, implementing light mode, and remaking
        the account and contact pages. On the backend, I handled adding images to products in the
        database, managing products, developing checkout and cart functionality, enabling search, and
        implementing the login system. Additionally, I managed website hosting, maintained the GitHub
        repository, distributed tasks as the project leader/manager, and provided technical support
        throughout the development process.</p>
        <div class="member-contact">
        <a href="mailto:aryan240@outlook.com">Email</a>
        <a href="https://linktr.ee/AryanKora" target="blank_">Linktree</a>
        </div>
      </div>
      </div>
    </div>

    <!-- Second Level -->
    <div class="tree-level level-2">
      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Abdul</h3>
        <p class="member-title">Full Stack Developer</p>
        <p class="member-bio">Abdul is a skilled full stack developer with expertise in both frontend and
        backend technologies. He is dedicated to creating seamless user experiences and ensuring that
        the Optique platform runs smoothly. His work spans across core features and system 
        functionality,consistently focusing on usability, performance, 
        and innovative solutions to enhance the overall platform experience.</p>
        <div class="member-contact">
        <a href="#">Email</a>
        <a href="#">LinkedIn</a>
        </div>
      </div>
      </div>

      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Angus</h3>
        <p class="member-title">Front-end Developer</p>
        <p class="member-bio">Angus is a creative front-end developer who specializes in crafting beautiful
        and responsive web interfaces. His attention to detail ensures that every aspect of the user
        experience is polished and engaging.</p>
        <div class="member-contact">
        <a href="#">Email</a>
        <a href="#">LinkedIn</a>
        </div>
      </div>
      </div>

      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Aqsa</h3>
        <p class="member-title">Front-end Developer</p>
        <p class="member-bio">Aqsa is a passionate front-end developer with a knack for creating intuitive
        user interfaces. She enjoys collaborating with designers to bring innovative ideas to life and
        enhance the overall user experience.</p>
        <div class="member-contact">
        <a href="#">Email</a>
        <a href="#">LinkedIn</a>
        </div>
      </div>
      </div>
    </div>

    <!-- Third Level -->
    <div class="tree-level level-3">
      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Aron</h3>
        <p class="member-title">Backend Developer</p>
        <p class="member-bio">Aron is a dedicated backend developer who focuses on building robust and
        scalable server-side applications. His expertise ensures that the Optique platform is efficient
        and reliable.</p>
        <div class="member-contact">
        <a href="#">Email</a>
        <a href="#">LinkedIn</a>
        </div>
      </div>
      </div>

      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Hussen</h3>
        <p class="member-title">Backend Developer</p>
        <p class="member-bio">Hussen is a backend developer with a strong focus on database management and
        server optimization. He is committed to ensuring that all data processes run smoothly and
        efficiently.</p>
        <div class="member-contact">
        <a href="#">Email</a>
        <a href="#">LinkedIn</a>
        </div>
      </div>
      </div>

      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/MOT/Nik.png') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Nikhil</h3>
        <p class="member-title">Backend Developer</p>
        <p class="member-bio">Nikhil is a backend developer who specializes in API development and integration. 
          His work ensures that the Optique platform communicates effectively with various services and applications. 
          During the project, I contributed to both the frontend and backend development. 
          I specifically focused on the user and admin login features, password recovery functionality, and integrating Optique’s 
          contact information across multiple platforms, including email, Instagram, Facebook, and other social media channels.</p>
        <div class="member-contact">
        <a href="mailto:kainthnikhil1@gmail.com">Email</a>
        <a href="https://www.linkedin.com/in/nikhil-kainth/">LinkedIn</a>
        </div>
      </div>
      </div>

      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/MOT/Oyinlola.jpg') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Oyinlola</h3>
        <p class="member-title">Front-end Developer</p>
        <p class="member-bio">Oyinlola is passionate about web design and front-end development. She focuses
        on creating user-friendly and visually appealing interfaces, contributing her skills to ensure
        the project delivers an engaging and seamless user experience. She thrives in collaborative
        environments, bringing creativity and attention to detail to every web project.</p>
        <div class="member-contact">
        <a href="#">Email</a>
        <a href="#">LinkedIn</a>
        </div>
      </div>
      </div>

      <div class="team-member">
      <div class="member-wrapper">
        <div class="member-image">
        <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
        </div>
      </div>
      <div class="member-card">
        <h3 class="member-name">Vatsal</h3>
        <p class="member-title">Backend Developer</p>
        <p class="member-bio">Vatsal is a backend developer with a focus on system architecture and
        performance optimization. He is dedicated to building scalable solutions that enhance the
        overall functionality of the Optique platform.</p>
        <div class="member-contact">
        <a href="#">Email</a>
        <a href="#">LinkedIn</a>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>
  <!-- Meet the Team Section End -->

  <!-- Testimonials Section -->
  <section class="testimonials-section">
    <h2 class="section-title" style="margin-bottom: 50px !important">What Our Partners Say</h2>
    <div class="testimonial-container">
    <div class="testimonial-wrapper">
      <div class="testimonial-card">
      <div class="quote-mark">"</div>
      <p class="testimonial-text">Optique has transformed how we operate our optician business. The digital
        platform is intuitive, and the quality of frames is exceptional. Our customers love the variety of
        premium brands available.</p>
      <div class="testimonial-author">
        <img src="{{ asset('Images/testimonial1.jpg') }}">
        <div>
        <h4>Rebecca Barton</h4>
        <p>Vision Care Opticians, London</p>
        </div>
      </div>
      </div>
    </div>

    <div class="testimonial-wrapper">
      <div class="testimonial-card">
      <div class="quote-mark">"</div>
      <p class="testimonial-text">The team at Optique understands the needs of modern opticians. Their
        platform has streamlined our ordering process and the customer support is always responsive and
        helpful.</p>
      <div class="testimonial-author">
        <img src="{{ asset('Images/testimonial2.jpg') }}">
        <div>
        <h4>Evan Jaye</h4>
        <p>Taylor Eyecare, Wolverhampton</p>
        </div>
      </div>
      </div>
    </div>

    <div class="testimonial-wrapper">
      <div class="testimonial-card">
      <div class="quote-mark">"</div>
      <p class="testimonial-text">We've seen a significant increase in customer satisfaction since partnering
        with Optique. The quality of their frames and the efficiency of their delivery service is unmatched
        in the industry.</p>
      <div class="testimonial-author">
        <img src="{{ asset('Images/testimonial3.jpg') }}">
        <div>
        <h4>Josh Jacobs
        </h4>
        <p>Clarity Vision, Liverpool</p>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>
  <!-- Testimonials Section End -->

  <!-- Contact CTA Section -->
  <section class="contact-cta">
    <div class="cta-content">
    <h2>Let's Frame Your Vision Together</h2>
    <p>Join our network of opticians and elevate your eyewear offerings with our premium collections</p>
    <a href="{{ route('contact') }}" class="about-button">Contact Us Today</a>
    </div>
  </section>
  <!-- Contact CTA Section End -->


@endsection
<!--
    Developer: Abdulrahman Muse
    University ID: 230228946
    Function: about page front end
-->

<html lang="en">

<head>
  <link href="{{ asset('css/about.css') }}" rel="stylesheet">
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'about')

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

<!-- Company Logo Section -->
<section class="logo-section">
  <div class="logo-container">
    <div class="logo-wrapper">
      <img src="{{ asset('Images/logo.png') }}" alt="Company Logo" class="company-logo">
      <div class="logo-text">
        <h2>We Are Frame Your World</h2>
        <p>A digital solution for opticians providing premium eyewear collections</p>
      </div>
    </div>
  </div>
</section>
<!-- Company Logo Section End -->

<!-- Our Story Section -->
<section class="about-story-section">
  <div class="about-wrapper">
    <div class="about-content">
      <h2>Our Story</h2>
      <p>Founded in 2015, Frame Your World began with a simple mission: to revolutionize how people shop for eyewear. 
        We believe that glasses are more than just a visual aid—they're an expression of your personal style and identity.
        <br><br>
        What started as a small boutique in London has grown into a comprehensive digital platform serving opticians 
        nationwide. Our journey has been driven by innovation, quality, and a deep understanding of what our customers need.
        <br><br>
        Today, we offer a curated collection of premium eyewear from world-renowned brands, making it easier for 
        opticians to provide their clients with the perfect frames that match both their prescription needs and style preferences.
        <br><br>
        Our digital solution simplifies the ordering process, provides detailed product information, and ensures 
        a seamless experience from browsing to delivery—all while maintaining the highest standards of quality and service.
      </p>
    </div>
    <div class="about-image">
      <div class="image-grid">
        <img src="{{ asset('Images/About/store-front.jpg') }}" alt="Our Store">
        <img src="{{ asset('Images/About/showroom.jpg') }}" alt="Our Showroom">
        <img src="{{ asset('Images/About/workshop.jpg') }}" alt="Our Workshop">
        <img src="{{ asset('Images/About/digital-platform.jpg') }}" alt="Digital Platform">
      </div>
    </div>
  </div>
</section>
<!-- Our Story Section End -->

<!-- Mission Values Section with Floaters -->
<section class="container mission-section">
  <h2 class="section-title">Our Mission & Values</h2>
  <div class="floater-body">
    <div class="floater-containter mission-floaters">
      <div class="floaters mission-floater">
        <image src="{{ asset('Images/gifs/target.gif') }}">
        <p>Quality First</p>
      </div>
      <div class="floaters mission-floater">
        <image src="{{ asset('Images/gifs/innovation.gif') }}">
        <p>Innovation</p>
      </div>
      <div class="floaters mission-floater">
        <image src="{{ asset('Images/gifs/customer.gif') }}">
        <p>Customer Focus</p>
      </div>
    </div>
  </div>
  <div class="text-box mission-box">
    <p>At Frame Your World, our mission is to transform the eyewear industry by providing opticians with a streamlined 
    digital platform that offers premium products, exceptional service, and innovative solutions. We're committed to 
    helping people express their unique style while improving their vision with quality eyewear that exceeds expectations.</p>
  </div>
</section>
<!-- Mission Values Section End -->

<!-- Meet the Team Section -->
<section class="team-section">
  <h1>Meet Our Team</h1>
  
  <div class="team-tree">
      <!-- CEO Level -->
      <div class="tree-level level-1">
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="CEO">
              </div>
              <div class="member-card">
                  <h3 class="member-name">John Smith</h3>
                  <p class="member-title">CEO & Founder</p>
                  <p class="member-bio">John founded our company in 2015 with a vision to revolutionize the industry. With over 15 years of experience, he leads our team with passion and innovation.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
      </div>
      
      <!-- Second Level - Executives -->
      <div class="tree-level level-2">
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="CTO">
              </div>
              <div class="member-card">
                  <h3 class="member-name">Sarah Johnson</h3>
                  <p class="member-title">Chief Technology Officer</p>
                  <p class="member-bio">Sarah oversees all technical aspects of the company. Her innovative approach has led to our award-winning product development.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
          
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="COO">
              </div>
              <div class="member-card">
                  <h3 class="member-name">Michael Chen</h3>
                  <p class="member-title">Chief Operations Officer</p>
                  <p class="member-bio">Michael ensures our day-to-day operations run smoothly. His strategic planning has helped us expand to three new markets.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
          
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="CMO">
              </div>
              <div class="member-card">
                  <h3 class="member-name">Emily Rodriguez</h3>
                  <p class="member-title">Chief Marketing Officer</p>
                  <p class="member-bio">Emily leads our marketing strategies with creativity and data-driven insights, resulting in a 200% growth in brand recognition.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
      </div>
      
      <!-- Third Level - Department Managers -->
      <div class="tree-level level-3">
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="Dev Manager">
              </div>
              <div class="member-card">
                  <h3 class="member-name">David Kim</h3>
                  <p class="member-title">Development Manager</p>
                  <p class="member-bio">David leads our development team, bringing technical expertise and leadership to our software projects.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
          
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="Design Manager">
              </div>
              <div class="member-card">
                  <h3 class="member-name">Lisa Wong</h3>
                  <p class="member-title">Design Manager</p>
                  <p class="member-bio">Lisa brings creativity and user focus to our product design, ensuring exceptional user experiences.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
          
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="Sales Manager">
              </div>
              <div class="member-card">
                  <h3 class="member-name">James Wilson</h3>
                  <p class="member-title">Sales Manager</p>
                  <p class="member-bio">James drives our sales strategy, building strong client relationships and exceeding targets consistently.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
          
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="HR Manager">
              </div>
              <div class="member-card">
                  <h3 class="member-name">Olivia Martinez</h3>
                  <p class="member-title">HR Manager</p>
                  <p class="member-bio">Olivia oversees our talent acquisition and employee development, creating a positive and productive workplace.</p>
                  <div class="member-contact">
                      <a href="#">Email</a>
                      <a href="#">LinkedIn</a>
                  </div>
              </div>
          </div>
          
          <div class="team-member">
              <div class="member-image">
                  <img src="/api/placeholder/100/100" alt="Finance Manager">
              </div>
              <div class="member-card">
                  <h3 class="member-name">Robert Taylor</h3>
                  <p class="member-title">Finance Manager</p>
                  <p class="member-bio">Robert manages our financial planning and analysis, ensuring sustainable growth and profitability.</p>
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
  <h2 class="section-title">What Our Partners Say</h2>
  <div class="testimonial-container">
    <div class="testimonial-card">
      <div class="quote-mark">"</div>
      <p class="testimonial-text">Frame Your World has transformed how we operate our optician business. The digital platform is intuitive, and the quality of frames is exceptional. Our customers love the variety of premium brands available.</p>
      <div class="testimonial-author">
        <img src="{{ asset('Images/Testimonials/testimonial1.jpg') }}" alt="John Smith">
        <div>
          <h4>John Smith</h4>
          <p>Vision Care Opticians, London</p>
        </div>
      </div>
    </div>
    
    <div class="testimonial-card">
      <div class="quote-mark">"</div>
      <p class="testimonial-text">The team at Frame Your World understands the needs of modern opticians. Their platform has streamlined our ordering process and the customer support is always responsive and helpful.</p>
      <div class="testimonial-author">
        <img src="{{ asset('Images/Testimonials/testimonial2.jpg') }}" alt="Lisa Taylor">
        <div>
          <h4>Lisa Taylor</h4>
          <p>Taylor Eyecare, Manchester</p>
        </div>
      </div>
    </div>
    
    <div class="testimonial-card">
      <div class="quote-mark">"</div>
      <p class="testimonial-text">We've seen a significant increase in customer satisfaction since partnering with Frame Your World. The quality of their frames and the efficiency of their delivery service is unmatched in the industry.</p>
      <div class="testimonial-author">
        <img src="{{ asset('Images/Testimonials/testimonial3.jpg') }}" alt="David Clarke">
        <div>
          <h4>David Clarke</h4>
          <p>Clarity Vision, Edinburgh</p>
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
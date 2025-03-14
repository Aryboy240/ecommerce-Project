<!--
    Developer: Aryan Kora
    University ID: 230228946
    Function: About page front end
-->

<html lang="en">

<head>
  <link href="{{ asset('css/about.css') }}" rel="stylesheet">
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

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
  <div class="mission-box-con">
    <div class="mission-box">
      <p>At Optique, our mission is to transform the eyewear industry by providing opticians with a streamlined 
      digital platform that offers premium products, exceptional service, and innovative solutions. We're committed to 
      helping people express their unique style while improving their vision with quality eyewear that exceeds expectations.</p>
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
        We want to Revolutionize Eyewear Shopping. To revolutionize the way people buy their eyeglasses by offering the latest technology
        and friendly services.Combine Functionality with Style: Design various models of sunglasses that provide utility with functional perspectives of
        taste and personality. Prioritize Customer Satisfaction: The goal is to build trust and long-term relationships with customers, and to achieve it,
        make sure that each of them leaves with something they would like. Commit to Quality: Offer good quality frames and lenses that are well made, well fitted, and long lasting.
        Embrace Sustainability: The incorporation of environment-friendly materials and work processes to minimize our impact
        on the biophysical environment during the provision of quality optical solutions.
      </p>
    </div>
    <div class="about-image">
      <div class="image-grid">
        <img src="{{ asset('Images/filler.webp') }}">
        <img src="{{ asset('Images/filler.webp') }}">
        <img src="{{ asset('Images/filler.webp') }}">
        <img src="{{ asset('Images/filler.webp') }}">
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
  <h1>Meet Our Team</h1>
  
  <div class="team-tree">
      <!-- First Layer -->
      <div class="tree-level level-1">
        <div class="team-member">
            <div class="member-wrapper">
              <div class="member-image" id="first-member">
                <img src="{{ asset('Images/MOT/Aryan.png') }}">
              </div>
            </div>
            <div class="member-card">
                <h3 class="member-name">Aryan Kora</h3>
                <p class="member-title">Team Leader</p>
                <p class="member-bio">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum doloremque aperiam ad iste vero, tenetur sunt praesentium tempora alias, nobis velit rem reprehenderit nihil cumque rerum molestias ab dolorem eius.</p>
                <div class="member-contact">
                    <a href="#">Email</a>
                    <a href="#">LinkedIn</a>
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
                  <p class="member-bio">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sunt ad, alias quasi est dolore voluptatem culpa provident obcaecati voluptatum distinctio nisi. Sapiente modi enim beatae commodi dignissimos? Officia, molestias sapiente!</p>
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
                  <p class="member-bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Maiores nam facilis officia, sit nihil asperiores placeat inventore, ex dolorum, neque suscipit. Quisquam a beatae iure? Odio ab earum corporis consectetur!</p>
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
                  <p class="member-bio">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto iste deleniti consequatur, delectus et cupiditate consequuntur excepturi asperiores provident accusamus quis, ab sapiente neque minus error optio. Sapiente, aperiam ipsum.</p>
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
                  <p class="member-bio">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ab sequi similique deserunt minima perferendis ducimus natus magnam dicta voluptas neque vero enim eveniet accusantium porro architecto necessitatibus dolor, facilis modi?</p>
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
                  <p class="member-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, assumenda cumque nisi impedit deleniti ex. Ipsam quos sapiente dolorum fugiat quisquam quam odio cumque qui vel? In distinctio a quae?</p>
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
                  <h3 class="member-name">Nikhil</h3>
                  <p class="member-title">Backend Developer</p>
                  <p class="member-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime veritatis blanditiis iure reiciendis fuga culpa magnam neque consectetur ipsa qui, distinctio velit voluptatem recusandae? Itaque accusamus explicabo labore ipsa harum?</p>
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
                  <h3 class="member-name">Oyinlola</h3>
                  <p class="member-title">Front-end Developer</p>
                  <p class="member-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere officiis, veritatis deserunt eos fugit omnis laborum eveniet ducimus enim reprehenderit iure sunt qui sapiente at quod explicabo vel neque nemo.</p>
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
                  <p class="member-bio">Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni excepturi sunt quas qui, perferendis molestiae nisi ea eum voluptas dolore tenetur ratione nemo labore quaerat similique quos perspiciatis nihil nobis.</p>
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
        <p class="testimonial-text">Optique has transformed how we operate our optician business. The digital platform is intuitive, and the quality of frames is exceptional. Our customers love the variety of premium brands available.</p>
        <div class="testimonial-author">
          <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
          <div>
            <h4>Brandon Ian Tidmarsh</h4>
            <p>GTFO Opticians, London</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="testimonial-wrapper">
      <div class="testimonial-card">
        <div class="quote-mark">"</div>
        <p class="testimonial-text">The team at Optique understands the needs of modern opticians. Their platform has streamlined our ordering process and the customer support is always responsive and helpful.</p>
        <div class="testimonial-author">
          <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
          <div>
            <h4>Dylan Michel Ellis-Patey</h4>
            <p>Prawn SW Eyecare, Wolverhampton</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="testimonial-wrapper">
      <div class="testimonial-card">
        <div class="quote-mark">"</div>
        <p class="testimonial-text">We've seen a significant increase in customer satisfaction since partnering with Optique. The quality of their frames and the efficiency of their delivery service is unmatched in the industry.</p>
        <div class="testimonial-author">
          <img src="{{ asset('Images/Users/Profile_Pics/Default/default_pf.png') }}">
          <div>
            <h4>Chanel Louise Vernon</h4>
            <p>2020 Vision Inc., Liverpool</p>
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
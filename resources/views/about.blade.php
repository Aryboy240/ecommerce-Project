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

<!-- Parallax Section -->
<div class="parallax">
  <h1>About Us</h1>
</div>

<!-- Meet the Team Section -->
<section class="team-section">
  <h2>Meet the Team</h2>
  <div class="team-tree">
      <!-- Team Leader -->
      <div class="team-member leader">
          <img src="leader.jpg" alt="Team Leader">
          <h3>Team Leader</h3>
          <p>Leading innovation and progress.</p>
      </div>

      <div class="sub-teams">
          <!-- Backend Team -->
          <div class="team backend">
              <h4>Backend Team</h4>
              <div class="team-row">
                  <div class="team-member">
                      <img src="backend1.jpg" alt="Backend Developer">
                      <h3>Backend Dev 1</h3>
                  </div>
                  <div class="team-member">
                      <img src="backend2.jpg" alt="Backend Developer">
                      <h3>Backend Dev 2</h3>
                  </div>
                  <div class="team-member">
                      <img src="backend3.jpg" alt="Backend Developer">
                      <h3>Backend Dev 3</h3>
                  </div>
              </div>
          </div>

          <!-- Frontend Team -->
          <div class="team frontend">
              <h4>Frontend Team</h4>
              <div class="team-row">
                  <div class="team-member">
                      <img src="frontend1.jpg" alt="Frontend Developer">
                      <h3>Frontend Dev 1</h3>
                  </div>
                  <div class="team-member">
                      <img src="frontend2.jpg" alt="Frontend Developer">
                      <h3>Frontend Dev 2</h3>
                  </div>
                  <div class="team-member">
                      <img src="frontend3.jpg" alt="Frontend Developer">
                      <h3>Frontend Dev 3</h3>
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>


<script>
// Parallax Effect
document.addEventListener("scroll", function () {
    const parallax = document.querySelector(".parallax");
    let scrollPosition = window.pageYOffset;
    parallax.style.transform = `translateY(${scrollPosition * 0.5}px)`;
});
</script>

@endsection
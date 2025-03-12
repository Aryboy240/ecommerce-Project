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

<!-- Side Navigation -->
<aside class="side-nav">
  <ul>
    <li><a href="#welcome" onclick="showSection('welcome')">Welcome</a></li>
    <li><a href="#goal" onclick="showSection('goal')">Our Goal</a></li>
    <li><a href="#who-we-are" onclick="showSection('who-we-are')">Who We Are</a></li>
  </ul>
</aside>

<!-- Sections to display the content -->
<!-- Content Sections -->
<div style="margin-left: 220px; padding-bottom: 100px">
  <section id="welcome" class="section visible">
    <h1>Welcome to Optique</h1>
    <p>Optique – where vision and style come together with innovation. To the outside world, Optique is an
      organization that is fully devoted to offering the best eyeglasses that address not only your vision but
      also your fashion sense. If you are interested in the newest trends or classics, our glasses’ selection is
      created to meet every customer’s needs and preferences.</p>
    <p>It is our goal to make the decision to purchase a pair of glasses as easy, fun, and beneficial as possible.
      Whether you browse our site from the comfort of your own home or visit our store, we are here to assist you
      in choosing the right frames and lenses for you. Welcome to a new world of glasses—welcome to Optique.</p>
  </section>
  <section id="goal" class="section hidden">
    <h1>Our Goal</h1>
    <ul>
      <li>Revolutionize Eyewear Shopping: To revolutionize the way people buy their eyeglasses by offering the
        latest technology and friendly services.</li>
      <li>Combine Functionality with Style: Design various models of sunglasses that provide utility with
        functional perspectives of taste and personality.</li>
      <li>Prioritize Customer Satisfaction: The goal is to build trust and long-term relationships with customers,
        and to achieve it, make sure that each of them leaves with something they would like.</li>
      <li>Commit to Quality: Offer good quality frames and lenses that are well made, well fitted, and long
        lasting.</li>
      <li>Embrace Sustainability: The incorporation of environment-friendly materials and work processes to
        minimize our impact on the biophysical environment during the provision of quality optical solutions.
      </li>
    </ul>
  </section>

  <section id="who-we-are" class="section hidden">
    <h1>Who We Are</h1>
    <p>We are Optique, a group of professionals who are inspired by a common mission to change people’s lives with
      the help of proper eyewear. We have paid much attention to the quality, appearance, and attitude towards
      customers, which made us a reputable company in the sphere of selling eyeglasses. Our specialization
      includes selecting beautiful frames, choosing the best lenses, and making sure that every client sees
      clearly and feels good.</p>
    <p>Optique is not just a brand but a group of people who are interested in vision, style, and relations. We're
      here to help you make sense of the world and communicate your ideas more effectively. Optique is your home –
      where every eyeglasses is not just an optical accessory but a window to the world.</p>
  </section>
</div>


<!-- JavaScript to handle section visibility -->
<script>
  function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(section => {
      section.classList.add('hidden');
      section.classList.remove('visible');
    });

    document.getElementById(sectionId).classList.remove('hidden');
    document.getElementById(sectionId).classList.add('visible');
  }
</script>
@endsection
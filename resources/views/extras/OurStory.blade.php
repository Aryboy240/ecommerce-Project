<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

@section('extra-head')

  <link rel="stylesheet" href="{{ asset('css/OurStory.css') }}">

@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Our Story')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

  <!--Our Story : Man Kwok -->
  <section id="ourStory-section">

<!-- Big Title: Man Kwok-->
  <div id="our-Story-info">
    <h1>Optique</h1>
    <h2>Our Story</h2>
  </div>

<!-- Big Title End-->

<!--Our Story Dialog : Man Kwok -->
  <div id="our-Story-dialog">
    <div id="dialog-1">
      <h1>Optique</h1>
      <p>Optique is a fabricate company created by a student team from Aston University, we meant to provide a complete experience of shopping in an E-commerce Websites, please enjoy the website.</p>
    </div>

    <div id="dialog-2">
      <h1>Situation</h1>
      <p>It is believed that about four billion people in the world need visual correction. However, half of them are unable to get their vision corrected due to the lack of eye care facilities as well as financial difficulties.</p>
    </div>

    <div id="dialog-3">
      <h1>Difficulty</h1>
      <p>Of course,it is impossible to change the world or help every single person in need.However, we know that there would be no improvement to the situation if we do nothing.</p>
    </div>

    <div id="dialog-4">
      <h1>Vision</h1>
      <p>Through Optique, we hope to bring people a clearer and a more beautiful vision before their eyes.</p>
    </div>
  </div>

</section>
<!--Our Story End -->
@endsection
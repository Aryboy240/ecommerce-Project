<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

@section('extra-head')

  <link rel="stylesheet" href="{{ asset('css/careers.css') }}">

@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Careers')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

  <!--Careers : Man Kwok -->
  <section class="Careers-section">

    <!-- Big Title: Man Kwok-->
    <div id="Careers-info">
        <h1>Careers</h1>
    </div>
    <!-- Big Title End-->
     
    <!-- Careers Section -->
    <div id="Careers-card">
        <!-- Dynamic careers will be here -->

      <div class="Card">
        <p class="Careers-title">Our aim</p>
        <div class="content">
          <p class="title">Our aim</p>
          <p class="descition">Our company aim to help people who have vistion problem!</p>
        </div>
      </div>

      <div class="Card">
        <p class="Careers-title">About Us</p>
        <div class="content">
          <p class="title">About Us</p>
          <p class="descition">A company that puts more smiles on people’s face.Optique strives to be that “one and only” company that the whole world needs.</p>
        </div>
      </div>

    </div>

    <div id="Careers-card">

      <div class="Card">
        <p class="Careers-title">Interviews with Our People</p>
        <div class="content">
          <p class="title">Interviews with Our People</p>
          <p class="descition">The team supporting Optique’ global expansion efforts. Come and see the people who work for us and what they do.</p>
        </div>
      </div>

      <div class="Card">
        <p class="Careers-title">Working environment</p>
        <div class="content">
          <p class="title">Working environment</p>
          <p class="descition">Your carrier at Optique starts with your strong will to accomplish your mission.</p>
        </div>
      </div>
    </div>
    <div id="Careers-card">

      <div id="Careers">
        <div class="Card">
          <p class="Careers-title">Company Benefits</p>
          <div class="content">
            <p class="title">Company Benefits</p>
            <p class="descition">Optique wants to be a part of the lives of our people and walk through the future with them</p>
          </div>
        </div>
      </div>

    </div>   
    
  </section>

@endsection
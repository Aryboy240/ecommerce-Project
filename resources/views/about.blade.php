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

<div class="construct-layer">
  <img src="{{ asset(path: 'Images/caution-layer.png') }}">
</div>

<div class="construct-mid">
  <img src="{{ asset(path: 'Images/caution.png') }}">
</div>

@endsection
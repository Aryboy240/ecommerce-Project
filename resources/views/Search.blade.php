<!--
    Developer: Nikhil Kainth
	  University ID: 230069888
    Function: Front end for the search page
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <!--CSS-->
  <link rel="stylesheet" href="{{ asset('css/search.css') }}"> 
  <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}"> 
  <!--Fonts-->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Mochiy+Pop+P+One&display=swap"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&family=Merriweather:ital,wght@1,300&family=Noto+Sans&family=Pacifico&family=Raleway&display=swap"
    rel="stylesheet"
  />
</head>

<!--Search page-->
<body>
  <div class="wrapper">
    <div id="search-container">
      <input type="search" id="search-input" placeholder="Search product name here..." />
      <button class="search-button">Search</button>
    </div>
    <div id="buttons">
      <button class="button-value">All</button>
      <button class="button-value">Sunglasses</button>
      <button class="button-value">Prescription Glasses</button>
      <button class="button-value">Accessories</button>
    </div>
    <div id="products"></div>
  </div>

  <!-- Link to the external JavaScript file -->
  <script src="{{ asset('js/search-script.js') }}"></script>
</body>
</html>
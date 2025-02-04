<html lang="en">

<head>

  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'cart')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')
<!-- Dynamic cart functions:: Aryan Kora -->
<script>
  // Function for removing an item from the cart
  function removeItem(cartItemId) {
    // Send AJAX request to remove the item
    fetch('/cart/remove', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}', // CSRF token for security
      },
      body: JSON.stringify({
        cart_item_id: cartItemId
      })
    })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert(data.error); // Display error message if any
        } else {
          alert(data.message); // Success message
          // Optionally, you could update the UI (e.g., remove the item from the cart)
          location.reload(); // Refresh the page to reflect the changes
        }
      })
      .catch(error => {
        console.error('Error removing item:', error);
      });
  }

  // Function for upadting the quantity of a product
  function updateQuantity(selectElement, itemId) {
    const quantity = selectElement.value;

    fetch('/cart/update', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: JSON.stringify({
        cart_item_id: itemId,
        quantity: quantity
      })
    })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
        } else {
          // Update the total price for the individual item
          document.getElementById(`total_${itemId}`).textContent =
            `${parseFloat(data.total_price).toFixed(2)}`;

          // Update the overall cart total
          document.getElementById('subtotal').textContent = `${parseFloat(data.subtotal).toFixed(2)}`;
          document.getElementById('cart-total').textContent = `${parseFloat(data.cart_total).toFixed(2)}`;
        }
      })
      .catch(error => console.error('Error updating quantity:', error));
  }
</script>


<!-- Hero Section -->
<section class="hero" style="padding: 40px 20px;">
  <div class="hero-content">
    <h1 class="page-title">YOUR CART</h1>
  </div>
</section>

<!-- Cart Content:: Aryan Kora -->
<section class="container">
  @if(isset($items) && $items->count() > 0)
    <div class="product-card-con">
    @foreach($items as $item)
    <div class="product-card">
      <div class="card-circle"></div>
      <div class="product-card-content" style="width: 60%; left: 0;">
      <h2>{{ $item->product->name }}</h2>
      <p style="margin: 10px 0;">Cost: £{{ number_format($item->product->price, 2) }}</p>
      <div style="margin: 10px 0;">
      <label for="quantity_{{ $item->id }}">Quantity:</label>
      <select id="quantity_{{ $item->id }}" name="quantity" onchange="updateQuantity(this, '{{ $item->id }}')"
      style="margin-left: 10px;">
      @for ($i = 1; $i <= 10; $i++)
      <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>{{ $i }}</option>
    @endfor
      </select>
      </div>
      <p style="color: var(--mint); font-size: 1.2em;">Total: £<span
      id="total_{{ $item->id }}">{{ number_format($item->product->price * $item->quantity, 2) }}</span>
      </p>
      <div style="margin-top: 20px;">
      <a href="#" onclick="removeItem('{{ $item->id }}')" style="color: #ff4444;">Remove</a>
      </div>
      </div>
      <img class="imageSize-1"
      src="{{ $item->product->images->first()?->image_path ?? asset('Images/default-product.png') }}"
      alt="{{ $item->product->name }}" style="height: 100px; border-radius: 10px; box-shadow: 0px 0px 10px rgba()">
    </div>
  @endforeach
    </div>

    <!-- Cart Summary -->
    <div class="product-card" style="width: 100%; max-width: 800px; margin: 40px auto; padding: 30px;">
    <div style="text-align: right;">
      <h2 style="color: var(--text-primary); margin-bottom: 20px;">Cart Summary</h2>
      <p style="color: var(--text-secondary); margin-bottom: 10px;">Subtotal: £<span
        id="subtotal">{{ number_format($total, 2) }}</span></p>
      <p style="color: var(--text-secondary); margin-bottom: 20px;">Shipping: Calculated at checkout</p>
      <h3 style="color: var(--mint); font-size: 1.5em; margin-bottom: 30px;">Total: £<span
        id="cart-total">{{ number_format($total, 2) }}</span></h3>
      <a href="{{ route('checkout') }}" class="btn-order" style="font-size: 1.1em;">Proceed to Checkout</a>
    </div>
    </div>
  @else
    <div class="empty-cart">
    <div class="empty-cart-animation">
      <img src="{{ asset('Images/gifs/glasses.gif') }}" alt="Empty Cart">
    </div>
    <h2>Your Cart is Empty</h2>
    <p>Looks like you haven't added anything to your cart yet. Explore our collection and find something
      special!</p>
    <a href="{{ route('welcome') }}" class="continue-shopping-btn">
      Continue Shopping
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="24" height="24">
      <path
        d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42L14.59 11H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 1.42 1.42l5-5a1 1 0 0 0 .21-.33 1 1 0 0 0 0-.76z" />
      </svg>
    </a>
    </div>
  @endif
</section>
@endsection
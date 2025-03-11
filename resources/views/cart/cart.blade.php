<html lang="en">

<head>

  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

</head>

</html>

@extends('layouts.mainLayout')

@section('title', 'cart')

@section('content')
<!-- Dynamic cart functions:: Aryan Kora DO NOT TOUCH, PLEASE -->
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
          location.reload(); // Refresh the page to reflect the changes
        }
      })
      .catch(error => {
        console.error('Error removing item:', error);
      });
  }

  // Function for updating the quantity of a product
  function updateQuantity(button, itemId) {
    const quantitySpan = button.parentElement.querySelector('.qty-value');
    let currentQty = parseInt(quantitySpan.textContent);
    const action = button.classList.contains('minus') ? 'decrease' : 'increase';
    
    if (action === 'decrease' && currentQty > 1) {
      currentQty--;
    } else if (action === 'increase' && currentQty < 10) {
      currentQty++;
    } else {
      return; // Don't proceed if trying to go below 1 or above 10
    }

    fetch('/cart/update', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: JSON.stringify({
        cart_item_id: itemId,
        quantity: currentQty
      })
    })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
        } else {
          // Update the quantity display
          quantitySpan.textContent = currentQty;
          
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

<section class="container">
  @if(isset($items) && $items->count() > 0)
    <div class="cart-list">
      <div class="cart-header">
        <div class="header-item">Product</div>
        <div class="header-item">Price</div>
        <div class="header-item">Quantity</div>
        <div class="header-item">Total</div>
      </div>
      
      @foreach($items as $item)
        <div class="cart-item">
          <div class="item-image">
            <img src="{{ $item->product->images->first()?->image_path ?? asset('Images/default-product.png') }}" alt="{{ $item->product->name }}">
          </div>
          <div class="item-details">
            <h3>{{ $item->product->name }}</h3>
          </div>
          <div class="item-price">£{{ number_format($item->product->price, 2) }}</div>
          <div class="item-quantity">
            <button class="qty-btn minus" onclick="updateQuantity(this, '{{ $item->id }}')">-</button>
            <span class="qty-value">{{ $item->quantity }}</span>
            <button class="qty-btn plus" onclick="updateQuantity(this, '{{ $item->id }}')">+</button>
          </div>
          <div class="item-total">£<span id="total_{{ $item->id }}">{{ number_format($item->product->price * $item->quantity, 2) }}</span></div>
          <button class="remove-btn" onclick="removeItem('{{ $item->id }}')">Remove</button>
        </div>
      @endforeach
    </div>

    <div class="cart-summary">
      <h2>Cart Total</h2>
      <div class="summary-row">
        <span>SUBTOTAL</span>
        <span id="subtotal">£{{ number_format($total, 2) }}</span>
      </div>
      <div class="summary-row">
        <span>DISCOUNT</span>
        <span>—</span>
      </div>
      <div class="summary-row total">
        <span>TOTAL</span>
        <span id="cart-total">£{{ number_format($total, 2) }}</span>
      </div>
      <a href="{{ route('checkout') }}" class="btn-order">Proceed To Checkout</a>
    </div>
    <section class="recommendations">
      <h2>You May Also Like</h2>
      <div class="recommendation-grid">
        @for ($i = 0; $i < 4; $i++)
        <div class="recommendation-card">
          <div class="card-tag">New</div>
          <div class="card-image"></div>
          <h3>Glasses</h3>
          <p>£599.00</p>
        </div>
        @endfor
      </div>
    </section>

  @else
    <div class="empty-cart">
      <div class="empty-cart-animation">
        <img src="{{ asset('Images/gifs/glasses.gif') }}" alt="Empty Cart">
      </div>
      <h2>Your Cart is Empty</h2>
      <p>Looks like you haven't added anything to your cart yet. Explore our collection and find something special!</p>
      <a href="{{ route('welcome') }}" class="btn-order">Continue Shopping</a>
    </div>
  @endif
</section>
@endsection
<html lang="en">

<head>

  <script defer src="/js/addToCart.js"></script>
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">

</head>

</html>

@extends('layouts.mainLayout')

@section('title', 'cart')

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
            // Store error message in sessionStorage
            sessionStorage.setItem('notification', JSON.stringify({ message: data.error, success: false }));
        } else {
            // Store success message in sessionStorage
            sessionStorage.setItem('notification', JSON.stringify({ message: data.message, success: true }));
        }
        
        // Reload the page
        location.reload();
    })
    .catch(error => {
        console.error('Error removing item:', error);
        // Store error message in sessionStorage
        sessionStorage.setItem('notification', JSON.stringify({ message: 'An error occurred while removing the item.', success: false }));
        
        // Reload the page
        location.reload();
    });
}

// Check for a stored notification and display it
window.onload = function() {
    const notificationData = sessionStorage.getItem('notification');
    if (notificationData) {
        const { message, success } = JSON.parse(notificationData);
        // Show the notification with the stored message
        showNotification(message, success);
        // Clear the notification from sessionStorage after it's shown
        sessionStorage.removeItem('notification');
    }
};

// Notification function to show the message
function showNotification(message, success = true) {
    // Create the notification element
    const notification = document.createElement("div");
    notification.textContent = message;

    // Apply styles for success or failure
    notification.classList.add("remove-notification");
    notification.style.backgroundColor = success ? "red" : "red";

    // Append the notification to the body
    document.body.appendChild(notification);

    // Show the notification with animation
    setTimeout(() => {
        notification.classList.add("show");
    }, 10); // Slight delay for animation to trigger

    // Remove the notification after 3 seconds
    setTimeout(() => {
            notification.classList.remove("show");
        }, 3000); // Notification stays visible for 3 seconds
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
            <a href="{{ route('product.details', ['id' => $item->product->id]) }}">
              <img src="{{ $item->product->images->first()?->image_path ?? asset('Images/default-product.png') }}" alt="{{ $item->product->name }}">
            </a>
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

    <!-- Recommended Glasses -->
    <section class="recommendations">
      <h2>You May Also Like</h2>
      <div class="recommendation-grid">
          @foreach ($recommendedProducts as $product)
          <a href="{{ route('product.details', ['id' => $product->id]) }}">
              <div class="recommendation-card">
                  <div class="card-details">
                      @foreach($product->images as $image)
                          @if($image->imageType && $image->imageType->name == 'front')
                              <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front">
                            @break
                          @endif
                      @endforeach
                    <h3>{{ $product->name }}</h3>
                    <p>£{{ number_format($product->price, 2) }}</p>
                    <form class="add-to-cart-form" onsubmit="addToCart(event, {{ $product->id }})">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="add-to-cart">Add to Cart</button>
                    </form>
                  </div>
                </div>
              </a>
          @endforeach
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
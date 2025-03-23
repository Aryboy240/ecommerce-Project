@extends('layouts.mainLayout')

@section('extra-head')
    <script defer src="{{ asset('js/addToCart.js') }}"></script>
    <script defer src="{{ asset('js/wishlist.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/product_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wishlist.css') }}">
@endsection

@section('title', 'Wishlist')

@section('content')
<section class="wishlist-container wishlist-section">
    <div class="wishlist-header">
        <h1>Your Wishlist</h1>
        @if($wishlistItems->count() > 0)
            <p class="wishlist-count">{{ $wishlistItems->count() }} item(s)</p>
        @endif
    </div>
    
    @if($wishlistItems->count() > 0)
        <div class="table-container">
            <table class="wishlist-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Frame Name</th>
                        <th>Price</th>
                        <th>Stock Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wishlistItems as $item)
                        <tr>
                            <td class="image-cell">
                                <a href="{{ route('product.details', ['id' => $item->product->id]) }}">
                                    <img src="{{ asset($item->product->images->first()->image_path) }}" alt="{{ $item->product->name }}" class="product-thumbnail">
                                </a>
                            </td>
                            <td class="product-name-cell">
                                <a href="{{ route('product.details', ['id' => $item->product->id]) }}">
                                    {{ $item->product->name }}
                                </a>
                            </td>
                            <td class="price-cell">£{{ number_format($item->product->price, 2) }}</td>
                            <td class="stock-cell">
                                @if ($item->product->stock_quantity == 0)
                                    <span class="stock-out">Out of Stock</span>
                                @elseif ($item->product->stock_quantity < 10)
                                    <span class="stock-low">Low Stock ({{ $item->product->stock_quantity }} left)</span>
                                @else
                                    <span class="stock-in">In Stock</span>
                                @endif
                            </td>
                            <td class="action-buttons">
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="icon-btn add-to-cart-btn">
                                        Add to Cart
                                    </button>
                                </form>
                                
                                <form action="{{ route('wishlist.remove') }}" method="POST" class="wishlist-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <button type="submit" class="remove-from-wishlist">
                                        <i class="far fa-trash-alt"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="wishlist-actions">
        <a href="{{ route('search') }}"  class="continue-shopping-btn">Continue Shopping</a>
        </div>
    @else
        <div class="empty-wishlist">
            <i class="far fa-heart empty-heart"></i>
            <p>Your wishlist is empty.</p>
            <a href="{{ route('search') }}"  class="continue-shopping-btn">Explore Our Products</a>
        </div>
    @endif
</section>

<style>
    main{
        margin: 5% 0 10% 0;
    }
</style>
@endsection
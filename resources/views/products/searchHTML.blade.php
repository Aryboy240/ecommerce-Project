@extends('layouts.app')

@section('title', 'Product Search')

@section('content')
    <style>
        .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .image-item {
            max-width: 300px;
            text-align: center;
        }
        .image-item img {
            max-width: 100%;
        }
        h3, h4 {
            margin-bottom: 10px;
        }
    </style>
    <h1>Product Images</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('products.index') }}">
        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
        <button type="submit">Search</button>
        <a href="{{ route('products.index') }}" style="margin-left: 10px;">Clear</a>
    </form>

    <!-- Product Table -->
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Images</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>${{ $product->price }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                    <td>
                        <div class="image-container">
                            @foreach(['front', 'side', 'angled', 'ortho', 'case', 'model', 'model2'] as $type)
                                <div class="image-item">
                                    <h4>{{ ucfirst($type) }} Images:</h4>
                                    <div>
                                        @foreach($product->images as $image)
                                            @if($image->imageType && $image->imageType->name == $type)
                                                <div>
                                                    <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - {{ ucfirst($type) }}">
                                                    <p>Type: {{ $image->imageType->name }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
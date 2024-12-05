<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Product Images</title>
</head>
<body>
    <h1>Product Images</h1>
    <div>
        <p>Product Name: {{ $product->name }}</p>
        <p>Description: {{ $product->description }}</p>
        <p>Price: ${{ $product->price }}</p>
        <p>Stock: {{ $product->stock_quantity }}</p>
        <h3>Images:</h3>
        <div>
            @foreach($product->images as $image)
                @if($image->imageType->name == 'front') <!-- Filter images by the 'front' type -->
                    <div style="margin-bottom: 20px;">
                        <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front" style="max-width: 300px;">
                        <p>Type: {{ $image->imageType->name }}</p>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</body>
</html>

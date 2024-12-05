<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Product Images</title>
</head>
<body>
    <h1>Product Images</h1>

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
                        <h3>Images:</h3>
                        <div>
                            @foreach($product->images as $image)
                                @if($image->imageType && $image->imageType->name == 'side') <!-- Filter by image type -->
                                    <div style="margin-bottom: 20px;">
                                        <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front" style="max-width: 300px;">
                                        <p>Type: {{ $image->imageType->name }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Create Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Create New Order</h1>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Customer:</label>
                <select name="customer_id" class="form-select" required>
                    <option value="">Select Customer</option>
                    @foreach(\App\Models\Customer::all() as $customer)
                        <option value="{{ $customer->id }}">
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <h3>Products</h3>
            <div class="row">
                @foreach(\App\Models\Product::all() as $product)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           name="items[{{ $product->id }}][product_id]" 
                                           value="{{ $product->id }}">
                                    <label class="form-check-label">
                                        {{ $product->name }} - ${{ $product->price }}
                                    </label>
                                </div>
                                <div class="mt-2">
                                    <label>Quantity:</label>
                                    <input type="number" name="items[{{ $product->id }}][quantity]" 
                                           value="1" min="1" class="form-control"
                                           @if($product->stock_quantity <= 0) disabled @endif>
                                    <small class="text-muted">In stock: {{ $product->stock_quantity }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-3">Create Order</button>
        </form>
    </div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }
        .status-pending {
            background-color: #FFC107;
            color: #000;
        }
        .status-processing {
            background-color: #17A2B8;
            color: #fff;
        }
        .status-shipped {
            background-color: #007BFF;
            color: #fff;
        }
        .status-delivered {
            background-color: #28A745;
            color: #fff;
        }
        .status-cancelled {
            background-color: #DC3545;
            color: #fff;
        }
        .status-refund_requested {
            background-color: #6C757D;
            color: #fff;
        }
        .product-image {
            width: 180px;
            height: 70px;
            object-fit: contain;
            border-radius: 4px;
        }
        .product-details {
            display: flex;
            align-items: center;
        }
        .product-info {
            margin-left: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Order #{{ $order->id }}</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card mb-4">
            <div class="card-body">
                <h5>Order Information</h5>
                <p>
                    <strong>Date:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}<br>
                    <strong>Status:</strong> 
                    <span class="order-status status-{{ $order->status }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>
                
                <div class="progress mb-3" style="height: 5px;">
                    @if($order->status == 'pending')
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 25%"></div>
                    @elseif($order->status == 'processing')
                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%"></div>
                    @elseif($order->status == 'shipped')
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                    @elseif($order->status == 'delivered')
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                    @elseif($order->status == 'cancelled')
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                    @elseif($order->status == 'refund_requested')
                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 100%"></div>
                    @endif
                </div>
                
                <h5>Customer Details</h5>
                <p>
                    <strong>Name:</strong> {{ $order->user->name }}<br>
                    <strong>Email:</strong> {{ $order->user->email }}
                </p>
                
                @if($order->canBeRefunded())
                <div class="mt-3">
                    <h5>Refund Options</h5>
                    <form action="{{ route('orders.refund', $order) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to request a refund?')">
                            Request Refund
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>

        <h3>Order Items</h3>
        <div class="card mb-4">
            <div class="card-body">
                @foreach($order->items as $item)
                    <div class="row mb-3 pb-3 border-bottom">
                        <div class="col-md-8">
                            <div class="product-details">
                                @php
                                    $frontImage = null;
                                    if($item->product->images->isNotEmpty()) {
                                        foreach($item->product->images as $image) {
                                            if($image->imageType && $image->imageType->name == 'front') {
                                                $frontImage = $image;
                                                break;
                                            }
                                        }
                                        // If no front image is found, use the first image
                                        if(!$frontImage && $item->product->images->count() > 0) {
                                            $frontImage = $item->product->images->first();
                                        }
                                    }
                                @endphp
                                
                                @if($frontImage)
                                    <img src="{{ asset($frontImage->image_path) }}" alt="{{ $item->product->name }}" class="product-image">
                                @else
                                    <div class="product-image bg-light d-flex align-items-center justify-content-center">
                                        <span class="text-muted">No image</span>
                                    </div>
                                @endif
                                
                                <div class="product-info">
                                    <h5>{{ $item->product->name }}</h5>
                                    <p class="mb-0">Category: {{ $item->product->category->name ?? 'N/A' }}</p>
                                    <p class="mb-0">Price: ${{ number_format($item->price, 2) }}</p>
                                    <p class="mb-0">Quantity: {{ $item->quantity }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end d-flex align-items-center justify-content-end">
                            <div>
                                <p class="mb-0 fw-bold">Subtotal:</p>
                                <h5>${{ number_format($item->price * $item->quantity, 2) }}</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
                
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 text-end">
                        <p class="fw-bold">Order Total:</p>
                        <h4>${{ number_format($order->total_amount, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to My Orders</a>
            @if($order->status == 'refund_requested')
                <div class="alert alert-info mt-3">
                    Your refund request is being processed. We'll contact you soon.
                </div>
            @endif
        </div>
    </div>
</body>
</html>
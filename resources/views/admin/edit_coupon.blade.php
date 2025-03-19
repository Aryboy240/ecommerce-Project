<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Coupon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
</head>
<body>
    <div class="container">
        
        <nav class="sidebar">
            <div class="logo">
                <img src="{{ asset('Images/logo.png') }}" alt="Logo">
                <h2>Admin Dashboard</h2>
            </div>
            <ul class="nav-links">
                <li><a href="{{ route('adminpanel') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="{{ route('productadmin') }}"><i class="fas fa-box"></i> Products</a></li>
                <li><a href="{{ route('customers') }}"><i class="fas fa-users"></i> Customers</a></li>
                <li><a href="{{ route('AdminOrders') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                <li><a href="{{ route('adminreport') }}"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li><a href="{{ route('admin.coupons') }}" class="active"><i class="fas fa-tag"></i> Coupons</a></li>
                <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <header class="header">
                <h1>Edit Coupon</h1>
            </header>

            <section class="form-container">
                <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" class="admin-form">
                    @csrf
                    @method('PUT')
                    
                    <label for="code">Code:</label>
                    <input type="text" name="code" id="code" value="{{ $coupon->code }}" required>
                    
                    <label for="type">Type:</label>
                    <select name="type" id="type" required>
                        <option value="fixed" {{ $coupon->type == 'fixed' ? 'selected' : '' }}>Fixed</option>
                        <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : '' }}>Percentage</option>
                    </select>
                    
                    <label for="value">Value:</label>
                    <input type="number" name="value" id="value" step="0.01" value="{{ $coupon->value }}" required>
                    
                    <label for="min_cart_amount">Minimum Cart Amount:</label>
                    <input type="number" name="min_cart_amount" id="min_cart_amount" step="0.01" value="{{ $coupon->min_cart_amount }}">
                    
                    <label for="valid_from">Valid From:</label>
                    <input type="date" name="valid_from" id="valid_from" value="{{ $coupon->valid_from }}" required>
                    
                    <label for="valid_until">Valid Until:</label>
                    <input type="date" name="valid_until" id="valid_until" value="{{ $coupon->valid_until }}" required>
                    
                    <label for="usage_limit">Usage Limit:</label>
                    <input type="number" name="usage_limit" id="usage_limit" value="{{ $coupon->usage_limit }}">
                    
                    <label for="is_active">Active:</label>
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ $coupon->is_active ? 'checked' : '' }}>
                    
                    <button type="submit" class="btn-primary">Update Coupon</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
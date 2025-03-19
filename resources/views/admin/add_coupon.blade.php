<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Coupon - Admin Panel</title>
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
                <h1>Add Coupon</h1>
            </header>
            
            <main>
                <form action="{{ route('admin.coupons.store') }}" method="POST" class="form-container">
                    @csrf
                    <div class="form-group">
                        <label for="code">Code:</label>
                        <input type="text" name="code" id="code" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Type:</label>
                        <select name="type" id="type" required>
                            <option value="fixed">Fixed</option>
                            <option value="percent">Percentage</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="value">Value:</label>
                        <input type="number" name="value" id="value" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="min_cart_amount">Minimum Cart Amount:</label>
                        <input type="number" name="min_cart_amount" id="min_cart_amount" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="valid_from">Valid From:</label>
                        <input type="date" name="valid_from" id="valid_from" required>
                    </div>
                    <div class="form-group">
                        <label for="valid_until">Valid Until:</label>
                        <input type="date" name="valid_until" id="valid_until" required>
                    </div>
                    <div class="form-group">
                        <label for="usage_limit">Usage Limit:</label>
                        <input type="number" name="usage_limit" id="usage_limit">
                    </div>
                    <div class="form-group form-check">
                        <label for="is_active">Active:</label>
                        <input type="checkbox" name="is_active" id="is_active" value="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Coupon</button>
                </form>
            </main>
        </div>
    </div>
</body>
</html>

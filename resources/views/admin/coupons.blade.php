<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Coupons</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/coupon.css') }}">

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
            <header>
                <h1>Coupons</h1>
                <a href="{{ route('admin.coupons.add') }}" class="btn btn-primary">Add Coupon</a>
            </header>
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Value</th>
                        <th>Valid From</th>
                        <th>Valid Until</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->type }}</td>
                            <td>{{ $coupon->value }}</td>
                            <td>{{ $coupon->valid_from->format('Y-m-d') }}</td>
                            <td>{{ $coupon->valid_until->format('Y-m-d') }}</td>
                            <td>
                                <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
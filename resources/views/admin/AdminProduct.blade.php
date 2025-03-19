<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productpanel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation-->
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
                <li><a href="#reports"><i class="fas fa-chart-bar"></i> Reports</a></li>
                <li><a href="{{ route('admin.coupons') }}"><i class="fas fa-tag"></i> Coupons</a></li>
                <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
            </ul>
        </nav>
        <div class="main-content">

            <main class="dashboard">
                <!-- Product Management Header -->
                <div class="page-header">
                    <h1>Product Management</h1>
                    <div class="header-actions">
                        <button class="action-btn">
                            <i class="fas fa-plus"></i>
                            Add New Product
                        </button>
                        <button class="action-btn secondary">
                            <i class="fas fa-download"></i>
                            Export Products
                        </button>
                    </div>
                </div>

                <!-- Product Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-glasses"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Total Frames</h3>
                            <p class="stat-value">500</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Low Stock Frames</h3>
                            <p class="stat-value">35</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon danger">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Out of Stock</h3>
                            <p class="stat-value">12</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-details">
                            <h3>New This Month</h3>
                            <p class="stat-value">15</p>
                        </div>
                    </div>
                </div>

                <!-- Product Filters -->
                <div class="filters-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search frames...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <div class="filter-controls">
                        <select class="filter-select">
                            <option value="">All Categories</option>
                            <option value="sunglasses">Sunglasses</option>
                            <option value="eyeglasses">Eyeglasses</option>
                            <option value="sports">Sports Glasses</option>
                            <option value="kids">Kids Frames</option>
                        </select>
                        <select class="filter-select">
                            <option value="">Frame Material</option>
                            <option value="metal">Metal</option>
                            <option value="plastic">Plastic</option>
                            <option value="acetate">Acetate</option>
                            <option value="titanium">Titanium</option>
                        </select>
                        <select class="filter-select">
                            <option value="">Frame Shape</option>
                            <option value="round">Round</option>
                            <option value="square">Square</option>
                            <option value="oval">Oval</option>
                            <option value="rectangle">Rectangle</option>
                            <option value="cat-eye">Cat Eye</option>
                        </select>
                    </div>
                </div>

                <!-- Product Table -->
                <div class="table-container">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Frame Name</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Frame Material</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <img src="frame-image.jpg" alt="Frame" class="product-thumbnail">
                                </td>
                                <td>Ray-Ban Aviator</td>
                                <td>RB-3025</td>
                                <td>£129.99</td>
                                <td>
                                    <span class="stock-status in-stock">In Stock (24)</span>
                                </td>
                                <td>Sunglasses</td>
                                <td>Metal</td>
                                <td class="action-buttons">
                                    <button class="icon-btn edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="icon-btn delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button class="icon-btn view">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- More product rows... -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <span class="page-ellipsis">...</span>
                    <button class="page-btn">10</button>
                    <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
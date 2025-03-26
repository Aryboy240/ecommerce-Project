<!-- This is a child of the "views/layouts/adminLayout.balde.php" -->
@extends('layouts.adminLayout')

<!-- Any extra head content for this page in specific -->
@section('extra-head')
    <link rel="stylesheet" href="{{ asset('css/admin/order.css') }}">
@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Admin Panel')

<!-- The @yeild in adminLayout's 'content' is filled by everything in this section -->
@section('content')

    <!-- Main Content Area -->
    <div class="main-content">
        <header class="header">
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="header-right">
                <div class="notifications">
                    <button><i class="fas fa-bell"></i></button>
                </div>
                <div class="profile">
                    <i class="fas fa-user"></i>
                    <div class="dropdown">
                        <button class="dropbtn">Admin User</button>
                        <div class="dropdown-content">
                            <a href="{{ route('wallpapers') }}" class="content-1">Profile</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" id="button-off" class="content-2">
                                    <a>Logout</a>
                                </button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="dashboard">
            <div class="dashboard-header">
                <h1>Dashboard Overview</h1>
            </div>

            <!-- Quick Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Total Orders</h3>
                        <p class="stat-value">{{ $totalOrders }}</p>
                        <p class="stat-change positive">+12% from last week</p> 
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Revenue</h3>
                        <p class="stat-value">£{{ number_format($totalRevenue, 2) }}</p>
                        <p class="stat-change positive">+8% from last week</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Active Customers</h3>
                        <p class="stat-value">{{ $activeCustomers }}</p>
                        <p class="stat-change positive">+5% from last week</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Low Stock Items</h3>
                        <p class="stat-value">{{ $lowStockItems }}</p>
                        <p class="stat-change negative">Needs attention</p>
                    </div>
                </div>
            </div>


            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <button onclick="location.href='{{ route('productadmin') }}'" class="action-btn">
                        <i class="fas fa-plus"></i>
                        Add New Product
                    </button>
                    <button onclick="location.href='{{ route('AdminOrders') }}'" class="action-btn">
                        <i class="fas fa-truck"></i>
                        Process Orders
                    </button>
                    <button onclick="location.href='{{ route('productadmin') }}'" class="action-btn">
                        <i class="fas fa-boxes"></i>
                        Update Stock
                    </button>
                    <button onclick="location.href='{{ route('admin.coupons') }}'" class="action-btn">
                        <i class="fas fa-tag"></i>
                        Manage Promotions
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <div class="activity-list">
                    <!-- Activities will be loaded here dynamically -->
                </div>
            </div>
        </main>
    </div>

<script src="{{ asset('js/order.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function fetchStats() {
        $.get("{{ url('/adminpanel/stats') }}", function(data) {
            $(".stat-value:eq(0)").text(data.totalOrders);
            $(".stat-value:eq(1)").text("£" + parseFloat(data.totalRevenue).toFixed(2));
            $(".stat-value:eq(2)").text(data.activeCustomers);
            $(".stat-value:eq(3)").text(data.lowStockItems);

            // Update percentage changes dynamically
            updatePercentage($(".stat-change:eq(0)"), data.ordersChange);
            updatePercentage($(".stat-change:eq(1)"), data.revenueChange);
            updatePercentage($(".stat-change:eq(2)"), data.customersChange);
            
            // Handle low stock separately
            let lowStockElement = $(".stat-change:eq(3)");
            if (data.lowStockItems > 0) {
                lowStockElement.text("Needs attention").removeClass("positive").addClass("negative");
            } else {
                lowStockElement.text("All stocked up").removeClass("negative").addClass("positive");
            }
        });
    }

    function updatePercentage(element, percentage) {
        let sign = percentage >= 0 ? "+" : "";
        let className = percentage >= 0 ? "positive" : "negative";

        element.text(`${sign}${percentage}% from last week`)
               .removeClass("positive negative")
               .addClass(className);
    }

    setInterval(fetchStats, 5000); // Refresh every 5 seconds
</script>
<script>
    function fetchRecentActivity() {
        $.get("{{ url('/adminpanel/recent-activity') }}", function(data) {
            let activityList = $(".activity-list");
            activityList.empty(); // Clear previous activities

            // Add recent orders
            data.orders.forEach(order => {
                activityList.append(`
                    <div class="activity-item">
                        <i class="fas fa-shopping-cart"></i>
                        <div class="activity-details">
                            <p>New order #${order.id} received</p>
                            <span>${timeAgo(order.created_at)}</span>
                        </div>
                    </div>
                `);
            });

            // Add low stock alerts
            data.lowStock.forEach(product => {
                activityList.append(`
                    <div class="activity-item">
                        <i class="fas fa-exclamation-triangle" style="color: red;"></i>
                        <div class="activity-details">
                            <p>Low stock alert: ${product.name}</p>
                            <span>${timeAgo(product.updated_at)}</span>
                        </div>
                    </div>
                `);
            });

            // Add new customer registrations
            data.newUsers.forEach(user => {
                activityList.append(`
                    <div class="activity-item">
                        <i class="fas fa-user" style="color: green;"></i>
                        <div class="activity-details">
                            <p>New customer registration: ${user.name}</p>
                            <span>${timeAgo(user.created_at)}</span>
                        </div>
                    </div>
                `);
            });
        });
    }

    function timeAgo(datetime) {
        let time = new Date(datetime);
        let now = new Date();
        let diff = Math.floor((now - time) / 1000); // Difference in seconds

        if (diff < 60) return `${diff} seconds ago`;
        let minutes = Math.floor(diff / 60);
        if (minutes < 60) return `${minutes} minutes ago`;
        let hours = Math.floor(minutes / 60);
        if (hours < 24) return `${hours} hours ago`;
        let days = Math.floor(hours / 24);
        return `${days} days ago`;
    }

    setInterval(fetchRecentActivity, 5000); // Refresh every 5 seconds because too many requests bad 💥
</script>
<style>
    .positive {
    color: green;
    }

    .negative {
        color: red;
    }
</style>
@endsection

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
                            <a href="{{ route('adminprofile') }}">Profile</a>
                            <a href="javascript:void(0);" onclick="openLogoutModal()">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="dashboard">
            <div class="dashboard-header">
                <h1>Dashboard Overview</h1>
                <div class="date-filter">
                    <input type="date" id="startDate">
                    <span>to</span>
                    <input type="date" id="endDate">
                </div>
            </div>

            <!-- Quick Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Total Orders</h3>
                        <p class="stat-value">156</p>
                        <p class="stat-change positive">+12% from last week</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Revenue</h3>
                        <p class="stat-value">£25,430</p>
                        <p class="stat-change positive">+8% from last week</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Active Customers</h3>
                        <p class="stat-value">892</p>
                        <p class="stat-change positive">+5% from last week</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Low Stock Items</h3>
                        <p class="stat-value">12</p>
                        <p class="stat-change negative">Needs attention</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="quick-actions">
                <h2>Quick Actions</h2>
                <div class="action-buttons">
                    <button class="action-btn">
                        <i class="fas fa-plus"></i>
                        Add New Product
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-truck"></i>
                        Process Orders
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-boxes"></i>
                        Update Stock
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-tag"></i>
                        Manage Promotions
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="recent-activity">
                <h2>Recent Activity</h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <i class="fas fa-shopping-cart"></i>
                        <div class="activity-details">
                            <p>New order #1234 received</p>
                            <span>2 minutes ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div class="activity-details">
                            <p>Low stock alert: Product XYZ</p>
                            <span>15 minutes ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-user"></i>
                        <div class="activity-details">
                            <p>New customer registration</p>
                            <span>1 hour ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script src="{{ asset('js/order.js') }}"></script>
@endsection

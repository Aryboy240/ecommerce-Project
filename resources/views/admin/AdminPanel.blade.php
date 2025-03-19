<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin Dashboard </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
        <link rel="stylesheet" href="{{ asset('css/order.css') }}">
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
                    <li><a href="{{ route('adminreport') }}"><i class="fas fa-chart-bar"></i> Reports</a></li>
                    <li><a href="{{ route('admin.coupons') }}"><i class="fas fa-tag"></i> Coupons</a></li>
                    <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>

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
        </div>

        <!-- Logout Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLogoutModal()">&times;</span>
            <h2>Confirm Logout</h2>
            <p>Are you sure you want to log out?</p>
            <p>Logged in as <strong>Admin User</strong>.</p>
            <div class="modal-actions">
                <button class="btn-primary" onclick="logout()">Confirm Logout</button>
                <button class="btn-secondary" onclick="closeLogoutModal()">Cancel</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/order.js') }}"></script>
    </body>
</html>
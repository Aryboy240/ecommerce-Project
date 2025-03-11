<!--
    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Front end for the User Account page (for logged-in users)

    Developer: Aryan Kora
    University ID: 230059030
    Function: Front end improvements
-->

<html lang="en">

<head>
    <link rel="stylesheet" href={{  asset('css/account.css') }}>
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Account')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')

<!-- Add this right after the opening body tag -->
<div class="toast-container"></div>

<!-- Add this before closing body tag -->
<div class="modal-overlay" id="confirmationModal">
    <div class="modal">
        <div class="modal-header">
            <i class="fas fa-exclamation-circle"></i>
            <h3 id="modalTitle">Confirm Action</h3>
        </div>
        <div class="modal-content" id="modalMessage">
            Are you sure you want to proceed with this action?
        </div>
        <div class="modal-actions">
            <button class="cancel-btn" onclick="closeModal()">Cancel</button>
            <button class="confirm-btn" id="confirmButton">Confirm</button>
        </div>
    </div>
</div>

<!-- Account page -->
<section class="main-account-section">
    <div class="account-wrapper">
        <div class="account-container">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-item active" data-tab="account">
                    <i class="fa-regular fa-user"></i>
                    <span>Account</span>
                </div>
                <div class="sidebar-item" data-tab="personal-info">
                    <i class="fa-regular fa-address-card"></i>
                    <span>Personal info</span>
                </div>
                <div class="sidebar-item" data-tab="purchases">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Purchases</span>
                </div>
                <div class="sidebar-item" data-tab="notifications">
                    <i class="fa-regular fa-bell"></i>
                    <span>Notifications</span>
                </div>
                <div class="sidebar-item" data-tab="privacy">
                    <i class="fa-regular fa-eye"></i>
                    <span>Privacy & sharing</span>
                </div>
                <div class="sidebar-item" data-tab="preferences">
                    <i class="fa-solid fa-sliders"></i>
                    <span>Global preferences</span>
                </div>
                <div class="sidebar-item" data-tab="accessibility">
                    <i class="fa-solid fa-universal-access"></i>
                    <span>Accessibility</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" id="button-off">
                        <div class="sidebar-item" data-tab="signOut">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            <span>Sign out</span>
                        </div>
                    </button>
                </form>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success')}}</div>
                @endif

                <!-- Account Tab -->
                <div class="tab-content active" id="account">
                    <div class="welcome-message">
                        <h1 >Welcome, {{ auth()->user()->name }}</h1>
                    </div>
                    
                    <div class="section-header">
                        <i class="fa-regular fa-user"></i>
                        <h2>Account Overview</h2>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-value">5</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">£249</div>
                            <div class="stat-label">Total Spent</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">2</div>
                            <div class="stat-label">Active Orders</div>
                        </div>
                    </div>
                    
                    <h2>Login & Security</h2>
                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Username</h4>
                        </div>
                        <div class="form-content">
                            <form id="username-form">
                                <div class="input-group">
                                    <input type="text" placeholder="New username">
                                </div>
                                <div class="input-group">
                                    <input type="password" placeholder="Current password">
                                </div>
                                <button type="submit">Update Username</button>
                            </form>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Password</h4>
                        </div>
                        <div class="form-content">
                            <form id="password-form">
                                <div class="input-group">
                                    <input type="password" placeholder="Current password">
                                </div>
                                <div class="input-group">
                                    <input type="password" placeholder="New password">
                                </div>
                                <div class="input-group">
                                    <input type="password" placeholder="Confirm new password">
                                </div>
                                <button type="submit">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Personal Info Tab -->
                <div class="tab-content" id="personal-info">
                    <h2>Personal Information</h2>
                    <div class="profile-info">
                        <form id="personal-info-form">
                            <div class="input-group">
                                <label>Full Name</label>
                                <input type="text" placeholder="Your full name">
                            </div>
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" placeholder="Your email">
                            </div>
                            <div class="input-group">
                                <label>Date of Birth</label>
                                <input type="date">
                            </div>
                            <button type="submit">Save Changes</button>
                        </form>
                    </div>
                </div>

                <!-- Purchases Tab -->
                <div class="tab-content" id="purchases">
                    <div class="section-header">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <h2>Your Purchases</h2>
                    </div>

                    <div class="purchase-history">
                        <!-- Purchase Item 1 -->
                        <div class="purchase-item">
                            <div class="purchase-header" onclick="togglePurchase(this)">
                                <h4>
                                    <i class="fa-solid fa-box"></i>
                                    Order #12345
                                </h4>
                                <div class="purchase-meta">
                                    <span class="purchase-date">March 15, 2024</span>
                                    <i class="fas fa-chevron-down expand-icon"></i>
                                </div>
                            </div>
                            <div class="purchase-details">
                                <div class="product-info">
                                    <img src="{{ asset('images/glasses1.jpg') }}" alt="Product" class="product-thumbnail">
                                    <div class="product-text">
                                        <h5>Ray-Ban Aviator Classic</h5>
                                        <p>Color: Gold</p>
                                        <p>Quantity: 1</p>
                                    </div>
                                </div>
                                <div class="purchase-status">
                                    <span class="status-badge delivered">Delivered</span>
                                    <span class="purchase-price">£129.99</span>
                                </div>
                            </div>
                        </div>

                        <!-- Purchase Item 2 -->
                        <div class="purchase-item">
                            <div class="purchase-header" onclick="togglePurchase(this)">
                                <h4>
                                    <i class="fa-solid fa-box"></i>
                                    Order #12346
                                </h4>
                                <div class="purchase-meta">
                                    <span class="purchase-date">March 10, 2024</span>
                                    <i class="fas fa-chevron-down expand-icon"></i>
                                </div>
                            </div>
                            <div class="purchase-details">
                                <div class="product-info">
                                    <img src="{{ asset('images/glasses2.jpg') }}" alt="Product" class="product-thumbnail">
                                    <div class="product-text">
                                        <h5>Oakley Holbrook</h5>
                                        <p>Color: Matte Black</p>
                                        <p>Quantity: 1</p>
                                    </div>
                                </div>
                                <div class="purchase-status">
                                    <span class="status-badge processing">Processing</span>
                                    <span class="purchase-price">£119.99</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-container billing-address">
                        <h3>Billing Address</h3>
                        <form class="billing-form">
                            <div class="form-row">
                                <div class="input-group">
                                    <label>Street Address</label>
                                    <input type="text" placeholder="123 Main St">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-group">
                                    <label>City</label>
                                    <input type="text" placeholder="City">
                                </div>
                                <div class="input-group">
                                    <label>Postcode</label>
                                    <input type="text" placeholder="Postcode">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-group">
                                    <label>County</label>
                                    <input type="text" placeholder="County">
                                </div>
                                <div class="input-group">
                                    <label>Country</label>
                                    <input type="text" placeholder="Country">
                                </div>
                            </div>
                            <button type="submit" class="save-address-btn">Save Address</button>
                        </form>
                    </div>
                </div>

                <!-- Notifications Tab -->
                <div class="tab-content" id="notifications">
                    <div class="section-header">
                        <i class="fa-regular fa-bell"></i>
                        <h2>Notification Preferences</h2>
                    </div>

                    <div class="notification-groups">
                        <!-- Order Updates -->
                        <div class="notification-group">
                            <h4>Order & Shipping</h4>
                            <div class="notification-items">
                                <div class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fa-solid fa-truck"></i>
                                    </div>
                                    <div class="notification-content">
                                        <h5>Order Status Updates</h5>
                                        <p>Stay informed about your order's journey from purchase to delivery.</p>
                                    </div>
                                    <label class="toggle">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Promotional Updates -->
                        <div class="notification-group">
                            <h4>Promotions & Offers</h4>
                            <div class="notification-items">
                                <div class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fa-solid fa-tag"></i>
                                    </div>
                                    <div class="notification-content">
                                        <h5>Promotional Offers & Discounts</h5>
                                        <p>Be the first to know about exclusive discounts, limited-time offers, and seasonal sales!</p>
                                    </div>
                                    <label class="toggle">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>

                                <div class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fa-solid fa-gift"></i>
                                    </div>
                                    <div class="notification-content">
                                        <h5>Birthday & Anniversary Alerts</h5>
                                        <p>We'd love to celebrate with you! Receive special discounts or offers on your special days.</p>
                                    </div>
                                    <label class="toggle">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Product Updates -->
                        <div class="notification-group">
                            <h4>Product Updates</h4>
                            <div class="notification-items">
                                <div class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fa-solid fa-box-open"></i>
                                    </div>
                                    <div class="notification-content">
                                        <h5>Back in Stock Alerts</h5>
                                        <p>Never miss your favorite items again! Get notified when out-of-stock products are available.</p>
                                    </div>
                                    <label class="toggle">
                                        <input type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>

                                <div class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                    <div class="notification-content">
                                        <h5>Review Requests</h5>
                                        <p>We'd love to hear your feedback! Get notified when it's time to rate your recent purchase.</p>
                                    </div>
                                    <label class="toggle">
                                        <input type="checkbox" checked>
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Privacy & Sharing Tab -->
                <div class="tab-content" id="privacy">
                    <div class="section-header">
                        <i class="fa-regular fa-eye"></i>
                        <h2>Privacy & Sharing</h2>
                    </div>

                    <div class="privacy-grid">
                        <!-- Profile Visibility -->
                        <div class="privacy-option">
                            <div class="privacy-option-header">
                                <div>
                                    <h4>Profile Visibility</h4>
                                    <p class="privacy-description">Control who can see your profile information</p>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="privacy-settings">
                                <select class="privacy-select">
                                    <option value="public">Public</option>
                                    <option value="private">Private</option>
                                    <option value="friends">Friends Only</option>
                                </select>
                            </div>
                        </div>

                        <!-- Data Usage -->
                        <div class="privacy-option">
                            <div class="privacy-option-header">
                                <div>
                                    <h4>Data Usage & Analytics</h4>
                                    <p class="privacy-description">Manage how we use your data to improve our services</p>
                                </div>
                                <label class="toggle">
                                    <input type="checkbox" checked>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </div>

                        <!-- Marketing Preferences -->
                        <div class="privacy-option">
                            <div class="privacy-option-header">
                                <div>
                                    <h4>Marketing Communications</h4>
                                    <p class="privacy-description">Control which marketing communications you receive</p>
                                </div>
                            </div>
                            <div class="marketing-options">
                                <div class="checkbox-group">
                                    <label>
                                        <input type="checkbox" checked>
                                        Email Newsletters
                                    </label>
                                </div>
                                <div class="checkbox-group">
                                    <label>
                                        <input type="checkbox" checked>
                                        Product Updates
                                    </label>
                                </div>
                                <div class="checkbox-group">
                                    <label>
                                        <input type="checkbox">
                                        Special Offers
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Connected Services -->
                        <div class="privacy-option">
                            <div class="privacy-option-header">
                                <div>
                                    <h4>Connected Services</h4>
                                    <p class="privacy-description">Manage third-party services connected to your account</p>
                                </div>
                            </div>
                            <div class="connected-services">
                                <div class="service-item">
                                    <i class="fab fa-google"></i>
                                    <span>Google</span>
                                    <button class="disconnect-btn">Disconnect</button>
                                </div>
                                <div class="service-item">
                                    <i class="fab fa-facebook"></i>
                                    <span>Facebook</span>
                                    <button class="connect-btn">Connect</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Global Preferences Tab -->
                <div class="tab-content" id="preferences">
                    <div class="section-header">
                        <i class="fa-solid fa-sliders"></i>
                        <h2>Global Preferences</h2>
                    </div>

                    <div class="preferences-grid">
                        <!-- Language & Region -->
                        <div class="preference-group">
                            <h4>Language & Region</h4>
                            <div class="option-group">
                                <label>Language</label>
                                <select>
                                    <option>English (UK)</option>
                                    <option>English (US)</option>
                                    <option>French</option>
                                    <option>German</option>
                                    <option>Spanish</option>
                                </select>
                            </div>
                            <div class="option-group">
                                <label>Time Zone</label>
                                <select>
                                    <option>GMT (London)</option>
                                    <option>CET (Paris, Berlin)</option>
                                    <option>EST (New York)</option>
                                    <option>PST (Los Angeles)</option>
                                </select>
                            </div>
                            <div class="option-group">
                                <label>Date Format</label>
                                <select>
                                    <option>DD/MM/YYYY</option>
                                    <option>MM/DD/YYYY</option>
                                    <option>YYYY-MM-DD</option>
                                </select>
                            </div>
                        </div>

                        <!-- Communication -->
                        <div class="preference-group">
                            <h4>Communication</h4>
                            <div class="option-group">
                                <label>Preferred Contact Method</label>
                                <select>
                                    <option>Email</option>
                                    <option>SMS</option>
                                    <option>Both</option>
                                </select>
                            </div>
                        </div>

                        <!-- Display -->
                        <div class="preference-group">
                            <h4>Display Settings</h4>
                            <div class="option-group">
                                <label>Theme</label>
                                <select>
                                    <option>System Default</option>
                                    <option>Light Mode</option>
                                    <option>Dark Mode</option>
                                </select>
                            </div>
                            <div class="option-group">
                                <label>
                                    <input type="checkbox" checked>
                                    Show Order History
                                </label>
                            </div>
                            <div class="option-group">
                                <label>
                                    <input type="checkbox" checked>
                                    Show Price in List View
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Accessibility Tab -->
                <div class="tab-content" id="accessibility">
                    <div class="section-header">
                        <i class="fa-solid fa-universal-access"></i>
                        <h2>Accessibility</h2>
                    </div>

                    <div class="accessibility-grid">
                        <!-- Visual Preferences -->
                        <div class="accessibility-option">
                            <h4>Visual Preferences</h4>
                            <div class="option-group">
                                <label>Text Size</label>
                                <div class="text-size-controls">
                                    <button class="size-btn">A-</button>
                                    <span class="current-size">100%</span>
                                    <button class="size-btn">A+</button>
                                </div>
                            </div>
                            <div class="option-group">
                                <label>Contrast</label>
                                <select>
                                    <option>Default</option>
                                    <option>High Contrast</option>
                                    <option>Low Contrast</option>
                                </select>
                            </div>
                            <div class="option-group">
                                <label>
                                    <input type="checkbox">
                                    Reduce Motion
                                </label>
                            </div>
                        </div>

                        <!-- Reading Preferences -->
                        <div class="accessibility-option">
                            <h4>Reading Preferences</h4>
                            <div class="option-group">
                                <label>Font Family</label>
                                <select>
                                    <option>Default</option>
                                    <option>OpenDyslexic</option>
                                    <option>Arial</option>
                                    <option>Times New Roman</option>
                                </select>
                            </div>
                            <div class="option-group">
                                <label>Line Spacing</label>
                                <select>
                                    <option>Normal</option>
                                    <option>Relaxed</option>
                                    <option>Spacious</option>
                                </select>
                            </div>
                        </div>

                        <!-- Navigation Preferences -->
                        <div class="accessibility-option">
                            <h4>Navigation Preferences</h4>
                            <div class="option-group">
                                <label>
                                    <input type="checkbox">
                                    Enable Keyboard Navigation
                                </label>
                            </div>
                            <div class="option-group">
                                <label>
                                    <input type="checkbox">
                                    Screen Reader Optimization
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sign Out Message -->
                <div class="tab-content active" id="signOut">
                    <div class="welcome-message">
                        <h1 >Welcome, {{ auth()->user()->name }}</h1>
                    </div>
                    
                    <div class="section-header">
                        <i class="fa-regular fa-user"></i>
                        <h2>Account Overview</h2>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-value">5</div>
                            <div class="stat-label">Total Orders</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">£249</div>
                            <div class="stat-label">Total Spent</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-value">2</div>
                            <div class="stat-label">Active Orders</div>
                        </div>
                    </div>
                    
                    <h2>Login & Security</h2>
                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Username</h4>
                        </div>
                        <div class="form-content">
                            <form id="username-form">
                                <div class="input-group">
                                    <input type="text" placeholder="New username">
                                </div>
                                <div class="input-group">
                                    <input type="password" placeholder="Current password">
                                </div>
                                <button type="submit">Update Username</button>
                            </form>
                        </div>
                    </div>

                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Password</h4>
                        </div>
                        <div class="form-content">
                            <form id="password-form">
                                <div class="input-group">
                                    <input type="password" placeholder="Current password">
                                </div>
                                <div class="input-group">
                                    <input type="password" placeholder="New password">
                                </div>
                                <div class="input-group">
                                    <input type="password" placeholder="Confirm new password">
                                </div>
                                <button type="submit">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching functionality
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const tabContents = document.querySelectorAll('.tab-content');

    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            const tabId = this.dataset.tab;
            
            // Remove active class from all items
            sidebarItems.forEach(si => si.classList.remove('active'));
            tabContents.forEach(tc => tc.classList.remove('active'));
            
            // Add active class to clicked item and corresponding tab
            this.classList.add('active');
            document.getElementById(tabId)?.classList.add('active');
        });
    });
});

// Toast notification function
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
        <span>${message}</span>
    `;
    
    document.querySelector('.toast-container').appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Confirmation modal functions
function showModal(title, message, onConfirm) {
    const modal = document.getElementById('confirmationModal');
    const modalTitle = document.getElementById('modalTitle');
    const modalMessage = document.getElementById('modalMessage');
    const confirmButton = document.getElementById('confirmButton');
    
    modalTitle.textContent = title;
    modalMessage.textContent = message;
    modal.classList.add('active');
    
    confirmButton.onclick = () => {
        onConfirm();
        closeModal();
    };
}

function closeModal() {
    document.getElementById('confirmationModal').classList.remove('active');
}

// Update form submissions
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        showModal(
            'Confirm Update',
            'Are you sure you want to save these changes?',
            () => {
                // Here you would normally submit the form
                showToast('Changes saved successfully!');
            }
        );
    });
});

// Sign out confirmation
document.querySelector('form[action="{{ route("logout") }}"]').addEventListener('submit', function(e) {
    e.preventDefault();
    
    showModal(
        'Confirm Sign Out',
        'Are you sure you want to sign out?',
        () => {
            this.submit();
        }
    );
});

// Add this to your existing JavaScript
function togglePurchase(header) {
    const purchaseItem = header.closest('.purchase-item');
    purchaseItem.classList.toggle('expanded');
}
</script>
@endsection

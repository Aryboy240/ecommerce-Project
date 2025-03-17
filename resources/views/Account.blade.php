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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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
                        <div class="sidebar-item">
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

                    <!-- Update Username -->
                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Username</h4>
                        </div>
                        <div class="form-content">
                            <form id="username-form">
                                <div class="input-group">
                                    <input type="text" name="new_username" placeholder="New username">
                                    <span id="username-error" class="error-message"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="current_password" placeholder="Current password">
                                    <span id="password-error" class="error-message"></span>
                                </div>
                                <button type="submit">Update Username</button>
                            </form>
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="form-container">
                        <div class="form-title">
                            <h4>Update Password</h4>
                        </div>
                        <div class="form-content">
                            <form id="password-form">
                                <div class="input-group">
                                    <input type="password" name="current_password" placeholder="Current password">
                                    <span id="current-password-error" class="error-message"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="new_password" placeholder="New password">
                                    <span id="new-password-error" class="error-message"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="confirm_new_password" placeholder="Confirm new password">
                                    <span id="confirm-password-error" class="error-message"></span>
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
                            @csrf
                            <div class="input-group">
                                <label>Full Name</label>
                                <input type="text" id="fullName" name="fullName" value="{{ auth()->user()->fullName }}" required>
                            </div>
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="input-group">
                                <label>Date of Birth</label>
                                <input type="date" id="birthday" name="birthday" value="{{ auth()->user()->birthday->format('Y-m-d') }}" required>
                            </div>
                            <button type="submit">Save Changes</button>
                            <p id="updateMessage" style="display: none;"></p>
                        </form>
                    </div>
                </div>


                <!-- Purchases Tab -->
                <div class="tab-content" id="purchases">
                    <div class="section-header">
                        <i class="fa-solid fa-bag-shopping"></i>
                        <h2>Your Purchases</h2>
                    </div>

                    <div class="purchase-history" style="width: 25% !important">
                        <a href="{{ route('orders.index') }}" class="btn-order"><span>See Previous Orders</span></a>
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
                if (this.closest('form')) return; // Prevent sign-out button from acting as a tab switcher
    
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
    
    // Handle username update form submission
document.getElementById('username-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const newUsername = event.target.querySelector('input[name="new_username"]').value.trim();
    const currentPassword = event.target.querySelector('input[name="current_password"]').value;
    
    // Clear previous errors
    document.getElementById('username-error').textContent = '';
    document.getElementById('password-error').textContent = '';

    let isValid = true;

    // Frontend validation checks for username
    if (newUsername.length < 3 || newUsername.length > 15) {
        document.getElementById('username-error').textContent = 'Username must be 3-15 characters.';
        isValid = false;
    } else if (!/^[a-zA-Z0-9]+$/.test(newUsername)) {
        document.getElementById('username-error').textContent = 'Username must be alphanumeric.';
        isValid = false;
    }

    // Frontend validation for password input
    if (currentPassword === '') {
        document.getElementById('password-error').textContent = 'Current password is required.';
        isValid = false;
    }

    if (!isValid) return; // Stop if validation fails

    showModal(
        'Confirm Update',
        'Are you sure you want to update your username?',
        () => {
            fetch('/update-username', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    new_username: newUsername,
                    password: currentPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Username updated successfully!');
                } else {
                    document.getElementById('username-error').textContent = data.message;
                }
            });
        }
    );
});

// Handle password update form submission
document.getElementById('password-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const currentPassword = event.target.querySelector('input[name="current_password"]').value;
    const newPassword = event.target.querySelector('input[name="new_password"]').value;
    const confirmPassword = event.target.querySelector('input[name="confirm_new_password"]').value;

    // Clear previous errors
    document.getElementById('current-password-error').textContent = '';
    document.getElementById('new-password-error').textContent = '';
    document.getElementById('confirm-password-error').textContent = '';

    let isValid = true;

    // Validate current password
    if (currentPassword === '') {
        document.getElementById('current-password-error').textContent = 'Current password is required.';
        isValid = false;
    }

    // Validate new password
    if (newPassword.length < 8 || newPassword.length > 25) {
        document.getElementById('new-password-error').textContent = 'Password must be between 8-25 characters.';
        isValid = false;
    }

    // Check if passwords match
    if (newPassword !== confirmPassword) {
        document.getElementById('confirm-password-error').textContent = 'Passwords do not match.';
        isValid = false;
    }

    if (!isValid) return; // Stop if validation fails

    showModal(
        'Confirm Update',
        'Are you sure you want to update your password?',
        () => {
            fetch('/update-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    current_password: currentPassword,
                    new_password: newPassword,
                    new_password_confirmation: confirmPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Password updated successfully!');
                } else {
                    document.getElementById('current-password-error').textContent = data.message;
                }
            });
        }
    );
});

document.getElementById('personal-info-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    let formData = new FormData(this);
    let updateMessage = document.getElementById('updateMessage');

    fetch("{{ route('update.personal.info') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateMessage.textContent = data.success;
            updateMessage.style.color = "green";
        } else {
            updateMessage.textContent = data.error;
            updateMessage.style.color = "red";
        }
        updateMessage.style.display = "block";
    })
    .catch(error => {
        updateMessage.textContent = "An error occurred!";
        updateMessage.style.color = "red";
        updateMessage.style.display = "block";
    });
});

</script>
@endsection

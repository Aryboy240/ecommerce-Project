<!--
    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Front end for the Customers page (for admins)
-->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Customer Management </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customers.css') }}">
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
            <li><a href="{{ route('orders') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="#reports"><i class="fas fa-chart-bar"></i> Reports</a></li>
            <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
        </ul>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Search customers..." class="search-input">
            <button class="search-button">Search</button>
        </div>

        <!-- Customer Table Section -->
        <section class="customer-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>D.O.B</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Rows for Customer Data -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>johndoe@gmail.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <button class="btn btn-view">View</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <button class="btn btn-view">View</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Emily Wilson</td>
                        <td>emilywilson@outlook.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <button class="btn btn-view">View</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Michael Johnson</td>
                        <td>michaeljohnson@outlook.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <button class="btn btn-view">View</button>
                            <button class="btn btn-delete">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>

    <!-- Customer Details Panel (Hidden until 'View' is clicked) -->
    <div class="customer-details-panel">
        <div class="details-header">
            <h2>Edit Customer</h2>
            <!-- Close Button -->
            <span class="close-btn">&times;</span>
        </div>

        <!-- Editable Customer Info --> 
        <div class="customer-info">

            <!-- Full Name Field -->
            <div class="info-field">
                <label>Full Name:</label>
                <div class="detail-view">
                    <span id="fullNameText">John Doe</span>
                    <input type="text" id="fullNameInput" class="hidden" value="John Doe">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-save hidden" >Save Changes</button>
                </div>
            </div>

            <!-- Email Field --> 
            <div class="info-field">
                <label>Email:</label>
                <div class="detail-view">
                    <span id="emailText">johndoe@gmail.com</span>
                    <input type="email" id="emailInput" class="hidden" value="johndoe@gmail.com">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-save hidden">Save Changes</button>
                </div>
            </div>

            <!-- D.O.B Field -->
            <div class="info-field">
                <label>Date of Birth:</label>
                <div class="detail-view">
                    <span id="dobText">dd/mm/yyyy</span>
                    <input type="date" id="dobInput" class="hidden" value="dd/mm/yyyy">
                    <button class="btn btn-edit">Edit</button>
                    <button class="btn btn-save hidden">Save Changes</button>
                </div>
            </div>

        </div>

        <!-- Customer Orders -->
        <div class="order-list">
            <h3>Orders</h3>
            <div class="order-item">
                <p><strong>Order #12345</strong></p>
                <p>Ray-Ban Aviator Classic - £129.99</p>
                <div class="order-status-row">
                    <!-- Order Status Dropdown -->
                    <select class="order-status">
                        <option value="Pending">Pending</option>
                        <option value="Dispatched">Dispatched</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    <button class="btn btn-save">Save Changes</button>
                </div>
            </div>

            <div class="order-item">
                <p><strong>Order #12346</strong></p>
                <p>Adidas Sunglasses - £199.99</p>
                <div class="order-status-row">  
                    <!-- Order Status Dropdown -->
                    <select class="order-status">
                        <option value="Pending">Pending</option>
                        <option value="Dispatched">Dispatched</option>
                        <option value="Delivered">Delivered</option>
                    </select>
                    <button class="btn btn-save">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->  
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Confirm Deletion</h2>
            <p>Please enter your password to delete this user.</p>
            <input type="password" placeholder="Enter password">
            <button class="btn btn-delete">Delete</button>
        </div>
    </div>
</div>

<!-- Link to JavaScript File -->
<script src="{{ asset('js/customers.js') }}"></script>

</body>
</html>
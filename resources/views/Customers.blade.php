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

    <div class="main-content">
        <div class="search-bar">
            <input type="text" placeholder="Search customers..." class="search-input">
            <button class="search-button">Search</button>
        </div>
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
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>johndoe@gmail.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <a href="" class="btn btn-view">View</a>
                            <a href="" class="btn btn-add">Edit</a>
                            <a href="" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>janesmith@example.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <a href="" class="btn btn-view">View</a>
                            <a href="" class="btn btn-add">Edit</a>
                            <a href="" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Emily Wilson</td>
                        <td>emilywilson@outlook.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <a href="" class="btn btn-view">View</a>
                            <a href="" class="btn btn-add">Edit</a>
                            <a href="" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Michael Johnson</td>
                        <td>michaeljohnson@outlook.com</td>
                        <td>dd/mm/yyyy</td>
                        <td class="actions">
                            <a href="" class="btn btn-view">View</a>
                            <a href="" class="btn btn-add">Edit</a>
                            <a href="" class="btn btn-delete">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>

<!-- View Modal -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="">&times;</span>
        <h2>Customer Details</h2>
        <p><strong>Name:</strong> John Doe</p>
        <p><strong>Email:</strong> johndoe@gmail.com</p>
        <p><strong>D.O.B:</strong> dd/mm/yyyy</p>
        <button class="btn-edit" onclick="">Edit</button>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="">&times;</span>
        <h2>Edit Customer</h2>
        <input type="text" placeholder="Name">
        <input type="email" placeholder="Email">
        <input type="number" placeholder="Orders">
        <input type="date" placeholder="dd/mm/yyyy">
        <button class="btn-save">Save Changes</button>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Please enter your password to delete this user.</p>
        <input type="password" placeholder="Enter password">
        <button class="btn-cancel" onclick="">Cancel</button>
        <button class="btn-delete">Delete</button>
    </div>
</div>

</body>
</html>
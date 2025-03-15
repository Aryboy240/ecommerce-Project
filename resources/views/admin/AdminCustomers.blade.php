<!--
    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Front end for the Customers page (for admins)
-->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <li><a href="{{ route('AdminOrders') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
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
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>D.O.B</th>
                        <th>Account Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- Admin Users Table -->
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Display the index number -->
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->fullName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birthday->format('d/m/Y') }}</td> <!-- Format DOB as dd/mm/yyyy -->
                            <td><span class="role-badge {{ $user->is_admin ? 'admin' : 'customer' }}">
                                {{ $user->is_admin ? 'Admin' : 'Customer' }}
                            </span></td>
                            <td class="actions">
                                <a href="#" class="btn btn-edit" data-id="{{ $user->id }}">Edit</a>
                                <form action="{{ route('deleteuser', $user->id) }}" method="post" style="margin-bottom: 0" id="delete-form-{{ $user->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-delete" data-id="{{ $user->id }}" onclick="openDeleteModal({{ $user->id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Edit Customer</h2>
        <form id="edit-form">
            @csrf
            <div class="input-group">
                <label>Full Name</label>
                <input type="text" id="edit-fullName" name="fullName">
            </div>
            <div class="input-group">
                <label>Username</label>
                <input type="text" id="edit-name" name="name" required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" id="edit-email" name="email" required>
            </div>
            <div class="input-group">
                <label>Date of Birth</label>
                <input type="date" id="edit-birthday" name="birthday" required>
            </div>
            <div class="input-group">
                <label>
                    <input type="checkbox" id="edit-is-admin" name="is_admin">
                    Make Admin
                </label>
            </div>            
            <input type="hidden" id="edit-user-id"> <!-- Hidden field for user ID -->
            <button type="submit" class="btn btn-save">Save Changes</button>
            <button type="button" class="btn btn-cancel">Cancel</button>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeDeleteModal()">&times;</span>
        <h2>Confirm Deletion</h2>
        <p>Are you sure you'd like to delete this user?</p>
        <button class="btn btn-confirmDelete" id="confirmDeleteBtn">Delete</button>
        <button class="btn btn-cancel" onclick="closeDeleteModal()">Cancel</button>
    </div>
</div>

<script src="{{ asset('js/customers.js') }}"></script>

<script>
    let currentUserId = null;

    // Open the delete modal
    function openDeleteModal(userId) {
        currentUserId = userId;  // Set the current user ID to be deleted
        document.getElementById('deleteModal').style.display = 'flex'; // Show the modal
    }

    // Close the delete modal
    function closeDeleteModal() {
        document.getElementById('deleteModal').style.display = 'none'; // Hide the modal
        currentUserId = null; // Reset the user ID
    }

    // Confirm the deletion and submit the form
    document.getElementById('confirmDeleteBtn').onclick = function() {
        if (currentUserId !== null) {
            document.getElementById('delete-form-' + currentUserId).submit(); // Submit the form to delete the user
        }
        closeDeleteModal(); // Close the modal after the action
    }
</script>
</body>
</html>
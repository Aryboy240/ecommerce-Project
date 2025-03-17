<!--
    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Front end for the Customers page (for admins)
-->

<!-- This is a child of the "views/layouts/adminLayout.balde.php" -->
@extends('layouts.adminLayout')

<!-- Any extra head content for this page in specific -->
@section('extra-head')
    <link rel="stylesheet" href="{{ asset('css/admin/customers.css') }}">
@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Admin Users')

<!-- The @yeild in adminLayout's 'content' is filled by everything in this section -->
@section('content')


<div class="main-content">
    <div class="page-header">
        <h1>Customer Accounts</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search customers..." class="search-input">
            <button class="search-button">Search</button>
            <div class="create-user-btn">
                <button id="openCreateUserModal" class="btn btn-primary">+ Create User</button>
            </div>
        </div>
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

<!-- Create Modal -->
<div id="createUserModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Create New User</h2>
        <form id="createUserForm">
            @csrf
            <label for="name">Username</label>
            <input type="text" id="name" name="name" required />

            <label for="fullName">Full Name</label>
            <input type="text" id="fullName" name="fullName" required />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required />

            <label for="birthday">Birthday</label>
            <input type="date" id="birthday" name="birthday" required />

            <label for="role">Role</label>
            <select id="role" name="role">
                <option value="0">Customer</option>
                <option value="1">Admin</option>
            </select>

            <button type="submit" class="btn btn-success">Create User</button>
        </form>
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

    // Create User

    document
        .getElementById("openCreateUserModal")
        .addEventListener("click", function () {
            document.getElementById("createUserModal").style.display = "flex";
        });

    document.querySelector(".close").addEventListener("click", function () {
        document.getElementById("createUserModal").style.display = "none";
    });

    document
        .getElementById("createUserForm")
        .addEventListener("submit", function (event) {
            event.preventDefault();

            let formData = new FormData(this);

            fetch("{{ route('admin.createUser') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                        .value,
                },
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        location.reload(); // Refresh the page to show the new user
                    } else {
                        alert("Error: " + data.message);
                    }
                });
        });
</script>
@endsection
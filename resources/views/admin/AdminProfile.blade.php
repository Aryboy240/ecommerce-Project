<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <h1>Admin Profile</h1>
            <a href="{{ route('adminpanel') }}" class="back-button"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </header>

        <!-- Profile Card -->
        <div class="profile-card">
            <div class="profile-header">
                <img src="Images/profile-pic.png" alt="Profile Picture" class="profile-pic">
                <h2 class="full-name">John Doe</h2>
                <p class="role"><i class="fas fa-user-tag"></i> Role: Admin</p>
                <p class="email"><i class="fas fa-envelope"></i> Email: johndoe@example.com</p>
                <p class="phone"><i class="fas fa-phone"></i> Phone: +1234567890</p>
                <p class="last-login"><i class="fas fa-clock"></i> Last Login: 2024-02-15 10:00 AM</p>
                <button class="edit-profile-btn" onclick="toggleEditProfile()"><i class="fas fa-edit"></i> Edit Profile</button>
            </div>
        </div>

        <!-- Editable Details Section -->
        <div class="editable-details" id="editableDetails" style="display: none;">
            <h3>Edit Details</h3>
            <form id="profileForm">
                <div class="form-group">
                    <label for="name"><i class="fas fa-user"></i> Name:</label>
                    <input type="text" id="name" value="John Doe" required>
                </div>
                <div class="form-group">
                    <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                    <input type="email" id="email" value="johndoe@example.com" readonly>
                </div>
                <div class="form-group">
                    <label for="phone"><i class="fas fa-phone"></i> Phone Number:</label>
                    <input type="text" id="phone" value="+1234567890" required>
                </div>
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> New Password:</label>
                    <input type="password" id="password" placeholder="Enter new password">
                </div>
                <div class="form-group">
                    <label for="confirm-password"><i class="fas fa-lock"></i> Confirm Password:</label>
                    <input type="password" id="confirm-password" placeholder="Confirm new password">
                </div>
                <button type="submit" class="btn-primary"><i class="fas fa-save"></i> Update Profile</button>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/profile.js') }}"></script>
    <script>
        // Function to toggle the visibility of the editable details section
        function toggleEditProfile() {
            const editableDetails = document.getElementById('editableDetails');
            if (editableDetails.style.display === 'none') {
                editableDetails.style.display = 'block'; // Show the editable details
            } else {
                editableDetails.style.display = 'none'; // Hide the editable details
            }
        }
    </script>
</body>
</html>

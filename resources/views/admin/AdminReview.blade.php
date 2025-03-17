<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Reviews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminReviews.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
</head>
<body>
    <div class="container">
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
                <li><a href="{{ route('adminprofile') }}"><i class="fas fa-user"></i> Profile</a></li>
                <li><a href="{{ route('admin.reviews') }}" class="active"><i class="fas fa-star"></i> Reviews</a></li>
                <li><a href="javascript:void(0);" onclick="openLogoutModal()"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
        <div class="main-content">
            <main class="dashboard">
                <div class="page-header">
                    <h1>Review Management</h1>
                </div>
                <div class="table-container">
                    <table class="review-table">
                        <thead>
                            <tr>
                                <th>Reviewer</th>
                                <th>Product</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <td>{{ $review->user->name }}</td>
                                    <td><a href="{{ route('product.details', ['id' => $review->product->id]) }}">{{ $review->product->name }}</a></td>
                                    <td>{{ $review->rating }} / 5</td>
                                    <td>{{ \Illuminate\Support\Str::limit($review->comment, 100) }}</td>
                                    <td class="action-buttons">
                                        <button class="edit-btn" data-id="{{ $review->id }}" data-rating="{{ $review->rating }}" data-comment="{{ $review->comment }}">Edit</button>
                                        <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-container">
                    {{ $reviews->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </main>
        </div>
    </div>
    
    <!-- Modal for Edit Review -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Edit Review</h2>
            <form id="editForm" method="POST" action="{{ route('admin.reviews.update', '') }}">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <input type="number" name="rating" id="editRating" placeholder="Rating (0-5)" min="0" max="5" required>
                </div>
                <div class="input-group">
                    <textarea name="comment" id="editComment" placeholder="Review Comment" required></textarea>
                </div>
                <button type="submit" class="save-btn">Save Changes</button>
            </form>
        </div>
    </div>

<script>
    // Open the modal when the Edit button is clicked
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const modal = document.getElementById('editModal');
        const closeBtn = document.querySelector('.close-btn');
        const editForm = document.getElementById('editForm');
        const editRating = document.getElementById('editRating');
        const editComment = document.getElementById('editComment');

        // Add click event listener to each Edit button
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const reviewId = button.getAttribute('data-id');
                const rating = button.getAttribute('data-rating');
                const comment = button.getAttribute('data-comment');

                // Debugging: Check if the button is being clicked
                console.log('Edit button clicked for review ID:', reviewId);

                // Set the values in the modal
                editRating.value = rating;
                editComment.value = comment;

                // Set the form action to include the review ID
                editForm.action = `/admin/reviews/${reviewId}`;

                // Show the modal
                modal.style.display = 'flex';
            });
        });

        // Close the modal when the close button is clicked
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        // Close the modal if the user clicks outside of it
        window.addEventListener('click', function(event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>
    
</body>
</html>

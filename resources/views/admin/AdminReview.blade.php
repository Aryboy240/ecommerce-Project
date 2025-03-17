<!-- This is a child of the "views/layouts/adminLayout.balde.php" -->
@extends('layouts.adminLayout')

<!-- Any extra head content for this page in specific -->
@section('extra-head')
    <link rel="stylesheet" href="{{ asset('css/admin/AdminReviews.css') }}">
@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Admin Reviews')

<!-- The @yeild in adminLayout's 'content' is filled by everything in this section -->
@section('content')

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
    
@endsection

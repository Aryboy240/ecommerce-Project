<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productpanel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
</head>
<body>
    <div class="container">
<!-- Sidebar Navigation (Fixed Navigation Issues) -->
<nav class="sidebar">
    <div class="logo">
        <img src="{{ asset('Images/logo.png') }}" alt="Logo">
        <h2>Admin Dashboard</h2>
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('adminpanel') }}"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="{{ route('productadmin') }}" class="active"><i class="fas fa-box"></i> Products</a></li>
        <li><a href="{{ route('customers') }}"><i class="fas fa-users"></i> Customers</a></li>
        <li><a href="{{ route('AdminOrders') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
        <li><a href="{{ route('adminreport') }}"><i class="fas fa-chart-bar"></i> Reports</a></li>
        <li><a href="{{ route('adminprofile') }}"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="javascript:void(0);" onclick="openLogoutModal()"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
    </ul>
</nav>
        <div class="main-content">
            <main class="dashboard">
                <div class="page-header">
                    <h1>Product Management</h1>
                </div>

                <!-- Product Statistics -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-glasses"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Total Frames</h3>
                            <p class="stat-value">{{ $totalFramesInStock ?? 0 }}</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon warning">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Low Stock Frames</h3>
                            <p class="stat-value">{{ $lowStockFrames ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon danger">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="stat-details">
                            <h3>Out of Stock</h3>
                            <p class="stat-value">{{ $outOfStockFrames ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon success">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="stat-details">
                            <h3>New This Month</h3>
                            <p class="stat-value">{{ $newThisMonth ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <!-- Product Table -->
                <div class="table-container">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Frame Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset(optional($product->images->first())->image_path ?? 'Images/default.png') }}" alt="Frame" class="product-thumbnail">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($product->description, 100) }}</td>
                                    <td>£{{ number_format($product->price, 2) }}</td>
                                    <td class="stock-update">
                                        <form method="POST" action="{{ route('productadmin.updateStock', $product->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" min="0" required class="stock-input">
                                            <button type="submit" class="update-btn">Update</button>
                                        </form>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td class="action-buttons">
                                        <!-- Edit Button (Restored Original Size) -->
                                        <button class="edit-btn" data-id="{{ $product->id }}">Edit</button>

                                        <!-- Delete Button Below Edit -->
                                        <form method="POST" action="{{ route('productadmin.destroy', $product->id) }}" onsubmit="return confirm('Are you sure?');">
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

                <!-- Pagination -->
                <div class="pagination-container">
                    {{ $products->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </main>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Edit Product</h2>

            <!-- Success Message (Initially Hidden) -->
            <div id="successMessage" class="success-message">✔ Added new product</div>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="input-group">
                    <input type="text" name="name" id="editName" placeholder="Product Name" required>
                </div>

                <div class="input-group">
                    <textarea name="description" id="editDescription" placeholder="Product Description" required></textarea>
                </div>

                <div class="input-group">
                    <input type="number" name="price" id="editPrice" placeholder="Price (£)" step="0.01" required>
                </div>

                <div class="input-group">
                    <input type="number" name="stock_quantity" id="editStock" placeholder="Stock Quantity" required>
                </div>

                <button type="submit" class="save-btn">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("editModal");
        const closeModal = document.querySelector(".close-btn");
        const successMessage = document.getElementById("successMessage");

        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                document.getElementById("editForm").action = `/admin/products/${id}`;
                modal.style.display = "flex";
            });
        });

        closeModal.addEventListener("click", function () {
            modal.style.display = "none";
        });

        document.getElementById("editForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const form = this;

            fetch(form.action, {
                method: "POST",
                body: new FormData(form)
            })
            .then(response => response.json())
            .then(data => {
                modal.style.display = "none";
                successMessage.style.display = "block";
                setTimeout(() => {
                    successMessage.style.display = "none";
                }, 3000);
            })
            .catch(error => console.error("Error:", error));
        });
    });
    </script>
</body>
</html>






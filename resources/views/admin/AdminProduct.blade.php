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
                
                <!-- 🔎 Categories & Search Bar -->
                <div class="filters-section" style="position: relative;">
                    <form method="GET" action="{{ route('productadmin') }}" class="filter-controls">
                        <!-- Search Bar (floated left) -->
                        <div class="search-container" style="float: left;">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </div>

                        <!-- Category Dropdown (floated right) -->
                        <div class="category-container" style="float: right;">
                            <select name="category" class="filter-select" onchange="this.form.submit()">
                                <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>

                    <!-- Add Product Button (centered horizontally and vertically) -->
                    <button 
                        class="add-product-btn" 
                        type="button" 
                        style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%);"
                    >
                        Add Product
                    </button>
                </div>

                <!-- (Alerts Removed: both low-stock and out-of-stock alerts have been taken out.) -->

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
                                @php
                                    $stockClass = '';
                                    if ($product->stock_quantity == 0) {
                                        $stockClass = 'out-of-stock';
                                    } elseif ($product->stock_quantity <= 10) {
                                        $stockClass = 'low-stock';
                                    }
                                @endphp
                                <tr class="{{ $stockClass }}">
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

    <!-- Add Product Modal -->
    <div id="addProductModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h2>Add New Product</h2>
            <div id="addSuccessMessage" class="success-message">✔ Product added successfully</div>
            <form id="addProductForm" method="POST" action="{{ route('productadmin.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" id="addName" placeholder="Product Name" required>
                </div>
                <div class="input-group">
                    <textarea name="description" id="addDescription" placeholder="Product Description" required></textarea>
                </div>
                <div class="input-group">
                    <input type="number" name="price" id="addPrice" placeholder="Price (£)" step="0.01" required>
                </div>
                <div class="input-group">
                    <input type="number" name="stock_quantity" id="addStock" placeholder="Stock Quantity" required>
                </div>
                <div class="input-group">
                    <label for="addCategory">Category:</label>
                    <select name="category_id" id="addCategory" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Upload Image -->
                <div class="input-group">
                    <label for="productImage">Upload Image:</label>
                    <input type="file" name="product_image" id="productImage" accept="image/*" required>
                </div>
                <button type="submit" class="save-btn">Add Product</button>
            </form>
        </div>
    </div>

    <!-- Existing Scripts -->
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("editModal");
        const closeModal = document.querySelector(".close-btn");
        const successMessage = document.getElementById("successMessage");

        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function () {
                const id = this.getAttribute("data-id");
                document.getElementById("editForm").action = /admin/products/${id};
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

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const addModal = document.getElementById("addProductModal");
        const closeAddModal = addModal.querySelector(".close-btn");
        const addProductBtn = document.querySelector(".add-product-btn");
        const addSuccessMessage = document.getElementById("addSuccessMessage");

        // Open "Add Product" modal
        addProductBtn.addEventListener("click", function () {
            addModal.style.display = "flex";
        });

        // Close modal
        closeAddModal.addEventListener("click", function () {
            addModal.style.display = "none";
        });

        // AJAX Submit Form
        document.getElementById("addProductForm").addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch("{{ route('productadmin.store') }}", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    addModal.style.display = "none";
                    addSuccessMessage.style.display = "block";
                    setTimeout(() => {
                        addSuccessMessage.style.display = "none";
                        location.reload();  // Reload the page after adding the product
                    }, 2000);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                location.reload();  // In case of an error, reload the page anyway
            });
        });

    });
    </script>

    <!-- New Inline CSS for Low/Out-of-Stock Rows -->
    <style>
        /* Low Stock (Orange Border) */
        .low-stock {
            border: 3px solid orange !important;
        }
        /* Out of Stock (Red Border) */
        .out-of-stock {
            border: 3px solid red !important;
        }
    </style>
</body>
</html>
















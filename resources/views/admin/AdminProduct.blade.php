<!-- This is a child of the "views/layouts/adminLayout.balde.php" -->
@extends('layouts.adminLayout')

<!-- Any extra head content for this page in specific -->
@section('extra-head')
    <link rel="stylesheet" href="{{ asset('css/admin/productpanel.css') }}">
@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Admin Products')

<!-- The @yeild in adminLayout's 'content' is filled by everything in this section -->
@section('content')
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
                            <td><a href="{{ route('product.details', ['id' => $product->id]) }}" style="text-decoration: none; color: inherit;">{{ $product->name }}</a></td>
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
                <!-- Upload Images -->
                <div class="input-group">
                    <label for="front_image">Front Image:</label>
                    <input type="file" name="front_image" id="front_image" accept="image/*" required>
                </div>
                <div class="input-group">
                    <label for="side_image">Side Image:</label>
                    <input type="file" name="side_image" id="side_image" accept="image/*">
                </div>
                <div class="input-group">
                    <label for="angled_image">Angled Image:</label>
                    <input type="file" name="angled_image" id="angled_image" accept="image/*">
                </div>
                <div class="input-group">
                    <label for="ortho_image">Orthogonal Image:</label>
                    <input type="file" name="ortho_image" id="ortho_image" accept="image/*">
                </div>
                <div class="input-group">
                    <label for="case_image">Case Image:</label>
                    <input type="file" name="case_image" id="case_image" accept="image/*">
                </div>
                <div class="input-group">
                    <label for="model_image">Model Image:</label>
                    <input type="file" name="model_image" id="model_image" accept="image/*">
                </div>
                <div class="input-group">
                    <label for="model2_image">Model 2 Image:</label>
                    <input type="file" name="model2_image" id="model2_image" accept="image/*">
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

                // For multiple file uploads, you can add each image to the FormData object
                const imageFields = [
                    'front_image',
                    'side_image',
                    'angled_image',
                    'ortho_image',
                    'case_image',
                    'model_image',
                    'model2_image'
                ];

                imageFields.forEach(function(field) {
                    const fileInput = document.getElementById(field);
                    if (fileInput && fileInput.files.length > 0) {
                        formData.append(field, fileInput.files[0]);
                    }
                });

                // Perform the AJAX request to submit the form
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
@endsection
















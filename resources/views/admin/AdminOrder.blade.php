<!-- This is a child of the "views/layouts/adminLayout.balde.php" -->
@extends('layouts.adminLayout')

<!-- Any extra head content for this page in specific -->
@section('extra-head')
    <link rel="stylesheet" href="{{ asset('css/admin/order.css') }}">
@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Admin Orders')

<!-- The @yeild in adminLayout's 'content' is filled by everything in this section -->
@section('content')

        <div class="main-content">
            
            <!-- Page Header -->
            <h1 class="page-header">Order Management</h1>

            <!-- Main Dashboard Content -->
            <main class="dashboard">
                <!-- Filter Section -->
                <section class="filters">
                    <div class="search-bar">
                        <input type="text" placeholder="Search orders..." class="search-input">
                        <button class="search-button">Search</button>
                    </div>
                    
                    <div class="filter-options">
                        <div class="filter-select">
                            <select class="filter-select">
                                <option value="">Payment Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                        
                        <div class="filter-select">
                            <select class="filter-select">
                                <option value="">Shipment Status</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        
                        <div class="date-range">
                            <input type="date" class="date-input">
                            <span>to</span>
                            <input type="date" class="date-input">
                        </div>
                        
                        <button class="reset-button">Reset Filters</button>
                    </div>
                </section>

                <!-- Transaction Table -->
                <section class="transaction-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID <i class="fas fa-sort"></i></th>
                                <th>Customer Name <i class="fas fa-sort"></i></th>
                                <th>Products</th>
                                <th>Date <i class="fas fa-sort"></i></th>
                                <th>Payment Status</th>
                                <th>Shipment Status</th>
                                <th>Total Amount <i class="fas fa-sort"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="order-id" data-label="Order ID">#10001</td>
                                <td data-label="Customer Name">John Doe</td>
                                <td data-label="Products">
                                    <button class="view-products-btn">View Products</button>
                                </td>
                                <td data-label="Date">2024-02-15</td>
                                <td data-label="Payment Status">
                                    <span class="status-badge paid">Paid</span>
                                </td>
                                <td data-label="Shipment Status">
                                    <span class="status-badge shipped">Shipped</span>
                                </td>
                                <td data-label="Total Amount">$120.00</td>
                                <td class="actions" data-label="Actions">
                                    <button class="action-btn details" onclick="viewDetails('10001')">
                                        <i class="fas fa-eye"></i> Details
                                    </button>
                                    <button class="action-btn update-status" onclick="updateStatus('10001')">
                                        <i class="fas fa-shipping-fast"></i> Update Status
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="order-id" data-label="Order ID">#10002</td>
                                <td data-label="Customer Name">Jane Smith</td>
                                <td data-label="Products">
                                    <button class="view-products-btn">View Products</button>
                                </td>
                                <td data-label="Date">2024-02-14</td>
                                <td data-label="Payment Status">
                                    <span class="status-badge pending">Pending</span>
                                </td>
                                <td data-label="Shipment Status">
                                    <span class="status-badge processing">Processing</span>
                                </td>
                                <td data-label="Total Amount">$245.50</td>
                                <td class="actions" data-label="Actions">
                                    <button class="action-btn details" onclick="viewDetails('10002')">
                                        <i class="fas fa-eye"></i> Details
                                    </button>
                                    <button class="action-btn update-status" onclick="updateStatus('10002')">
                                        <i class="fas fa-shipping-fast"></i> Update Status
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="order-id" data-label="Order ID">#10003</td>
                                <td data-label="Customer Name">Alice Johnson</td>
                                <td data-label="Products">
                                    <button class="view-products-btn">View Products</button>
                                </td>
                                <td data-label="Date">2024-02-13</td>
                                <td data-label="Payment Status">
                                    <span class="status-badge failed">Failed</span>
                                </td>
                                <td data-label="Shipment Status">
                                    <span class="status-badge cancelled">Cancelled</span>
                                </td>
                                <td data-label="Total Amount">$300.00</td>
                                <td class="actions" data-label="Actions">
                                    <button class="action-btn details" onclick="viewDetails('10003')">
                                        <i class="fas fa-eye"></i> Details
                                    </button>
                                    <button class="action-btn update-status" onclick="updateStatus('10003')">
                                        <i class="fas fa-shipping-fast"></i> Update Status
                                    </button>
                                </td>
                            </tr>
                            <!-- More order rows can be added here -->
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination">
                        <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">3</button>
                        <span class="page-ellipsis">...</span>
                        <button class="page-btn">10</button>
                        <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </section>
            </main>
        </div>

    <!-- Modal for Order Details -->
    <div id="orderDetailsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Order Details</h2>
            <div class="order-info">
                <!-- Order details will be populated dynamically -->
                <p><strong>Order ID:</strong> <span id="order-id"></span></p>
                <p><strong>Customer Name:</strong> <span id="customer-name"></span></p>
                <p><strong>Products:</strong> <span id="products"></span></p>
                <p><strong>Payment Method:</strong> <span id="payment-method"></span></p>
                <p><strong>Transaction ID:</strong> <span id="transaction-id"></span></p>
                <p><strong>Order Date:</strong> <span id="order-date"></span></p>
                <p><strong>Receipt:</strong> <span id="receipt"></span></p>
            </div>
        </div>
    </div>

    <!-- Modal for Status Update -->
    <div id="statusUpdateModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Update Shipment Status</h2>
            <form id="updateStatusForm">
                <select name="shipment_status" required>
                    <option value="processing">Processing</option>
                    <option value="shipped">Shipped</option>
                    <option value="delivered">Delivered</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <button type="submit" class="btn-primary">Update Status</button>
            </form>
        </div>
    </div>

    <!-- Notification Container -->
    <div id="notificationContainer" class="notification-container"></div>
@endsection

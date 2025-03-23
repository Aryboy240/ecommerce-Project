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

            </main>
        </div>

    

    <!-- Notification Container -->
    <div id="notificationContainer" class="notification-container"></div>
<script>
    // Global variables
    let currentOrderId = null;

    // When document loads
    document.addEventListener('DOMContentLoaded', function() {
        loadOrders();
        
        // Set up event listeners
        const searchButton = document.querySelector('.search-button');
        if (searchButton) {
            searchButton.addEventListener('click', loadOrders);
        }
        
        const resetButton = document.querySelector('.reset-button');
        if (resetButton) {
            resetButton.addEventListener('click', resetFilters);
        }
        
        // Set up modal close buttons
        const closeButtons = document.querySelectorAll('.close');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('orderDetailsModal').style.display = 'none';
                document.getElementById('statusUpdateModal').style.display = 'none';
            });
        });
        
        // Set up status update form
        const updateStatusForm = document.getElementById('updateStatusForm');
        if (updateStatusForm) {
            updateStatusForm.addEventListener('submit', function(e) {
                e.preventDefault();
                updateOrderStatus();
            });
        }
    });
    
    // Load orders from backend
    function loadOrders() {
        // If there are no real orders in your database, this function won't show anything
        // In that case, use the commented function below to display the dummy data instead
        
        const searchInput = document.querySelector('.search-input').value;
        const paymentStatus = document.querySelectorAll('.filter-select')[0].value;
        const shipmentStatus = document.querySelectorAll('.filter-select')[1].value;
        const dateFrom = document.querySelectorAll('.date-input')[0].value;
        const dateTo = document.querySelectorAll('.date-input')[1].value;
        
        // Create URL with query parameters
        let url = '{{ route("admin.orders.data") }}';
        let params = new URLSearchParams();
        
        if (searchInput) params.append('search', searchInput);
        if (paymentStatus) params.append('payment_status', paymentStatus);
        if (shipmentStatus) params.append('shipment_status', shipmentStatus);
        if (dateFrom) params.append('date_from', dateFrom);
        if (dateTo) params.append('date_to', dateTo);
        
        const queryString = params.toString();
        if (queryString) {
            url += '?' + queryString;
        }
        
        // Fetch orders from backend
        fetch(url)
            .then(response => {
                console.log('Response status:', response.status);
                return response.json().then(data => {
                    return { status: response.status, data: data };
                });
            })
            .then(result => {
                console.log('API Response:', result);
                
                if (result.data.error) {
                    console.error('Error from API:', result.data.error);
                    // If there's an error, show dummy data
                    displayDummyOrders();
                } else if (result.data.orders && result.data.orders.length > 0) {
                    console.log('Found', result.data.orders.length, 'real orders');
                    displayOrders(result.data.orders);
                } else {
                    console.log('No orders found in API response');
                    // If no orders found, show dummy data
                    displayDummyOrders();
                }
            })
            .catch(error => {
                console.error('Error fetching orders:', error);
                // If fetch fails, show dummy data
                displayDummyOrders();
            });
    }
    
    // Display dummy orders (only if real data is not available)
    function displayDummyOrders() {
        const dummyOrders = [
            {
                order_id: '10001',
                customer_name: 'John Doe',
                date: '2024-02-15',
                payment_status: 'Paid',
                shipment_status: 'Shipped',
                total_amount: '120.00'
            },
            {
                order_id: '10002',
                customer_name: 'Jane Smith',
                date: '2024-02-14',
                payment_status: 'Pending',
                shipment_status: 'Processing',
                total_amount: '245.50'
            },
            {
                order_id: '10003',
                customer_name: 'Alice Johnson',
                date: '2024-02-13',
                payment_status: 'Failed',
                shipment_status: 'Cancelled',
                total_amount: '300.00'
            }
        ];
        
        displayOrders(dummyOrders);
    }
    
    // Display orders in table
    function displayOrders(orders) {
        const tableBody = document.querySelector('tbody');
        tableBody.innerHTML = '';
        
        if (!orders || orders.length === 0) {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="8" class="no-orders">No orders found</td>
                </tr>
            `;
            return;
        }
        
        orders.forEach(order => {
            const row = document.createElement('tr');
            
            // Format the status badge classes
            const paymentStatusClass = getStatusClass(order.payment_status);
            const shipmentStatusClass = getStatusClass(order.shipment_status);
            
            row.innerHTML = `
                <td class="order-id" data-label="Order ID">#${order.order_id}</td>
                <td data-label="Customer Name">${order.customer_name}</td>
                <td data-label="Products">
                    <button class="view-products-btn" onclick="viewProducts(${order.order_id})">View Products</button>
                </td>
                <td data-label="Date">${order.date}</td>
                <td data-label="Payment Status">
                    <span class="status-badge ${paymentStatusClass}">${order.payment_status}</span>
                </td>
                <td data-label="Shipment Status">
                    <span class="status-badge ${shipmentStatusClass}">${order.shipment_status}</span>
                </td>
                <td data-label="Total Amount">£${order.total_amount}</td>
                <td class="actions" data-label="Actions">
                    <button class="action-btn details" onclick="viewDetails(${order.order_id})">
                        <i class="fas fa-eye"></i> Details
                    </button>
                    <button class="action-btn update-status" onclick="updateStatus(${order.order_id})">
                        <i class="fas fa-shipping-fast"></i> Update Status
                    </button>
                </td>
            `;
            
            tableBody.appendChild(row);
        });
    }
    
    // Reset all filters
    function resetFilters() {
        document.querySelector('.search-input').value = '';
        document.querySelectorAll('.filter-select')[0].value = '';
        document.querySelectorAll('.filter-select')[1].value = '';
        document.querySelectorAll('.date-input')[0].value = '';
        document.querySelectorAll('.date-input')[1].value = '';
        
        loadOrders();
    }
    
    // View order details
    function viewDetails(orderId) {
        // For demo purposes, show dummy details
        const dummyOrder = {
            id: orderId,
            user: { name: 'Customer #' + orderId },
            items: [
                { product: { name: 'Product A' }, quantity: 2, price: '45.00' },
                { product: { name: 'Product B' }, quantity: 1, price: '30.00' }
            ],
            payment_method: 'Credit Card',
            transaction_id: 'TXN' + (1000000 + parseInt(orderId)),
            created_at: new Date().toISOString(),
            receipt_url: null
        };
        
        // Try to get real data first
        fetch(`/admin/orders/${orderId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.order) {
                    populateOrderDetails(data.order);
                } else {
                    populateOrderDetails(dummyOrder);
                }
            })
            .catch(error => {
                console.error('Error fetching order details:', error);
                populateOrderDetails(dummyOrder);
            });
            
        // Show the modal
        document.getElementById('orderDetailsModal').style.display = 'block';
    }
    
    function populateOrderDetails(order) {
        document.getElementById('order-id').textContent = order.id;
        document.getElementById('customer-name').textContent = order.user.name;
        
        // Format products list
        const productsList = order.items.map(item => 
            `${item.product.name} (${item.quantity} × £${item.price})`
        ).join(', ');
        
        document.getElementById('products').textContent = productsList;
        document.getElementById('payment-method').textContent = order.payment_method || 'Online';
        document.getElementById('transaction-id').textContent = order.transaction_id || 'N/A';
        document.getElementById('order-date').textContent = new Date(order.created_at).toLocaleString();
        
        // Show receipt link if available
        if (order.receipt_url) {
            document.getElementById('receipt').innerHTML = `<a href="${order.receipt_url}" target="_blank">View Receipt</a>`;
        } else {
            document.getElementById('receipt').textContent = 'Not available';
        }
    }
    
    // View products for an order
    function viewProducts(orderId) {
        // Dummy products for demo
        const dummyProducts = [
            { product: { name: 'Product A' }, quantity: 2, price: '45.00' },
            { product: { name: 'Product B' }, quantity: 1, price: '30.00' }
        ];
        
        // Try to get real data first
        fetch(`/admin/orders/${orderId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const products = data.order ? data.order.items : dummyProducts;
                showProductsList(orderId, products);
            })
            .catch(error => {
                console.error('Error fetching products:', error);
                showProductsList(orderId, dummyProducts);
            });
    }
    
    function showProductsList(orderId, products) {
        let productsList = '';
        products.forEach(item => {
            productsList += `${item.product.name} - ${item.quantity} × £${item.price}\n`;
        });
        
        alert(`Products in Order #${orderId}:\n\n${productsList}`);
    }
    
    // Show update status modal
    function updateStatus(orderId) {
        currentOrderId = orderId;
        document.getElementById('statusUpdateModal').style.display = 'block';
    }
    
    // Update order status
    function updateOrderStatus() {
        if (!currentOrderId) return;
        
        const status = document.querySelector('select[name="shipment_status"]').value;
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch(`/admin/orders/${currentOrderId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Order status updated successfully', 'success');
                document.getElementById('statusUpdateModal').style.display = 'none';
                loadOrders(); // Reload orders to show updated status
            } else {
                showNotification(data.message || 'Failed to update status', 'error');
            }
        })
        .catch(error => {
            console.error('Error updating status:', error);
            showNotification('Failed to update status. Please try again.', 'error');
        });
    }
    
    // Helper function to get status badge class
    function getStatusClass(status) {
        if (!status) return '';
        
        status = status.toLowerCase();
        if (status === 'paid' || status === 'completed' || status === 'delivered' || status === 'shipped') {
            return 'paid';
        } else if (status === 'pending' || status === 'processing') {
            return 'pending';
        } else if (status === 'failed' || status === 'cancelled') {
            return 'failed';
        }
        return '';
    }
    
    // Show notification
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        
        document.getElementById('notificationContainer').appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
</script>
@endsection

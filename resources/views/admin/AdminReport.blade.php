<!--
    Developer: man huen Angus kwok
    University ID: 230049488
    Function: Front end for the admin report page
    
    Modified by: Vatsal
    Student code: 220408633
    Modifications: Added dynamic data for reports, charts, and order processing
    Updated to always show real values from the database
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin Reports </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
        <link rel="stylesheet" href="{{ asset('css/order.css') }}">
        <link rel="stylesheet" href="{{ asset('css/adminreport.css') }}">
        <!-- Chart.js for graphs -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            <!-- Main Content Area -->
            <div class="main-content">
                
                <div class="hearer">
                    <p class="title">Report Dashboard</p>
                </div>
                <div class="bar1">
                        
                    <div class="info">
                        <div class="info1">
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">Total Revenue</div>
                                    <div class="info-per">+{{ $revenueGrowth }}%</div>
                                </div>
                                <div class="info-secound">
                                    ${{ $totalRevenue }}
                                </div>
                            </div>
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">New Orders</div>
                                    <div class="info-per">+{{ $orderGrowth }}%</div>
                                </div>
                                <div class="info-secound">
                                    {{ $newOrdersCount }}
                                </div>
                            </div>
                        </div>
                        <div class="info1">
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">Total Products</div>
                                    <div class="info-per">{{ $totalProducts }}</div>
                                </div>
                                <div class="info-secound">
                                    {{ $productCount }}
                                </div>
                            </div>
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">New Customers</div>
                                    <div class="info-per">+{{ $customerGrowth }}</div>
                                </div>
                                <div class="info-secound">
                                    {{ $newCustomersCount }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="table">
                        <div class="tabletitle">Top 3 Bestsellers</div>
                        <div class="tablerank">
                            @if(count($topProducts) > 0)
                                @foreach($topProducts as $index => $product)
                                <div class="glassrank">
                                    <p class="rankp">no{{ $index + 1 }}</p>
                                    <div class="rankproduct">
                                        <p>{{ $product->name }}</p>
                                        <div class="table-img">
                                            @foreach($product->images as $image)
                                                @if($image->imageType && $image->imageType->name == 'front')
                                                    <a href="{{ route('product.details', ['id' => $product->id]) }}" >
                                                        <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front" class="item-img">
                                                    </a>
                                                    @break
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <p>{{ $product->sales_percentage }}%</p>
                                </div>
                                @endforeach
                            @else
                                <div class="glassrank">
                                    <p>No sales data available yet</p>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>

            <main class="inoutcomeboard">
                <div class="board incomeboard">
                    <p>Incoming Orders</p>
                    <div class="boardlist">
                        <p>Item Image</p>
                        <p>Item Id</p>
                        <p>Stock</p>
                        <p>Date</p>
                        <p>Order Id</p>
                    </div>
                    
                    @if(count($incomingOrders) > 0)
                        @foreach($incomingOrders as $item)
                        <div class="itemlist">                             
                            @foreach($item->product->images as $image)
                                @if($image->imageType && $image->imageType->name == 'front')
                                    <a href="{{ route('product.details', ['id' => $item->product->id]) }}" >
                                        <img src="{{ asset($image->image_path) }}" alt="{{ $item->product->name }} - Front" class="item-img">
                                    </a>
                                    @break
                                @endif
                            @endforeach
                            <p class="itemid">{{ $item->product->id }}</p> 
                            <p class="stock">{{ $item->quantity }}</p>
                            <p class="date">{{ $item->created_at->format('d/m/Y') }}</p>                        
                            <p class="orderid">{{ $item->order_id }}</p>
                        </div>
                        @endforeach
                    @else
                        <div class="itemlist">
                            <p colspan="5" style="text-align: center;">No incoming orders yet</p>
                        </div>
                    @endif
                </div>
                
                <div class="board outcomeboard">
                    <p>Outgoing Orders</p>
                    <div class="boardlist">
                        <p>Item Image</p>
                        <p>Item Id</p>
                        <p>Stock</p>
                        <p>Date</p>
                        <p>Order Id</p>
                    </div>
                    <div class="boarditem">
                    @if(count($outgoingOrders) > 0)
                        @foreach($outgoingOrders as $item)
                        <div class="itemlist">                             
                            @foreach($item->product->images as $image)
                                @if($image->imageType && $image->imageType->name == 'front')
                                    <a href="{{ route('product.details', ['id' => $item->product->id]) }}" >
                                        <img src="{{ asset($image->image_path) }}" alt="{{ $item->product->name }} - Front" class="item-img">
                                    </a>
                                    @break
                                @endif
                            @endforeach
                            <div class="listdetail">
                                <div class="listdetail1">
                                    <p class="itemid">{{ $item->product->id }}</p> 
                                    <p class="stock">{{ $item->quantity }}</p>
                                    <p class="date">{{ $item->created_at->format('d/m/Y') }}</p>
                                </div>
                                <p class="orderid">{{ $item->order_id }}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="itemlist">
                            <p colspan="5" style="text-align: center;">No outgoing orders yet</p>
                        </div>
                    @endif
                    </div>
                </div>
            </main>

                
            <main class="dashboard">
                <div class="dashboard-bar">
                    <div class="bar-nota">
                        @if(count($outOfStockProducts) > 0)
                            <img src="{{ asset('Images/error.png') }}" alt="Error Image" class="error-img">
                            <p class="out-of-stock warn">{{ count($outOfStockProducts) }} {{ count($outOfStockProducts) == 1 ? 'item' : 'items' }} out of stock</p>
                            <div class="hidden-ids warn">
                                @foreach($outOfStockProducts as $product)
                                    {{ $product->id }}
                                    @if(!$loop->last),@endif
                                @endforeach
                            </div>
                        @else
                            <img src="{{ asset('Images/error.png') }}" alt="Product Image" class="error-img">
                            <p class="out-of-stock">No items out of stock</p>
                            <div class="hidden-ids">
                                No items out of stock
                            </div>
                        @endif
                    </div>
                    <div class="searchbar">
                        <input type="text" id="productSearch" placeholder="Search products..." class="search-bar">
                        <button class="search-bar-button" onclick="searchProducts()">Search</button>
                    </div>
                </div>
                <main class="dashboarditem">
                    @if(count($products) > 0)
                        @foreach($products as $product)
                        <div class="report-container">
                            <div class="report-glass">
                                @foreach($product->images as $image)
                                    @if($image->imageType && $image->imageType->name == 'front')
                                        <a href="{{ route('product.details', ['id' => $product->id]) }}" >
                                            <img src="{{ asset($image->image_path) }}" alt="{{ $product->name }} - Front" class="product-img">
                                        </a>
                                        @break
                                    @endif
                                @endforeach
                                <p>{{ $product->category->name ?? 'Uncategorized' }}</p>
                                <p>{{ $product->id }}</p>
                            </div>
                            <div class="product-info">
                                <div class="product-name">{{ $product->name }}</div>
                                <div class="order stockorder {{ $product->stock_quantity <= 0 ? 'warn' : '' }}">
                                    <p>In stock:</p>
                                    <p>{{ $product->stock_quantity }}</p>
                                </div>
                                <div class="order incomeorder">
                                    <p>Income order:</p>
                                    <p>{{ $product->incoming_count }}</p>
                                </div>
                                <div class="order outcomeorder">
                                    <p>Outcome order:</p>
                                    <p>{{ $product->outgoing_count }}</p>
                                </div>
                            </div>
                            <div class="product-inoutcome">
                                <div class="inoutcome-status"><p>Date</p><p>Status</p><p>Type</p><p>ID</p></div>
                                
                                @if(count($product->recent_orders) > 0)
                                    @foreach($product->recent_orders as $order)
                                    <div class="inoutcome-detail">
                                        <p>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m') }}</p>
                                        <p class="{{ $order->status == 'completed' ? 'Done' : 'warn' }}">{{ ucfirst($order->status) }}</p>
                                        <p>{{ $order->type }}</p>
                                        <p>{{ $order->id }}</p>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="inoutcome-detail">
                                        <p colspan="4" style="text-align: center;">No order history</p>
                                    </div>
                                @endif
                                
                                <div class="inoutcome-viewdetail"><p>view detail</p></div>
                                
                                @if($product->stock_quantity <= 0)
                                <div class="inoutcome-outofstock warn"><p>Out Of Stock!</p></div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="report-container">
                            <p>No products available</p>
                        </div>
                    @endif
                </main> 
            </main>
            </div>
        </div>

        <!-- Logout Modal -->
        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeLogoutModal()">&times;</span>
                <h2>Confirm Logout</h2>
                <p>Are you sure you want to log out?</p>
                <p>Logged in as <strong>Admin User</strong>.</p>
                <div class="modal-actions">
                    <button class="btn-primary" onclick="logout()">Confirm Logout</button>
                    <button class="btn-secondary" onclick="closeLogoutModal()">Cancel</button>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/adminreport.js') }}"></script>
        <script>
            // Function to search products
            function searchProducts() {
                const searchTerm = document.getElementById('productSearch').value.toLowerCase();
                const products = document.querySelectorAll('.report-container');
                
                products.forEach(container => {
                    const productName = container.querySelector('.product-name').textContent.toLowerCase();
                    const productId = container.querySelector('.report-glass p:last-child').textContent;
                    
                    if (productName.includes(searchTerm) || productId.includes(searchTerm)) {
                        container.style.display = 'flex';
                    } else {
                        container.style.display = 'none';
                    }
                });
            }
            
            // Initialize charts
            document.addEventListener('DOMContentLoaded', function() {
                // Orders per month chart
                const ordersCtx = document.getElementById('ordersChart').getContext('2d');
                const ordersChart = new Chart(ordersCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($orderChartLabels) !!},
                        datasets: [{
                            label: 'Orders Per Month',
                            data: {!! json_encode($orderChartData) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Monthly Orders'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                
                // Customers over time chart
                const customersCtx = document.getElementById('customersChart').getContext('2d');
                const customersChart = new Chart(customersCtx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($customerChartLabels) !!},
                        datasets: [{
                            label: 'Total Customers',
                            data: {!! json_encode($customerChartData) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Customer Growth'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
        <script src="{{ asset('js/order.js') }}"></script>
    </body>
</html>
<!--
    Developer: man huen Angus kwok
	  University ID: 230049488
    Function: Front end for the admin report page
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
                    <p class="title">Report</p>
                </div>
                <div class="bar1">
                        
                    <div class="info">
                        <div class="info1">
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">Revenue</div>
                                    <div class="info-per">+33%</div>
                                </div>
                                <div class="info-secound">
                                    $4510
                                </div>
                            </div>
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">New order</div>
                                    <div class="info-per">+10%</div>
                                </div>
                                <div class="info-secound">
                                    59
                                </div>
                            </div>
                        </div>
                        <div class="info1">
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">Total page view</div>
                                    <div class="info-per">+398</div>
                                </div>
                                <div class="info-secound">
                                    4,358
                                </div>
                            </div>
                            <div class="info-detail">
                                <div class="info-first">
                                    <div class="info-title">User</div>
                                    <div class="info-per">+102</div>
                                </div>
                                <div class="info-secound">
                                    2,360
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table">
                        <div class="tabletitle">Top 3 sales</div>
                        <div class="tablerank">
                            
                            <div class="glassrank">
                                <p class="rankp">no1</p>
                                <div class="rankproduct">
                                    <p>Square Frame Glasses</p>
                                    <div class="table-img">
                                        <img src="{{ asset('Images/products/glasses1.jpeg') }}" alt="Product Image">
                                    </div>
                                </div>
                                <p>19%</p>
                            </div>
                            <div class="glassrank">
                                <p class="rankp">no2</p>
                                <div class="rankproduct">
                                    <p>Square Sunglasses</p>
                                    <div class="table-img">
                                        <img src="{{ asset('Images/products/sun2.jpeg') }}" alt="Product Image">
                                    </div>
                                </div>
                                <p>12%</p>
                            </div>
                            <div class="glassrank">
                                <p class="rankp">no3</p>
                                <div class="rankproduct">
                                    <p>Classic Round Glasses</p>
                                    <div class="table-img">
                                        <img src="{{ asset('Images/products/glasses2.png') }}" alt="Product Image">
                                    </div>
                                </div>    
                                <p>8%</p>
                            </div>
                        </div>
                    </div>
            </div>

            <main class="inoutcomeboard">
                <div class="board incomeboard">
                    <p>Incoming Order</p>
                    <div class="boardlist">
                        <p>Item Image</p>
                        <p>Item Id</p>
                        <p>Stock</p>
                        <p>Date</p>
                        <p>Order Id</p>
                    </div>
                    <div class="itemlist">                             
                        <img src="{{ asset('Images/products/Featured/Comfit/33145006/33145006-front-2000x1125.jpg') }}" alt="Product Image" class="item-img">
                        <p class="itemid">33145006</p> 
                        <p class="stock">8</p>
                        <p class="date">01/04/2025</p>                        
                        <p class="orderid">0001</p>
                        
                    </div>
                    <div class="itemlist">                             
                        <img src="{{ asset('Images/products/Featured/Adidas/32859928/32859928-front-2000x1125.jpg') }}" alt="Product Image" class="item-img">
                        <p class="itemid">32859928</p> 
                        <p class="stock">2</p>
                        <p class="date">03/09/2025</p>
                        <p class="orderid">0002</p>
                    </div>
                    
                </div>
                <div class="board outcomeboard">
                    <p>Outcoming Order</p>
                    <div class="boardlist">
                        <p>Item Image</p>
                        <p>Item Id</p>
                        <p>Stock</p>
                        <p>Date</p>
                        <p>Order Id</p>
                    </div>
                    <div class="boarditem">
                    <div class="itemlist">                             
                        <img src="{{ asset('Images/products/Featured/Adidas/32859935/32859935-front-2000x1125.jpg') }}" alt="Product Image" class="item-img">
                        <div class="listdetail">
                            <div class="listdetail1">
                                <p class="itemid">32859935</p> 
                                <p class="stock">3</p>
                                <p class="date">5/02/2023</p>
                            </div>
                        <p class="orderid">0003</p>
                        </div>
                    </div>
                    </div>
                </div>
            </main>

                
                <main class="dashboard">
                    <div class="dashboard-bar">
                        <div class="bar-nota">
                            
                            <img src="{{ asset('Images/error.png') }}" alt="Product Image" class="error-img">
                            <p class="out-of-stock warn">1 item out of stock</p>
                            <div class="hidden-ids warn">
                            32859935
                            </div>
                        </div>
                        <div class="searchbar">
                            <input type="text" placeholder="Search orders..." class="search-bar">
                            <button class="search-bar-button">Search</button>
                        </div>
                    </div>
                    <main class="dashboarditem">
                    <div class="report-container">
                        <div class="report-glass">
                            <img src="{{ asset('Images/products/Featured/Adidas/32859928/32859928-front-2000x1125.jpg') }}" alt="Product Image" class="product-img">
                            <p>Adidas</p>
                            <p>32859928</p>
                        </div>
                        <div class="product-info">
                            <div class="product-name">Square Frame Glasses</div>
                            <div class="order stockorder">
                                <p>In stock:</p>
                                <p>10</p>
                            </div>
                            <div class="order incomeorder">
                                <p>Income order:</p>
                                <p>0</p>
                            </div>
                            <div class="order outcomeorder">
                                <p>Outcome order:</p>
                                <p>0</p>
                            </div>
                        </div>
                        <div class="product-inoutcome">
                            <div class="inoutcome-status"><p>Date</p><p>staus</p><p>type</p><p>id</p></div>
                            <div class="inoutcome-detail"><p>27/1</p><p class="Done">Done</p><p>in</p><p>001</p></div>
                            <div class="inoutcome-detail"><p>23/2</p><p class="Done">Done</p><p>out</p><p>002</p></div>
                            <div class="inoutcome-viewdetail"><p>view detail</p></div>
                        </div>
                    </div>

                    <div class="report-container">
                        <div class="report-glass">
                            <img src="{{ asset('Images/products/Featured/Adidas/32859935/32859935-front-2000x1125.jpg') }}" alt="Product Image" class="product-img">
                            <p>Adidas</p>
                            <p>32859935</p>
                        </div>
                        <div class="product-info">
                            <div class="product-name">Square Frame Glasses</div>
                            <div class="order stockorder warn">
                                <p>In stock:</p>
                                <p>0</p>
                            </div>
                            <div class="order incomeorder">
                                <p>Income order:</p>
                                <p>3</p>
                            </div>
                            <div class="order outcomeorder">
                                <p>Outcome order:</p>
                                <p>2</p>
                            </div>
                        </div>
                        <div class="product-inoutcome">
                            <div class="inoutcome-status"><p>Date</p><p>staus</p><p>type</p><p>id</p></div>
                            <div class="inoutcome-detail"><p>1/2</p><p class="Done">Done</p><p>in</p><p>004</p></div>
                            <div class="inoutcome-detail"><p>3/2</p><p class="Done">Done</p><p>out</p><p>003</p></div>
                            <div class="inoutcome-viewdetail"><p>view detail</p></div>
                            <div class="inoutcome-outofstock warn"><p>Out Of Stock !</p></div>
                        </div>
                    </div>

                    <div class="report-container">
                        <div class="report-glass">
                            <img src="{{ asset('Images/products/Featured/Adidas/32859942/32859942-front-2000x1125.jpg') }}" alt="Product Image" class="product-img">
                            <p>Adidas</p>
                            <p>32859942</p>
                        </div>
                        <div class="product-info">
                            <div class="product-name">Square Frame Glasses</div>
                            <div class="order stockorder">
                                <p>In stock:</p>
                                <p>3</p>
                            </div>
                            <div class="order incomeorder">
                                <p>Income order:</p>
                                <p>3</p>
                            </div>
                            <div class="order outcomeorder">
                                <p>Outcome order:</p>
                                <p>3</p>
                            </div>
                        </div>
                        <div class="product-inoutcome">
                            <div class="inoutcome-status"><p>Date</p><p>staus</p><p>type</p><p>id</p></div>
                            <div class="inoutcome-detail"><p>3/4</p><p class="Done">Done</p><p>in</p><p>005</p></div>
                            <div class="inoutcome-detail"><p>5/3</p><p class="warn">UnDone</p><p>out</p><p>006</p></div>
                            <div class="inoutcome-viewdetail"><p>view detail</p></div>
                        </div>
                    </div>
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

    <script src="{{ asset('js/order.js') }}"></script>
    </body>
</html>
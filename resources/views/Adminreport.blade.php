<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Admin Reports </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
        <!-- JS -->
        <script defer src="/js/adminreport.js"></script>
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
                    <li><a href="{{ route('orders') }}"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                    <li><a href="#reports"><i class="fas fa-chart-bar"></i> Reports</a></li>
                    <li><a href="#settings"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>

            <!-- Main Content Area -->
            <div class="main-content">
                <header class="header">
                    <div class="search-bar">
                        <input type="text" placeholder="Search...">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                    <div class="header-right">
                        <div class="notifications">
                            <button><i class="fas fa-bell"></i></button>
                        </div>
                        <div class="profile">
                            <i class="fas fa-user"></i>
                            <div class="dropdown">
                                <button class="dropbtn">Admin User</button>
                                <div class="dropdown-content">
                                    <a href="{{ route('adminprofile') }}">Profile</a>
                                    <a href="javascript:void(0);" onclick="openLogoutModal()">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="dashboard">
                
                <div class="report-container">
                    <img src="{{ asset('Images/products/glasses1.jpeg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Square Frame Glasses</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>                      
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/sun1.jpeg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Aviator Sunglasses</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/case1.jpeg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Hard Shell Case</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/glasses2.png') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Classic Round Glasses</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/sun2.jpeg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Square Sunglasses</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/case2.png') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Premium Leather Case</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/glasses3.png') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Oval Frame Glasses</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/sun3.png') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Sport Sunglasses</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/case3.jpeg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Travel Case</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/glasses cleaner.jpg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Glasses Cleaner</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/contacts cleaner.jpg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Contacts Cleaner</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>

                <div class="report-container">
                    <img src="{{ asset('Images/products/case4.jpg') }}" alt="Product Image" class="product-img">
                    <div class="product-info">
                        <div class="product-name">Travel Case</div>
                        <div class="bar-container"> <!--stock bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar stock-bar" data-stock="100"></div>
                        </div>
                        <div class="bar-container"> <!--income bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar incoming-bar" data-incoming="50"></div>
                        </div>
                        <div class="bar-container"> <!--outgoing bar-->
                            <div class="button-group">
                                <button class="decrease-btn">−</button>
                                <button class="increase-btn">+</button>
                            </div>
                            <div class="bar outgoing-bar" data-outgoing="30"></div>
                        </div>
                    </div>
                </div>


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
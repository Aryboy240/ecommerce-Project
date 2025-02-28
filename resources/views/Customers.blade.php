<!--
    Developer: Aqsa Amjad
    University ID: 230066670
    Function: Front end for the User Account page (for logged-in users)

    Developer: Aryan Kora
    University ID: 230059030
    Function: Front end improvements
-->

<html lang="en">

<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Dashboard </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/aryansExtras.css') }}">
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/customers.css') }}">
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

    <div class="main-content">
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>johndoe@gmail.com</td>
                    <td class="actions">
                        <a href="" class="btn btn-view">View</a>
                        <a href="" class="btn btn-add">Edit</a>
                        <a href="" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Jane Smith</td>
                    <td>janesmith@example.com</td>
                    <td class="actions">
                        <a href="" class="btn btn-view">View</a>
                        <a href="" class="btn btn-add">Edit</a>
                        <a href="" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Emily Wilson</td>
                    <td>emilywilson@outlook.com</td>
                    <td class="actions">
                        <a href="" class="btn btn-view">View</a>
                        <a href="" class="btn btn-add">Edit</a>
                        <a href="" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Michael Johnson</td>
                    <td>michaeljohnson@outlook.com</td>
                    <td class="actions">
                        <a href="" class="btn btn-view">View</a>
                        <a href="" class="btn btn-add">Edit</a>
                        <a href="" class="btn btn-delete">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
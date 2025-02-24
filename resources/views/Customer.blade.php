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
    <link rel="stylesheet" href="{{  asset('css/customer.css') }}">
</head>

</html>

<!-- This is a child of the "views/layouts/mainLayout.balde.php" -->
@extends('layouts.mainLayout')

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Customer Details')

<!-- The @yeild in mainLayout's 'main' is filled by everything in this section -->
@section('content')
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
            <td>John Smith</td>
            <td>johnsmith@gmail.com</td>
            <td class="actions">
                <a href="" class="btn btn-view">View</a>
                <a href="" class="btn btn-add">Edit</a>
                <a href="" class="btn btn-delete">Delete</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jane Doe</td>
            <td>janedoe@example.com</td>
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
@endsection
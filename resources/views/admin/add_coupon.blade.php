<!-- This is a child of the "views/layouts/adminLayout.balde.php" -->
@extends('layouts.adminLayout')

<!-- Any extra head content for this page in specific -->
@section('extra-head')
<link rel="stylesheet" href="{{ asset('css/coupon.css') }}">
@endsection

<!-- Theres a @yeild in the app's title, so this fills it with the proceeding information -->
@section('title', 'Optique | Add Coupons')

<!-- The @yeild in adminLayout's 'content' is filled by everything in this section -->
@section('content')
<div class="main-content">
    <header class="header">
        <h1><i class="fas fa-tag"></i> Add Coupon</h1>
    </header>
    
    <main>
        <form action="{{ route('admin.coupons.store') }}" method="POST" class="form-container">
            @csrf
            <h2>Coupon Details</h2>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="code">Coupon Code:</label>
                        <input type="text" name="code" id="code" placeholder="e.g. SUMMER25" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="type">Discount Type:</label>
                        <select name="type" id="type" required>
                            <option value="fixed">Fixed Amount</option>
                            <option value="percent">Percentage</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="value">Discount Value:</label>
                        <input type="number" name="value" id="value" step="0.01" placeholder="e.g. 10.00" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="min_cart_amount">Minimum Cart Amount:</label>
                        <input type="number" name="min_cart_amount" id="min_cart_amount" step="0.01" placeholder="e.g. 50.00">
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="valid_from">Valid From:</label>
                        <input type="date" name="valid_from" id="valid_from" required>
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group">
                        <label for="valid_until">Valid Until:</label>
                        <input type="date" name="valid_until" id="valid_until" required>
                    </div>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-col">
                    <div class="form-group">
                        <label for="usage_limit">Usage Limit:</label>
                        <input type="number" name="usage_limit" id="usage_limit" placeholder="Leave empty for unlimited">
                    </div>
                </div>
                <div class="form-col">
                    <div class="form-group form-check">
                        <label for="is_active">Active Status:</label>
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked>
                    </div>
                </div>
            </div>
            
            <div class="actions">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create Coupon</button>
                <a href="{{ route('admin.coupons') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Coupons</a>
            </div>
        </form>
    </main>
</div>
@endsection
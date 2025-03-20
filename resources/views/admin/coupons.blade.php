@extends('layouts.adminLayout')

{{-- Extra head content specific to this page --}}
@section('extra-head')
    <link rel="stylesheet" href="{{ asset('css/coupon.css') }}">
@endsection

{{-- Set the page title --}}
@section('title', 'Admin Coupons')

{{-- Main content section --}}
@section('content')
    <div class="main-content">
        <header>
            <h1>Coupons</h1>
            <a href="{{ route('admin.coupons.add') }}" class="btn btn-primary">Add Coupon</a>
        </header>
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Valid From</th>
                    <th>Valid Until</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->type }}</td>
                        <td>{{ $coupon->value }}</td>
                        <td>{{ $coupon->valid_from->format('Y-m-d') }}</td>
                        <td>{{ $coupon->valid_until->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.coupons.edit', $coupon) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.coupons.destroy', $coupon) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


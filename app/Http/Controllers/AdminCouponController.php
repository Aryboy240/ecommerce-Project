<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    public function coupons()
    {
        $coupons = Coupon::all();
        return view('admin.coupons', compact('coupons'));
    }

    public function add()
    {
        return view('admin.add_coupon');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'min_cart_amount' => 'nullable|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'usage_limit' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active'); 

        Coupon::create($data);

        return redirect()->route('admin.coupons')->with('success', 'Coupon created successfully!');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.edit_coupon', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $coupon->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric',
            'min_cart_amount' => 'nullable|numeric',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'usage_limit' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active'); 

        $coupon->update($data);

        return redirect()->route('admin.coupons')->with('success', 'Coupon updated successfully!');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('success', 'Coupon deleted successfully!');
    }
}
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
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)
                        ->where('is_active', 1)
                        ->whereDate('valid_from', '<=', now())
                        ->whereDate('valid_until', '>=', now())
                        ->first();
        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid or expired coupon.'], 400);
        }
        // Retrieve cart total
        $cartTotal = session()->get('cart_total', 0);
        // Check minimum cart amount
        if ($cartTotal < $coupon->min_cart_amount) {
            return response()->json([
                'success' => false, 
                'message' => 'Minimum cart total must be £' . $coupon->min_cart_amount . ' to apply this coupon.'
            ], 400);
        }
        // Calculate discount
        $discount = ($coupon->type === 'percent') ? ($cartTotal * ($coupon->value / 100)) : $coupon->value;
        $newTotal = max(0, $cartTotal - $discount);
        // Store coupon info in session
        session()->put('applied_coupon', [
            'code' => $coupon->code,
            'discount' => $discount,
            'new_total' => $newTotal
        ]);
        return response()->json([
            'success' => true,
            'discount' => number_format($discount, 2),
            'newTotal' => number_format($newTotal, 2)
        ]);
    }
}


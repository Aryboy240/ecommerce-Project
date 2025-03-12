<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductReview;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review = new ProductReview();
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->product_id = $productId;
        
        // Ensure the user_id is set
        $review->user_id = auth()->id(); // This will assign the current logged-in user's ID

        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully!');
    }

    


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

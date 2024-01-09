<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\ProductPackage;

class ReviewController extends Controller
{
    public function send_review(Request $request,$id)
    {
           $review = New Review;
           $review->productPackage_id = $id;
           $review->review = $request->review;
           $review->save();


           $package = ProductPackage::find($id);
           $package->rating = $package->rating + $request->rating;
           $package->save();

           $packagra = ProductPackage::find($id);
   
    $count = Review::where('productPackage_id', $id)->count();
    

    $review_star = $packagra->rating;

    if ($review_star != 0) {
        // Calculate initial rating
        $Rating = ($count * 5) / $review_star;
    
        // Ensure the rating is capped at 5
        $Rating = min($Rating, 5);
    
        // Ensure the rating is at least 1
        $Rating = max($Rating, 1);
    } else {
        $Rating = 0; // Handle the zero case as needed
    }
    
    if ($Rating != 0) {
        // Calculate final rating out of 5
        $tRating = 5 / $Rating;
    } else {
        $tRating = 0; // Handle the zero case as needed
    }
    
    // Round the final rating to 1 decimal place
    $totalRating = round($tRating, 1);
    
    // Ensure the final rating is capped at 5
    $totalRating = min($totalRating, 5);
    
    // Assign the totalRating to the packagra object and save it
    $packagra->ratting_ever = $totalRating;
    
    $packagra->save();
    
    
return response()->json(['data' => $package]);

    }
}

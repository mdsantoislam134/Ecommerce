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

    $tstar = $packagra->rating;
    $review_star = intval($tstar);
    if ($review_star != 0) {
        $Rating = ($count * 5) / $review_star;
    } else {
        $Rating = 0; // Handle the zero case as needed
    }

    if ($Rating != 0) {
        $tRating = 5 / $Rating;
    } else {
        $tRating = 0; // or handle the zero case as needed
    };
    

    $totalRating = round($tRating, 1);

  $packagra->ratting_ever = $totalRating;

$packagra->save();
return response()->json(['data' => $package]);

    }
}

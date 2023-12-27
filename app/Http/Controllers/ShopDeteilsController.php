<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopDeteils;
use Illuminate\Support\Facades\Auth;

class ShopDeteilsController extends Controller
{
   public function add_details(Request $request){

    $request->validate([
        'shop_name' => 'required|string',
        'shop_img' => 'required|',
        'shop_address' => 'required|string',
        'tin_number' => 'required|string',
        'bin_number' => 'required|string',
        'owner_name' => 'required|string',
        'owner_nid' => 'required|string',
        'owner_phone' => 'required|string',
        'email' => 'required|email',
        'phone_verify' => 'required|string',
        'email_verify' => 'required|string',
        'tow_factor' => 'required|string',
    ]);
    $user = Auth::user();
    $shopDetails = new ShopDeteils;
         $shopDetails->shop_name = $request->input('shop_name');
         $shopDetails->shop_address = $request->input('shop_address');
         $shopDetails->tin_number = $request->input('tin_number');
         $shopDetails->bin_number = $request->input('bin_number');
         $shopDetails->owner_name = $request->input('owner_name');
         $shopDetails->owner_nid = $request->input('owner_nid');
         $shopDetails->owner_phone = $request->input('owner_phone');
         $shopDetails->email = $request->input('email');
         $shopDetails->phone_verify = $request->input('phone_verify');
         $shopDetails->email_verify = $request->input('email_verify');
         $shopDetails->tow_factor = $request->input('tow_factor');

      
        
            $photo = $request->file('shop_img');
            $imageName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('shopimage', $imageName); // Fixed the move method to use $photo instead of $request->photo
            $shopDetails->shop_img = $imageName;


  $user->ShopDeteils()->save($shopDetails);


    return response()->json(['message' => 'Shop details stored successfully', 'data' => $shopDetails]);
       
 
}
}
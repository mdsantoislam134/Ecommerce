<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\delivery_option;

class DeliveryOptionController extends Controller
{
    
     public function add_delivery_option(Request $request){

        $deli = New delivery_option;
        $deli->delivery_text = $request->delivery_text;
        $deli->save();


        return redirect('Add-Delivery-Option')->with('massage', "Rules Added!");
     }
}

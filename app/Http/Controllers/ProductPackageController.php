<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductPackage;
Use App\Models\PackageProduct;
Use App\Models\Product;
class ProductPackageController extends Controller
{
    public function add_package(Request $request){
        $request->validate([
            'package_name' => 'required|string',
            'policy_id' => 'required',
            'delivery_option_id' => 'required',
            'package_price' => 'required|numeric',
        ]);

        $package = New ProductPackage;
            $package->package_name = $request->input('package_name');
            $package->policy_id = $request->input('policy_id');
            $package->delivery_option_id = $request->input('delivery_option_id');
            $package->package_price = $request->input('package_price');
      
            $package->save();
      
            $items = $request->input('products');
            foreach($items as $all){
                $pack = new PackageProduct; // Fix: Change $pac to $pack
                $pack->productPackage_id = $package->id;
                $pack->product_id = $all;
                $pack->save();
            }
        
           

         $data = $package->packageProduct;
         
        return response()->json(['data' => $data]);
    }
    
}

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

            if (is_array($items)) {
                // If $items is already an array, use it directly
                foreach ($items as $all) {
                    
                    $pack = new PackageProduct;
                    $pack->productPackage_id = $package->id;
                    $pack->product_id = $all['id'];
                    $pack->order_count = $all['order_count'];
        
                    $pack->save();
                    
                }
            } 
    
         
        return response()->json(['data' => $package]);
    }
    

    
//  update package 
public function update_package(Request $request, $id){
   

    $package = ProductPackage::find($id);

    if (!$package) {
        return response()->json(['error' => 'Package not found'], 404);
    }

    if( $request->input('package_name'))
    {
        $package->package_name = $request->input('package_name');
    }
    if( $request->input('policy_id'))
    {
        $package->policy_id = $request->input('policy_id');
    }
    if( $request->input('delivery_option_id'))
    {
        $package->delivery_option_id = $request->input('delivery_option_id');
    }
    if( $request->input('package_price'))
    {
        $package->package_price = $request->input('package_price');
    }

    $package->save();


    // Delete existing PackageProduct records for the package
    if($request->input('products'))
    {
        PackageProduct::where('productPackage_id', $package->id)->delete();

        $items = $request->input('products');
    
        if (is_array($items)) {
            // If $items is already an array, use it directly
            foreach ($items as $all) {
                
                $pack = new PackageProduct;
                $pack->productPackage_id = $package->id;
                $pack->product_id = $all['product_id'];
                $pack->order_count = $all['order_count'];
    
                $pack->save();
                
            }
        } 
    }
    
    return response()->json(['data' => $package]);
}

public function get_package()
{
     $package = ProductPackage::where('user_id',);
}

}

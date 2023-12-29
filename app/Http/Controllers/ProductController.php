<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
class ProductController extends Controller
{
    
   public function add_product(Request $request){

    $request->validate([
      'user_id' => 'required|numeric',
      'catagori_id' => 'required|numeric',
      'sub_catagorie_id' => 'required|numeric',
      'prduct_name' => 'required|string|max:255',
      'prduct_details' => 'required|string',
      'prduct_price' => 'required|numeric',
      'prduct_quantity' => 'required|numeric',
    ]);

    $product = new Product();
    $product->user_id = $request->user_id;
    $product->catagori_id = $request->catagori_id;
    $product->sub_catagorie_id = $request->sub_catagorie_id;
    $product->prduct_name = $request->prduct_name;
    $product->prduct_details = $request->prduct_details;
    $product->prduct_price = $request->prduct_price;
    $product->prduct_quantity = $request->prduct_quantity;

  $product->save();

  // img store 
  if ($request->hasFile('images')) {
    $images = $request->file('images');

    foreach ($images as $image) {
        // Handle each image (e.g., store in storage, database, etc.)
        $filename = $image->getClientOriginalName(); // Get the original filename
        $image->move('productimage', $filename);

        $pack = new ProductImage; 
        $pack->product_id = $product->id; 
        $pack->product_image = $filename;
        $pack->save();
    }
}

    return response()->json(['data' => $product]);

   }

}

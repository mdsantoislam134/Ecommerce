<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Catagory;

class TestController extends Controller
{
    
    // public function addimg(Request $request)
    // {
    //     $img = New Test;

       
    //         $image = $request->file('image');
        
    //         $filename = $image->getClientOriginalName(); // Get the original filename
    //         $image->move('test', $filename);
    //             $img->image = $filename;
    //             $img->save();
    //             return response()->json(['data' => $img]);
    // }


    public function addmultiimg(Request $request)
    {
        $request->validate([
         
            'catagori_id' => 'required',
            'sub_catagorie_id' => 'required',
            'prduct_name' => 'required',
            'prduct_details' => 'required',
            'prduct_price' => 'required',
            'prduct_quantity' => 'required',
          ]);
      
          $product = new Product();
          $product->user_id = $request->user()->id;
          $product->catagori_id = $request->catagori_id;
          $product->sub_catagorie_id = $request->sub_catagorie_id;
          $product->prduct_name = $request->prduct_name;
          $product->prduct_details = $request->prduct_details;
          $product->prduct_price = $request->prduct_price;
          $product->prduct_quantity = $request->prduct_quantity;
          $product->order_count = "1";
      
        $product->save();

        $cata =Catagory::find($request->catagori_id);
        $cata->items_count = $cata->items_count + 1;
        $cata->save(); 

        if ($request->hasFile('image')) {
            $images = $request->file('image');

            if (is_array($images)) {
                $uploadedImages = [];

                foreach ($images as $image) {
                    $imageName = $image->getClientOriginalName(); // Get the original image name
                    $image->move(public_path('productimage'), $imageName); // Move the image to the desired directory

                    $pack = new ProductImage; 
                    $pack->product_id = $product->id; 
             
                    $pack->product_image = "/productimage/$imageName";
                    $pack->save();

                    $uploadedImages[] = $imageName;
                }

                return response()->json(['message' => 'Images uploaded successfully', 'images' => $product], 200);
            } else {
                return response()->json(['message' => 'Invalid images provided'], 400);
            }
        } else {
            return response()->json(['message' => 'No images were uploaded'], 400);
        }

    }





    // update product 

    public function productupdate(Request $request, $id)
{

    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Update product fields
    if($request->catagori_id)
    {
        $product->catagori_id = $request->catagori_id;
    }
          
    if($request->sub_catagorie_id)
    {
        $product->sub_catagorie_id = $request->sub_catagorie_id;
    }
    if($request->prduct_name)
    {
        $product->prduct_name = $request->prduct_name;
    }
    if($request->prduct_details)
    {
        $product->prduct_details = $request->prduct_details;
    }
    if($request->prduct_price)
    {
        $product->prduct_price = $request->prduct_price;
    }
    if($request->prduct_quantity)
    {
        $product->prduct_quantity = $request->prduct_quantity;
    }
        
    $product->save();

    if ($request->hasFile('image')) {
        $images = $request->file('image');
    
        if (is_array($images)) {
            // Delete existing images associated with the product
            ProductImage::where('product_id', $product->id)->delete();
    
            $uploadedImages = [];
    
            foreach ($images as $image) {
                $imageName = $image->getClientOriginalName(); // Get the original image name
                $image->move(public_path('productimage'), $imageName); // Move the image to the desired directory
    
                $pack = new ProductImage;
                $pack->product_id = $product->id;
                $pack->product_image = "/productimage/$imageName";
                $pack->save();
    
                $uploadedImages[] = $imageName;
            }
    
            return response()->json(['message' => 'Images updated successfully', 'images' => $uploadedImages], 200);
        }
    } 

    $data = Product::with('productimage')->find($product->id);

    return response()->json(['message' => 'Product updated successfully', 'product' => $data], 200);
}



// get product user base 

public function getproduct(Request $request)
{
      $product = Product::where('user_id',$request->user()->id)->with('productimage')->get();
      return response()->json(['message' => 'Product get successfully', 'product' => $product], 200);
}
    
    

}

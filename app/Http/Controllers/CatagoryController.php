<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\SubCatagory;
use App\Models\Product;
use App\Models\ProductImage;
class CatagoryController extends Controller
{
    
    public function add_cata(Request $request)
    {
        $request->validate([
            'catagory' => 'required',
            'cata_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        
        $cata = new Catagory;
        $cata->catagory = $request->catagory;
    
        if ($request->hasFile('cata_image')) {
            $photo = $request->file('cata_image');
            $imageName = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move('catagoryimage', $imageName);
          
            $cata->catagory_image = "/catagoryimage/$imageName";
        }
    
        $cata->items_count = 0;
        $cata->save();
    
        return redirect('Catagory')->with('message', 'Category Added!');
    }
    


    public function addcata(){
        return view('Admin.addcatagory');
    }


    public function add_sub_cata(Request $request,$id){

        $catagoeri = Catagory::find($id);
 
        $subcata = New SubCatagory;
        $subcata->subcata = $request->subcata;

        $catagoeri->SubCatagory()->save($subcata);

        

        $url = url('Sub-Catagory/'.$id);

        return redirect($url)->with('massage', "Sub Category Added!");

    }


//   public function deletecata($id){
//     Product::where('category_id', $id)->delete();

//     // Then delete the category
//     Category::find($id)->delete();
    
//   }




//   Retrive cata List 

public function catalist()
{
    $domain = url('/'); // Get the base URL of the application

    // Fetch categories with their associated subcategories
    $cata = Catagory::with('subcatagory')->get();
    
    // Check if catagory_image exists before updating the image URL
    $cata = $cata->map(function ($category) use ($domain) {
        if ($category->catagory_image) {
            $category->catagory_image = $domain . $category->catagory_image; // Update the image URL with the base URL
        }
        return $category;
    });

    // Return the response with the updated category data
    return response()->json(['data' => $cata]);
}


//  for api 
public function getproduct($id)
{
    $pro = Product::where('sub_catagorie_id', $id)->with('productimage')->get();

    // Check if productimg relationship exists before mapping
    $domain = url('/');
    $pro->each(function ($product) use ($domain) {
        $product->productimage->each(function ($image) use ($domain) {
            $image->product_image = $domain . $image->product_image;
        });
    });

    return response()->json(['data' => $pro]);
}




}

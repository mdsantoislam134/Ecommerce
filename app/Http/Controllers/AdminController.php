<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Catagory;
use App\Models\SubCatagory;
use App\Models\delivery_option;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function loginview(){
        return view('Admin.login');
     }


     public function login(Request $request)
     {
        
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user =$request->user();
            if ($user->user_type != "Admin") {
                Auth::logout();
                return redirect()->back()->with('error',"Invalid Admin");
            }

              return redirect()->route('Adminhome');
        } 
        
        return redirect()->back()->with('error',"Invalid Admin");
        }



        public function home(){
            return view('admin.dashboard');
        }


    public function showcata(){
       $catagory = Catagory::all();
        return view('admin.catagory',['cata'=>$catagory]);
    }


public function addsubcata($id){
  
     return view('Admin.addsubcata',['id'=>$id]);
}



public function showsubcata($id){

    $product = Catagory::find($id);

  return view('Admin.subcatagory',['subcata'=>$product]);
}


// public function deletesubcata($id){
//     // Find the products with the specified subcategory ID
//     $products = Product::where('sub_catagorie_id', $id)->get();

//     // Delete associated records in the package_products table
//     foreach ($products as $product) {
//         PackageProduct::where('product_id', $product->id)->delete();
//     }

//     // Then delete the products
//     Product::where('sub_catagorie_id', $id)->delete();

//     // Finally, delete the subcategory
//     SubCatagory::find($id)->delete();

//     return redirect()->back()->with('error', "Sub Category Deleted!");
// }


//  Policy && Delivery Option 


public function adddeli()
{
   $deli = delivery_option::all();

    return view('Admin.delivery',['deli'=>$deli]);
}


public function showForm(){
    return view('Admin.addrouls');
}


}
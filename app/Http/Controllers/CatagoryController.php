<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\SubCatagory;
class CatagoryController extends Controller
{
    
     
    public function add_cata(Request $request){

        $cata = New Catagory;
        $cata->catagory = $request->catagory;
        $cata->items_count = 0 ;
        $cata->save();

        return redirect('Catagory')->with('massage', "Category Added!");
       
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





}

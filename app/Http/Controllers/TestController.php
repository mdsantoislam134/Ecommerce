<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    
    public function addimg(Request $request)
    {
        $img = New Test;

       
            $image = $request->file('image');
        
            $filename = $image->getClientOriginalName(); // Get the original filename
            $image->move('test', $filename);
                $img->image = $filename;
                $img->save();
                return response()->json(['data' => $img]);
    }


    public function addmultiimg(Request $request)
    {
      
        if ($request->hasFile('image')) {
            $images = $request->file('image');
        
            foreach ($images as $image) {
                  $img = New Test;
                // Handle each image (e.g., store in storage, database, etc.)
                $filename = $image->getClientOriginalName(); // Get the original filename
                $image->move('test', $filename);
                $img->image = $filename;
                $img->save();
             
            }
              }
        return response()->json(['data' => $img]);
    }
    

}

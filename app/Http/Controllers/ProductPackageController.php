<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductPackage;
Use App\Models\PackageProduct;
Use App\Models\Product;
Use App\Models\Order;
class ProductPackageController extends Controller
{

    public function add_package(Request $request){
        // $request->validate([
        //     'package_name' => 'required|string',
        //     'policy_id' => 'required',
        //     'delivery_option_id' => 'required',
        //     'package_price' => 'required|numeric',
        // ]);

        $package = New ProductPackage;
            $package->user_id = $request->user()->id;
            $package->package_name ="medisen Package";
            $package->package_discription = "Buye the package and Enjoy the Winter";
            $package->policy_id = 1;
            $package->delivery_option_id = 1;
            $package->package_price ="1000";
            $package->package_discount_price = "800";
            $package->rating = "0";
      
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
    if( $request->input('package_discount_price'))
    {
        $package->package_discount_price = $request->input('package_discount_price');
    }
    if( $request->input('package_discription'))
    {
        $package->package_discription = $request->input('package_discription');
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
                $pack->product_id = $all['id'];
                $pack->order_count = $all['order_count'];
    
                $pack->save();
                
            }
        } 
    }
    
    return response()->json(['data' => $package]);
}



public function get_package(Request $request)
{
      $userid =$request->user()->id;
      $packages = ProductPackage::where('user_id', $userid)->with('products.productimage')->get();
    //   productimage 
    $packages->each(function ($package) {
        $package->products->each(function ($product) {
            if ($product->productimage) {
                // Use unique to ensure each image is processed only once
                $uniqueImages = $product->productimage->unique('id');

                $uniqueImages->each(function ($image) {
                    $image->product_image = asset($image->product_image);
                });
            }
        });
    });

      return response()->json(['data' => $packages]);
}

public function get_all_package(Request $request)
{
    $packages = ProductPackage::with(['products.productimage'])->get();

    $packages->each(function ($package) {
        $package->products->each(function ($product) {
            if ($product->productimage) {
                // Use unique to ensure each image is processed only once
                $uniqueImages = $product->productimage->unique('id');

                $uniqueImages->each(function ($image) {
                    $image->product_image = asset($image->product_image);
                });
            }
        });
    });

    return response()->json(['data' => $packages]);
}



public function get_pending_order_package(Request $request)
{
    $orders = Order::where('buyer_id', $request->user()->id)
        ->with([
            'productPackages.products.productimage',
        ])
        ->get();

    // Add the app domain to the product_image path
    $orders->each(function ($package) {
    $package->productPackages->each(function ($package) {
        $package->products->each(function ($product) {
            if ($product->productimage) {
                // Use unique to ensure each image is processed only once
                $uniqueImages = $product->productimage->unique('id');

                $uniqueImages->each(function ($image) {
                    $image->product_image = asset($image->product_image);
                });
            }
        });
    });
});

    return response()->json(['data' => $orders]);
}




public function get_pending_order_seller(Request $request){

        $orders = Order::where('seller_id',$request->user()->id )
           ->where('order_status',"pending")
            ->with([
                'productPackages.products.productimage',
            ])
            ->get();
            $orders->each(function ($package) {
                $package->productPackages->each(function ($package) {
                    $package->products->each(function ($product) {
                        if ($product->productimage) {
                            // Use unique to ensure each image is processed only once
                            $uniqueImages = $product->productimage->unique('id');
            
                            $uniqueImages->each(function ($image) {
                                $image->product_image = asset($image->product_image);
                            });
                        }
                    });
                });
            });
        
        return response()->json(['data' => $orders]);

   
}


public function dealofday(){
    // Retrieve ProductPackage records with related products and product images
    $packages = ProductPackage::with([
        'products.productimage',
        'user' => function ($query) {
            $query->select('id', 'store_name'); // Select only the necessary columns
        }
    ])->where('catagory', "Deal of the Day")->get();

   
    $packages->each(function ($package) {
        $package->products->each(function ($product) {
            if ($product->productimage) {
                // Use unique to ensure each image is processed only once
                $uniqueImages = $product->productimage->unique('id');

                $uniqueImages->each(function ($image) {
                    $image->product_image = asset($image->product_image);
                });
            }
        });
    });
    // Return the data as JSON response
    return response()->json(['data' => $packages]);
}


public function specialoffer(){

      // Retrieve ProductPackage records with related products and product images
      $packages = ProductPackage::with([
        'products.productimage',
        'user' => function ($query) {
            $query->select('id', 'store_name'); // Select only the necessary columns
        }
    ])->where('catagory', "Special Offer")->get();
    


    
      $packages->each(function ($package) {
          $package->products->each(function ($product) {
              if ($product->productimage) {
                  // Use unique to ensure each image is processed only once
                  $uniqueImages = $product->productimage->unique('id');
  
                  $uniqueImages->each(function ($image) {
                      $image->product_image = asset($image->product_image);
                  });
              }
          });
      });
      
      // Return the data as JSON response
      return response()->json(['data' => $packages]);
}



public function singelsellerpackage($id)
{
    $packages = ProductPackage::with([
        'products.productimage',
        'user' => function ($query) {
            $query->select('id', 'store_name'); // Select only the necessary columns
        }
    ])->where('user_id', $id)->get();
    


    
      $packages->each(function ($package) {
          $package->products->each(function ($product) {
              if ($product->productimage) {
                  // Use unique to ensure each image is processed only once
                  $uniqueImages = $product->productimage->unique('id');
  
                  $uniqueImages->each(function ($image) {
                      $image->product_image = asset($image->product_image);
                  });
              }
          });
      });
      // Return the data as JSON response
      return response()->json(['data' => $packages]);
}



}
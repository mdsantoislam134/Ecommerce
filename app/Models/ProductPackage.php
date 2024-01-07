<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function policy()
    {
        return $this->belongsTo(Policy::class);
    }

    public function delivery_option()
    {
        return $this->belongsTo(delivery_option::class);
    }

    public function packageProduct()
    {
        return $this->hasMany(PackageProduct::class,'productPackage_id');
    }

    public function products()
{
    return $this->belongsToMany(Product::class, 'package_products','productPackage_id','product_id');
}

  public function orders()
   {
    return $this->belongsToMany(Order::class, 'order_product_package')
        ->withPivot('total_price', 'package_quantity')
        ->withTimestamps();
   }
    

public function orderpackage()
{
    return $this->hasMany(OrderPackage::class, 'order_id');
}
public function review()
{
    return $this->hasMany(Review::class, 'productPackage_id');
}
}

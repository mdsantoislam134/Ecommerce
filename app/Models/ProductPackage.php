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
    return $this->hasMany(Order::class, 'productPackage_id');
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPackage extends Model
{
    use HasFactory;

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

}

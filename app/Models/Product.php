<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'product_name',
        'product_details',
        'product_img',
        'product_price',
        'product_quantity',
        'order_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catagory()
    {
        return $this->belongsTo(Catagory::class,'catagori_id');
    }
    public function productimage()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCatagory::class,'sub_catagorie_id');
    }

    public function packageProduct()
    {
        return $this->hasMany(PackageProduct::class,'product_id');
    }

    public function productPackages()
    {
        return $this->belongsToMany(ProductPackage::class, 'package_products', 'product_id', 'productPackage_id');
    }
}

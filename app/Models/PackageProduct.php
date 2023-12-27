<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageProduct extends Model
{
    use HasFactory;

    public function productPackage()
    {
        return $this->belongsTo(ProductPackage::class,'productPackage_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

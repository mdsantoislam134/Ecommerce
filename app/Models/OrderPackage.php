<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'productPackage_id', 'total_price', 'package_quantity'
    ];

    
    public function productpackage()
    {
        return $this->belongsTo(ProductPackage::class, 'productPackage_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}

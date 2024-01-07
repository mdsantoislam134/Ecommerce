<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'buyer_id',
        'order_status',
        'total_cost',
        'buyer_address',
        'seller_id',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_id = Str::random(8);
        });
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

     public function productPackages()
    {
        return $this->belongsToMany(ProductPackage::class, 'order_packages', 'order_id', 'productPackage_id');
    }
    
    public function orderpackage()
    {
        return $this->hasMany(OrderPackage::class, 'order_id');
    }

}

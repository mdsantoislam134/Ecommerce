<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['order_id', 'productPackage_id', 'buyer_id', 'order_status', 'buyer_address'];

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

    public function productpackage()
    {
        return $this->belongsTo(ProductPackage::class, 'productPackage_id');
    }
    // Your other model code...
}

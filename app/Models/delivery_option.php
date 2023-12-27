<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class delivery_option extends Model
{
    use HasFactory;

    public function productPackage()
    {
        return $this->hasOne(ProductPackage::class);
    }
}

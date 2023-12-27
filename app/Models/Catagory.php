<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catagory extends Model
{
    use HasFactory;
 
    public function subcatagory(){
      return $this->hasMany(SubCatagory::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

}

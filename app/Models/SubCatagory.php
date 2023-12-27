<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCatagory extends Model
{
    use HasFactory;
    public function catagory(){
        return $this->beLongsTo(Catagory::class);
      }

      public function product()
      {
          return $this->hasMany(Product::class);
      }


}

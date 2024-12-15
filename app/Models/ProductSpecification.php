<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    //
    protected $fillable = ['product_id','product_code','specs_value','qty','purchase_price','sale_price','status'];

    public function products(){
        return $this->hasMany(Product::class);
    }
}

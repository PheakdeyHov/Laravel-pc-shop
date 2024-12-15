<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    //
    protected $fillable = ['purchase_id','product_id','product_name','product_specifications_id','specs_value','qty','purchase_price','sale_price','status'];

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function specifications(){
        return $this->hasMany(ProductSpecification::class);
    }

    public function purchase(){
        return $this->belongsTo(Purchase::class);
    }
}

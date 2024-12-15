<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable = ['suppliers_id','shipping_company','shipping_price','shipping_status','paid_price','notpaid_price','total_price'];

    public function suppliers(){
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseproduct(){
        return $this->hasMany(PurchaseProduct::class);
    }
}

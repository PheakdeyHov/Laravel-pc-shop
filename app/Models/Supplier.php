<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = ['name' , 'email' , 'address' , 'phonenumber'];

    public function purchase(){
        return $this->hasMany(Purchase::class);
    }
}

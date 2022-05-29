<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productbooking extends Model
{
    use HasFactory;
    protected $table="productbookings";
    public function productbooking(){
        return  $this->hasMany(Productbookingdetail::class,'booking_id');
    }

    public function customer(){
        return  $this->belongsTo(Customer::class)->select('id', 'name','email','mobile','membership_id','address');
    }
}

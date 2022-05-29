<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table="bookings";

    
    public function bookingdetail(){
        return  $this->hasMany(Bookingdetail::class);
    }

    public function customer(){
        return  $this->belongsTo(Customer::class)->select('id', 'name','email','mobile','membership_id','address');
    }

}

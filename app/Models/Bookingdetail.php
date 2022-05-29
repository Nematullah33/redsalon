<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookingdetail extends Model
{
    use HasFactory;
    protected $table="bookingdetail";

    public function service(){
        return  $this->belongsTo(Service::class,'service_id')->select('id', 'name','price');
    }
}

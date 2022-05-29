<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table="customers";

    public function designation(){
        return  $this->belongsTo(Designation::class)->select('id', 'name');
    }
    public function customer(){
        return  $this->hasMany(Service::class,'service_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table='services';

    public function category(){
        return  $this->belongsTo(Category::class)->select('id', 'name');
    }
    public function servicedetail(){
        return  $this->hasMany(Bookingdetail::class);
    }
}

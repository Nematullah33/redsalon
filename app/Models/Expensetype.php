<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expensetype extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function expense(){
        return  $this->hasMany(Expense::class);
    }


}

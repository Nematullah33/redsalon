<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expensetype;

class ExpensetypeController extends Controller
{
    public function addExptype(Request $req){
        $designation=new Expensetype;
        $designation->name=$req->name;
        $designation->save();
               
        return back()->with('success', 'Add successfully');
    }
}

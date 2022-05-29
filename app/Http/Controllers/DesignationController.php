<?php

namespace App\Http\Controllers;
use App\Models\Designation;
use Illuminate\Http\Request;
class DesignationController extends Controller
{
    //
    public function addDesignation(Request $req){
        $designation=new Designation;
        $designation->name=$req->name;
        $designation->save();
               
        return back()->with('success', 'Status update successfully');
    }
}

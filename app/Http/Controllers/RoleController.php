<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;
use App\Models\MenuMappning;
class RoleController extends Controller
{
    public function index(){
        $roles=Role::all(); 
        return view('pages.role.manage_role',compact('roles'));
    }
    public function edit($id){
        $roles=Role::all();
        $allmenus=Menu::all();
        //return $allmenus;
        $menus= MenuMappning::select('role_id','menu_id','menu_name')->where('role_id',$id)->get();
        //return $menus;
        return view('pages.menumapping.edit_mapping',compact('roles','menus','allmenus'));
    }
}

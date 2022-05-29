<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Menu;
use App\Models\MenuMappning;

class MenuMappingController extends Controller
{
    public function create(){
        $roles=Role::all();
        $menus=Menu::all();
        return view('pages.menumapping.create_mapping',compact('roles','menus'));
    }

    public function store(Request $request){
        $data = $request->all();
       
        foreach ($data['menu_id'] as $menu) {
            $menus = explode(":", $menu);
            $menumap = new MenuMappning();
            $menumap->role_id = $data['role_id'];
            // $menumap->description = $data['description'] ?? "";
            $menumap->menu_id = $menus[0];
            $menumap->menu_name = $menus[1];
            $menumap->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Menu Mapping Successfully!'
        ]);
    }
    public function menumappingUpdate(Request $request){
        $data = $request->all();
        //return $data;
        MenuMappning::where('role_id', $data['role_id'])->delete();
        
        foreach ($data['menu_id'] as $menu) {
            $menus = explode(":", $menu);
            $menumap = new MenuMappning();
            $menumap->role_id = $data['role_id'];
            $menumap->menu_id = $menus[0];
            $menumap->menu_name = $menus[1];
            $menumap->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Menu Mapping Updated Successfully!'
        ]);
    }

    public function getMenu(){
        
        $id=$_GET['id'];
        $menu= MenuMappning::select('menu_id','menu_name')->where('role_id',$id)->get();
        return $menu;
        return json_encode($menu);
    }
}

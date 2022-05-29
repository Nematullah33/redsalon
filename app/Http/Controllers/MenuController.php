<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;
class MenuController extends Controller
{
    public function index(){
       $menus=Menu::all(); 
       return view('pages.menu.manage_menu',compact('menus'));
    }
    public function create(){
         
        return view('pages.menu.create_menu');
    }
    public function store(Request $req){
        $validator = Validator::make($req->all(), [
            
            'name' => 'required',
            'url' => 'required',
            
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $menu=new Menu;
        $menu->name=$req->name;
        $menu->url=$req->url;
        $menu->description=$req->description;
        $menu->save();
        return view('pages.menu.create_menu');
    }

}

<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;

class PriceController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(){
        $user_id=session('sess_id');
        if(!isset($user_id))return redirect('/');
        return view('layout.erp.dashboard');
    }
    public function get_price(Request $request){
        $px=DB::getTablePrefix();
        $id= $request->input('Product');
        $price = DB::select("select new_price from {$px}products where id='$id'");
        $price=$price[0]->new_price;
        return $price;

        
    }
    public function name(){
        return "Hello";
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Setting;
use App\Models\Transaction;
use PDF;
use Illuminate\Support\Facades\DB;
class StockController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(Request $request)
    {
        $search=$request['search'] ?? "";
        if($search!=""){
        $products = Product::select('id', 'name')->where('name','LIKE',"%$search%")->with(['stocks' => function($q) {
            $q->select('id', 'product_id', 'qty');
             $q->groupBy('id','product_id','qty');
        }])->get();
       
        return view("pages.stock.manage_stock",compact('products','search'));

        }else{
            $products = Product::select('id', 'name')->with(['stocks' => function($q) {
                $q->select('id', 'product_id', 'qty');
                 $q->groupBy('id','product_id','qty');
            }])->orderBy('id','DESC')->paginate(10);
            return view("pages.stock.manage_stock",compact('products','search'));
        }
    }
    public function stockListpdf(Request $request)
    {
        $site = Setting::first();
            $products = Product::select('id', 'name')->with(['stocks' => function($q) {
                $q->select('id', 'product_id', 'qty');
                 $q->groupBy('id','product_id','qty');
            }])->get();
            $pdf = PDF::loadView('pages.pdf.stocklist', compact('products','site')); //stock report
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        
    }
    public function show($id)
    {
        $stock=Stock::with('product','transaction')->where('product_id',$id)->get();
        return view("pages.stock.details_stock",["products"=>$stock]);
    }
    public function create()
    {
        $px=DB::getTablePrefix();
        $transactions = DB::select("select id,name from {$px}transactions");
        $products = DB::select("select id,name from {$px}products");
        return view('pages/stock/stock_adjustment',compact('products','transactions'));
    }
    public function stocksReceiveCreate()
    {
        $px=DB::getTablePrefix();
        $transactions = DB::select("select id,name from {$px}transactions");
        $products = DB::select("select id,name from {$px}products");
        return view('pages/stock/stock_receive_adjustment',compact('products','transactions'));
    }
    

    public function store(Request $request)
    {

        $service=new Stock;
        $service->product_id=$request->cmbProduct;
        $service->transaction_id=$request->cmbType;
        if($request->cmbType==6 || $request->cmbType==7){
            $service->qty=$request->qty;
            $service->note=$request->note;
            $service->save();
        }else{
            $service->qty=-$request->qty;
            $service->note=$request->note;
            $service->save();
        }
        return back()->with('save_adjusmnet','Stock adjusment successfully');

    }
    public function save(Request $request)
    {

        $service=new Stock;
        $service->product_id=$request->cmbProduct;
        $service->transaction_id=$request->cmbType;
        if($request->cmbType==6){
            $service->qty=$request->qty;
            $service->note=$request->note;
            $service->save();
        }else{
            $service->qty=-$request->qty;
            $service->note=$request->note;
            $service->save();
        }
        
        return back()->with('save_adjusmnet','Stock adjusment successfully');

    }

    public function stockReport(Request $request){
        $from=$request['formOrder'] ?? "";
        $to=$request['toOrder'] ?? "";
        
        if($from!="" && $to!=""){
            $transactions=stock::with('product','transaction')->whereBetween('created_at', [$from, $to])->get(); 
            return view('pages/stock/report_stock',compact('transactions','from','to'));
        }else{
            $transactions=stock::with('product','transaction')->orderBy('id','DESC')->paginate(10);
            //return $transactions;
            return view('pages/stock/report_stock',compact('transactions','from','to'));
        }
        
    }



}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\Customer;
use App\Models\Stock;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class PurchaseController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $from=$request['formOrder']?? "";
        $to=$request['toOrder']?? "";
        if($from!="" && $to!=""){
            $purchases=Purchase::join('suppliers as s','s.id','=','purchases.supplier_id')
            ->select('purchases.id','s.name as supplier_name','s.mobile','purchases.total_amount','purchases.purchase_date')
            ->whereBetween('purchases.purchase_date', [$from, $to])->get();
            return view("pages.purchase.manage_purchase",["purchases"=>$purchases]);
        }else{
            
            $purchases=Purchase::join('suppliers as s','s.id','=','purchases.supplier_id')
            ->select('purchases.id','s.name as supplier_name','s.mobile','purchases.total_amount','purchases.purchase_date')
            ->orderBy('id','DESC')->paginate(10);
            return view("pages.purchase.manage_purchase",["purchases"=>$purchases]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $px=DB::getTablePrefix();
        $purchase_id = DB::select("select max(id) id from {$px}purchases");
        $suppliers=DB::table("suppliers")->get();
        $products=DB::table("products")->get();

       // print_r($suppliers);
        return view("pages.purchase.create_purchase",["purchase_id"=>$purchase_id,"suppliers"=>$suppliers,"products"=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         
               
         
          //print_r($products);
        //Order
         $purchase=new Purchase;

        // print_r($order);

           $purchase->supplier_id=$request->cmbSupplier;
           $purchase->purchase_date=date("Y-m-d",strtotime($request->txtpurchaseDate));
           $purchase->note=isset($request->txtNote)?$request->txtNote:"NA";
           $purchase->total_amount=$request->subtotal;
           if($request->cmbSupplier!=0){
            $purchase->save();
           }

        $products=$request->txtProducts; 

        foreach($products as $product){         
           
            $purchase_detail=new PurchaseDetail;         

            $purchase_detail->purchase_id=$purchase->id;
            $purchase_detail->product_id=$product["item_id"];
            $purchase_detail->qty=$product["qty"];
            $purchase_detail->price=$product["price"];            
            //$purchase_detail->discount=isset($product["discount"])?$product["discount"]:0;
           // $purchase_detail->vat=0;
            $purchase_detail->save();
            $stock=new Stock;
            $stock->product_id=$product["item_id"];
            $stock->qty=$product["qty"];
            $stock->transaction_id=2;
            $stock->save();
        }


         //Stock




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $px=DB::getTablePrefix();
        $customer=DB::select("select o.id,c.name,c.mobile,c.email,company from {$px}suppliers c,{$px}purchases o where o.supplier_id=c.id and o.id=$id");

        $details=DB::select("select c.id,p.name product_name,d.price,d.qty,o.total_amount,o.purchase_date from {$px}purchases o,{$px}purchase_details d,{$px}products p,{$px}suppliers c where c.id=o.supplier_id and o.id=d.purchase_id and d.product_id=p.id and o.id='$id'");
        return view("pages.purchase.invoice",["details"=>$details,"customer"=>$customer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function purchDelete(Request $request)
    {

        $px=DB::getTablePrefix();
		if ($request->ajax()) {
            $data = $request->all();
            $purchase = Purchase::find($data['id']);
            $purchasedetail = PurchaseDetail::where('purchase_id',$data['id']);
            
            if (!is_null($purchase)) {
                $purchase->delete();
                $purchasedetail->delete();
                //DB::delete("delete from {$px}purchase_details where purchase_id={$data['id']}");
            }
            return response()->json([
                'success' => true
            ]);
        }

    }

}

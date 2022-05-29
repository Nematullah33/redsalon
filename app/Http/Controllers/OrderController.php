<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Stock;
use App\Models\Transactionlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade as PDF;


class OrderController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(Request $request){
        $from=$request['formOrder'] ?? "";
        $to=$request['toOrder'] ?? "";
        
        if($from!="" && $to!=""){
            $orders=Order::join('customers as c','c.id','=','orders.customer_id')
            ->select('orders.id','orders.status_id','c.name as cus_name','c.mobile','orders.order_date','orders.order_total','orders.customer_note','orders.advance')
            ->whereBetween('orders.order_date', [$from, $to])->get();
            return view("pages.order.manage",["orders"=>$orders, "from"=> $from, "to"=>$to]);
        }else{
            $orders=Order::join('customers as c','c.id','=','orders.customer_id')
            ->select('orders.id','orders.status_id','c.name as cus_name','c.mobile','orders.order_date','orders.order_total','orders.discount','orders.paid_amount','orders.advance')
            ->orderBy('id','DESC')->paginate(10);
            return view("pages.order.manage",["orders"=>$orders, "from"=> $from, "to"=>$to]);
        }
    }   

    public function orderPrint(Request $request)
    {
        $from=$request->from ?? "";
        $to=$request->to ?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){
            $orders=Order::join('customers as c','c.id','=','orders.customer_id')
            ->select('orders.id','orders.status_id','c.name as cus_name','c.mobile','orders.order_date','orders.order_total','orders.discount','orders.paid_amount')
            ->whereBetween('orders.order_date', [$from, $to])->get();

            $pdf = PDF::loadView('pages.pdf.order_report', compact('orders','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $orders=Order::join('customers as c','c.id','=','orders.customer_id')
            ->select('orders.id','orders.status_id','c.name as cus_name','c.mobile','orders.order_date','orders.order_total','orders.discount','orders.paid_amount','orders.advane')
            ->orderBy('id','DESC')->get();
            $pdf = PDF::loadView('pages.pdf.order_report', compact('orders','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }
    }

    public function create(){
        $px=DB::getTablePrefix();
        $order_id = DB::select("select max(id) id from {$px}orders");
        // $product = DB::select("select p.id,p.name,p.price, sum(s.qty) qty from lc_products p,lc_stocks s where p.id=s.product_id group By p.id");
        $product = Product::select('id', 'name',)->with(['stocks' => function($q) {
            $q->select('id', 'product_id', 'qty');
             $q->groupBy('id','product_id','qty');
            }])->get();
            
        $customer = DB::select("select id,name,membership_id,mobile from {$px}customers");
        return view("pages.order.create_order",["order_id"=>$order_id,"products"=>$product,"customers"=>$customer]);
    }

    public function store(Request $request){
        
        $px=DB::getTablePrefix();
        $customer_id=$request->input('cmbCustomer');
        $invoice_id=$request->invoice_id;
       
        $order_date=$request->input('txtSaleDate');

        $discount=$request->totalDiscount ?? 0;
        $vat=$request->input('txtVat');
        $note=$request->input('txtNote');
        $order_total=$request->input('subtotal');
        $products=$request->input('txtProduct');
        $paid_amount=$request->input('paidAmount');
        $payment_type=$request->input('paymentType');
        $advPaid=$request->input('advPaid') ?? 0;
        //print_r($products);
        $discount=round($order_total*$discount/100);
        $order_date=date("Y-m-d",strtotime($order_date));//convert date into mysql format
        $created_at=date("Y-m-d");
        $updated_at=date("Y-m-d");
        
       DB::insert("insert into {$px}orders(customer_id,invoice_id,advance,order_date,discount,vat,customer_note,paid_amount,payment_type,order_total,created_at,updated_at)values('$customer_id','$invoice_id','$advPaid','$order_date','$discount','$vat','$note','$paid_amount','$payment_type','$order_total','$created_at','$updated_at')");   
        $order_id=DB::getPdo()->lastInsertId();
        ;
        foreach($products as $product){ 
             
            //print_r($product);
            DB::insert("insert into {$px}order_details(order_id,product_id,price,qty,discount,created_at,updated_at)values('$order_id','{$product["item_id"]}','{$product["price"]}','{$product["qty"]}','{$product["discount"]}','$created_at','$updated_at')");

             $stock=new Stock;
             $stock->product_id=$product["item_id"];
             $stock->qty=-$product["qty"];
             $stock->transaction_id=1;
             $stock->save();

        }
        $log=new Transactionlog;
        $log->transaction_type='Product Sale';
        $log->customer_id=$customer_id;
        $log->date=$order_date;
        $log->sale_total=$order_total;
        $log->paid_amount=$paid_amount;
        $log->advance=$advPaid;
        $log->payment_type=$payment_type;
        $log->invoice_id=$invoice_id;
        $log->discount=$discount;
        $log->save();
        $site= Setting::first();
        $customer=DB::select("select o.id,o.invoice_id,c.name,c.mobile,c.email from {$px}customers c,{$px}orders o where o.customer_id=c.id and o.id=$order_id");

        $details=DB::select("select c.id,p.name product_name,d.price,d.qty,d.discount,o.discount as total_discount,o.order_date,o.paid_amount from {$px}orders o,{$px}order_details d,{$px}products p,{$px}customers c where c.id=o.customer_id and o.id=d.order_id and d.product_id=p.id and o.id='$order_id'");
        
        return response()->json([
            'view'=>(String)View::make("pages.order.print_sale_invoice",["details"=>$details,"customer"=>$customer,"advPaid"=>$advPaid,"site"=>$site])
          
        ]);
        
      
    }

    public function show($id)
    {
        $px=DB::getTablePrefix();
        $customer=DB::select("select o.id,o.invoice_id,c.name,c.mobile,c.email from {$px}customers c,{$px}orders o where o.customer_id=c.id and o.id=$id");
        $details=DB::select("select c.id,p.name product_name,d.price,d.qty,d.discount,o.discount as total_discount,o.paid_amount,o.order_date from {$px}orders o,{$px}order_details d,{$px}products p,{$px}customers c where c.id=o.customer_id and o.id=d.order_id and d.product_id=p.id and o.id='$id'");
        return view("pages.order.invoice",["details"=>$details,"customer"=>$customer]);
    }

    public function edit($id){
        $px=DB::getTablePrefix();
       $roles = DB::select('select id,name from roles');

       //$user = DB::select("select id,username,email,role_id from users where id='$id'");
        $user= DB::table('users')->where('id', $id)->first();
        return view("pages.user.edit_user",["user"=>$user,"roles"=>$roles]);
    }

    public function update($id,Request $request){
        $px=DB::getTablePrefix();
        $role_id= $request->input('cmbRole'); 
        $username = $request->input('txtUsername'); 
        $email=   $request->input('txtEmail');   
        $password=$request->input('txtPassword'); 

        $file=$request->file('filePhoto'); 

        $photo = $username.'.'.$file->getClientOriginalExtension();
        $path = public_path('/img');
        $file->move($path,$photo);

        DB::update("update users set photo='$photo', username='$username',email='$email',password='$password',role_id='$role_id' where id='$id'");       
        

        //return Redirect::route('users.index');
        return back()->with('success','Image Upload successfully');
    }

    // public function destroy($id){
    //     $px=DB::getTablePrefix();
    //     DB::delete("delete from {$px}orders where id={$id}");
    //     DB::delete("delete from {$px}order_details where order_id={$id}");
    //     //return Redirect::route('users.index');
    //     return back()->with('delete_order','This Order Deleted successfully');
    // }
    public function orderDelete(Request $request)
    {

        $px=DB::getTablePrefix();
		if ($request->ajax()) {
            $data = $request->all();
            $purchase = Order::find($data['id']);
            $purchasedetail = orderDetail::where("purchase_id",$data['id']);
            
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
    public function updateStatus(Request $req){
        $status=$req->status_id;
        $id=$req->order_id;
        Order::where('id', $id)
        ->update(['status_id' => $status]);
        //return back()->with('success', 'status update successfully');
    }
    
}
<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Servicesale;
use App\Models\ServicesaleDetal;
use App\Models\Transactionlog;
use App\Models\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\View;
use PDF;

class ServicesaleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function index(Request $request){
        $from=$request['formOrder']?? "";
        $to=$request['toOrder']?? "";
        if($from!="" && $to!=""){
            

            $orders=Servicesale::join('customers as c','c.id','=','servicesales.customer_id')
            ->select('servicesales.id','c.name as cus_name','c.mobile','servicesales.sale_date','servicesales.paid_amount','servicesales.sale_total','servicesales.discount','servicesales.advance')
            ->whereBetween('servicesales.sale_date', [$from, $to])->get();
            return view("pages.servicesale.manage_servicesale",["orders"=>$orders, "from"=> $from, "to"=>$to]);
        }else{
            $orders=Servicesale::join('customers as c','c.id','=','servicesales.customer_id')
            ->select('servicesales.id','c.name as cus_name','c.mobile','servicesales.sale_date','servicesales.paid_amount','servicesales.sale_total','servicesales.advance','servicesales.discount')
            ->orderBy('id','DESC')->paginate(10);
            return view("pages.servicesale.manage_servicesale",["orders"=>$orders, "from"=> $from, "to"=>$to]);
        }


    }  
    
    public function servicesalePrint(Request $request)
    {
        $from=$request->from ?? "";
        $to=$request->to ?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){

            $orders=Servicesale::join('customers as c','c.id','=','servicesales.customer_id')
            ->select('servicesales.id','c.name as cus_name','c.mobile','servicesales.sale_date','servicesales.paid_amount','servicesales.sale_total','servicesales.discount')
            ->whereBetween('servicesales.sale_date', [$from, $to])->get();
            $pdf = PDF::loadView('pages.pdf.servicesale_report', compact('orders','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $orders=Servicesale::join('customers as c','c.id','=','servicesales.customer_id')
            ->select('servicesales.id','c.name as cus_name','c.mobile','servicesales.sale_date','servicesales.paid_amount','servicesales.sale_total','servicesales.discount')
            ->orderBy('id','DESC')->get();

            $pdf = PDF::loadView('pages.pdf.servicesale_report', compact('orders','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }
    }

    public function create(){
        $px=DB::getTablePrefix();
        $designation = DB::select("select id,name from {$px}designations");
        $sales_id = DB::select("select max(id) id from {$px}servicesales");
        $service = DB::select("select id,name,price from {$px}services");
        $customer = DB::select("select id,name,membership_id,mobile from {$px}customers");
        return view("pages.servicesale.create_servicesale",["sales_id"=>$sales_id,"services"=>$service,"customers"=>$customer,"designation"=>$designation]);
    }

    public function store(Request $request){  
        $invoice = Servicesale::where('invoice_id',$request->invoice_id)->exists();
        if($invoice){
            return response()->json([
                'status'=>false
            ]);
        }
        $px=DB::getTablePrefix();
        $customer_id=$request->input('cmbCustomer');
       
        $sale_date=$request->input('txtSaleDate');

        $discount=$request->input('totalDiscount');
        $vat=$request->input('txtVat');
        $note=$request->input('txtNote');
        $sale_total=$request->input('subtotal');
        $services=$request->input('txtProduct');
        $paid_amount=$request->input('paidAmount');
        $payment_type=$request->input('paymentType');
        $advPaid=$request->input('advPaid') ?? 0;
        $invoice_id=$request->input('invoice_id');
        //print_r($products);
        $discount=round($sale_total*$discount/100);
        $sale_date=date("Y-m-d",strtotime($sale_date));//convert date into mysql format
        $created_at=date("Y-m-d");
        $updated_at=date("Y-m-d");
        //$booking=DB::select("select booking_id from {$px}servicesales where=''");
        //$result = Servicesale::where('booking_id', 5)->exists();
        if($customer_id!=0 || $invoice_id!=0){
            DB::insert("insert into {$px}servicesales(customer_id,invoice_id,sale_date,discount,vat,customer_note,paid_amount,payment_type,sale_total,created_at,updated_at,advance)values('$customer_id','$invoice_id','$sale_date','$discount','$vat','$note','$paid_amount','$payment_type','$sale_total','$created_at','$updated_at','$advPaid')");   
                $s_sale_id=DB::getPdo()->lastInsertId();
        
            foreach($services as $service){ 
                //print_r($service);
                DB::insert("insert into {$px}servicesaledetails(servicesale_id,service_id,price,qty,discount,created_at,updated_at)values('$s_sale_id','{$service["item_id"]}','{$service["price"]}','{$service["qty"]}','{$service["discount"]}','$created_at','$updated_at')");   
            }
        }
        
        $log=new Transactionlog;
        $log->transaction_type='Service Sale';
        $log->customer_id=$customer_id;
        $log->date=$sale_date;
        $log->sale_total=$sale_total;
        $log->paid_amount=$paid_amount;
        $log->advance=$advPaid;
        $log->payment_type=$payment_type;
        $log->invoice_id=$invoice_id;
        $log->discount=$discount;
        $log->save();
        $site= Setting::first();
        $customer=DB::select("select o.invoice_id,c.name,c.mobile,c.email from {$px}customers c,{$px}servicesales o where o.customer_id=c.id and o.id=$s_sale_id");
        $details=DB::select("select c.id,s.name service_name,d.price,d.qty,d.discount,o.sale_date,o.sale_total,o.discount as total_discount,o.paid_amount from {$px}servicesales o,{$px}servicesaledetails d,{$px}services s,{$px}customers c where c.id=o.customer_id and o.id=d.servicesale_id and d.service_id=s.id and o.id='$s_sale_id'");
        return response()->json([
            'view'=>(String)View::make("pages.servicesale.print_invoice", ["details"=>$details,"customer"=>$customer,"advPaid"=>$advPaid,"site"=>$site])
        ]);
        
        
      
    }

    public function show($id)
    {
        
        $px=DB::getTablePrefix();
        $customer=DB::select("select o.id,o.invoice_id,c.name,c.mobile,c.email from {$px}customers c,{$px}servicesales o where o.customer_id=c.id and o.id=$id");
        $details=DB::select("select c.id,s.name service_name,d.price,d.qty,d.discount,o.sale_date,o.discount as total_discount,o.paid_amount,o.advance from {$px}servicesales o,{$px}servicesaledetails d,{$px}services s,{$px}customers c where c.id=o.customer_id and o.id=d.servicesale_id and d.service_id=s.id and o.id='$id'");
        return view("pages.servicesale.invoice",["details"=>$details,"customer"=>$customer]);
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

    public function destroy($id){
        $px=DB::getTablePrefix();
        DB::delete("delete from {$px}servicesales where id={$id}");
        DB::delete("delete from {$px}servicesaledetails where servicesale_id={$id}");
        //return Redirect::route('users.index');
        return back()->with('delete_order','This Sales Record Deleted successfully');
    }
    public function updateStatus(Request $req){
        $status=$req->status_id;
        $id=$req->order_id;
        Servicesale::where('id', $id)
        ->update(['status_id' => $status]);
        //return back()->with('success', 'status update successfully');
    }
    public function checkInvoice(Request $req){
        $invoice = Servicesale::where('invoice_id',$req->invoice_id)->exists();
        if($invoice){
            return response()->json([
                'status'=>true
            ]);
        }
        return response()->json([
            'status'=>false
        ]);
    }
    
}
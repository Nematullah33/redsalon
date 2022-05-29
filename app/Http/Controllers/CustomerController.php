<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Servicesale;
use App\Models\Service;
use App\Models\Booking;
use App\Models\Productbooking;
use App\Http\Resources\CustomerResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class CustomerController extends Controller
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
        
        // $tomorrow = Carbon::tomorrow();
        // $tomorrows  = Carbon::parse($tomorrow)->format('m-d');
        $search=$request['search'] ?? "";
        if($search!=""){
            $customers =Customer::with('designation')
                    ->where('customers.name', 'LIKE', "%$search%")
                    ->orWhere('customers.mobile', 'LIKE', "%$search%")
                    ->orWhere('customers.email', 'LIKE', "%$search%")
                    ->orWhere('customers.membership_id', 'LIKE', "%$search%")
                    ->get();
                return view('pages/customer/manage_customer',compact('customers','search'));
        }else{
            $customers=Customer::with('designation')
            ->orderBy('id','DESC')->paginate(10);
            return view('pages/customer/manage_customer',compact('customers','search'));
        }
        

    }
    public function todayDob()
    {
        $today = Carbon::today()->format('m-d');
        
        $customers=Customer::with('designation')
        ->where('customers.dob', 'LIKE', "%$today%")
        ->orderBy('id','DESC')->paginate(10);
        
        return view('pages/customer/today_dob',compact('customers'));

    }
    public function tomorrowDob()
    {
        $tomorrow = Carbon::tomorrow()->format('m-d');
        $customers=Customer::with('designation')
        ->where('customers.dob', 'LIKE', "%$tomorrow%")
        ->orderBy('id','DESC')->paginate(10);
        return view('pages/customer/tomorrow_dob',compact('customers'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $px=DB::getTablePrefix();
        $designation = DB::select("select id,name from {$px}designations");
        return view('pages/customer/create_customer',["designation"=>$designation]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation Data
        $validator = Validator::make($request->all(), [
            'txtName' => 'required',
            'txtMobile' => 'required',
            'membership' => 'unique:customers,membership_id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $customer=new Customer;
        $customer->name=$request->txtName;
        $customer->mobile=$request->txtMobile;
        $customer->email=$request->txtEmail;
        $customer->designation_id=$request->cmbDesignation;
        $customer->membership_id=$request->membership;
        $customer->dob=date("Y-m-d",strtotime($request->dob));
        $customer->join_date=date("Y-m-d",strtotime($request->join_date));
        $customer->remark=$request->remark;
        $customer->address=$request->address;

            $customer->save();
            if(isset($request->filePhoto)){
                    $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                    $customer->photo=$imageName;
                    $customer->update();
                    $request->filePhoto->move(public_path('/img/customer'),$imageName);
                }
            toastr()->info('Customer Added successfully');
            return back();

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers=Customer::findOrFail($id);
        $booking=Booking::with('bookingdetail','bookingdetail.service')->where('customer_id',$id)->get();
        $productbooking=Productbooking::with('productbooking','productbooking.product')->where('customer_id',$id)->get();
        //return $productbooking;
        $orders=Order::join('customers as c','c.id','=','orders.customer_id')
            ->select('orders.id','orders.status_id','c.name as cus_name','c.mobile','orders.order_date','orders.order_total','orders.discount','orders.paid_amount')
            ->where('c.id',$id)
            ->orderBy('id','DESC')->get();

        $services=Servicesale::join('customers as c','c.id','=','servicesales.customer_id')
            ->select('servicesales.id','servicesales.sale_date','servicesales.paid_amount','servicesales.sale_total','servicesales.discount','servicesales.advance')
            ->where('c.id',$id)
            ->orderBy('id','DESC')->get();    
        
        return view('pages/customer/details_customer',compact('customers','orders','services','booking','productbooking'));
    }
    
    public function invoice($id)
    {
        
        $px=DB::getTablePrefix();
        $customer=DB::select("select o.id,c.name,c.mobile,c.email from {$px}customers c,{$px}orders o where o.customer_id=c.id and o.id=$id");
        $details=DB::select("select c.id,p.name product_name,d.price,d.qty,d.discount,o.discount as total_discount,o.paid_amount,o.order_date from {$px}orders o,{$px}order_details d,{$px}products p,{$px}customers c where c.id=o.customer_id and o.id=d.order_id and d.product_id=p.id and o.id='$id'");
        return view("pages.order.invoice",["details"=>$details,"customer"=>$customer]);
    }
    public function serviceInvoice($id)
    {

        $px=DB::getTablePrefix();
        $customer=DB::select("select o.id,c.name,c.mobile,c.email from {$px}customers c,{$px}servicesales o where o.customer_id=c.id and o.id=$id");
        $details=DB::select("select c.id,s.name service_name,d.price,d.qty,d.discount,o.discount as total_discount,o.paid_amount,o.sale_date from {$px}servicesales o,{$px}servicesaledetails d,{$px}services s,{$px}customers c where c.id=o.customer_id and o.id=d.servicesale_id and d.service_id=s.id and o.id='$id'");
        return view("pages.servicesale.invoice",["details"=>$details,"customer"=>$customer]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $px=DB::getTablePrefix();
        $designation = DB::select("select id,name from {$px}designations");
        $customers=Customer::find($id);
        return view('pages/customer/edit_customer',compact('customers','designation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $customer=Customer::find($request->id);
        $customer->name=$request->txtName;
        $customer->mobile=$request->txtMobile;
        $customer->email=$request->txtEmail;
        $customer->designation_id=$request->cmbDesignation;
        $customer->membership_id=$request->membership;
        $customer->dob=date("Y-m-d",strtotime($request->dob));
        $customer->join_date=date("Y-m-d",strtotime($request->join_date));
        $customer->remark=$request->remark;
        $customer->address=$request->address;
        
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $customer->photo=$imageName;
                $request->filePhoto->move(public_path('/img/customer'),$imageName);
            }
        $customer->update();
        toastr()->info('Customer updated successfully');
        return Redirect::route('customers.index');
        //return back()->with('update_customer','Customer Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        $customer=Customer::find($id);
        if($customer->delete())
        {
            return back()->with('delete_customer','Customer Delete successfully');
        }
    }
    public function get_customer(){
        $id=$_GET['id'];
        $customer=Customer::find($id);
        return json_encode($customer);
    }
    public function get_customer_booking(){
        $id=$_GET['id'];
        $booking=Servicesale::where('booking_id',$id)->count();
        
        if($booking==0){
            $booking=Booking::select('id','customer_id','advance')->with('customer')->where('id',$id)->first();
            return response()->json([
                'booking'=>$booking
            ]);
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'Data Exit'
            ]);
        }
        //if($id!=null){
            
        //}
        
    }
    public function customerDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $customer = Customer::find($data['id']);
            if (!is_null($customer)) {
                $customer->delete();
            }
            return response()->json([
                'success' => true
            ]);
        }

    }


    

}

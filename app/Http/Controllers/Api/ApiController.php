<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Expense;
use Illuminate\Http\Request;

use JWTAuth;
use App\Models\Log;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Service;
use App\Models\Servicesale;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;

class ApiController extends Controller
{

    public function dashboard(){
        $today = Carbon::today()->format('m-d');
        $tomorrow  = Carbon::tomorrow()->format('m-d');
        $advance=DB::select("SELECT sum(advance) as advance FROM lc_bookings where created_at LIKE '%$today%'");
        $today_sale=DB::select("SELECT sum(order_total) as price FROM lc_orders where created_at LIKE '%$today%'");
        $today_serviesale=DB::select("SELECT sum(sale_total) as price FROM lc_servicesales where created_at LIKE '%$today%'");
        $dob_today=DB::select("select count(*) id from lc_customers where dob LIKE '%$today%' ");
        $dob_tomorrow=DB::select("select count(*) id from lc_customers where dob LIKE '%$tomorrow%' ");
        $cus=DB::select("select count(*) id from lc_customers");
        $booking=DB::select("select count(*) id from lc_bookings");
        $date=date('Y-m-d');
        $today_booking=DB::select("select count(*) id from lc_bookings where booking_date='$date'");
        $today_panding_booking=DB::select("select count(*) id from lc_bookings where status='1' and booking_date='$date'");
        
        $pro_sale=DB::select("select sum(order_total) price from lc_orders");
        $service_sale=DB::select("select sum(sale_total) price from lc_servicesales");
        $stocks=DB::select("select sum(qty) qty from lc_stocks");
        return response()->json([
            'success' => true,
            'data'=>[
                "today_dob" => $dob_today,
                "tomorrow_dob" => $dob_tomorrow,
                "total_customer"=>$cus,
                "all_booking"=>$booking,
                "today_booking"=>$today_booking,
                "product_sale"=>$pro_sale,
                "service_sale"=>$service_sale,
                "stocks"=>$stocks,
                "advance_booking"=>$advance,
                "today_product_sale"=>$today_sale,
                "today_service_sale"=>$today_serviesale,
                "today_panding_booking"=>$today_panding_booking],
        ], 200);
        
    }
    // daily Report
    public function dailyReport(Request $request)
    {
        //Date Formet
        $from_date = new DateTime( $request->fromDate);
        $fromDate = $from_date->format('Y-m-d');
        $to_date = new DateTime( $request->toDate);
        $toDate = $to_date->format('Y-m-d');

        $from=$fromDate ?? "";
        $to=$toDate ?? "";
        if($from!=="" && $to!==""){
            $paymenttype= DB::select("SELECT  t.payment_type, sum(t.paid_amount) 'total' FROM lc_transactionlogs t where t.date between '$from' and '$to'  group by t.payment_type ");
            //return $paymenttype;
            $salestype = DB::select("SELECT  t.transaction_type 'sale_type', sum(t.paid_amount) 'total' FROM lc_transactionlogs t where t.date between '$from' and '$to' group by t.transaction_type");
            
            $total = DB::select("SELECT  sum(t.paid_amount) 'sale_total' FROM lc_transactionlogs t where t.date between '$from' and '$to'");
            
            $expense = DB::select("SELECT  sum(e.amount) 'amount' FROM lc_expenses e where e.date between '$from' and '$to'");
            $expensetype = DB::select("SELECT  et.name 'expense_type', sum(e.amount) 'amount' FROM lc_expenses e,lc_expensetypes et where et.id=e.expensetype_id and e.date between '$from' and '$to' group by et.name");

            $purchase = DB::select("SELECT  sum(p.total_amount) 'amount' FROM lc_purchases p where p.purchase_date between '$from' and '$to'");
            $payments = DB::select("SELECT  sum(p.amount) 'paid_amount' FROM lc_payments p where p.payment_date between '$from' and '$to'");
            $booking_advance = DB::select("SELECT  sum(b.advance) 'amount' FROM lc_bookings b where b.booking_date between '$from' and '$to'");
            $productbooking = DB::select("SELECT  sum(pb.advance) 'amount' FROM lc_productbookings pb where pb.date between '$from' and '$to'");
            
            return response()->json([
                'success' => true,
                'data'=>[
                    "paymenttype" => $paymenttype,
                    "salestype" => $salestype,
                    "total"=>$total,
                    "expense"=>$expense,
                    "expensetype"=>$expensetype,
                    "purchase"=>$purchase,
                    "supplier_payments"=>$payments,
                    "booking_advance"=>$booking_advance,
                    "productbooking"=>$productbooking],
            ], 200);
        }
        
    }
    //stock Report 
    protected function stockReport(Request $request)
    {
        
        $search=$request['name'] ?? "";
        if($request->isMethod('POST')){
            $products = Product::select('id', 'name')->where('name','LIKE',"%$search%")->with(['stocks' => function($q) {
                $q->select('id', 'product_id', 'qty');
                $q->groupBy('id','product_id','qty');
            }])->paginate(10);
            
                return response()->json([
                    'success' => true,
                    'data'=> $products
                ], 200);

        }
        if($request->isMethod('GET')){
            $products = Product::select('id', 'name')->with(['stocks' => function($q) {
                $q->select('id', 'product_id', 'qty');
                 $q->groupBy('id','product_id','qty');
            }])->paginate(10);
            return response()->json([
                'success' => true,
                'data'=> $products
            ], 200);
        }
    }

    //customer list
    public function customers(Request $request)
    {
        // $tomorrow = Carbon::tomorrow();
        // $tomorrows  = Carbon::parse($tomorrow)->format('m-d');
        $search=$request['search'] ?? "";
        if($search!=""){
            $customers = Customer::with('designation')
                    ->where('customers.name', 'LIKE', "%$search%")
                    ->orWhere('customers.mobile', 'LIKE', "%$search%")
                    ->orWhere('customers.email', 'LIKE', "%$search%")
                    ->orWhere('customers.membership_id', 'LIKE', "%$search%")
                    ->paginate(10);
                    return response()->json([
                        'success' => true,
                        'data'=> $customers
                    ], 200);
        }else{
            $customers=Customer::with('designation')
            ->orderBy('id','DESC')->paginate(10);
            return response()->json([
                'success' => true,
                'data'=> $customers
            ], 200);
        }
        

    }
    
    //product list
    public function products(Request $request)
    {
        
        $search=$request['name'] ?? "";
        
        if($search!=""){

            $products =Product::with('category')
                    ->where('products.name', 'LIKE', "%$search%")
                    ->paginate(10);
                    return response()->json([
                        'success' => true,
                        'data'=> $products
                    ], 200);
        }else{

            $products = Product::with('category')->paginate(10);
            return response()->json([
                'success' => true,
                'data'=> $products
            ], 200);
        }
        

    }

    //Expenses list
    public function expenses(Request $request){
        $from=$request['fromDate']?? "";
        $to=$request['toDate']?? "";
        if($from!="" && $to!=""){
            $expenses=Expense::with('expensetype')
            ->whereBetween('date', [$from, $to])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $expenses
            ], 200);
        }else{
            $expenses=Expense::with('expensetype')->orderBy('id','DESC')->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $expenses
            ], 200);
        }

    } 
     
    //service list
    public function services(Request $request)
    {
        $search=$request['search'] ?? "";
        if($search!=""){
            $services =Service::with('category')
                    ->where('services.name', 'LIKE', "%$search%")
                    ->paginate(10);
                return response()->json([
                    'success' => true,
                    'data' => $services
                ]);
        }else{
            $services = Service::with('category')->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $services
            ]);
        } 

    }
    
    //Booking List
    public function bookings(Request $request)
    {
        $px=DB::getTablePrefix();
        $customer = DB::select("select id,name,mobile,membership_id from {$px}customers");
        $from=$request['fromDate']?? "";
        $to=$request['toDate']?? "";
        if($from!="" && $to!=""){
            $bookings = Booking::with('customer', 'bookingdetail.service')
            ->whereBetween('booking_date', [$from, $to])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $bookings
            ]);   
        }else{
            $bookings = Booking::with('customer', 'bookingdetail.service')
            ->orderBy('id','DESC')->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $bookings
            ]);  
        }
                  
        
    }

    // Payment List
    public function payments(Request $request){
		$from=$request['fromDate']?? "";
        $to=$request['toDate']?? "";
        if($from!="" && $to!=""){
		    $payments=Payment::with('supplier')->whereBetween('payment_date', [$from, $to])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $payments
            ]); 
		}else{
			$payments=Payment::with('supplier')->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $payments
            ]); 
		}
	}

    // Product Sale List
    public function productsales(Request $request){
        $from=$request['fromDate'] ?? "";
        $to=$request['toDate'] ?? "";
        
        if($from!="" && $to!=""){
            $productsale=Order::join('customers as c','c.id','=','orders.customer_id')
            ->select('orders.id','orders.status_id','c.name as cus_name','c.mobile','orders.order_date','orders.order_total','orders.customer_note','orders.advance')
            ->whereBetween('orders.order_date', [$from, $to])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $productsale
            ]); 
        }else{
            $productsale=Order::join('customers as c','c.id','=','orders.customer_id')
            ->select('orders.id','orders.status_id','c.name as cus_name','c.mobile','orders.order_date','orders.order_total','orders.discount','orders.paid_amount','orders.advance')
            ->orderBy('id','DESC')->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $productsale
            ]); 
        }
    } 

    //Service Sale List
    public function servicesales(Request $request){
        $from=$request['fromDate']?? "";
        $to=$request['toDate']?? "";
        if($from!="" && $to!=""){
            $servicesale=Servicesale::join('customers as c','c.id','=','servicesales.customer_id')
            ->select('servicesales.id','c.name as cus_name','c.mobile','servicesales.sale_date','servicesales.paid_amount','servicesales.sale_total','servicesales.discount','servicesales.advance')
            ->whereBetween('servicesales.sale_date', [$from, $to])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $servicesale
            ]);
        }else{
            $servicesale=Servicesale::join('customers as c','c.id','=','servicesales.customer_id')
            ->select('servicesales.id','c.name as cus_name','c.mobile','servicesales.sale_date','servicesales.paid_amount','servicesales.sale_total','servicesales.advance','servicesales.discount')
            ->orderBy('id','DESC')->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $servicesale
            ]);
            
        }


    }

    //Purchase list
    public function purchases(Request $request)
    {
        $from=$request['fromDate']?? "";
        $to=$request['toDate']?? "";
        if($from!="" && $to!=""){
            $purchases=Purchase::join('suppliers as s','s.id','=','purchases.supplier_id')
            ->select('purchases.id','s.name as supplier_name','s.mobile','purchases.total_amount','purchases.purchase_date')
            ->whereBetween('purchases.purchase_date', [$from, $to])->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $purchases
            ]);
        }else{
            
            $purchases=Purchase::join('suppliers as s','s.id','=','purchases.supplier_id')
            ->select('purchases.id','s.name as supplier_name','s.mobile','purchases.total_amount','purchases.purchase_date')
            ->orderBy('id','DESC')->paginate(10);
            return response()->json([
                'success' => true,
                'data' => $purchases
            ]);
        }

    }
}

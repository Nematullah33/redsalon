<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index(){
        $today = Carbon::today()->format('m-d');
        $tomorrow  = Carbon::tomorrow()->format('m-d');
        $advance=DB::select("SELECT sum(advance) as advance FROM lc_bookings where created_at LIKE '%$today%'");
        $today_sale=DB::select("SELECT sum(order_total) as price FROM lc_orders where created_at LIKE '%$today%'");
        $today_serviesale=DB::select("SELECT sum(sale_total) as price FROM lc_servicesales where created_at LIKE '%$today%'");
        $dob_today=DB::select("select count(*) id from lc_customers where dob LIKE '%$today%' ");
        $cusdob=DB::select("select count(*) id from lc_customers where dob LIKE '%$tomorrow%' ");
        $cus=DB::select("select count(*) id from lc_customers");
        $booking=DB::select("select count(*) id from lc_bookings");
        $date=date('Y-m-d');
        $today_booking=DB::select("select count(*) id from lc_bookings where booking_date='$date'");
        $today_panding_booking=DB::select("select count(*) id from lc_bookings where status='1' and booking_date='$date'");
        
        $pro_sale=DB::select("select sum(order_total) price from lc_orders");
        $service_sale=DB::select("select sum(sale_total) price from lc_servicesales");
        $stocks=DB::select("select sum(qty) qty from lc_stocks");
        $user_id=session('sess_id');     
        if(!isset($user_id))return redirect('/');
        return view('layout.erp.dashboard',["dob_today"=>$dob_today,"cusdob"=>$cusdob,"cus"=>$cus,"bookings"=>$booking,"today_booking"=>$today_booking,
        "pro_sale"=>$pro_sale,"service_sale"=>$service_sale,"stocks"=>$stocks,"today_panding_booking"=>$today_panding_booking,"advance"=>$advance,"today_sale"=>$today_sale,"today_serviesale"=>$today_serviesale]);
    }
}

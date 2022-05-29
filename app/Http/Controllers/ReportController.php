<?php

namespace App\Http\Controllers;
use App\models\Order;
use App\models\Servicesale;
use App\models\Expense;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(Request $request){
        $from=$request['formOrder']?? "";
        $to=$request['toOrder']?? "";
        
        if($from!="" && $to!=""){
            $dailySales = DB::select("SELECT  date(l.order_date) 'Date',count(l.id) 'no_of_transactions',sum(l.paid_amount) 'total_sale' FROM lc_orders l where l.order_date between '$from' and '$to' group by date(order_date)");

            $dailyServiceSales = DB::select("SELECT  date(s.sale_date) 'Date',count(s.id) 'no_of_transactions',sum(s.paid_amount) 'total_sale' FROM lc_servicesales s where s.sale_date between '$from' and '$to' group by date(sale_date)" );

            $dailyPurchase = DB::select("SELECT  date(p.purchase_date) 'Date',count(p.id) 'no_of_transactions',sum(p.total_amount) 'total_purchase' FROM lc_purchases p where p.purchase_date between '$from' and '$to' group by date(purchase_date)");
            
            $dailypayment = DB::select("SELECT  date(pm.payment_date) 'Date',count(pm.id) 'no_of_transactions',sum(pm.amount) 'total_paymnet' FROM lc_payments pm where pm.payment_date between '$from' and '$to' group by date(payment_date)");

            $dailyexpenses = DB::select("SELECT  date(e.date) 'Date',count(e.id) 'no_of_transactions',sum(e.amount) 'total_expense' FROM lc_expenses e where e.date between '$from' and '$to' group by date(date)");
            
            $advance=DB::select("SELECT sum(advance) as advance FROM lc_bookings where created_at between '$from' and '$to'");
            
            return view("pages.reports.make_report",["dailyServiceSales"=>$dailyServiceSales,"dailyexpenses"=>$dailyexpenses,"dailyPurchase"=>$dailyPurchase,"dailySales"=>$dailySales,"dailypayments"=>$dailypayment, "from"=> $from, "to"=>$to,"advance_booking"=>$advance]);

        }else{

            $dailySales = DB::select('SELECT  date(l.order_date) "Date",count(l.id) "no_of_transactions",sum(l.paid_amount) "total_sale" FROM lc_orders l group by date(order_date)' );
            $dailyServiceSales = DB::select('SELECT  date(s.sale_date) "Date",count(s.id) "no_of_transactions",sum(s.paid_amount) "total_sale" FROM lc_servicesales s group by date(sale_date)' );
            $dailyPurchase = DB::select('SELECT  date(p.purchase_date) "Date",count(p.id) "no_of_transactions",sum(p.total_amount) "total_purchase" FROM lc_purchases p group by date(purchase_date)' );
            $dailypayment = DB::select('SELECT  date(pm.payment_date) "Date",count(pm.id) "no_of_transactions",sum(pm.amount) "total_paymnet" FROM lc_payments pm group by date(payment_date)');
            $dailyexpenses = DB::select('SELECT  date(e.date) "Date",count(e.id) "no_of_transactions",sum(e.amount) "total_expense" FROM lc_expenses e group by date(date)');
            $advance=DB::select('SELECT sum(advance) as advance FROM lc_bookings');
            //return $dailypayment;
            return view("pages.reports.make_report",["dailyServiceSales"=>$dailyServiceSales,"dailyexpenses"=>$dailyexpenses,"dailyPurchase"=>$dailyPurchase,"dailySales"=>$dailySales,"dailypayments"=>$dailypayment,"from"=> $from, "to"=>$to,"advance_booking"=>$advance]);
        }

    }
    public function dailyReport(Request $request){
        $from=$request['formOrder']?? "";
        $to=$request['toOrder']?? "";
        
        if($from!="" && $to!=""){
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
            
            return view("pages.reports.daily_report",compact('paymenttype','salestype','total','from','to','expense','expensetype','purchase','payments','booking_advance','productbooking'));
        }else{
            $today = Carbon::today()->format('Y-m-d');
            $booking_advance = DB::select("SELECT  sum(b.advance) 'amount' FROM lc_bookings b where b.booking_date='$today'");
            $productbooking = DB::select("SELECT  sum(pb.advance) 'amount' FROM lc_productbookings pb where pb.date='$today'");
            //return $productbooking;
            $purchase = DB::select("SELECT  sum(p.total_amount) 'amount' FROM lc_purchases p where p.purchase_date='$today'");
            $payments = DB::select("SELECT  sum(p.amount) 'paid_amount' FROM lc_payments p where p.payment_date='$today'");
            //return $payment;
            $expense = DB::select("SELECT  sum(e.amount) 'amount' FROM lc_expenses e where e.date='$today'");
            
            $expensetype = DB::select("SELECT  et.name 'expense_type', sum(e.amount) 'amount' FROM lc_expenses e,lc_expensetypes et where e.date='$today' and et.id=e.expensetype_id group by et.name");
            
            $total = DB::select("SELECT  sum(t.paid_amount) 'sale_total' FROM lc_transactionlogs t where t.date='$today'");
           
            $salestype = DB::select("SELECT  t.transaction_type 'sale_type', sum(t.paid_amount) 'total' FROM lc_transactionlogs t where t.date='$today' group by t.transaction_type");
            
            $paymenttype= DB::select("SELECT  t.payment_type, sum(t.paid_amount) 'total' FROM lc_transactionlogs t where t.date='$today' group by t.payment_type ");
            
            return view("pages.reports.daily_report",compact('paymenttype','salestype','total','from','to','expense','expensetype','purchase','payments','booking_advance','productbooking'));
        }
    }
    public function dailyReportPrint(Request $request){
        $from=$request['formOrder']?? "";
        $to=$request['toOrder']?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){
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

            $pdf = PDF::loadView('pages.pdf.daily_report', compact('paymenttype','salestype','total','from','to','expense','expensetype','purchase','payments','booking_advance','productbooking','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            
            $today = Carbon::today()->format('Y-m-d');
            $booking_advance = DB::select("SELECT  sum(b.advance) 'amount' FROM lc_bookings b where b.booking_date='$today'");
            $productbooking = DB::select("SELECT  sum(pb.advance) 'amount' FROM lc_productbookings pb where pb.date='$today'");
            //return $productbooking;
            $purchase = DB::select("SELECT  sum(p.total_amount) 'amount' FROM lc_purchases p where p.purchase_date='$today'");
            $payments = DB::select("SELECT  sum(p.amount) 'paid_amount' FROM lc_payments p where p.payment_date='$today'");
            //return $payment;
            $expense = DB::select("SELECT  sum(e.amount) 'amount' FROM lc_expenses e where e.date='$today'");
            
            $expensetype = DB::select("SELECT  et.name 'expense_type', sum(e.amount) 'amount' FROM lc_expenses e,lc_expensetypes et where e.date='$today' and et.id=e.expensetype_id group by et.name");
            
            $total = DB::select("SELECT  sum(t.paid_amount) 'sale_total' FROM lc_transactionlogs t where t.date='$today'");
           
            $salestype = DB::select("SELECT  t.transaction_type 'sale_type', sum(t.paid_amount) 'total' FROM lc_transactionlogs t where t.date='$today' group by t.transaction_type");
            
            $paymenttype= DB::select("SELECT  t.payment_type, sum(t.paid_amount) 'total' FROM lc_transactionlogs t where t.date='$today' group by t.payment_type ");
            
            $pdf = PDF::loadView('pages.pdf.daily_report', compact('paymenttype','salestype','total','from','to','expense','expensetype','purchase','payments','booking_advance','productbooking','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
            
        }
    }
    public function salesreportPrint(Request $request)
    {
        $from=$request['from']?? "";
        $to=$request['to']?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){
            $dailySales = DB::select("SELECT  date(l.order_date) 'Date',count(l.id) 'no_of_transactions',sum(l.paid_amount) 'total_sale' FROM lc_orders l where l.order_date between '$from' and '$to' group by date(order_date)");
            $pdf = PDF::loadView('pages.pdf.product_sale_report', compact('dailySales','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $dailySales = DB::select('SELECT  date(l.order_date) "Date",count(l.id) "no_of_transactions",sum(l.paid_amount) "total_sale" FROM lc_orders l group by date(order_date)' );
            $pdf = PDF::loadView('pages.pdf.product_sale_report', compact('dailySales','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }
    }
    public function servicesalePdf(Request $request)
    {
        $from=$request['from']?? "";
        $to=$request['to']?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){
            $dailyServiceSales = DB::select("SELECT  date(s.sale_date) 'Date',count(s.id) 'no_of_transactions',sum(s.paid_amount) 'total_sale' FROM lc_servicesales s where s.sale_date between '$from' and '$to' group by date(sale_date)" );

            $pdf = PDF::loadView('pages.pdf.service_sale_pdf', compact('dailyServiceSales','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $dailyServiceSales = DB::select('SELECT  date(s.sale_date) "Date",count(s.id) "no_of_transactions",sum(s.paid_amount) "total_sale" FROM lc_servicesales s group by date(sale_date)' );
            $pdf = PDF::loadView('pages.pdf.service_sale_pdf', compact('dailyServiceSales','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }
    }
    public function purchasePdf(Request $request)
    {
        $from=$request['from']?? "";
        $to=$request['to']?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){
            $dailyPurchase = DB::select("SELECT  date(p.purchase_date) 'Date',count(p.id) 'no_of_transactions',sum(p.total_amount) 'total_purchase' FROM lc_purchases p where p.purchase_date between '$from' and '$to' group by date(purchase_date)");

            $pdf = PDF::loadView('pages.pdf.purchase_pdf', compact('dailyPurchase','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $dailyPurchase = DB::select('SELECT  date(p.purchase_date) "Date",count(p.id) "no_of_transactions",sum(p.total_amount) "total_purchase" FROM lc_purchases p group by date(purchase_date)' );
            $pdf = PDF::loadView('pages.pdf.purchase_pdf', compact('dailyPurchase','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }
    }
    public function paymentReport(Request $request)
    {
        $from=$request['from']?? "";
        $to=$request['to']?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){
            $dailypayments = DB::select("SELECT  date(pm.payment_date) 'Date',count(pm.id) 'no_of_transactions',sum(pm.amount) 'total_paymnet' FROM lc_payments pm where pm.payment_date between '$from' and '$to' group by date(payment_date)");

            $pdf = PDF::loadView('pages.pdf.purchase_pdf', compact('dailypayments','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $dailypayments = DB::select('SELECT  date(pm.payment_date) "Date",count(pm.id) "no_of_transactions",sum(pm.amount) "total_paymnet" FROM lc_payments pm group by date(payment_date)');
            $pdf = PDF::loadView('pages.pdf.payment_report', compact('dailypayments','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }
    }
    public function expenseReport(Request $request)
    {
        $from=$request['from']?? "";
        $to=$request['to']?? "";
        $site= Setting::first();
        if($from!="" && $to!=""){
            $dailyexpenses = DB::select("SELECT  date(e.date) 'Date',count(e.id) 'no_of_transactions',sum(e.amount) 'total_expense' FROM lc_expenses e where e.date between '$from' and '$to' group by date(date)");

            $pdf = PDF::loadView('pages.pdf.purchase_pdf', compact('dailyexpenses','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $dailyexpenses = DB::select('SELECT  date(e.date) "Date",count(e.id) "no_of_transactions",sum(e.amount) "total_expense" FROM lc_expenses e group by date(date)');
            $pdf = PDF::loadView('pages.pdf.dailyexpense_report', compact('dailyexpenses','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }
    }
    
    

}

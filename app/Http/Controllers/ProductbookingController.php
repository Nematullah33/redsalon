<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\Productbooking;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Productbookingdetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductbookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(Request $request)
    {
        $px=DB::getTablePrefix();
        $customer = DB::select("select id,name,mobile,membership_id from {$px}customers");

            $bookings = Productbooking::with('customer', 'productbooking.product')
            ->orderBy('id','DESC')->limit(20)->get();
            //return $bookings;

            return view('pages/productbooking/manage_booking',compact('bookings','customer'));  

    }
    public function printBooking(Request $request){
        $data = $request->all();
        
        $site= Setting::first();
        $bookings=Productbooking::with('customer','productbooking.product')->where('id',$data['id'])->first();
        //return $bookings;
        return response()->json([
            'success'=>true,
            'view'=>(String)View::make("pages.productbooking.print_booking_order",["bookings"=>$bookings,"site"=>$site])
        ]);
    }
    public function getBoooking(Request $request){
        $cus_id=$request->id;
        $bookings = Productbooking::with('customer','productbooking.product')
            ->where('customer_id',$cus_id)
            ->orderBY('id','DESC')
            ->get();
            return $bookings;
    }
    public function getBoookingByDate(Request $request){
        $date=date('Y-m-d', strtotime($request->date));
        //return $date;
        $bookings = Productbooking::with('customer', 'productbooking.product')
            ->where('booking_date',$date)
            ->orderBY('id','DESC')
            ->get();
            return $bookings;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $px=DB::getTablePrefix();

        $booking_id = DB::select("select max(id) id from {$px}productbookings");
        $customer = DB::select("select id,name,mobile,membership_id from {$px}customers");
        $product = DB::select("select id,name,price from {$px}products");
        return view('pages/productbooking/create_booking',["customer"=>$customer,"product"=>$product,"booking_id"=>$booking_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return $request->booking_date;

        $booking=new Productbooking;
        $booking->customer_id=$request->cmbCustomer;
        $booking->date=\Carbon\Carbon::parse($request->booking_date)->format('Y-m-d');
        $booking->advance=$request->advance;
        $booking->reference=$request->reference;
        $booking->save();
        
        $lists = $request->input('cmbService');
        foreach($lists as $list){
            $booking_detail=new Productbookingdetail;
            $booking_detail->booking_id=$booking->id;
            $booking_detail->product_id=$list;
            $booking_detail->save();
        };
        
        return back()->with('save_booking','Booking added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking=Productbooking::findOrFail($id);
        return $booking;
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
        $category = DB::select("select id,name from {$px}categories");
        $booking=Productbooking::find($id);
        return view('pages/booking/edit_booking',compact('category','booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $booking=Productbooking::find($id);
        $booking->name=$request->txtName;
        $booking->category_id=$request->cmbCategory;
        $booking->price=$request->price;
        $booking->description=$request->description;

        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $booking->photo=$imageName;
                $request->filePhoto->move(public_path('/img/booking'),$imageName);
            }
        $booking->update();
        return back()->with('update_booking','booking Updated successfully');

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
        $booking=Productbooking::find($id);
        if($booking->delete())
        {
            return back()->with('delete_booking','booking Delete successfully');
        }
    }
    public function get_booking(){
        $id=$_GET['id'];
        $booking=Productbooking::find($id);
        return json_encode($booking);
    }



	public function bookingDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $booking = Productbooking::find($data['id']);
            if (!is_null($booking)) {
                $booking->delete();
            }

            return response()->json([
                'success' => true
            ]);
        }

    }
    public function updateStatus(Request $req){
        $status=$req->status_id;
        $id=$req->booking_id;
        Productbooking::where('id', $id)
        ->update(['status' => $status]);
        return back()->with('success', 'status update successfully');
    }

}



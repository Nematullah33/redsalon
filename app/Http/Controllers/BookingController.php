<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use App\Models\Booking;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Bookingdetail;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
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
            $bookings = Booking::with('customer', 'bookingdetail.service')
            ->orderBy('id','DESC')->limit(20)->get();
            return view('pages/booking/manage_booking',compact('bookings','customer'));        
        
    }
    public function printBooking(Request $request){
        $data = $request->all();
        
        $site= Setting::first();
        $bookings=Booking::with('customer','bookingdetail.service')->where('id',$data['id'])->first();
        //return $bookings;
        return response()->json([
            'success'=>true,
            'view'=>(String)View::make("pages.booking.print_booking_order",["bookings"=>$bookings,"site"=>$site])
        ]);
    }
    public function getBoooking(Request $request){
        $cus_id=$request->id;
        $bookings = Booking::with('customer', 'bookingdetail.service')
            ->where('customer_id',$cus_id)
            ->orderBY('id','DESC')
            ->get();
            return $bookings;
    }
    public function getBoookingByDate(Request $request){
        $date=date('Y-m-d', strtotime($request->date));
        //return $date;
        $bookings = Booking::with('customer', 'bookingdetail.service')
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

        $booking_id = DB::select("select max(id) id from {$px}bookings");
        $customer = DB::select("select id,name,mobile,membership_id from {$px}customers");
        $service = DB::select("select id,name,price from {$px}services");
        return view('pages/booking/create_booking',["customer"=>$customer,"service"=>$service,"booking_id"=>$booking_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();

        $booking=new Booking;
        $booking->customer_id=$request->cmbCustomer;
        $booking->booking_date=date("Y-m-d",strtotime($request->booking_date));
        $booking->booking_time=$request->booking_time;
        $booking->advance=$request->advance;
        $booking->reference=$request->reference;
        $booking->save();
        
        $lists = $request->input('cmbService');
        foreach($lists as $list){
            $booking_detail=new Bookingdetail;
            $booking_detail->booking_id=$booking->id;
            $booking_detail->service_id=$list;
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
        $booking=Booking::findOrFail($id);
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
        $booking=Booking::find($id);
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
        $booking=Booking::find($id);
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
        return Redirect::route('bookings/');
        //return back()->with('update_booking','booking Updated successfully');

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
        $booking=Booking::find($id);
        if($booking->delete())
        {
            return back()->with('delete_booking','booking Delete successfully');
        }
    }
    public function get_booking(){
        $id=$_GET['id'];
        $booking=Booking::find($id);
        return json_encode($booking);
    }



	public function bookingDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $booking = Booking::find($data['id']);
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
        Booking::where('id', $id)
        ->update(['status' => $status]);
        return back()->with('success', 'status update successfully');
    }

}


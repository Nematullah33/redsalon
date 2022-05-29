<?php

namespace App\Http\Controllers;

use App\Models\Supplier;

use App\Http\Resources\SupplierResource;
use App\Models\Payment;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
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
        $search=$request['search'] ?? "";
        if($search!=""){
            $suppliers =Supplier::where('suppliers.name', 'LIKE', "%$search%")
                    ->orWhere('suppliers.mobile', 'LIKE', "%$search%")
                    ->orWhere('suppliers.email', 'LIKE', "%$search%")
                    ->get();
                return view('pages/supplier/manage_supplier',compact('suppliers','search'));
        }else{
            $suppliers=Supplier::paginate(10);
            // SupplierResource::collection($Suppliers);
            $suppliers=Supplier::orderBy('id','DESC')->get();
            //return $Suppliers;
            return view('pages/supplier/manage_supplier',compact('suppliers','search'));
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages/supplier/create_supplier');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $supplier=new Supplier;
        $supplier->name=$request->txtName;
        $supplier->mobile=$request->txtMobile;
        $supplier->email=$request->txtEmail;
        $supplier->company=$request->company;
        $supplier->address=$request->address;

        $supplier->save();
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $supplier->photo=$imageName;
                $supplier->update();
                $request->filePhoto->move(public_path('/img/supplier'),$imageName);
            }
        return back()->with('save_supplier','Supplier Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $suppliers=Supplier::findOrFail($id);
        $payments=Payment::where('supplier_id',$id)->orderBy('id','DESC')->get();

        $purchases=Purchase::join('suppliers as s','s.id','=','purchases.supplier_id')
            ->select('purchases.id','purchases.purchase_date','purchases.total_amount')
            ->where('s.id',$id)
            ->orderBy('id','DESC')->get();    
        
        return view('pages/supplier/details_supplier',compact('purchases','suppliers','payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$Suppliers=Supplier::where('id',$id)->first();
        $suppliers=Supplier::find($id);
        return view('pages/supplier/edit_supplier',compact('suppliers'));
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
        $supplier=Supplier::find($id);
        $supplier->name=$request->txtName;
        $supplier->mobile=$request->txtMobile;
        $supplier->email=$request->txtEmail;
		$supplier->company=$request->company;
        $supplier->address=$request->address;
        
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $supplier->photo=$imageName;
                $request->filePhoto->move(public_path('/img/supplier'),$imageName);
            }
        $supplier->update();
        return back()->with('update_supplier','Supplier Updated successfully');

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
        $supplier=Supplier::find($id);
        if($supplier->delete())
        {
            return back()->with('delete_supplier','Supplier Delete successfully');
        }
    }
    public function get_supplier(){
        $id=$_GET['id'];
        $Supplier=Supplier::find($id);
        return json_encode($Supplier);
    }



	public function supplierDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $supplier = Supplier::find($data['id']);
            if (!is_null($supplier)) {
                $supplier->delete();
            }

            return response()->json([
                'success' => true
            ]);
        }
        //return $id;
        // $supplier=Supplier::find($id);
        // if($supplier->delete())
        // {
        //     return back()->with('delete_supplier','Supplier Delete successfully');
        // }
    }


    

}

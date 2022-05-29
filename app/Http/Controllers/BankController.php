<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Location;
use App\Models\type;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\QueryException;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $location=Location::all();
        $type=type::all();
        $bank=Bank::join('locations','banks.location_id','=','locations.id')
        ->join('types','banks.account_type_id','=','types.id')
        ->select('banks.id','banks.name','locations.name as place','banks.branch','banks.account_name','banks.account_no','banks.mobile','types.name as type','banks.segment_code')
        ->get();
        //return $bank;
        return view("pages.bank.create_bank",["bank"=>$bank,"location"=>$location,"type"=>$type]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bank=new Bank;
        $bank->name=$request->txtBank;
        $bank->branch=$request->txtBrach;
        $bank->location_id=$request->cmbLocation;
        $bank->account_name=$request->txtAcName;
        $bank->account_no=$request->txtAcNo;
        $bank->mobile=$request->txtMbNo;
        $bank->mobile=$request->txtMbNo;
        $bank->account_type_id=$request->cmbType;
        $bank->segment_code=$request->txtSegCode;
        $bank->address=$request->txtBrach;
        
        if($bank->save())
        {
            return back()->with('save_bank','Bank Added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
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
    public function update(Request $request,Bank $bank)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        
        if($bank->delete())
        {
            return back()->with('delete_bank','Bank Delete Successfully');
        }

    }
}

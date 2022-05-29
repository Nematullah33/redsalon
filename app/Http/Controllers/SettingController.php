<?php

namespace App\Http\Controllers;

use App\Models\Setting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
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

        $site =Setting::find(1);
            return view('pages/setting/edit_setting',compact('site'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $setting=Setting::find($id);
        $setting->name=$request->txtName;
        $setting->mobile=$request->txtMobile;
        $setting->email=$request->txtEmail;
        $setting->address=$request->address;
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $setting->photo=$imageName;
                $request->filePhoto->move(public_path('/img/setting'),$imageName);
            }
        $setting->update();
        return back()->with('update_setting','Setting Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    

}


<?php

namespace App\Http\Controllers;

use App\Models\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
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
        //return $search;
        if($search!=""){
            $services =Service::with('category')
                    ->where('services.name', 'LIKE', "%$search%")
                    ->get();
                return view('pages/service/manage_service',compact('services','search'));
        }else{

            $services = Service::with('category')->paginate(10);
            
            return view('pages/service/manage_service',compact('services','search'));
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $px=DB::getTablePrefix();
        $category = DB::select("select id,name from {$px}categories");
        return view('pages/service/create_service',["category"=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $service=new Service;
        $service->name=$request->txtName;
        $service->category_id=$request->cmbCategory;
        $service->price=$request->price;
        $service->description=$request->description;
        $service->save();
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $service->photo=$imageName;
                $service->update();
                $request->filePhoto->move(public_path('/img/service'),$imageName);
            }
        return back()->with('save_service','service Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service=Service::findOrFail($id);
        return $service;
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
        $service=Service::find($id);
        return view('pages/service/edit_service',compact('category','service'));
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
        $service=Service::find($id);
        $service->name=$request->txtName;
        $service->category_id=$request->cmbCategory;
        $service->price=$request->price;
        $service->description=$request->description;

        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $service->photo=$imageName;
                $request->filePhoto->move(public_path('/img/service'),$imageName);
            }
        $service->update();
        return back()->with('update_service','service Updated successfully');

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
        $service=Service::find($id);
        if($service->delete())
        {
            return back()->with('delete_service','service Delete successfully');
        }
    }
    public function get_service(){
        $id=$_GET['id'];
        $service=Service::find($id);
        return json_encode($service);
    }



	public function serviceDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $service = Service::find($data['id']);
            if (!is_null($service)) {
                $service->delete();
            }

            return response()->json([
                'success' => true
            ]);
        }

    }

}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Country;

class EmployeeController extends Controller
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
    public function index()
    {
        //latest()->paginate(5);
        $emp=Employee::join('country as c','employees.country_id','=','c.id')
        //->where('employees.country_id','1')
        ->select('employees.id','employees.name','employees.email','employees.mobile','c.name as country')
        ->get();
        return view('pages.employee.manage_emp',["employee"=>$emp]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country=Country::all();

        return view('pages.employee.create_emp',["country"=>$country]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $emp=new Employee;
        $emp->name=$req->txtName;
        $emp->mobile=$req->txtMobile;
        $emp->email=$req->txtEmail;
        $emp->country_id=$req->cmbCountry;
        if($emp->save()){
           return back()->with('success', 'Employee Added successfully');
          // return redirect()->route('employee.index')->with('save_emp','Emplyee created successfully');
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp=Employee::find($id);
        return view('pages.employee.details_emp',["emp"=>$emp]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $country=Country::all();
        return view('pages.employee.edit_emp',["emp"=>$employee,"countries"=>$country]);
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
        $emp=Employee::find($id);
        $emp->name=$request->txtName;
        $emp->mobile=$request->txtMobile;
        $emp->email=$request->txtEmail;
        $emp->country_id=$request->cmbCountry;
        if($emp->update()){
           return back()->with('success', 'Update employee successfully');
          
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if($employee->delete()){
            return back()->with('success', 'Employee Deleted successfully');
        }
    }
}

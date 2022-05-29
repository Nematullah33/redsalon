<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Expensetype;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class ExpenseController extends Controller
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
    public function index(Request $request){
        $from=$request['formOrder']?? "";
        $to=$request['toOrder']?? "";
        if($from!="" && $to!=""){
            $expenses=Expense::with('expensetype')
            ->whereBetween('date', [$from, $to])->get();
            return view("pages.expense.manage_expense",["expenses"=>$expenses,"from"=>$from,"to"=>$to]);
        }else{
            $expenses=Expense::with('expensetype')->orderBy('id','DESC')->limit('10')->get();
            //return $expenses;
            return view("pages.expense.manage_expense",["expenses"=>$expenses,"from"=>$from,"to"=>$to]);
        }

    } 
    public function expenselistPrint(Request $request){
        $from=$request->from ?? "";
        $to=$request->to ?? "";
        $site= Setting::first();
        
        if($from!="" && $to!=""){
            $expenses=Expense::select('*')
            ->whereBetween('date', [$from, $to])->get();
            $pdf = PDF::loadView('pages.pdf.expense_list_report', compact('expenses','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }else{
            $expenses=Expense::with('expensetype')->orderBy('id','DESC')->limit('10')->get();
            $pdf = PDF::loadView('pages.pdf.expense_list_report', compact('expenses','from','to','site'));
            $file_name = time().'.'.'pdf';
            return $pdf->download($file_name);
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exptype=Expensetype::all();
        return view('pages/expense/create_expense',compact('exptype'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expense=new Expense;
        $expense->name=$request->txtName;
        $expense->amount=$request->txtAmount;
        $expense->expensetype_id=$request->cmbExpType;
        $expense->date=date("Y-m-d",strtotime($request->expDate));
        $expense->reference=$request->reference;
        $expense->note=$request->note;
        $expense->save();
        return back()->with('save_expense','Expense Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exptype=Expensetype::all();
        $expenses=Expense::find($id);
        return view('pages/expense/edit_expense',compact('expenses','exptype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        
        $expense=Expense::find($id);
        $expense->expensetype_id=$request->cmbExpType;
        $expense->name=$request->txtName;
        $expense->amount=$request->txtAmount;
        $expense->date=date("Y-m-d",strtotime($request->expDate));
        $expense->reference=$request->reference;
        $expense->note=$request->note;
        $expense->update();
        return back()->with('update_expense','Expense Updated successfully');

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
        $expense=Expense::find($id);
        if($expense->delete())
        {
            return back()->with('delete_expense','expense Delete successfully');
        }
    }
    public function get_expense(){
        $id=$_GET['id'];
        $expense=Expense::find($id);
        return json_encode($expense);
    }
    public function expenseDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $expense = Expense::find($data['id']);
            if (!is_null($expense)) {
                $expense->delete();
            }
            return response()->json([
                'success' => true
            ]);
        }

    }


    

}

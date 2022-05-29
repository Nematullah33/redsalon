<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function addTransaction(Request $req){
        $transaction=new Transaction;
        $transaction->name=$req->name;
        $transaction->save();
               
        return back()->with('success', 'Transaction update successfully');
    }
}

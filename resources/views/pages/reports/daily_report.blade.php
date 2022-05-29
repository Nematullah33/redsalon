@extends('layout.erp.home')
@section('title', 'Daily Reports')
@section('content')
<style>
.table td {
    padding: 10px;
}

.table th {
    padding: 10px;
}
</style>


<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="card">
                <div class="card-header">
                    <h5> Reports </h5>

                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block table-border-style">
                    <form action="">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="form-label">From</label>
                                <input type="date" name='formOrder'
                                    class="form-control" value="<?php echo date('Y-m-d');?>" />
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">To</label>
                                <input type="date" name='toOrder'
                                    class="form-control" value="<?php echo date('Y-m-d');?>"/>
                            </div>
                            <div class="col-sm-2">
                                <div style="margin-bottom:8px;"></div><br>
                                <button type="submit" style="padding: 4px 15px;" class=" btn-outline-primary">Search  <i class="fa fa-search"></i></button>
                                
                            </div>
                        </form>
                            <div class="col-sm-2">
                                <a href="{{url('daily-report')}}" style="padding: 4px 15px;"  class="btn-outline-primary">Refresh</a>
                            </div>
                            <div class="col-md-1">
                                <div style="float: right; padding:5px;">
                                    <form action="{{ route('dailyreport.pdf') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                    
                     
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Sales</h5>
                                    </div>
                                    <div class="card-body">
                                        
                                        <table class="table table-bordered">
                                            <tr class="table-info">
                                                <th>Total sales :</th>
                                                <th><b>  ৳ {{round($total[0]->sale_total)}}</b></th>
                                            </tr>
                                            
                                            
                                            @foreach($paymenttype as $payment)
                                            <tr>
                                                <th>{{$payment->payment_type}}</th>
                                                <th>৳ {{round($payment->total)}}</th>
                                                
                                            </tr>
                                            @endforeach
                                            @foreach($salestype as $sales)
                                            <tr>
                                                <th>{{$sales->sale_type}}</th>
                                                <th>৳ {{round($sales->total)}}</th>
                                                
                                            </tr>
                                            @endforeach

                                            <tr>
                                                <th>Advance Booking</th>
                                                <th>৳ {{round($booking_advance[0]->amount+$productbooking[0]->amount)}}</th>
                                                
                                            </tr>
                                        </table>
                                    </div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Expenses</h5>
                                    </div>
                                    <div class="card-body">
                                        
                                        <table class="table table-bordered">
                                            <tr class="table-info">
                                                <th>Total Expense :</th>
                                                <th><b>  ৳ {{round($expense[0]->amount)}}</b></th>
                                            </tr>
                                            
                                            
                                            @foreach($expensetype as $exptype)
                                            <tr>
                                                <th>{{$exptype->expense_type}}</th>
                                                <th>৳ {{round($exptype->amount)}}</th>
                                                
                                            </tr>
                                            @endforeach
                                            
                                            <tr>
                                                <th>Purchase</th>
                                                <th>৳ {{round($purchase[0]->amount)}}</th>
                                            </tr>
                                            <tr>
                                                <th>Suppliers Payment</th>
                                                <th>৳ {{round($payments[0]->paid_amount) ?? 0}}</th>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Profit & Loss</h5>
                                    </div>
                                    <div class="card-body">
                                           @php
                                                 $income=round($total[0]->sale_total+$booking_advance[0]->amount+$productbooking[0]->amount);
                                                $expensetotal= round($expense[0]->amount)+round($payments[0]->paid_amount);
                                                $grossprofit=$income-$expensetotal;
                                           @endphp
                                           <table class="table table-bordered">
                                                <tr>
                                                    <th>Net Profit</th>
                                                    <th>৳ {{$income}}</th>
                                                </tr>
                                                <tr>
                                                    <th>Gross Profit</th>
                                                    <th>৳ {{$grossprofit}}</th>
                                                </tr>
                                           </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    $(function(){
        let income= $("#income").val();
        let loss= $("#loss").val();
        let profit= $("#profit").val();
        $("#show-income").html(income);
        $("#show-loss").html(loss);
        $("#show-profit").html(profit);

        
    })
</script>

@endsection
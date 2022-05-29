@extends('layout.erp.home')
@section('title', 'Reports')
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
                            <div class="col-sm-3">
                                <div style="margin-bottom:8px;"></div><br>
                                <button type="submit" style="padding: 4px 15px;" class=" btn-outline-primary">Search  <i class="fa fa-search"></i></button>
                                
                            </div>
                            <div class="col-sm-2">
                                <a href="{{url('reports')}}" style="padding: 4px 15px;"  class="btn-outline-primary">Refresh</a>
                            </div>
                        </div>
                    </form>
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Product Sale</a>
                          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Service Sale</a>
                          <a class="nav-item nav-link" id="nav-transaction-tab" data-toggle="tab" href="#nav-purchase" role="tab" aria-controls="nav-purchase" aria-selected="false">Purchase</a>
                          <a class="nav-item nav-link" id="nav-transaction-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="false">Payment</a>
                          <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Expense</a>
                          
                          <a class="nav-item nav-link" id="nav-transaction-tab" data-toggle="tab" href="#nav-transaction" role="tab" aria-controls="nav-transaction" aria-selected="false">Profit And Loss</a>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="table-responsive">
                                <div style="float: right; padding:5px;">
                                    <form action="{{ route('salesreport.print') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary text-white">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Number Of Transaction</th>
                                            <th>Total Sale</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <input type="hidden" value="{{$total=0}}">
                                            @php
                                                $sn=1;
                                                $sale_total=0;
                                            @endphp
                                        @foreach($dailySales as $dailySale)
                                        <tr>
                                            <td>{{$sn++}}</td>
                                            <td>{{$dailySale->Date}}</td>
                                            <td>{{$dailySale->no_of_transactions}}</td>
                                            <td>{{$dailySale->total_sale}}</td>
   
                                        </tr>
                                        
                                        @php
                                            $sale_total+=$dailySale->total_sale;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            
                                            <td></td>
                                            <td></td>
                                            <td class="text-right text-info"><b>Total </b></td>
                                            <td class="text-info"><b>{{$sale_total}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="table-responsive">
                                <div style="float: right; padding:5px;">
                                    <form action="{{ route('servicesale.pdf') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary text-white">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Number Of Transaction</th>
                                            <th>Total Service Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <input type="hidden" value="{{$total=0}}">
                                        <tr>
                                            @php
                                                $sn=1;
                                                $service_sale_total=0;
                                            @endphp
                                            @foreach($dailyServiceSales as $ServiceSale)
                                            <td>{{$sn++}}</td>
                                            <td>{{$ServiceSale->Date}}</td>
                                            <td>{{$ServiceSale->no_of_transactions}}</td>
                                            <td>{{$ServiceSale->total_sale}}</td>
                                            
                                            
                                        </tr>
                                        
                                        @php
                                            $service_sale_total+=$ServiceSale->total_sale;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            
                                            <td></td>
                                            <td></td>
                                            <td class="text-right text-info"><b>Total </b></td>
                                            <td class="text-info"><b>{{$service_sale_total}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-purchase" role="tabpanel" aria-labelledby="nav-purchase-tab">
                            <div class="table-responsive">
                                <div style="float: right; padding:5px;">
                                    <form action="{{ route('purchase.pdf') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="table-primary text-white">
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Number Of Transaction</th>
                                            <th>Total Purchase Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <input type="hidden" value="{{$total=0}}">
                                        <tr>
                                            @php
                                                $sn=1;
                                                $purchase_total=0;
                                            @endphp
                                            @foreach($dailyPurchase as $dailyPurch)
                                            <td>{{$sn++}}</td>
                                            <td>{{$dailyPurch->Date}}</td>
                                            <td>{{$dailyPurch->no_of_transactions}}</td>
                                            <td>{{$dailyPurch->total_purchase}}</td>
                                            
                                            
                                        </tr>
                                        
                                        @php
                                            $purchase_total+=$dailyPurch->total_purchase;
                                        @endphp
                                        @endforeach
                                        <tr>
                                            
                                            <td></td>
                                            <td></td>
                                            <td class="text-right text-info"><b>Total </b></td>
                                            <td class="text-info"><b>{{$purchase_total}}</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
                            <table class="table table-bordered">
                                <div style="float: right; padding:5px;">
                                    <form action="{{ route('payment.report') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                                <thead>
                                    <tr class="table-primary text-white">
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Number Of Transaction</th>
                                        <th>Total Expense Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <input type="hidden" value="{{$total=0}}">
                                    <tr>
                                        @php
                                            $sn=1;
                                            $payment_total=0;
                                        @endphp
                                        @foreach($dailypayments as $dailypayment)
                                        <td>{{$sn++}}</td>
                                        <td>{{$dailypayment->Date}}</td>
                                        <td>{{$dailypayment->no_of_transactions}}</td>
                                        <td>{{$dailypayment->total_paymnet}}</td>
                                        
                                        
                                    </tr>
                                    
                                    @php
                                        $payment_total+=$dailypayment->total_paymnet;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        
                                        <td></td>
                                        <td></td>
                                        <td class="text-right text-info"><b>Total </b></td>
                                        <td class="text-info"><b>{{$payment_total}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table class="table table-bordered">
                                <div style="float: right; padding:5px;">
                                    <form action="{{ route('expense.report') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                                <thead>
                                    <tr class="table-primary text-white">
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Number Of Transaction</th>
                                        <th>Total Expense Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <input type="hidden" value="{{$total=0}}">
                                    <tr>
                                        @php
                                            $sn=1;
                                            $expense_total=0;
                                        @endphp
                                        @foreach($dailyexpenses as $dailyexp)
                                        <td>{{$sn++}}</td>
                                        <td>{{$dailyexp->Date}}</td>
                                        <td>{{$dailyexp->no_of_transactions}}</td>
                                        <td>{{$dailyexp->total_expense}}</td>
                                        
                                        
                                    </tr>
                                    
                                    @php
                                        $expense_total+=$dailyexp->total_expense;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        
                                        <td></td>
                                        <td></td>
                                        <td class="text-right text-info"><b>Total </b></td>
                                        <td class="text-info"><b>{{$expense_total}}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="tab-pane fade" id="nav-transaction" role="tabpanel" aria-labelledby="nav-transaction-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 offset-3">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="">
                                                        <th>Product Sales</th>
                                                        <th>:</th>
                                                        <th>{{$sale_total}}</th>
                                                    </tr>
                                                    <tr class="">
                                                        <th>Service Sales</th>
                                                        <th>:</th>
                                                        <th >{{$service_sale_total}}</th>
                                                    </tr>
                                                    <tr class="">
                                                        <th>Purchases</th>
                                                        <th>:</th>
                                                        <th >{{$purchase_total}}</th>
                                                    </tr>
                                                    <tr>    
                                                        <th>Supplier Payments</th>
                                                        <th>:</th>
                                                        <th >{{$payment_total}}</th>
                                                    </tr>
                                                    <tr>    
                                                        <th>Expenses</th>
                                                        <th>:</th>
                                                        <th >{{$expense_total}}</th>
                                                    </tr>
                                                    <tr>   
                                                        <th>Gross Profit</th>
                                                        <th>:</th>
                                                        <th id='show-profit'></th>
                                                    </tr>
                                                </thead>
                                                
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                      </div>
                      @php
                            $income=$sale_total+$service_sale_total;
                            $loss=$payment_total+$expense_total;
                            $grossprofit=$income-$loss;
                      @endphp
                    <input type="hidden" name="" id="income" value="{{$income+$advance_booking[0]->advance}}">
                    <input type="hidden" name="" id="loss" value="{{$loss}}">
                    <input type="hidden" name="" id="profit" value="{{$grossprofit}}">
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
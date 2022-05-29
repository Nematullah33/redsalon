<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Service Sale Pdf</title>
    <style>
        .table-responsive {
            display: inline-block;
            width: 100%;
            overflow-x: auto;
        }
        table {
            border-collapse: collapse;
        }
        table tr td{
            border:1px solid #ccc; 
            padding: 5px;
        }
        table tr th{
            border:1px solid #ccc; 
            padding: 5px;
        }
    </style>
</head>
<body>
                    <div style="text-align: center;">
                        <img src="{{public_path('img/setting/'.$site->photo)}}" style="width:50px;">
                        <p>Company Name: {{$site->name}} <br>
                        Mobile: {{$site->mobile}} <br>
                        Email: {{$site->email}} <br>
                        Address: {{$site->address}}</p>
                    </div>
                    
                    <div>Daily Reports</div>
                    <div>{{$from}} <?php if($from!=''){ echo "To ";}?> {{$to}}</div>
                <div class="table-responsive">
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
                                            <th><b>  Tk {{round($total[0]->sale_total)}}</b></th>
                                        </tr>
                                        
                                        
                                        @foreach($paymenttype as $payment)
                                        <tr>
                                            <th>{{$payment->payment_type}}</th>
                                            <th>Tk {{round($payment->total)}}</th>
                                            
                                        </tr>
                                        @endforeach
                                        @foreach($salestype as $sales)
                                        <tr>
                                            <th>{{$sales->sale_type}}</th>
                                            <th>Tk {{round($sales->total)}}</th>
                                            
                                        </tr>
                                        @endforeach

                                        <tr>
                                            <th>Advance Booking</th>
                                            <th>Tk {{round($booking_advance[0]->amount+$productbooking[0]->amount)}}</th>
                                            
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
                                            <th><b>  Tk {{round($expense[0]->amount)}}</b></th>
                                        </tr>
                                        
                                        
                                        @foreach($expensetype as $exptype)
                                        <tr>
                                            <th>{{$exptype->expense_type}}</th>
                                            <th>Tk {{round($exptype->amount)}}</th>
                                            
                                        </tr>
                                        @endforeach
                                        
                                        <tr>
                                            <th>Purchase</th>
                                            <th>Tk {{round($purchase[0]->amount)}}</th>
                                        </tr>
                                        <tr>
                                            <th>Suppliers Payment</th>
                                            <th>Tk {{round($payments[0]->paid_amount) ?? 0}}</th>
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
                                                <th>Tk {{$income}}</th>
                                            </tr>
                                            <tr>
                                                <th>Gross Profit</th>
                                                <th>Tk {{$grossprofit}}</th>
                                            </tr>
                                       </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
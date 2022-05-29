
<style>

    .invoice-mid{
        
        margin-top:50px;
    }
    
    .invoice-item tr td {
    
        font-weight: bold;
    
        padding: 0px 0px 0px 5px;
        
    
    }
    
    .invoice-item {
        width: 100%;
    }
    
    .invoice-item1 {
        width: 100%;
    }
    
    .invoice-item1 tr td {
        
        font-weight: bold;
        padding: 0px 60px 0px 5px;
        
    
    }
    
    .invoice-price tr td {
        float: right;
        padding: 10px 23px 0px 10px;
        
    }
    
    .invoice-area {
        margin-top: 30px;
    }
    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }
    .col-md-12 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .col-md-2 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
    
    .col-md-4 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    .col-md-8 {
        -webkit-box-flex: 0;
        -ms-flex: 0 0 66.666667%;
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
        
    }
    .row {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }
    </style>
    
    
        <!-- Main-body start -->
        <div class="container">
            <div class="page-wrapper" id="invoice">
                <div class="row">
                    <div class="col-md-12">
                        <div class="invoice-header"></div>
                        <div class="container" style="background-color:#fff;">
                            <h2 style='color:rgb(186, 19, 19);font-weight:bold; text-align: center;'>INVOICE</h2>
                            <div class="row">
                                <div class="col-md-4">
                                    <h3 style='color:rgb(186, 19, 19);font-weight:bold;'>Red Salon</h3>
                                    <table>
                                        <tr>
                                            <td>Invoice No</td>
                                            <td>:</td>
                                            <td>{{$customer[0]->id}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Invoice Date</td>
                                            <td>:</td>
                                            <td>{{date('d-M-y', strtotime($details[0]->order_date))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Phone</td>
                                            <td>:</td>
                                            <td>01956-203742</td>
                                        </tr>
                                        
                                    </table>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <h3 style='font-weight:bold;margin-top:30px;'>Customers</h3>
                                    <table>
                                        
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td>{{$customer[0]->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile</td>
                                            <td>:</td>
                                            <td>{{$customer[0]->mobile}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{$customer[0]->email}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <div class="container invoice-mid" style="background-color:#fff;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="invoice-area">
                                        <table class="invoice-item">
                                            <tr>
                                                <td>Item Description</td>
                                                <td>Unit Price</td>
                                                <td>Quantity</td>
                                                <td>Discount</td>
                                                <td style='border-right:none;'>Total</td>
                                            </tr>
                                        </table>
    
                                    </div>
                                    <table class="invoice-item1">
                                    <input type="hidden" value="{{$sub_total=0}}
                                    {{$grand_total=0}}
                                    {{$dis_total=0}}">
                                    
                                        @foreach($details as $detail)
                                            <input type="hidden" value="{{$grand_total+=$detail->price*$detail->qty-$detail->discount}}
                                            {{$sub_total+=$detail->price*$detail->qty}}
                                            {{$dis_total+=$detail->discount}}">
                                        <tr>
                                            <td >{{$detail->product_name}}</td>
                                            <td style='text-align:right;'>{{$detail->price}}</td>
                                            <td style='text-align:right;'>{{$detail->qty}}</td>
                                            <td style='text-align:right;'>{{$detail->discount}}</td>
                                            <td style='text-align:right;'>{{$detail->price*$detail->qty-$detail->discount}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </table>
    
                                </div>
                            </div>
                            <div class="row invoice-mid">
                                <div class="col-md-8">
                                    <div style="margin-top:20px">
                                        
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <table>
                                        <tr>
                                            <td>Sub Total</td>
                                            <td>:</td>
                                            <td>{{$sub_total}}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Discount ({{round(($details[0]->total_discount)/($sub_total/100))}} %)</td>
                                            <td>:</td>
                                            <td>{{round($details[0]->total_discount)}}</td>
                                        </tr>
                                        <tr>
                                            <td>Advance</td>
                                            <td>:</td>
                                            <td>{{$advPaid ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td style="color:red;">Grand Total</td>
                                            <td style="color:red;">:</td>
                                            <td>{{round($grand_total-$details[0]->total_discount)}}</td>
                                        </tr>
                                        <tr>
                                            <td style="color:green;">Paid</td>
                                            <td>:</td>
                                            <td>{{$details[0]->paid_amount}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row invoice-mid">
                                
                                <div class="col-md-8">
                                
                                </div>
                                <div class="col-md-2">
                                    <h5 style="margin-top:60px; border-top:1px dotted #000; font-weight:bold; text-align:center;">Signature</h5>
                                </div>
                            </div>
    
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    
    

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
    .invoice-item tr td{
        border-collapse: collapse;
        border: 1px solid #ccc;
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
                            <div style="text-align: center;">
                                <img src="{{asset('img/setting/'.$site->photo)}}" style="width:50px;">
                                <p>Company Name: {{$site->name}} <br>
                                Mobile: {{$site->mobile}} <br>
                                Email: {{$site->email}} <br>
                                Address: {{$site->address}}</p>
                            </div>
                        </div>
                        
                        <div class="container invoice-mid" style="background-color:#fff;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="invoice-area">
                                        <table class="invoice-item">
                                            <tr>
                                                <td>Payment Date</td>
                                                <td>Payment Type</td>
                                                <td>Ammount</td>
                                            
                                            </tr>
                                        </table>
    
                                    </div>
                                    <table class="invoice-item1">
                                    <input type="hidden" value="{{$sub_total=0}}
                                    {{$grand_total=0}}
                                    {{$dis_total=0}}">
                                    
                                        @foreach($payments as $payment)
                                            
                                        <tr>
                                            <td >{{$payment->payment_date}}</td>
                                            <td >{{$payment->payment_type}}</td>
                                            <td >{{$payment->amount}}</td>
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
    
    
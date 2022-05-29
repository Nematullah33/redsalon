@extends('layout.erp.home')
@section('title', 'Purchase Invoice')
@section('content')
<style>
.invoice-header {
    height: 30px;
    background-color: rgb(233 17 143);
    border-bottom: 2px solid #000;
}
.invoice-mid{
    height:200px;
    margin-top:50px;
}

.invoice-footer {
    height: 10px;
    width: 100%;
    box-sizing: border-box;
    border-top: 5px solid #000;
    border-radius: 70% 70% 0px 0px;
    background-color: rgb(200, 16, 16);
}
.invoice-footer1{
    border-top: 2px solid #f6f4e8;
    border-radius: 70% 70% 0px 0px;
}


.invoice-item tr td {
    color: #fff;
    font-weight: bold;
    border-right: 3px solid rgb(183 23 23);
    padding: 0px 0px 0px 5px;
    border-radius: 20%;

}

.invoice-item {
    width: 100%;
}

.invoice-item1 {
    width: 100%;
}

.invoice-item1 tr td {
    color: #000;
    border: 1px solid rgb(197, 21, 21);
    font-weight: bold;
    padding: 0px 166px 0px 5px;
    border-radius: 10px;

}

.invoice-price tr td {
    color: #000;
    border-bottom: 1px solid #000;
    font-weight: bold;
    padding: 10px 23px 0px 10px;
    border-radius: 10px;
}

.invoice-area {
    margin-top: 30px;
    background-color: rgb(225 97 171);
    padding: 5px;
}
</style>

<div class="pcoded-inner-content" >
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper" id="invoice">
            <div class="row" style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;">
                <div class="col-md-12">
                    <div class="invoice-header"></div>
                    <div class="container" style="background-color:#fff;">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 style='color:rgb(183 23 23);font-weight:bold;margin-top:30px;'>Purchase</h2>
                                <table>
                                    <tr>
                                        <td>Invoice No</td>
                                        <td>:</td>
                                        <td>{{$customer[0]->id}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Invoice Date</td>
                                        <td>:</td>
                                        <td>{{date('d-M-y', strtotime($details[0]->purchase_date))}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="float:right;">
                                <h3 style='font-weight:bold;margin-top:30px;'>Purchase TO</h3>
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
                    <div class="container" style="background-color:#fff;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-area">
                                    <table class="invoice-item">
                                        <tr>
                                            <td style='border-left:3px solid rgb(183 23 23);'>Item Description</td>
                                            <td>Unit Price</td>
                                            <td>Quantity</td>
                                            
                                            <td style='border-right:none;'>Total</td>
                                        </tr>
                                    </table>

                                </div>
                                <table class="invoice-item1">
                                <input type="hidden" value="{{$sub_total=0}}
                                {{$grand_total=0}}
                                {{$dis_total=0}}">
                                
                                    @foreach($details as $detail)
                                    <tr>
                                        <td >{{$detail->product_name}}</td>
                                        <td style='text-align:left;'>{{$detail->price}}</td>
                                        <td style='text-align:right;'>{{$detail->qty}}</td>
                                        <td style='text-align:right; padding-right:68px;'>{{$detail->price*$detail->qty}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </table>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div style="margin-top:20px">
                                    
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 mt-3">
                                <table class="invoice-price">
                                    
                                    <tr>
                                        <td style="color:rgb(183 23 23);">Grand Total</td>
                                        <td style="color:rgb(183 23 23);">:</td>
                                        <td>{{$details[0]->total_amount}}</td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                        <div class="row invoice-mid">
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4">
                            {{-- <button onclick="generatePDF()">Download as PDF</button> --}}
                            </div>
                            <div class="col-md-2">
                                <h5 style="margin-top:60px; border-top:1px dotted #000; font-weight:bold;">Signeture
                                </h5>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>
                    <div style="background-color:#fff;">
                        <div class="invoice-footer">
                            <div class="invoice-footer1"></div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
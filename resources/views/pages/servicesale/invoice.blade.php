@extends('layout.erp.home')
@section('content')
<style>
.invoice-header {
    height: 30px;
    background-color: rgb(92 28 9);
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
    background-color: rgb(92 28 9);
}
.invoice-footer1{
    border-top: 2px solid #e0decf;
    border-radius: 70% 70% 0px 0px;
}


.invoice-item tr td {
    color: #fff;
    font-weight: bold;
    border-right: 3px solid rgb(206, 19, 19);
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
    border: 1px solid #000;
    font-weight: bold;
    padding: 0px 60px 0px 5px;
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
    background-color: rgb(92 28 9);
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
                                <h2 style='color:rgb(92 28 9);font-weight:bold;margin-top:30px;'>INVOICE</h2>
                                <table>
                                    <tr>
                                        <td>Service ID</td>
                                        <td>:</td>
                                        <td>{{$customer[0]->invoice_id}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Service Date</td>
                                        <td>:</td>
                                        <td>{{date('d-M-y', strtotime($details[0]->sale_date))}}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="float:right;">
                                <h3 style='font-weight:bold;margin-top:30px;'>INVOICE TO</h3>
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
                                            <td style='border-left:3px solid rgb(193, 18, 18);'>Item Description</td>
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
                                        <td >{{$detail->service_name}}</td>
                                        <td style='text-align:right;'>{{$detail->price}}</td>
                                        <td style='text-align:right;'>{{$detail->qty}}</td>
                                        <td style='text-align:right;'>{{$detail->discount}}</td>
                                        <td style='text-align:right;'>{{$detail->price*$detail->qty-$detail->discount}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </table>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 mt-3">
                                <table class="invoice-price">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>:</td>
                                        <td>{{$sub_total}}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount</td>
                                        <td>:</td>
                                        <td>{{$sub_total*$details[0]->total_discount/100}}</td>
                                    </tr>
                                    <tr>
                                        <td>Advance</td>
                                        <td>:</td>
                                        <td>{{$details[0]->advance}}</td>
                                    </tr>
                                    @php $discount=$sub_total*$details[0]->total_discount/100 @endphp
                                    <tr>
                                        <td style="color:rgb(212, 19, 19);">Grand Total</td>
                                        <td style="color:rgb(218, 14, 14);">:</td>
                                        <td>{{$grand_total-$discount-$details[0]->advance}}</td>
                                    </tr>
                                    <tr>
                                        <td style="color:green;">Paid</td>
                                        <td>:</td>
                                        <td>{{$details[0]->paid_amount}}</td>
                                    </tr>
                                    <tr>
                                       
                                        <td style="color:rgb(218, 14, 14);">Due</td>
                                        <td>:</td>
                                        <td style="color:rgb(218, 14, 14);">{{$grand_total-$details[0]->paid_amount-$discount-$details[0]->advance}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row invoice-mid">
                            
                            <div class="col-md-8">
                            {{-- <button onclick="generatePDF()">Download as PDF</button> --}}
                            </div>
                            <div class="col-md-2">
                                <h5 style="margin-top:60px; border-top:1px dotted #000; font-weight:bold; text-align:center;">Signeture
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
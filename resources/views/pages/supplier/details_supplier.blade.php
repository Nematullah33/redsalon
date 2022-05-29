@extends('layout.erp.home')
@section('title', 'Suppliers Details')
@section('content')
<style>
    .table td{
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
                            <a href="{{route('suppliers.create')}}">
                                <h5><i class="fa fa-plus btn btn-primary">  New Supplier</i></h5>
                            </a>
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body border-info">
                                    <table class="table table-bordered  table-striped p-3" style='width:100%'>
                                        <div>
                                            @if (!empty($suppliers->photo))
                                            <img src="{{asset('img/supplier')}}/{{$suppliers->photo}}" width='100%' height="50%" alt="{{$suppliers->photo}}">
                                            
                                            @else
                                            <img src="{{asset('img')}}/no_image.png" width='100' height="50%">
                                            @endif
                                        </div>
                                        <tr class="mt-2">
                                            <td>Name</td>
                                            <td>:</td>
                                            <td>{{$suppliers->name}}</td>
                                        </tr><tr>   
                                            <td>Mobile</td>
                                            <td>:</td>
                                            <td>{{$suppliers->mobile}}</td>
                                        </tr><tr>   
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{$suppliers->email}}</td>
                                        </tr><tr>    
                                            <td>Address</td>
                                            <td>:</td>
                                            <td>{{$suppliers->address}}</td>
                                        </tr>
                                    </tr>
                                    <tr class="table-warning">    
                                        <td>Total Due</td>
                                        <td>:</td>
                                        <td id='total-due'></td>
                                    </tr>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-8">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Purchase date</a>
                                  
                                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Payments History</a>
                                </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class='table-info'>
                                                    <th>#</th>
                                                    <th>Purchase Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr>
                                                    @php $total_purchase=0;@endphp
                                                    @foreach($purchases as $purchase)
                                                    <td>{{$purchase->id}}</td>
                                                    <td>{{date('d-M-y', strtotime($purchase->puchase_date))}}</td>
                                                    <td>{{$purchase->total_amount}}</td>
                                                    <td>
                                                        <a class="btn-info btn-sm" href="{{url('servicesale-invoice')}}/{{$purchase->id}}"><i class='fa fa-eye'></i>
                                                           <a> 
                                                        
                                                    </td>
                                                    @php  $total_purchase+=$purchase->total_amount; @endphp
                                                </tr>
                                                  
                                                @endforeach
                                                <tr >
                                                    <td></td>
                                                    <td class="text-warning">Total Purchase</td>
                                                    <td class="text-warning"><b><?=$total_purchase?></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="card-body">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr class='table-info'>
                                                    <th>#</th>
                                                    <th>Payment Date</th>
                                                    <th>Total Amount</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr>
                                                    @php
                                                        $total_payment=0;
                                                    @endphp
                                                    @foreach($payments as $payment)
                                                    <td>{{$payment->id}}</td>
                                                    <td>{{date('d-M-y', strtotime($payment->payment_date))}}</td>
                                                    <td>{{$payment->amount}}</td>
                                                    <td>
                                                        <a class="btn-info btn-sm" href="{{url('servicesale-invoice')}}/{{$purchase->id}}"><i class='fa fa-eye'></i>
                                                           <a> 
                                                        
                                                    </td>
                                                    @php  $total_payment+=$payment->amount; @endphp
                                                    
                                                   
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td class='text-success'>Total Payment</td>
                                                    <td class='text-success'><b><?=$total_payment?></b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id='total-due-amount' value='<?=$total_purchase-$total_payment?>'>
        </div>
    </div>
</div>

<script>
    $(function(){
        let total=$('#total-due-amount').val();
        $('#total-due').html(total);
    })
    

</script>
@endsection
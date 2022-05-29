@extends('layout.erp.home')
@section('title', 'Customers Details')
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
                            <a href="{{url('customers')}}">
                                <h5><i class="ti-angle-left btn btn-primary">  Back</i></h5>
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
                                    <table class="table table-bordered table-striped mt-2">
                                        <div>
                                            @if (!empty($customers->photo))
                                            <img src="{{asset('img/customer')}}/{{$customers->photo}}" class="img-thumbnail" width='100%' height="50%" alt="{{$customers->photo}}">
                                            
                                            @else
                                            <img src="{{asset('img')}}/no_image.png" width='60' height="50%">
                                            @endif
                                        </div>
                                        <tr>
                                            <td>Name</td>
                                            <td>:</td>
                                            <td>{{$customers->name}}</td>
                                        </tr><tr>   
                                            <td>Mobile</td>
                                            <td>:</td>
                                            <td>{{$customers->mobile}}</td>
                                        </tr><tr>   
                                            <td>Email</td>
                                            <td>:</td>
                                            <td>{{$customers->email}}</td>
                                        </tr><tr>    
                                            <td>Address</td>
                                            <td>:</td>
                                            <td>{{$customers->address}}</td>
                                        </tr><tr>    
                                            <td>Joining</td>
                                            <td>:</td>
                                            <td>{{date("d-F-Y",strtotime($customers->join_date))}}</td>
                                        </tr>
                                        <tr class="table-warning">    
                                            <td>DUE</td>
                                            <td>:</td>
                                            <td id='total-dueAmount'></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-8">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                  <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Service</a>
                                  <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Product</a>
                                  <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Booking</a>
                                  <a class="nav-item nav-link" id="nav-productbooking-tab" data-toggle="tab" href="#nav-productbooking" role="tab" aria-controls="nav-productbooking" aria-selected="false">Product Booking</a>
                                </div>
                              </nav>
                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class='table-info'>
                                                        <th>Sale Date</th>
                                                        <th>Total Amount</th>
                                                        <th>Paid Amount</th>
                                                        <th>Discount</th>
                                                        <th>Advance</th>
                                                        <th>Due</th>
                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        @php
                                                            $sale=0;$paid=0;$discount=0;$due=0; $advance=0;
                                                        @endphp 
                                                        @foreach($services as $service)
                                                        <td>{{date('d-M-y', strtotime($service->sale_date))}}</td>
                                                        <td>{{$service->sale_total}}</td>
                                                        <td>{{round($service->paid_amount)}}</td>
                                                        <td>{{round($service->discount)}}</td>
                                                        <td>{{$service->advance}}</td>
                                                        @php $due1=$service->sale_total-($service->discount)-$service->paid_amount-$service->advance; @endphp
                                                        <td>{{round($due1)}}</td>
                                                        
                                                        <td>
                                                            <a class="btn-info btn-sm" href="{{url('servicesale-invoice')}}/{{$service->id}}"><i class='fa fa-eye'></i>
                                                               <a> 
                                                            
                                                        </td>
                                                        @php
                                                        $sale+=$service->sale_total;
                                                        $paid+=$service->paid_amount;
                                                        $advance+=$service->advance;
                                                        $discount+=$service->discount;
                                                        $due+=$service->sale_total-($service->discount)-$service->paid_amount-$service->advance;
                                                        @endphp 
                                                    </tr>
                                                    
                                                    @endforeach
                                                    <tr class='table-warning'>
                                                        <td>Total</td>
                                                        <td>{{$sale}}</td>
                                                        <td>{{round($paid)}}</td>
                                                        <td>{{round($discount)}}</td>
                                                        <td>{{$advance}}</td>
                                                        <td>{{$due}}</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class='table-info'>
                                                        
                                                        <th>Sale Date</th>
                                                        <th>Total Amount</th>
                                                        <th>Paid Amount</th>
                                                        <th>Discount</th>
                                                        <th>Due</th>
                                                        
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        @php
                                                        $p_sale=0;$p_paid=0;$p_discount=0;$p_due=0;
                                                        @endphp
                                                        @foreach($orders as $order)
                                                        
                                                        <td>{{date('d-M-y', strtotime($order->order_date))}}</td>
                                                        <td>{{$order->order_total}}</td>
                                                        <td>{{round($order->paid_amount)}}</td>
                                                        <td>{{round($order->discount)}}</td>
                                                        <td>{{round($order->order_total-$order->discount-$order->paid_amount)}}</td>
                                                        
                                                        <td>
                                                            <a class="btn-info btn-sm" href="{{url('productsale-invoice')}}/{{$order->id}}"><i class='fa fa-eye'></i>
                                                               <a> 
                                                            
                                                        </td>
                                                        @php
                                                        $p_sale+=$order->order_total;
                                                        $p_paid+=$order->paid_amount;
                                                        $p_discount+=$order->discount;
                                                        $p_due+=$order->order_total-($order->discount)-$order->paid_amount-$order->advance;
                                                        @endphp 
                                                    </tr>
                                                    @endforeach
                                                    <tr class='table-warning'>
                                                        
                                                        <td>Total</td>
                                                        <td>{{$p_sale}}</td>
                                                        <td>{{round($p_paid)}}</td>
                                                        <td>{{round($p_discount)}}</td>
                                                        <td>{{round($p_due)}}</td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class='table-info'>
                                                        <th>ID</th>
                                                        <th>Booking Date</th>
                                                        <th>Booking Time</th>
                                                        <th>Advance </th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        @php
                                                            $advance=0;
                                                        @endphp 
                                                        @foreach($booking as $book)
                                                        <td>{{$book->id}}</td>
                                                        <td>{{date('d-M-y', strtotime($book->booking_date))}}</td>
                                                        <td>{{date('h:t: A', strtotime($book->booking_time))}}</td>
                                                        <td>{{$book->advance ?? 0}}</td>
                                                        <td>
                                                            {{-- <a class="btn-info btn-sm" href="{{route('bookings.show',$cus->id)}}"><i class='fa fa-eye'></i>
                                                               <a>  --}}
                                                            
                                                        </td>
                                                        @php
                                                        $advance+=$book->advance;
                                                        @endphp 
                                                    </tr>
                                                    
                                                    @endforeach
                                                    <tr class='table-warning'>
                                                        
                                                        <td></td>
                                                        <td></td>
                                                        <td class="text-right">Total</td>
                                                        <td>{{$advance}}</td>
                                                        
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-productbooking" role="tabpanel" aria-labelledby="nav-productbooking-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr class='table-info'>
                                                        <th>ID</th>
                                                        <th>Booking Date</th>
                                                        <th>Advance </th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    <tr>
                                                        @php
                                                            $advance=0;
                                                        @endphp 
                                                        @foreach($productbooking as $probook)
                                                        <td>{{$probook->id}}</td>
                                                        <td>{{date('d-M-y', strtotime($probook->date))}}</td>
                                                        <td>{{$probook->advance ?? 0}}</td>
                                                        
                                                        @php
                                                        $advance+=$probook->advance;
                                                        @endphp 
                                                    </tr>
                                                    
                                                    @endforeach
                                                    <tr class='table-warning'>

                                                        <td></td>
                                                        <td class="text-right">Total</td>
                                                        <td>{{$advance}}</td>
  
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
            </div>
            <input type="hidden" id='total-due' value="<?=($due+$p_due)?>">
        </div>
    </div>
</div>

<script>
    $(function(){
        let due=$('#total-due').val();
        $('#total-dueAmount').html(due);
    })
    $(document).on('click', '.deleteCustomer', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('customer/delete') }}",
                    data: {id:id},
                    success: function(res){
                        if(res.success === true){
                            location.reload();
                            $("#successMessage").show();
                        }
                    },
                    error: function(){
                        console.log('Error');
                    }
                })
            }
        })
    })
</script>
@endsection
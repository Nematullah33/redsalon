<!-- <form action="{{url('user/save')}}" method="post"> -->
@extends('layout.erp.home')
@section('title', 'Add Product Booking')
@section('content')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h5>Create Productbookings  /</h5>
                                        <a href="{{url('productbookings')}}">Manage Productbookings</a>
                                    </div>
                                
                                <div class="col-md-3">
                                    <label>Booking ID</label>
                                    <input type="text" style="width:54px; border:none; " class="bg-info text-center" readonly value="{{$booking_id[0]->id+1}}">
                                </div>
                            </div>
                            </div>
                            <div class="card-block">
                                        @if(Session::has('save_booking'))
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                {{Session::get('save_booking')}}
                                                
                                            </div>
                                        @endif
                                <form action="{{route('productbookings.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Customer</label>
                                        <div class="col-sm-9">
                                            <select id="cmbCustomer" name="cmbCustomer" class="form-control"
                                                    style='width:100%' required>
                                                    <option>Select Customer</option>
                                                    @foreach ($customer as $cus)
                                                    <option value="{{$cus->id}}">{{$cus->name }} ({{$cus->mobile }}) ({{$cus->membership_id}})</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Products</label>
                                        <div class="col-sm-9">
                                            <select id="cmbService" name="cmbService[]" class="form-control"
                                                    style='width:100%' multiple>
                                                    @foreach ($product as $ser)
                                                    <option value="{{$ser->id}}">{{$ser->name }}  ( price-{{$ser->price}})</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Booking Date</label>
                                        <div class="col-sm-9">
                                            <input type="text" id='booking_date' value="<?=date('d-m-Y')?>" name='booking_date'
                                                class="form-control" placeholder="0.00" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Advance Payment</label>
                                        <div class="col-sm-9">
                                            <input type="number" id='advance' name='advance'
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Reference</label>
                                        <div class="col-sm-9">
                                            <input type="text" id='reference' name='reference'
                                                class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">

                                        <div class="col-sm-12">
                                            <input type="submit" name='btnCreate'
                                                class="btn center" style="background-color:#e9118f; color:#fff;" value='Submit'>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                    </div>
                </div>
            </div>
            <!-- Page body end -->

        </div>

    </div>
</div>
    <!-- Main-body end -->
    <div id="styleSelector">
    </div>
    <script>
        $(function(){
            $("#cmbCustomer").select2();
            $("#cmbService").select2();
            $("#booking_date").datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    </script>
@endsection
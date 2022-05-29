<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
    @section('title', 'Edit Customer')
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
                                    <h5>Update Customers  /</h5>
                                    <a href="{{url('customers')}}">Manage Customer</a>
    
                                </div>
                                <div class="card-block">
                                            @if(Session::has('update_customer'))
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    {{Session::get('update_customer')}}
                                                    
                                                </div>
                                            
                                            @endif
                                    <form action="{{route('update.customer')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <input type="hidden" value="{{$customers->id}}" name='id'>
                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='txtName'
                                                    class="form-control " value="{{$customers->name}}" placeholder="Customer Name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-3 col-form-label">Mobile</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='txtMobile'
                                                    class="form-control " value="{{$customers->mobile}}" placeholder="Mobile" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name='txtEmail'
                                                    class="form-control " value="{{$customers->email}}" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Membership ID</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='membership'
                                                    class="form-control " placeholder="10010" value="{{$customers->membership_id}}" >
                                            </div>
                                        </div>
                                        <div class="form-group row"> 
                                            <label class="col-sm-3 col-form-label">Designation</label>
                                            <div class="col-sm-9">
                                                <select id="cmbDesignation" name="cmbDesignation" style="width:100%" class="form-control">
                                                        <option >Select</option>
                                                        @foreach ($designation as $cus)
                                                            @if ($customers->designation_id==$cus->id)
                                                                <option value="{{$cus->id}}" selected='selected'>{{$cus->name}}</option>
                                                                @else
                                                                <option value="{{$cus->id}}">{{$cus->name}}</option>
                                                            @endif
                                                        @endforeach
    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Date Of Birth</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='dob' id='dob' class="form-control" value="{{date('d-m-Y',strtotime($customers->dob))}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Joining Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='join_date' id='join_date' class="form-control" value="{{date('d-m-Y')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name='address' class='form-control'>{{$customers->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Remarks</label>
                                            <div class="col-sm-9">
                                                <textarea name='remark' rows="1" class='form-control'>{{$customers->remark}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Photo</label>
                                            <div class="col-sm-9">
                                                <input type="file" name='filePhoto' class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
    
                                            <div class="col-sm-3">
                                                <input type="submit" name='btnCreate'
                                                    class="form-control  btn-primary" style='background-color:#E9118F'  value='Submit'>
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
                $("#cmbDesignation").select2();
                $("#dob").datepicker({
                dateFormat: 'dd-mm-yy'
                });
            });
        </script>
    @endsection
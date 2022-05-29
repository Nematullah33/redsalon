<!-- <form action="{{url('user/save')}}" method="post"> -->
@extends('layout.erp.home')
@section('title', 'Add Customer')
@section('content')
<div class="pcoded-inner-content">
    <div class="addEmployeeModal modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="user_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Designation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name='name' id='name' class="form-control">
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="1" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn" style="background-color: #E9118F" id="btnSubmit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>  
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
                                <h5>Create Customers  /</h5>
                                <a href="{{url('customers')}}">Manage Customers</a>
                            </div>
                            <div class="card-block">
                                        @if(Session::has('save_customer'))
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                {{Session::get('save_customer')}}
                                                
                                            </div>
                                        @endif  
                                        @if(Session::has('warning'))
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            {{Session::get('warning')}}
                                            
                                        </div>
                                        @endif
                                <form action="{{route('customers.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Name <span class="text-danger"> *</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name='txtName'
                                                class="form-control " placeholder="Customer Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        
                                        <label class="col-sm-3 col-form-label">Mobile  <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name='txtMobile'
                                                class="form-control @error('txtMobile') is-invalid @enderror" value="{{ old('txtMobile') }}" placeholder="Mobile" required>

                                                @error('txtMobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" name='txtEmail'
                                                class="form-control " placeholder="example@gmail.com" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Membership ID</label>
                                        <div class="col-sm-9">
                                            <input type="text" name='membership'
                                                class="form-control @error('membership') is-invalid @enderror" placeholder="Membership ID" value="{{ old('membership') }}">
                                                @error('membership')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Designation</label>
                                        <div class="col-sm-8">
                                            <select id="cmbDesignation" name="cmbDesignation" class="form-control"
                                                    style='width:100%'>
                                                    <option style="padding:0px;">Select</option>
                                                    @foreach ($designation as $cus)
                                                    <option value="{{$cus->id}}">{{$cus->name}}</option>
                                                    @endforeach

                                            </select>
                                            
                                        </div>

                                        <div class="col-sm-1">
                                            <a href=".addEmployeeModal" class="btn-sm btn-info fa fa-plus" title="Add Designation" style="line-height: 10px; padding:8px;" data-toggle="modal"></a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Date Of Birth</label>
                                        <div class="col-sm-9">
                                            <input type="text" name='dob' id='dob' class="form-control" value="{{date('d-m-Y')}}">
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
                                            <textarea name='address' class='form-control'></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        
                                        <label class="col-sm-3 col-form-label">Remarks</label>
                                        <div class="col-sm-9">
                                            <textarea name='remark' rows="1" class='form-control'></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Photo</label>
                                        <div class="col-sm-9">
                                            <input type="file" name='filePhoto' class="form-control ">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-sm-12">
                                            <input type="submit" name='btnCreate'
                                                class="btn btn-primary center" style='background-color:#E9118F' value='Submit'>
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
            $("#dob").datepicker({
                dateFormat: 'dd-mm-yy'
                
            });
            $("#join_date").datepicker({
                dateFormat: 'dd-mm-yy'
                
            });
            
            $("#cmbDesignation").select2();
            
        $("#btnSubmit").on('click',function(){
            let name=$("#name").val(); 
            
            $.ajax({
                url:"{{route('add.designation')}}",
                type:'get',
                data:{"name":name},
                success:function(res){
                   //console.log(res);
                  location.reload();
                }
            });
        });

        });
    </script>
@endsection
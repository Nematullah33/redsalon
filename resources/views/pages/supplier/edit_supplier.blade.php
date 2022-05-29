<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
    @section('title', 'Edit Suppliers')
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
                                    
                                    <h5>Update Supplier  /</h5>
                                    <a href="{{url('suppliers')}}">Manage Suppliers</a>
                                </div>
                                <div class="card-block">
                                            @if(Session::has('update_supplier'))
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    {{Session::get('update_supplier')}} 
                                                </div>
                                            
                                            @endif
                                    <form action="{{ route('suppliers.update',$suppliers->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <input type="hidden" value="{{$suppliers->id}}" name='id'>
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name='txtName'
                                                    class="form-control " value="{{$suppliers->name}}" placeholder="Customer Name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-2 col-form-label">Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="text" name='txtMobile'
                                                    class="form-control " value="{{$suppliers->mobile}}" placeholder="Mobile" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name='txtEmail'
                                                    class="form-control " value="{{$suppliers->email}}" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">                                    
                                            <label class="col-sm-2 col-form-label">Company</label>
                                            <div class="col-sm-10">
                                                <input type="text" name='company'
                                                    class="form-control " placeholder="Company Name" value="{{$suppliers->company}}" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        
                                            <label class="col-sm-2 col-form-label">Address</label>
                                            <div class="col-sm-10">
                                                <textarea name='address' class='form-control'>{{$suppliers->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Upload File</label>
                                            <div class="col-sm-10">
                                                <input type="file" name='filePhoto' class="form-control ">
                                            </div>
                                        </div>
                                        <div class="form-group row">
    
                                            <div class="col-sm-12">
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
    @endsection
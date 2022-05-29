<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
   @section('title', 'Edit Company') 

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
                                    <h5>Site Settings  /</h5>
                                </div>
                                <div class="card-block">
                                            @if(Session::has('update_setting'))
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    {{Session::get('update_setting')}}
                                                    
                                                </div>
                                            
                                            @endif
                                    <form action="{{ route('settings.update',$site->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">

                                            <label class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='txtName'
                                                    class="form-control " value="{{$site->name}}" placeholder="Customer Name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-3 col-form-label">Mobile</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='txtMobile'
                                                    class="form-control " value="{{$site->mobile}}" placeholder="Mobile" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name='txtEmail'
                                                    class="form-control " value="{{$site->email}}" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                        
                                            <label class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea name='address' class='form-control'>{{$site->address}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Company Logo</label>
                                            <div class="col-sm-6">
                                                <input type="file" name='filePhoto' class="form-control ">
                                            </div>
                                            <div class="col-sm-3">
                                                <img src="{{asset('img/setting')}}/{{$site->photo}}" width='100%' height="100%" alt="{{$site->photo}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
    
                                            <div class="col-sm-3">
                                                <input type="submit" name='btnCreate'
                                                    class="form-control  btn-primary img-thumbnail" style='background-color:#E9118F'  value='Update'>
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
                
    
            });
        </script>
    @endsection
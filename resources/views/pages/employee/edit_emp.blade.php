<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
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
                                    <h5><a href="{{url('employee')}}">Manage User</a></h5>
    
                                </div>
                                <div class="card-block">
                                            @if(Session::has('success'))
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    {{Session::get('success')}}
                                                    
                                                </div>
                                            
                                            @endif
                                    <form action="{{route('employee.update',$emp->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                        
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name='txtName'
                                                    class="form-control form-control-round" value="{{$emp->name}}" placeholder="Customer Name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-2 col-form-label">Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="text" name='txtMobile'
                                                    class="form-control form-control-round" value="{{$emp->mobile}}" placeholder="Mobile" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" name='txtEmail'
                                                    class="form-control form-control-round" value="{{$emp->email}}" placeholder="Email" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Country</label>
                                            <div class="col-sm-10">
                                                <select name="cmbCountry" id="">
                                                    @foreach ($countries as $country)
                                                        @if($emp->country_id == $country->id)
                                                            <option value="{{$country->id}}" selected >{{$country->name}}</option>
                                                        @else
                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
    
                                            <div class="col-sm-12">
                                                <input type="submit" name='btnCreate'
                                                    class="form-control form-control-round btn-primary" value='Submit'>
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
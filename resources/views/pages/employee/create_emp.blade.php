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
                                <h5><a href="{{url('employee')}}">Manage Buyer</a></h5>

                            </div>
                            <div class="card-block">
                                        @if(Session::has('save_emp'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{Session::get('success')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-lebel="Close"></button>
                                        </div>
                                        @endif
                                <form action="{{route('employee.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='txtName'
                                                class="form-control form-control-round" placeholder="Customer Name" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        
                                        <label class="col-sm-2 col-form-label">Mobile</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='txtMobile'
                                                class="form-control form-control-round" placeholder="Mobile" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name='txtEmail'
                                                class="form-control form-control-round" placeholder="Email" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Country</label>
                                        <div class="col-sm-10">
                                            <select name="cmbCountry" id="">
                                                @foreach ($country as $co)
                                                
                                                    <option value="{{$co->id}}">{{$co->name}}</option>
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
<!-- <form action="{{url('user/save')}}" method="post"> -->
@extends('layout.erp.home')
@section('title', 'Add Service')
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
                                <h5><a href="{{url('services')}}">Manage Services</a></h5>

                            </div>
                            <div class="card-block">
                                        @if(Session::has('save_service'))
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                {{Session::get('save_service')}}
                                                
                                            </div>
                                        
                                        @endif
                                <form action="{{route('services.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Service Name <span class="text-danger"> *</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name='txtName'
                                                class="form-control" placeholder="Service Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Service Category</label>
                                        <div class="col-sm-9">
                                            <select id="cmbCategory" name="cmbCategory" class="form-control"
                                                    style='width:100%' required>
                                                    <option value="">Select Category</option>
                                                    @foreach ($category as $cat)
                                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row"> 
                                        <label class="col-sm-3 col-form-label">Service Price <span class="text-danger"> *</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name='price'
                                                class="form-control" placeholder="0.00" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Service Photo</label>
                                        <div class="col-sm-9">
                                            <input type="file" name='filePhoto' class="form-control ">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Service Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-sm-12">
                                            <input type="submit" name='btnCreate'
                                                class="btn btn-primary center" style='background-color:#E9118F'  value='Submit'>
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
            $("#cmbCategory").select2();

        });
    </script>
@endsection
<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
    @section('title', 'Edit Service')
    @section('content')
    <style>
        select.form-control:not([size]):not([multiple]) {
        height: 36px; !important;
         } 
    </style>  
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
                                    <h5><a href="{{url('services')}}">Manage Service</a></h5>
                                </div>
                                <div class="card-block">
                                            @if(Session::has('update_service'))
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    {{Session::get('update_service')}}
                                                    
                                                </div>
                                            
                                            @endif
                                    <form action="{{ route('services.update',$service->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <input type="hidden" value="{{$service->id}}" name='id'>
                                            <label class="col-sm-3 col-form-label">Service Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='txtName'
                                                    class="form-control " value="{{$service->name}}" placeholder="category Name" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row"> 
                                            <label class="col-sm-3 col-form-label">Category Name</label>
                                            <div class="col-sm-9">
                                                <select id="cmbCategory" name="cmbCategory" class="form-control"
                                                        style='border:1px solid #ccc;'>
                                                        <option style="padding:0px;">Select Category</option>
                                                        @foreach ($category as $cat)
                                                            @if ($service->category_id==$cat->id)
                                                                <option value="{{$cat->id}}" selected='selected'>{{$cat->name}}</option>
                                                                @else
                                                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                            @endif
                                                        @endforeach
    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row"> 
                                            <label class="col-sm-3 col-form-label">Service Price </label>
                                            <div class="col-sm-9">
                                                <input type="text" name='price'
                                                    class="form-control" placeholder="0.00" value="{{$service->price}}" required>
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
                                                <textarea name="description" id="description"  class="form-control">{{$service->description}}</textarea>
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
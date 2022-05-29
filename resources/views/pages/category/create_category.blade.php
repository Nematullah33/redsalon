<!-- <form action="{{url('user/save')}}" method="post"> -->
@extends('layout.erp.home')
@section('title', 'Add Category')
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
                                <h5><a href="{{url('categories')}}">Manage Categories</a></h5>

                            </div>
                            <div class="card-block">
                                        @if(Session::has('save_category'))
                                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                                {{Session::get('save_category')}}
                                                
                                            </div>
                                        
                                        @endif
                                <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row"> 
                                        <label class="col-sm-2 col-form-label">Name <span class="text-danger"> *</span></label>
                                        <div class="col-sm-10">
                                            <input type="text" name='txtName'
                                                class="form-control " placeholder="Category Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" name='filePhoto' class="form-control ">
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
@endsection
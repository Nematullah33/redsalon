<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
@section('title', 'Edit Category')

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
                                    <h5><a href="{{url('categories')}}">Manage categories</a></h5>
    
                                </div>
                                <div class="card-block">
                                            @if(Session::has('update_category'))
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    {{Session::get('update_category')}}
                                                    
                                                </div>
                                            
                                            @endif
                                    <form action="{{ route('categories.update',$categories->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <input type="hidden" value="{{$categories->id}}" name='id'>
                                            <label class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name='txtName'
                                                    class="form-control " value="{{$categories->name}}" placeholder="category Name" autocomplete="off">
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
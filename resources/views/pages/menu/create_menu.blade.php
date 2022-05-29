<!-- <form action="{{url('user/save')}}" method="post"> -->
@extends('layout.erp.home')
@section('title','Menu')
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
                                <h5><a href="{{url('menus')}}">Manage Menu</a></h5>

                            </div>
                            <div class="card-block">
                                @if(Session::has('save_user'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    {{Session::get('save_user')}}
                                    
                                </div>
                                @endif
                                <form action="{{route('menus.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Menu Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="name"  value="{{ old('name') }}" autocomplete="off">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Url</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='url' class="form-control @error('txtUrl') is-invalid @enderror"
                                                placeholder="url"  value="{{ old('txtUrl') }}"> 
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name='description' class='form-control'></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-sm-12">
                                            <input type="submit" name='btnCreate'
                                                class="form-control" style="background-color: #E9118F; color:#fff;" value='Submit'>
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
            $("#cmbRole").select2();
            
        })
    </script>
    
@endsection
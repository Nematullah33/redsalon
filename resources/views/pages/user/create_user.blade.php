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
                                <h5><a href="{{url('users')}}">Manage User</a></h5>

                            </div>
                            <div class="card-block">
                                @if(Session::has('save_user'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    {{Session::get('save_user')}}
                                    
                                </div>
                                @endif
                                <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Select Role</label>
                                        <div class="col-sm-10">
                                            <select id="cmbRole" name="cmbRole" class="form-control @error('cmbRole') is-invalid @enderror" style='width:100%' required>
                                                <option value="">Select</option>
                                                @foreach ($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('cmbRole')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">User Name</label>
                                        <div class="col-sm-10">
                                            
                                            <input type="text" name="txtUsername" class="form-control @error('txtUsername') is-invalid @enderror" placeholder="Username"  value="{{ old('txtUsername') }}" autocomplete="off">
                                            @error('txtUsername')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">User Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='txtEmail' class="form-control @error('txtEmail') is-invalid @enderror"
                                                placeholder="Email"  value="{{ old('txtEmail') }}">
                                                @error('txtEmail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror 
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name='txtPassword'
                                                class="form-control" placeholder="Password" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Upload File</label>
                                        <div class="col-sm-10">
                                            <input type="file" name='filePhoto' class="form-control">
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
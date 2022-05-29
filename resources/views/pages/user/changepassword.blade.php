@extends('layout.erp.home')
@section('title','change Password')
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
                           <div class="card-header"></div>
                            <div class="card-block">
                                @if(Session::has('error_message'))
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        {{Session::get('error_message')}}
                                    </div>
                                @endif
                                
                                @if(Session::has('message'))
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        {{Session::get('message')}}
                                    </div>
                                @endif
                                <form action="{{route('changePassword')}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Current Password</label>
                                        <div class="col-sm-9">
                                            
                                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Current Password"  value="{{ old('current_password') }}" autocomplete="off">
                                            @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">New Password</label>
                                        <div class="col-sm-9">
                                            
                                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="New Password"  value="{{ old('new_password') }}" autocomplete="off">
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            
                                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password"  value="{{ old('password_confirmation') }}" autocomplete="off">
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-sm-4">
                                            <input type="submit" name='btnCreate'
                                                class="form-control" style="background-color: #E9118F; color:#fff; cursor: pointer;" value='Change Password'>
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
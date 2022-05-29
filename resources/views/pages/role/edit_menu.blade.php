@extends('layout.erp.home')
@section('title','Menu Permisions')
@section('content')

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Page body start -->
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-8 offset-2">
                        <!-- Basic Form Inputs card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5><a href="{{url('users')}}">Manage User</a></h5>

                            </div>
                            <div class="card-block">
                                @if(Session::has('update_user'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    {{Session::get('update_user')}}
                                    
                                </div>
                                @endif
                            <form action="{{route('users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                              @csrf
                              @method("PUT")

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Select Role</label>
                                        <div class="col-sm-10">
                                            <select id="cmbRole" name="cmbRole" class="form-control" style="width:100%">
                                                <option value="opt1">Select</option>
                                                @foreach ($roles as $role)
                                                @if($role->id==$user->role_id)
                                                      <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                                   @else
                                                   <option value="{{$role->id}}">{{$role->name}}</option>
                                                   @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='txtUsername'
                                                class="form-control " placeholder="Username" value="{{$user->username}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" name='txtEmail' value="{{$user->email}}" class="form-control "
                                                placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name='txtPassword'
                                                class="form-control " value="" placeholder="Password" autocomplete="off">
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
                                                class="form-control" style="background-color: #E9118F; color:#fff;"  value='Update User'>
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
<script>
    $(function(){
        $("#cmbRole").select2();

    })
</script>
@endsection




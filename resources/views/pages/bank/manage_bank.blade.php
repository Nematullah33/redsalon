@extends('layout.erp.home')
@section('content')
<style>
    .table td{
        padding: 10px;
    } 
    .table th {
    padding: 10px;
    }
</style>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('users.create')}}">
                        <h5>Create User</h5>
                    </a>

                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="fa fa fa-wrench open-card-option"></i></li>
                            <li><i class="fa fa-window-maximize full-card"></i></li>
                            <li><i class="fa fa-minus minimize-card"></i></li>
                            <li><i class="fa fa-refresh reload-card"></i></li>
                            <li><i class="fa fa-trash close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach( $users as $user)
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->password}}</td>
                                    <td>

                                        <div style="display:flex">
                                            <button style='border:none;  padding:5px;' class="btn btn-default waves-effect" data-toggle="tooltip" data-placement="top" title="" data-original-title="To Update User" ><a 
                                                    href="{{route('users.edit',$user->id)}}"><i class='fa fa-pencil'></i> Edit<a></button>
                                            <button style='border:none;  padding:5px;' class="btn btn-default waves-effect" data-toggle="tooltip" data-placement="top" title="" data-original-title="View User Details"  > <a 
                                                    href="{{route('users.show',$user->id)}}"><i class='fa fa-eye'></i>  Details<a></button>
                                            <button style='border:none;'>
                                                <form  action="{{route('users.destroy',$user->id)}}"
                                                    method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <i class='fa fa-trash'></i><input type="submit" name="btnDelete" value="Delete" style='border:none; padding:6px;' class="btn btn-default waves-effect" data-toggle="tooltip" data-placement="top" title="" data-original-title="To Delete User" />
                                                </form>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
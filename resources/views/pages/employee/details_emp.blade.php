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
<div class="row">
    <div class="col-md-8">
        <div class="pcoded-inner-content">
            <!-- Main-body start -->
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('employee.index')}}">
                                <h5><i class="fa fa-plus btn btn-primary">Manage Employee</i></h5>
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

                                <table class="table table-hover table-striped">

                                    <tr class='table-info'>
                                        <th>ID</th>
                                        <th>:</th>
                                        <th>{{$emp->id}}</th>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <th>:</th>
                                        <th>{{$emp->name}}</th>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <th>:</th>
                                        <th>{{$emp->mobile}}</th>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <th>{{$emp->email}}</th>
                                    </tr>
                                
                                
                                </table>
                                
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

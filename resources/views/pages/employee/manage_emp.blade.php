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
                    <a href="{{route('employee.create')}}">
                        <h5><i class="fa fa-plus btn btn-primary">  New Buyer</i></h5>
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
                            <thead>
                                @if(Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{Session::get('success')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-lebel="Close"></button>
                                    </div>
                                @endif
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody  class="">
                                <tr>
                                @foreach($employee as $cus)
                                    <td>{{$cus->id}}</td>
                                    <td>{{$cus->name}}</td>
                                    <td>{{$cus->mobile}}</td>
                                    <td>{{$cus->email}}</td>
                                    <td>{{$cus->country}}</td>
                                    <td>

                                        {{-- <div style="display:flex">
                                            <a href="{{route('employee.show',$cus->id)}}" style="padding:2px; border:1px solid hsl(177, 88%, 74%);"><i class="fa fa-eye btn btn-info" style="padding: 10px; "></i></a>
                                            <a href="{{route('employee.edit',$cus->id)}}" style="padding:2px; border:1px solid hsl(177, 82%, 74%);"><i class="fa fa-pencil-square-o btn btn-success" style="padding: 10px; "></i></a>
                                            <a href="/delete-employee/{{$cus->id}}" style="padding:2px; border:1px solid hsl(177, 67%, 65%);"><i class="fa fa-trash btn btn-danger" style="padding: 10px;"></i></a>
                                        </div> --}}
                                        <form action="{{ route('employee.destroy',$cus->id) }}" method="POST">
   
                                            <a class="btn btn-info" href="{{ route('employee.show',$cus->id) }}">Show</a>
                            
                                            <a class="btn btn-primary" href="{{ route('employee.edit',$cus) }}">Edit</a>
                           
                                            @csrf
                                            @method('DELETE')
                              
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
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





@extends('layout.erp.home')
@section('title', 'Dashboard')
@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                    <p class="m-b-0">Welcome to Redsalon</p>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{url('/home')}}"> <i class="fa fa-home"></i> </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#!">Dashboard</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                       
                                            <div class="row">  
                                                <!-- Project statustic end -->
                                                <div class="col-xl-4 col-md-12">
                                                    <div class="card mat-clr-stat-card text-white" style="background-color: rgb(252, 49, 49)">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-3 text-center" style="background-color: rgb(209, 8, 8)">
                                                                    <i class="fas fa-users mat-icon f-24"></i>
                                                                </div>
                                                                <div class="col-9 cst-cont">
                                                                    <h5>{{$cus[0]->id}}+</h5>
                                                                    <p class="m-b-0">Customers</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   
                                                <div class="col-xl-4 col-md-12"> 
                                                    <div class="card mat-clr-stat-card text-white" style="background-color: rgb(239, 79, 154)">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-3 text-center " style="background-color: rgb(191, 16, 118)">
                                                                    <i class="fas fa-trophy mat-icon f-24"></i>
                                                                </div>
                                                                <div class="col-9 cst-cont">
                                                                    <h5>{{$today_booking[0]->id}}</h5>
                                                                    <p class="m-b-0">Today Bookings</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-12"> 
                                                    <div class="card mat-clr-stat-card text-white" style="background-color: rgb(239, 79, 154)">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-3 text-center " style="background-color: rgb(191, 16, 118)">
                                                                    <i class="fas fa-trophy mat-icon f-24"></i>
                                                                </div>
                                                                <div class="col-9 cst-cont">
                                                                    <h5>{{$today_panding_booking[0]->id}}</h5>
                                                                    <p class="m-b-0">Today Pending Bookings</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-4 col-md-12"> 
                                                    <div class="card mat-clr-stat-card text-white" style="background-color: #843ab8">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-3 text-center" style="background-color: #672398">
                                                                    <i class="fas fa-trophy mat-icon f-24"></i>
                                                                </div>
                                                                <div class="col-9 cst-cont">
                                                                    <h5>{{$bookings[0]->id}}</h5>
                                                                    <p class="m-b-0">Total Bookings</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-4 col-md-12"> 
                                                    <div class="card mat-clr-stat-card text-white" style="background-color: #81c9f6">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                
                                                                    <div class="col-3 text-center" style="background-color: #39b1f6">
                                                                        <i class="fas fa-birthday-cake f-28 pt-4"></i>
                                                                    </div>
                                                                
                                                                    <div class="col-9 cst-cont">
                                                                        <a href="{{ route('today.dob')}}" onMouseOver="this.style.color='#000'"
                                                                        onMouseOut="this.style.color='#fff'">
                                                                            <h5>{{$dob_today[0]->id}}</h5>
                                                                            <p class="m-b-0">Today Birthday's </p>
                                                                        </a>
                                                                    </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="col-xl-4 col-md-12"> 
                                                    <div class="card mat-clr-stat-card text-white" style="background-color: #81c9f6">
                                                        <div class="card-block">
                                                            <div class="row">
                                                                <div class="col-3 text-center" style="background-color: #39b1f6">
                                                                    <i class="fas fa-birthday-cake f-28 pt-4"></i>
                                                                </div>
                                                                <div class="col-9 cst-cont">
                                                                    <a href="{{ route('tomorrow.dob')}}" onMouseOver="this.style.color='#000'"
                                                                        onMouseOut="this.style.color='#fff'">
                                                                    <h5>{{$cusdob[0]->id}}</h5>
                                                                    <p class="m-b-0">Tomorrow Birthday's </p></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   

                                            </div> 
                                        @if(session('sess_role_id') == 1)   
                                            <div class="row">  
                                                <div class="col-xl-12 col-md-12">
                                                    <div class="row">
                                                        <!-- sale card start -->
                                                        <div class="col-md-3">
                                                            <div class="card text-center order-visitor-card">
                                                                <div class="card-block">
                                                                    <h6 class="m-b-0">Today Product Sales</h6>
                                                                    <h4 class="m-t-15 m-b-15"><i class="fa fa-arrow-down m-r-15 text-c-red"></i>{{$today_sale[0]->price ?? 0}}</h4>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card text-center order-visitor-card">
                                                                <div class="card-block">
                                                                    <h6 class="m-b-0">Total Product Sales</h6>
                                                                    <h4 class="m-t-15 m-b-15"><i class="fa fa-arrow-up m-r-15 text-c-green"></i>{{$pro_sale[0]->price ?? 0}}</h4>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card text-center order-visitor-card">
                                                                <div class="card-block">
                                                                    <h6 class="m-b-0">Today Service Sales</h6>
                                                                    <h4 class="m-t-15 m-b-15"><i class="fa fa-arrow-down m-r-15 text-c-red"></i>{{$today_serviesale[0]->price ?? 0}}</h4>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card text-center order-visitor-card">
                                                                <div class="card-block">
                                                                    <h6 class="m-b-0">Total Service Sales</h6>
                                                                    <h4 class="m-t-15 m-b-15"><i class="fa fa-arrow-down m-r-15 text-c-red"></i>{{$service_sale[0]->price ?? 0}}</h4>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="col-md-3">
                                                            <div class="card text-center order-visitor-card">
                                                                <a href="{{route('stocks.index')}}" onMouseOver="this.style.color='#fff'"
                                                                onMouseOut="this.style.color='#000'"><div class="card-block">
                                                                    
                                                                    <h6 class="m-b-0">Stocks</h6>
                                                                    
                                                                    <h4 class="m-t-15 m-b-15"><i class="fa fa-arrow-up m-r-15 text-c-green"></i>{{$stocks[0]->qty}}</h4>
                                                                    
                                                                </div></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="card text-center order-visitor-card">
                                                                <div class="card-block">
                                                                    <h6 class="m-b-0">Today's Advance</h6>
                                                                    <h4 class="m-t-15 m-b-15"><i class="fa fa-arrow-up m-r-15 text-c-green"></i>{{$advance[0]->advance ?? 0}}</h4>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!-- sale card end -->
                                                    </div>
                                                </div>
                                            </div>
                                        @endif    
                                    </div>
                                    <!-- Page-body end -->
                                </div>
                                <div id="styleSelector"> </div>
   </div>
</div>
@endsection
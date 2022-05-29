@extends('layout.erp.home')
@section('title', 'Product Bookings')
@section('content')
<style>
    .table td{
        padding: 10px;
    } 
    .table th {
    padding: 10px;
    }
    p {
    margin-top: 0;
    margin-bottom: 0.3rem;
    }

</style>
<div class="pcoded-inner-content">
    <div class="addEmployeeModal modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="user_form">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
    
                    <select id="cmbStatus" name="cmbStatus" class="form-control" >
                        <option value="1">Panding</option>
                        <option value="2">Completed</option>
                    </select>
    
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" value="1" name="type">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <button type="button" class="btn" style="background-color: #E9118F" id="btnSubmit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="card">
                <div class="card-header">
                             <h5> Productbooking List  /</h5>
                            <a href="{{route('productbookings.create')}}">Create Productbooking</a>
                            
                            <a class="float-right pr-5" href="{{route('productbookings.index')}}">
                                <h6> Refresh</h6>
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
                    <div class="row" style='margin:-10px; padding:0px;'>
                        <div class="col-md-12">
                            
                                <div class="form-group row border-primary" style="background-color: aliceblue">
                                    <div class="col-sm-4 p-2">
                                        <select id="cmbCustomer" name="cmbCustomer" class="form-control"
                                                    style='width:100%'>
                                                    <option>SELECT</option>
                                                    @foreach ($customer as $cus)
                                                    <option value="{{$cus->id}}">{{$cus->name }} ({{$cus->mobile}})  ({{$cus->membership_id}})</option>
                                                    @endforeach

                                        </select>
                                    </div>
                                </div>
                        </div>
                        
                    </div>
                    
                    <hr>
                    <div class="row" id='bookingDetails' >
                        @foreach($bookings as $booking)
                         
                            <div class="col-md-12">
                                <div class="">
                                    <div class="row p-3" style="border-radius: 5px;">
                                        <div style="background-color:#e9118f; color:#fff" class="p-3">
                                            <h4>{{date('d-M-y', strtotime($booking->date))}}</h4>
                                            <p style='border:1px solid #ccc; text-align:center;border-radius:3px; padding:0px;'>{{$booking->booking_time}}</p>
                                            <p class="text-center">Booking #{{$booking->id}}</p>
                                        </div>
                                        <div style="background-color:#f53ca8;color:#fff;max-width:176px;" class="p-3">
                                            <h4>{{$booking->customer->name}}</h4>
                                            <p style='padding-left:5px;'><span class="ti-email"></span>  {{$booking->customer->email}}</p>
                                            @foreach($booking->productbooking as $details_data)
                                                <span style='padding-left:5px;'>{{$details_data->product->name}}</span>    
                                            @endforeach
                                        </div>
                                        <div style="background-color:#f53ca8; color:#fff;" class="p-3">
                                            <h4 class="mb-4"></h4>
                                            <p style='padding-left:5px;'><span class="ti-mobile"></span>  {{$booking->customer->mobile}}</p>
                                            
                                        </div>
                                        <div style="background-color:#f53ca8;color:#fff;" class="p-3">
                                            <h4 class="mb-4"></h4>
                                            @if($booking->status==1)
                                            <td ><a href=".addEmployeeModal" style="border-radius:5px; background-color:#f5b514; color:#fff;" data-id="{{$booking->id}}" class="btn btn-sm btnUpdate" data-toggle="modal"> Panding</a></td>
                                            @elseif($booking->status==2)
                                            <td ><a href=".addEmployeeModal" style="border-radius:5px;" data-id="{{$booking->id}}" class="btn btn-info btn-sm btnUpdate" data-toggle="modal"> Completed</a></td>
                                            @endif
                                             
                                            <a href="javascript:" id="{{$booking->id}}" class="printbooking"><button class="btn btn-primary btn-sm" style="border-radius:5px; border:1px solid #E9118F"> Print</button>  </a>
                                            <a href="javascript:" id="{{$booking->id}}" class="deletebooking"><button class="btn btn-danger btn-sm" style="border-radius:5px; border:1px solid #E9118F"> Delete</button>  </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach    
                    </div>
                    
                </div>
            </div>
            <input type="hidden" name="" id="booking_id">
        </div>
    </div>
</div>

<script>
    
   $(function(){
        $("#booking_date").datepicker({
                dateFormat: 'dd-mm-yy'
            });
        $("#cmbCustomer").select2(); 
       
        $(document).on('click','.printbooking',function(e){
            
                e.preventDefault();
                var id = $(this).attr('id'); 
                $.ajax({
                    type: 'get',
                    url: "{{ url('print-productbooking') }}",
                    data: {id:id},
                    success: function(res){
                        console.log(res.view);
                        
                        if(res.success == true){
                            var win = window.open("","_top");
                            win.document.write(res.view);
                            self.focus();
                            win.print();
                            win.close();
                            location.reload();

                        }
                    },
                    error: function(){
                        console.log('Error');
                    }
                })
        });

        $("#cmbCustomer").on("change",function(){ 
            
           $.ajax({
             url:"<?php echo url("get/productboooking")?>",
             type:'GET',
             data:{"id":$(this).val()},
             success:function(res){
               let html="";
                for(booking of res){
                    html+="<div class='col-md-12' style='width:100%'>";
                        html+="<div>";
                            html+="<div class='row p-3' style='border-radius: 5px;''>";
                                html+="<div style='background-color:#e9118f; color:#fff;' class='p-3'>";
                                    html+="<h4>"+booking.date+"</h4>";
                                    html+="<p class='text-center'>Booking #"+booking.id+"</p>";
                                    html+="</div>";
                                    html+="<div style='background-color:#f53ca8; color:#fff;' class='p-3'>";
                                        html+="<h4>"+booking.customer.name+"</h4>";
                                        html+=" <p style='padding-left:5px;'><span class='ti-email'></span>  "+booking.customer.email+"</p>";
                                            for(details_data of booking.productbooking){
                                                html+="<span style='padding-left:5px;'>"+details_data.product.name+"</span>";    
                                            }
                                            html+="</div>";
                                            
                                            html+="<div style='background-color:#f53ca8; color:#fff;' class='p-3'>";
                                            html+="<h4 class='mb-4'></h4>";
                                            html+="<p style='padding-left:5px;'><span class='ti-mobile'></span>  "+booking.customer.mobile+"</p>";
                                            
                                            html+="</div>";
                                            html+="<div style='background-color:#f53ca8;' class='p-3'>";
                                            html+="<h4 class='mb-4'></h4>";
                                            if(booking.status==1){
                                                html+="<td ><a href='.addEmployeeModal' style='border-radius:5px;' data-id="+booking.id+" class='btn btn-warning btn-sm btnUpdate' data-toggle='modal'>Panding</a></td>";   
                                            }else{
                                                html+="<td ><a href='.addEmployeeModal' style='border-radius:5px;' data-id="+booking.id+" class='btn btn-info btn-sm btnUpdate' data-toggle='modal'> Completed</a></td>";     
                                            }
                                            html+="<a href='javascript:' id="+booking.id+" class='printbooking pl-1'><button class='btn btn-primary btn-sm' style='border-radius:5px; border:1px solid #E9118F'> Print</button>  </a>";
                                            html+="<a href='javascript:' id="+booking.id+" class='deletebooking pl-1'><button class='btn btn-danger btn-sm' style='border-radius:5px; border:1px solid #E9118F'> Delete</button>  </a>";
                                            html+="</div>";
                                            html+=" </div>";
                                            html+=" </div>";
                                            html+=" </div>";
                }//end foreach
                $("#bookingDetails").html(html);
                //console.log(bookings.customer.name);
              }
               
             
               
             
           });
        }); 

        $(document).on('click', '.btnUpdate',function(){
            let booking_id=$(this).data("id");
            $("#booking_id").val(booking_id);

        });
        $("#btnSubmit").on('click',function(){
            let id=$("#booking_id").val(); 
            let status_id=$("#cmbStatus").val();
            
            $.ajax({
                url:"{{route('update.booking_status')}}",
                type:'get',
                data:{"status_id":status_id,"booking_id":id},
                success:function(res){
                   //console.log(res);
                  location.reload();
                }
            });
        });


   });
    $(document).on('click', '.deletebooking', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'get',
                    url: "{{ url('productbooking/delete') }}",
                    data: {id:id},
                    success: function(res){
                        if(res.success === true){
                            location.reload();
                            $("#successMessage").show();
                        }
                    },
                    error: function(){
                        console.log('Error');
                    }
                })
            }
        })
    })
</script>
@endsection
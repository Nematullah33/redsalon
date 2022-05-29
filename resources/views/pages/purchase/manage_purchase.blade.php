@extends('layout.erp.home')
@section('title', 'Purchase List')
@section('content')
<style>
.table td {
    padding: 10px;
}

.table th {
    padding: 10px;
}
</style>
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
                    <option value="1">On Process</option>
                    <option value="2">On the way</option>
                    <option value="3">Delidered</option>
                </select>

                </div>
                <div class="modal-footer">
                    <input type="hidden" value="1" name="type">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn btn-success" id="btnSubmit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('purchase.create')}}">
                        <h5><i class="fa fa-plus btn btn-primary">  New Purchase </i></h5>
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
                    <form action="">
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <label class="form-label">From</label>
                                <input type="date" name='formOrder'
                                    class="form-control" value="<?php echo date('Y-m-d');?>" />
                            </div>
                            <div class="col-sm-3">
                                <label class="form-label">To</label>
                                <input type="date" name='toOrder'
                                    class="form-control" value="<?php echo date('Y-m-d');?>"/>
                            </div>
                            <div class="col-sm-3">
                                <div style="margin-bottom:8px;"></div><br>
                                <button type="submit" style="padding: 4px 15px;" class=" btn-outline-primary">Search  <i class="fa fa-search"></i></button>
                                
                            </div>
                            <div class="col-sm-2">
                                <a href="{{url('purchase')}}" style="padding: 4px 15px;"  class="btn-outline-primary">Go Back</a>
                            </div>
                        </div>
                    </form>

                    @if(Session::has('delete_order'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                            {{Session::get('delete_order')}}        
                            </div>
                        @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Supplier Name</th>
                                    <th>Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Purchase Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                <tr>
                                    
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->supplier_name}}</td>
                                    <td>{{$purchase->mobile}}</td>
                                    <td>{{$purchase->total_amount}}</td>
                                    <td>{{$purchase->purchase_date}}</td>
                                    
                                    

                                    {{-- @if($order->status_id==1)
                                    <td ><a href=".addEmployeeModal" style="border-radius:20px;" data-id="{{$order->id}}" class="btn btn-outline-success btn-sm btnUpdate" data-toggle="modal"> On Process</a></td>
                                    @elseif($order->status_id==2)
                                    <td ><a href=".addEmployeeModal" style="border-radius:20px;" data-id="{{$order->id}}" class="btn btn-outline-primary btn-sm btnUpdate" data-toggle="modal"> On the way</a></td>
                                    @elseif($order->status_id==3)
                                    <td ><a href=".addEmployeeModal" style="border-radius:20px;" data-id="{{$order->id}}" class="btn btn-outline-info btn-sm btnUpdate" data-toggle="modal"> Delivered</a></td>
                                    @endif --}}
                                    
                                    <td>
                                        <div style="display:flex">
                                            
                                            
                                                        <a href="{{route('purchase.show',$purchase->id)}}" style="padding:2px; border:1px solid hsl(177, 88%, 74%);"><i class="fa fa-eye btn btn-info" style="padding: 10px; "></i></a>

                                                        {{-- <a href="javascript:" id="{{ $purchase->id }}" class="deletePurchase" style="padding:2px; border:1px solid hsl(177, 67%, 65%);"><i class="fa fa-trash btn btn-danger" style="padding: 10px;"></i></a> --}}
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                        
                        @if($purchases instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{$purchases->links()}}
                        @endif
                    </div>
                </div>
            </div>
            <input type="hidden" name="" id="order_id">
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.deletePurchase', function(e){
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
                    url: "{{ route('purchase.delete') }}",
                    data: {id:id},
                    success: function(res){
                        console.log(res);
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
<script>
    $(function(){
        $(".btnUpdate").on('click',function(){
            let order_id=$(this).data("id");
            $("#order_id").val(order_id);

        });
        
        $("#btnSubmit").on('click',function(){
            let id=$("#order_id").val(); 
            let status_id=$("#cmbStatus").val();
            
            $.ajax({
                url:"{{route('update.order_status')}}",
                type:'get',
                data:{"status_id":status_id,"order_id":id},
                success:function(res){
                   
                 location.reload();
                }
            });
        });
    });
</script>
@endsection
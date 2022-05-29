@extends('layout.erp.home')
@section('title', 'Product Sales List')
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
                    <h5>Manage Product Sale  /</h5>
                    <a href="{{url('productsale/create')}}">Create Product Sale</a>


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
                            <div class="col-sm-2">
                                <div style="margin-bottom:8px;"></div><br>
                                <button type="submit" style="padding: 4px 15px;" class=" btn-outline-primary">Search  <i class="fa fa-search"></i></button>
                                
                            </div>
                    </form>
                            <div class="col-sm-2">
                                <a href="{{url('productsale')}}" style="padding: 4px 15px;"  class="btn-outline-primary">Referesh</a>
                                
                            </div>
                            <div class="col-sm-1">
                                <div class="pl-3">
                                    <form action="{{ route('order.print') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                            </div>
                        </div>
                    

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
                                    <th>Customer Name</th>
                                    <th>Mobile</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Discount</th>
                                    <th>Sale Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    @foreach($orders as $order)
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->cus_name}}</td>
                                    <td>{{$order->mobile}}</td>
                                    <td>{{$order->order_total}}</td>
                                    <td>{{$order->paid_amount}}</td>
                                    <td>{{$order->discount}}</td>
                                    <td>{{$order->order_date}}</td>
                                    
                                    

                                    {{-- @if($order->status_id==1)
                                    <td ><a href=".addEmployeeModal" style="border-radius:20px;" data-id="{{$order->id}}" class="btn btn-outline-success btn-sm btnUpdate" data-toggle="modal"> On Process</a></td>
                                    @elseif($order->status_id==2)
                                    <td ><a href=".addEmployeeModal" style="border-radius:20px;" data-id="{{$order->id}}" class="btn btn-outline-primary btn-sm btnUpdate" data-toggle="modal"> On the way</a></td>
                                    @elseif($order->status_id==3)
                                    <td ><a href=".addEmployeeModal" style="border-radius:20px;" data-id="{{$order->id}}" class="btn btn-outline-info btn-sm btnUpdate" data-toggle="modal"> Delivered</a></td>
                                    @endif --}}
                                    
                                    <td>
                                        <div style="display:flex">
                                            
                                            <button style='border:none;  padding:5px;'
                                                class="btn btn-default waves-effect" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="View User Details">
                                                <a href="{{route('productsale.show',$order->id)}}"><i class='fa fa-eye'></i>
                                                    Details<a></button>
                                            <button style='border:none;'>
                                                <form action="{{route('productsale.destroy',$order->id)}}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <i class='fa fa-trash'></i><input type="submit" name="btnDelete"
                                                        value="Delete" style='border:none; padding:6px;'
                                                        class="btn btn-default waves-effect" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="To Delete User" />
                                                </form>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{$orders->links()}}
                        @endif
                    </div>
                </div>
            </div>
            <input type="hidden" name="" id="order_id">
        </div>
    </div>
</div>
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
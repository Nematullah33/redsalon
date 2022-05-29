@extends('layout.erp.home')
@section('title', 'Expenses')
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
                    <a href="{{route('expenses.create')}}">
                        <h5><i class="fa fa-plus btn btn-primary">  New Expense </i></h5>
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
                            <div class="col-sm-2">
                                <div style="margin-bottom:8px;"></div><br>
                                <button type="submit" style="padding: 4px 15px;" class=" btn-outline-primary">Search  <i class="fa fa-search"></i></button>
                                
                            </div>
                            <div class="col-sm-2">
                                <a href="{{url('expenses')}}" style="padding: 4px 15px;"  class="btn-outline-primary">Refresh</a>
                            </div>
                        </form>
                            <div class="col-sm-1">
                                <div class="pl-3">
                                    <form action="{{ route('expenselist.print') }}" method="post">
                                        @csrf
                                        @if($from!="" && $to!="")
                                        <input type="hidden" name="from" value="{{$from}}">
                                        <input type="hidden" name="to" value="{{$to}}">
                                        @endif
                                        <input type="submit" class="" value="Print">
                                    </form>
                                </div>
                            </div>
                        </div>
                   

                    @if(Session::has('delete_expense'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                            {{Session::get('delete_expense')}}        
                            </div>
                        @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Expense For</th>
                                    <th>Expense Date</th>
                                    <th>Reference</th>
                                    <th>Note</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    @php
                                        $total=0;
                                    @endphp
                                    @foreach($expenses as $exp)
                                    <td>{{$exp->id}}</td>
                                    <td>{{$exp->expensetype->name ?? ''}}</td>
                                    <td>{{$exp->name}}</td>
                                    <td>{{date("d-M-Y", strtotime($exp->date))}}</td>
                                    <td>{{$exp->reference}}</td>
                                    <td>{{$exp->note}}</td>
                                    <td>{{$exp->amount}}</td>
                                    <td>
                                        <div style="display:flex">
                                            <a href="{{route('expenses.edit',$exp->id)}}" style="padding:2px; border:1px solid hsl(177, 82%, 74%);"><i class="fa fa-pencil-square-o btn btn-success" style="padding: 10px; "></i></a>
                                            <a href="javascript:" id="{{ $exp->id }}" class="deleteExpense" style="padding:2px; border:1px solid hsl(177, 67%, 65%);"><i class="fa fa-trash btn btn-danger" style="padding: 10px;"></i></a>
                                        </div>
                                    </td>
                                    {{-- @php  $total+=$exp->amount; @endphp --}}
                                    
                                       
                                </tr>
                                @endforeach
                                {{-- <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td style="background-color: #e9118f;color:#fff; text-align:center"><b> Total Expense</b></td>
                                    <td style="background-color: #fe47b1;color:#fff;"><b>৳ {{$total}}</b></td>
                                </tr> --}}
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <input type="hidden" name="" id="order_id">
        </div>
    </div>
</div>
<script>
        $(document).on('click', '.deleteExpense', function(e){
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
                    url: "{{ url('expense/delete') }}",
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
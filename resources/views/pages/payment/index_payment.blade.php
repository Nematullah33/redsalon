
@extends('layout.erp.home')
@section('title', 'Payments')
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
                    <a href="{{route('payments.create')}}">
                        <h5><i class="fa fa-plus btn btn-primary">  Add Payment </i></h5>
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
                                 @if(Session::has('delete_product'))
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        {{Session::get('delete_product')}}
                                        
                                    </div>
                                @endif
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class='table-info'>
									<th>#</th>
									<th>Supplier Name</th>
									<th>Amount</th>
									
									<th>Payment Date</th>
									<th>Payment Type</th>
									<th>Payment Note</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach($payments as $payment)
                                <tr>
                                    
                                    <td>{{$i++}}</td>
									<td>{{$payment->supplier->name}}</td>
									<td>{{$payment->amount}}</td>
									
									<td>{{date("d-M-Y", strtotime($payment->payment_date))}}</td>
									<td>{{$payment->payment_type}}</td>
                                    <td>{{$payment->payment_note}}</td>

                                    <td>
                                        <div style="display:flex">
                                            <a href="{{route('payments.edit',$payment->id)}}" style="padding:2px; border:1px solid hsl(177, 82%, 74%);"><i class="fa fa-pencil-square-o btn btn-success" style="padding: 10px; "></i></a>
                                            <a href="javascript:" id="{{ $payment->id }}" class="deletePayments" style="padding:2px; border:1px solid hsl(177, 67%, 65%);"><i class="fa fa-trash btn btn-danger" style="padding: 10px;"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $payments->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).on('click', '.deletePayments', function(e){
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
                    url: "{{ url('payment/delete') }}",
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

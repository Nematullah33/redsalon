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
                            <a href="{{url('stocks')}}">
                                <h5><i class="ti-angle-left btn btn-primary"> Back</i></h5>
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr class='table-info'>
                                            
                                            <th>Transaction Date</th>
                                            <th>Product Name</th>
                                            <th>Transaction</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $total=0; @endphp

                                          @foreach($products as $product)
                                        <tr>
                                            <td>{{date('d-M-y', strtotime($product->created_at))}}</td>
                                            <td>{{$product->product->name}}</td>
                                            <td>{{$product->transaction->name}}</td>
                                            <td>{{$product->qty}}</td>
                                            @php $total+=$product->qty @endphp
                                        </tr>
                                        @endforeach
                                        <tr class="bg-info">
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">Available Quantity</td>
                                            <td>{{$total}}</td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).on('click', '.deleteCustomer', function(e){
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
                    url: "{{ url('customer/delete') }}",
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
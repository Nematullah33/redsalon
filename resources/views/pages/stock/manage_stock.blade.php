@extends('layout.erp.home')
@section('title', 'Stocks')
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
                            <a href="{{route('stocks.index')}}">
                                <h5><i class="fa fa-plus btn btn-primary">  Stocks List</i></h5>
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
                        <div class="col-md-7"></div>
                        <div class="col-md-4">
                            <form action="">
                                <div class="input-group mb-3">
                                    <input type="search" name="search" value="{{$search}}" class="form-control" placeholder="Search by name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                                  </div>
                            </form>
                        </div>
                        <div class="col-md-1">
                            <div style="float: right; padding:5px;">
                                <form action="{{ route('stocklist.pdf') }}" method="post">
                                    @csrf
                                    <input type="submit" class="" value="Print">
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                @if(Session::has('delete_category'))
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        {{Session::get('delete_category')}}
                                        
                                    </div>
                                @endif
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Available Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody  class="">
                                

                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->stocks()->sum('qty')}}</td>
                                    <td>
                                        <div style="display:flex">
                                            <a href="{{route('stocks.show',$product->id)}}" style="padding:2px; border:1px solid hsl(177, 88%, 74%);"><i class="fa fa-eye btn btn-info" style="padding: 10px; "></i></a> 
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{$products->links()}}
                        @endif
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).on('click', '.deleteCategory', function(e){
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
                    url: "{{ url('category/delete') }}",
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
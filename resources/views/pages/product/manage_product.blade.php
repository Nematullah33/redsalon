@extends('layout.erp.home')
@section('title', 'Products')
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
                    <h5>Manage Products  /</h5>
                    <a href="{{url('products/create')}}">Create Product</a>

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
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <form action="">
                                <div class="input-group mb-3">
                                    <input type="search" name="search" value="{{$search}}" class="form-control" placeholder="Search by name" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                                  </div>
                            </form>
                        </div>
                        
                    </div>
                    
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                @if(Session::has('delete_product'))
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        {{Session::get('delete_product')}}
                                        
                                    </div>
                                @endif
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody  class="">
                                
                                @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                    <td>
                                        @if (!empty($product->photo))
                                        <img src="{{asset('img/product')}}/{{$product->photo}}" width='60' height="50%" alt="{{$product->photo}}">
                                        
                                        @else
                                        <img src="{{asset('img')}}/no_image.png" width='60' height="50%">
                                        @endif
                                       
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->price}}</td>
                                    
                                    <td>@if ($product->status == 1)
                                        <span onclick='update_status(" . {{$product->id}}. ",0)' id='span_" . {{$product->id}} . "'  class='label label-success' style='cursor:pointer'>Active </span>
                                    @else 
                                        <span onclick='update_status(" . {{$product->id}} . ",1)' id='span_" . {{$product->id}} . "'  class='label label-danger' style='cursor:pointer'> Inactive </span>
                                    @endif
                                    </td>
                                    <td>
                                        <div style="display:flex">
                                            <a href="{{route('products.edit',$product->id)}}" style="padding:2px; border:1px solid hsl(177, 82%, 74%);"><i class="fa fa-pencil-square-o btn btn-success" style="padding: 10px; "></i></a>
                                            <a href="javascript:" id="{{ $product->id }}" class="deleteProduct" style="padding:2px; border:1px solid hsl(177, 67%, 65%);"><i class="fa fa-trash btn btn-danger" style="padding: 10px;"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        @if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            {{ $products->links() }}
                        @endif
                        
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).on('click', '.deleteProduct', function(e){
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
                    url: "{{ url('product/delete') }}",
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
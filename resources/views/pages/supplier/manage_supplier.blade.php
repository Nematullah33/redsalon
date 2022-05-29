@extends('layout.erp.home')
@section('title', 'Suppliers')
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
    <h2 id="successMessage" style="display: none">Success</h2>
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="card">
                <div class="card-header">
                           
                            <h5>Manage Supplier  /</h5>
                            <a href="{{route('suppliers.create')}}">Create Supplier</a>
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
                                    <input type="search" name="search" value="{{$search}}" class="form-control" placeholder="Search by name, phone, email" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                                  </div>
                            </form>
                        </div>
                        
                    </div>
                    
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                @if(Session::has('delete_customer'))
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        {{Session::get('delete_customer')}}
                                        
                                    </div>
                                @endif
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Address</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody  class="">
                                <tr>
                                @foreach($suppliers as $sup)
                                    <td>{{$sup->id}}</td>
                                    <td>
                                        @if (!empty($sup->photo))
                                        <img src="{{asset('img/supplier')}}/{{$sup->photo}}" width='60' height="50%" alt="{{$sup->photo}}">
                                        
                                        @else
                                        <img src="{{asset('img')}}/no_image.png" width='60' height="50%">
                                        @endif
                                       
                                    </td>
                                    <td>{{$sup->name}}</td>
                                    <td>{{$sup->mobile}}</td>
                                    <td>{{$sup->email}}</td>
                                    <td>{{$sup->address}}</td>
                                    <td>{{$sup->company}}</td>


                                    <td>

                                        <div style="display:flex">
                                            <a href="{{ route('suppliers.show',$sup->id) }}" style="padding:2px; border:1px solid hsl(177, 88%, 74%);"><i class="fa fa-eye btn btn-info" style="padding: 10px; "></i></a>
                                            <a href="{{route('suppliers.edit',$sup)}}" style="padding:2px; border:1px solid hsl(177, 82%, 74%);"><i class="fa fa-pencil-square-o btn btn-success" style="padding: 10px; "></i></a>
                                            <a href="javascript:" id="{{ $sup->id }}" class="deleteSupplier" style="padding:2px; border:1px solid hsl(177, 67%, 65%);"><i class="fa fa-trash btn btn-danger" style="padding: 10px;"></i></a>
     
                                        </div>
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

<script>
    $(document).on('click', '.deleteSupplier', function(e){
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
                    url: "{{ url('supplier/delete') }}",
                    data: {id:id},
                    success: function(res){
                        if(res.success === true){
                            // location.reload();
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
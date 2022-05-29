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
                            <h5><a href="{{route('customers.index')}}">Manage Customers  / </a></h5>
                            <a href="#">Today Bithdays</a>
                            
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
                                    <th>Birth Day</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Membership ID</th>
                                    <th>Designation</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody  class="">
                                <tr> @php $sn=0; @endphp 
                                @foreach($customers as $cus)
                                
                                  <td>{{$sn++}}</td>
                                    <td>
                                        @if (!empty($cus->photo))
                                        <img src="{{asset('img/customer')}}/{{$cus->photo}}" width='60' height="50%" alt="{{$cus->photo}}">
                                        
                                        @else
                                        <img src="{{asset('img')}}/no_image.png" width='60' height="50%">
                                        @endif
                                       
                                    </td>
                                    <td>{{$cus->name}}</td>
                                    <td style="background-color: rgb(247 202 228)">{{date('d-M',strtotime($cus->dob))}}</td>
                                    <td>{{$cus->mobile}}</td>
                                    <td>{{$cus->email}}</td>
                                    <td>{{$cus->membership_id}}</td>
                                    <td>{{$cus->designation->name ?? ""}}</td>
                                    <td>{{$cus->address}}</td>


                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                        {{ $customers->links() }}
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
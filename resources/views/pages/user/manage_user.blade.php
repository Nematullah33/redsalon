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
                    <h5>User List  /</h5>
                    <a href="{{route('users.create')}}">
                        <b>Create User</b> 
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
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach( $users as $user)
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>

                                        <div style="display:flex">
                                            
                                            <a href="{{route('users.edit',$user->id)}}" style="padding:2px; border:1px solid hsl(177, 82%, 74%);"><i class="fa fa-pencil-square-o btn btn-success" style="padding: 10px; "></i></a>
                                            <a href="javascript:" id="{{ $user->id }}" class="deleteUser" style="padding:2px; border:1px solid hsl(177, 67%, 65%);"><i class="fa fa-trash btn btn-danger" style="padding: 10px;"></i></a>
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
        $(document).on('click', '.deleteUser', function(e){
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
                    url: "{{ url('user/delete') }}",
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
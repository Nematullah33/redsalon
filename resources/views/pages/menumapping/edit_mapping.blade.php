<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
    @section('title','Menu')
    @section('content')
    <style>
        .table td, .table th {
        padding: 0.25rem 0.75rem;
        }
    </style>
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
    
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        {{-- <div class="col-sm-2"></div> --}}
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5><a href="{{url('Roles')}}">Manage Roles</a></h5>
    
                                </div>
                                <div class="card-block">
                                    <div class="alert alert-success d-flex align-items-center" style="display: none !important;" id="alertMessage" role="alert"></div>
                                    
                                    <form action="javascript:void(0)" >
                                        @csrf
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Role Name</label>
                                            <div class="col-md-4">
                                                <select id="cmbRole" name="cmbRole" class="form-control"
                                                    style='width:100%'>
                                                    <option style="padding:0px;">Select</option>
                                                    @foreach ($roles as $role)
                                                    @if($menus[0]->role_id==$role->id)
                                                    <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                                    @endif
                                                     {{-- <option value="{{$role->id}}" @if($menus[0]->role_id==$role->id) selected @endif>{{$role->name}}</option> --}}
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Description</label>
                                            <div class="col-sm-4">
                                                <textarea name='description' id='description' class='form-control'></textarea>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <tr class="table-info">
                                                        <th>Menu ID</th>
                                                        <th>Select All</th>
                                                        <th>Menu Name</th>
                                                    </tr>
                                                    <tr>
                                                        <td>#</td>
                                                        <td><input type="checkbox" id='checkAll'>  Select all</td>
                                                        <td></td>
                                                    </tr>
                                                    
                                                    @foreach($allmenus as $allmenu)
                                                     
                                                    
                                                    <tr style="padding: 5px;">
                                                        
                                                        <td>{{$allmenu->id}}</td>
                                                        
                                                        <td></td>
                                                        <td style="font-size: 15px; padding-left:10px;">
                                                            <input class="check_id" name="menu_id" type="checkbox" value="{{$allmenu->id.':'.$allmenu->name}}" @foreach($menus as $menu) @if($menu->menu_id == $allmenu->id) checked @endif @endforeach>  {{$allmenu->name}}
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2 offset-4">
                                                <input type="submit" name='btnCreate' id="btnCreate" class="form-control"
                                                   style="background-color: #E9118F; color:#fff; cursor: pointer;" value='Update'>
                                            </div>
                                        </div>
    
                                    </form>
                                </div>
                            </div>
                            <!-- Basic Form Inputs card end -->
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
    
            </div>
    
        </div>
    </div>
        <!-- Main-body end -->
        <div id="styleSelector">
        </div>
        <script>
            $(function(){
                $("#cmbRole").select2();
                
            
    
                $("#checkAll").click(function(){
                    if ($(this).is(':checked')) {
                        $('input[type=checkbox]').prop('checked',true);
                    } else {
                        $('input[type=checkbox]').prop('checked',false);
                    }       
                });
                $("#btnCreate").on("click",function(){
                    let token = $("input[name='_token']").val();
                    let method = $("input[name='_method']").val();
                    let role_id = $("#cmbRole").val();
                    let description = $("#description").val();
    
                    var menu_id = new Array();
                    $('.check_id:checked').each(function(i){
                        menu_id.push($(this).val());
                    
                    });
                    $.ajax({
                        url: "{{route('update.menumapping')}}",
                        type: 'POST',
                        data: {
                            _token:token,
                            _method:method,
                            "role_id": role_id,
                            "menu_id": menu_id,
                            "description": description,
    
                        },
                        success:function(res){
                            if(res.success == true) {
                                $("#alertMessage").show();
                                $("#alertMessage").html(res.message);
                                $('html, body').animate({ scrollTop: 0 }, 0);
                            }
                        }
                    });
                    
                });
                $("#cmbRole").on("change",function(){
                    let role_id = $(this).val();
                    $.ajax({
                        url: "{{url('get-menu')}}",
                        type: "get",
                        data: {
                            "id": role_id 
                        },
                        success: function(res) {
                            console.log(res);
                            
                        }
                    });
                });
                
            })
        </script>
        
    @endsection
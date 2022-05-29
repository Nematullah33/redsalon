<!-- <form action="{{url('user/save')}}" method="post"> -->
@extends('layout.erp.home')
@section('content')
<style>
    .table td{
        
        padding: 0.5rem 0.75rem;
        
    }
</style>
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">

            <!-- Page body start -->
            <div class="page-body">
                <div class="row">

                    <div class="col-sm-12">
                        <!-- Basic Form Inputs card start -->
                        <div class="card" style="margin-bottom: 5px;">
                            <div class="card-header">
                                <h5 style="padding:7px;" class="btn-info"> Create Bank</h5>

                            </div>
                            <div class="card-block" style="padding-bottom: 5px;">
                                @if(Session::has('save_bank'))
                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                    {{Session::get('save_bank')}}  
                                </div>
                                @endif
                                <div style="">
                                    <form action="{{route('bank.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
    
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Bank Name</label>
                                                <input type="hidden" name="id" id="id">
                                                <input type="text" name='txtBank' id='txtBank' class="form-control"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Brach Name</label>
                                                <input type="text" name='txtBrach' id='txtBrach' class="form-control"
                                                    >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Account Name</label>
                                                <input type="text" name='txtAcName' id='txtAcName' class="form-control"
                                                    >
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Bank Place</label>
                                                <select name="cmbLocation" id="cmbLocation" style="padding: 6px 10px;">
                                                    @foreach ($location as $loc)
                                                    <option value="{{$loc->id}}">{{$loc->name}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <label class="col-form-label">Account Type</label>
                                                <select name="cmbType" id="cmbType" style="padding: 6px 10px;">
                                                    @foreach ($type as $ty)
                                                    <option value="{{$ty->id}}">{{$ty->name}}</option>
                                                    @endforeach  
                                                </select>
                                            </div>
                                            
                                        </div>
    
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Mobile No</label>
                                                <input type="text" name='txtMbNo' id='txtMbNo' class="form-control"
                                                    >
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Account No</label>
                                                <input type="text" name='txtAcNo' id='txtAcNo' class="form-control"
                                                    >
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Segment Code</label>
                                                <input type="text" name='txtSegCode' id='txtAcNo' class="form-control"
                                                    >
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label" style="margin-top: 15px;"></label>
                                                <input type="submit" name='btnCreate' id='btnCreate'
                                                    class="form-control form-control-round btn-outline-info" value='Submit'>
                                            </div>
                                        </div>
    
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- Basic Form Inputs card end -->
                    </div>
                </div>
            </div>
            <!-- Page body end -->


            <!-- Main-body start -->

            <div class="card">
                <div class="card-block table-border-style">
                    <div class="table-responsive">
                        @if(Session::has('delete_bank'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                {{Session::get('delete_bank')}}  
                            </div>
                        @endif
                        <table class="table table-hover">
                            <thead>
                                <tr class='table-info'>
                                    <th>#</th>
                                    <th>Bank Name</th>
                                    <th>Place</th>
                                    <th>Brach</th>
                                    <th>A.Name</th>
                                    <th>A.No</th>
                                    <th>Mobile</th>
                                    <th>A.Type</th>
                                    <th>S.Code</th>
                                    
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    @foreach($bank as $bnk)
                                    <td>{{$bnk->id}}</td>
                                    <td>{{$bnk->name}}</td> 
                                    <td>{{$bnk->place}}</td>                             
                                    <td>{{$bnk->branch}}</td>
                                    <td>{{$bnk->account_name}}</td>
                                    <td>{{$bnk->account_no}}</td>
                                    <td>{{$bnk->mobile}}</td>
                                    <td>{{$bnk->type}}</td>
                                    <td>{{$bnk->segment_code}}</td>
                                    
                                    <td>

                                        <div style="display:flex">
                                            <button style='border:none;  padding:5px;'
                                                class="btn btn-default waves-effect" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="To Update User"><a
                                                    href="{{route('users.edit',$bnk->id)}}"><i class='fa fa-pencil'></i>
                                                    Edit<a></button>
                                            <button style='border:none;  padding:5px;'
                                                class="btn btn-default waves-effect" data-toggle="tooltip"
                                                data-placement="top" title="" data-original-title="View User Details">
                                                <a href="{{route('users.show',$bnk->id)}}"><i class='fa fa-eye'></i>
                                                    Details<a></button>
                                            <button style='border:none;'>
                                                <form action="{{route('bank.destroy',$bnk->id)}}" method="post">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main-body end -->
<div id="styleSelector">
</div>
<script>
    // $(function(){
    //     $("#btnCreate").on('click',function(e){
    //         e.preventDefault();
    //         $bank=$("txtBank").val();
    //         $branch=$("txtBranch").val();
    //         $address=$("txtAddress").val();
    //         $.ajax({
    //          url:"<?php echo url("update/bank")?>",
    //          type:'post',
    //          data:{"txtBank":$bank,"txtBranch":$branch,"txtAddress",$address},
    //          success:function(res){
    //            //console.log(res);
    //           let product=JSON.parse(res);
    //            console.log(product);
    //          }
    //        });
    //     });
    // });
</script>
@endsection
<!-- <form action="{{url('user/save')}}" method="post"> -->
    @extends('layout.erp.home')
    @section('title', 'Add Expense')
    @section('content')

<div class="addEmployeeModal modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="user_form">
                <div class="modal-header">
                    <h4 class="modal-title">Add Expense Category</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <input type="text" name='name' id='name' class="form-control">
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="1" name="type">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <button type="button" class="btn" style="background-color: #E9118F" id="btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div> 
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
    
                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5><a href="{{url('expenses')}}">Manage Expense</a></h5>
    
                                </div>
                                <div class="card-block">
                                            @if(Session::has('save_expense'))
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    {{Session::get('save_expense')}} 
                                                </div>
                                            @endif
                                    <form action="{{route('expenses.store')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row"> 
                                            <label class="col-sm-3 col-form-label">Category <span class="text-danger"> *</span></label>
                                            <div class="col-sm-8">
                                                <select id="cmbExpType" name="cmbExpType" class="form-control"
                                                        style='width:100%'>
                                                        <option style="padding:0px;">Select</option>
                                                        @foreach ($exptype as $exp)
                                                        <option value="{{$exp->id}}">{{$exp->name}}</option>
                                                        @endforeach
    
                                                </select>
                                                
                                            </div>
    
                                            <div class="col-sm-1">
                                                <a href=".addEmployeeModal" class="btn-sm btn-info fa fa-plus" title="Add Designation" style="line-height: 10px; padding:8px;" data-toggle="modal"></a>
                                            </div>
                                        </div>
                                        <div class="form-group row"> 
                                            <label class="col-sm-3 col-form-label">Expense For<span class="text-danger"> *</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name='txtName'
                                                    class="form-control " placeholder="expense for" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-3 col-form-label">Amount<span class="text-danger">  *</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name='txtAmount'
                                                    class="form-control " placeholder="0.00" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Expense Date</label>
                                            <div class="col-sm-9">
                                                <input type="text" id='expDate'name='expDate'
                                                    class="form-control" value="<?= date('d-m-Y')?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Reference</label>
                                            <div class="col-sm-9">
                                                <input type="text" name='reference'
                                                    class="form-control " placeholder="" >
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            
                                            <label class="col-sm-3 col-form-label">Note</label>
                                            <div class="col-sm-9">
                                                <textarea name='note' class='form-control'></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
    
                                            <div class="col-sm-12">
                                                <input type="submit" name='btnCreate'
                                                    class="btn btn-primary center" style='background-color:#E9118F' value='Submit'>
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
                $("#cmbExpType").select2();
                $("#expDate").datepicker({
                    dateFormat: 'dd-mm-yy'
                });

            $("#btnSubmit").on('click',function(){
                let name=$("#name").val(); 
                    $.ajax({
                        url:"{{route('add.exptype')}}",
                        type:'get',
                        data:{"name":name},
                        success:function(res){
                        //console.log(res);
                        location.reload();
                        }
                    });
                });
    
            });
        </script>
    @endsection
@extends('layout.erp.home')
@section('title', 'Edit Payment')
@section('content')
<div class="pcoded-inner-content">
	<div class="main-body">
        <div class="page-wrapper">

            <!-- Page body start -->
            <div class="page-body">
				<div class="row">

					<div class="col-md-8">
						<div  class="card">
							
							<div  class="card-header">
								<h5>Update Payments  /</h5> 
								<a href="{{url('/payments')}}">Manage Payments</a>
								
							</div>
							<div  class="card-body">
													
									@if(Session::has('success'))
										<div class="alert alert-success d-flex align-items-center" role="alert">
											{{Session::get('success')}}
											
										</div>
									@endif
								<form action="{{route('payments.update',$payment->id)}}" method="post" enctype="multipart/form-data">
									@csrf
									@method('PUT')
										<div class="form-group row">
											<div class="col-md-6 mb-1">
												<label class="col-form-label">Supplier Select</label>
												<select id="cmbSupplier" name="cmbSupplier" class="form-control"
														style='width:100%'>
														<option style="padding:0px;">Select</option>
														@foreach ($suppliers as $supplier)
														@if ($payment->supplier_id==$supplier->id)
														<option value="{{$supplier->id}}" selected>{{$supplier->name}}</option>
														@else
														<option value="{{$supplier->id}}">{{$supplier->name}}</option>
														@endif
														
														@endforeach

												</select>
											</div>
											
											<div class="col-md-6 mb-1 mt-2">
												<label for="">Payment Type</label><br>
												<select class="form-control" id='paymentType' name='paymentType' style='width:100%'>
													<option value="Cash">Cash</option>
													<option value="Cheque">Cheque</option>
													<option value="Bkash">Bkash</option>
												</select>
											</div>
											<div class="col-md-6">
												<label for="">Amount</label><br>
												<input type="number" style="padding: 0.2rem 0.75rem; border-radius:4px;" class="form-control" value="{{$payment->amount}}" id='paymentAmount' name='paymentAmount'>
											</div>
											<div class="col-md-6">
												<label for="">Payment Date</label><br>
												<input type="text" style="padding: 0.2rem 0.75rem; border-radius:4px;" class="form-control" id='paymentDate' name='paymentDate' value='{{date("d-m-Y", strtotime($payment->payment_date))}}'>
											</div>
											
											<div class="col-md-6">
												<label for="">Remarks</label><br>
												<textarea name="txtNote" style="border-radius:4px;" id="txtNote" class="form-control">{{$payment->payment_note}}</textarea>
											</div>
											
										</div>
										<div class="">
											<button style="margin-top:10px; border-radius:4px; padding:0px 19px; font-size:16px;font-weight:bold;"
											class="btn waves-effect waves-light btn-info btn-lg btn-outline-info"
											id="btnProcessOrder"><i class="icofont icofont-check-circled"></i> Update Payment </button>
										</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card">
							<div class="card-header">
								<h5>Due Amounts</h5> 
							</div>
							<div class="card-body">
								<table class="table-bordered payments">
									

								</table>
							</div>
							<div class="card-header"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function(){
	
    $("#cmbSupplier").select2();
    $("#paymentType").select2();

	$("#paymentDate").datepicker({
        dateFormat: 'dd-mm-yy'
    });
	$("#cmbCustomer").select2();
	$("#cmbSupplier").on("change",function(){
		let id=$(this).val();
		$.ajax({
                url:"{{route('get.payment')}}",
                type:'get',
                data:{"id":id},
                success:function(res){
					console.log(res);

						$(".payments").html("<h4 style='background-color:#E9118F; color:#fff; padding:5px;'>Due Amount : ৳ "+res+"</h4>")
					}
					
				
                
        });
	});
});
</script>
@endsection

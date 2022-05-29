@extends('layout.erp.home')
@section('title', 'Add Payment')
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
								<h5>Make Payments  /</h5> 
								<a href="{{url('/payments')}}">Manage Payments</a>
								
							</div>
							<div  class="card-body">
													
									@if(Session::has('success'))
										<div class="alert alert-success d-flex align-items-center" role="alert">
											{{Session::get('success')}}
											
										</div>
									
									@endif
								<form action="javascript:void(0)" method="post" enctype="multipart/form-data">
									@csrf
										<div class="form-group row">
											<div class="col-md-6 mb-1">
												<label class="col-form-label">Supplier Select</label>
												<select id="cmbSupplier" name="cmbSupplier" class="form-control"
														style='width:100%'>
														<option style="padding:0px;">Select</option>
														@foreach ($suppliers as $supplier)
														<option value="{{$supplier->id}}">{{$supplier->name}}</option>
														@endforeach

												</select>
											</div>
											
											<div class="col-md-6 mb-1 mt-2">
												<label for="">Payment Type</label><br>
												<select class="form-control" id='paymentType' name='paymentType' style='width:100%'>
													<option value="Cash">Cash</option>
													<option value="Cheque">Card</option>
													<option value="Bkash">Bkash</option>
												</select>
											</div>
											<div class="col-md-6">
												<label for="">Amount</label><br>
												<input type="number" style="padding: 0.2rem 0.75rem; border-radius:4px;" class="form-control" id='paymentAmount' name='paymentAmount'>
											</div>
											<div class="col-md-6">
												<label for="">Payment Date</label><br>
												<input type="text" style="padding: 0.2rem 0.75rem; border-radius:4px;" class="form-control" id='paymentDate' name='paymentDate' value='<?= date('d-m-Y')?>'>
											</div>
											
											<div class="col-md-6">
												<label for="">Remarks</label><br>
												<textarea name="txtNote" style="border-radius:4px;" id="txtNote" class="form-control"></textarea>
											</div>
											
										</div>
										<div class="">
											<button style="margin-top:10px; border-radius:4px; padding:0px 19px; font-size:16px;font-weight:bold;"
											class="btn waves-effect waves-light btn-info btn-lg btn-outline-info"
											id="btnProcessOrder"><i class="icofont icofont-check-circled"></i> Save </button>
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
	$("#btnProcessOrder").on('click',function(e){
		e.preventDefault();
		
        Swal.fire({
            title: 'Confirm?',
            
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save!'
            }).then((result) => {
            if (result.isConfirmed) {
				let token = $("input[name='_token']").val();
				let method = $("input[name='_method']").val();
				let cmb_supplier=$("#cmbSupplier").val();
				let payment_type=$("#paymentType").val();
				let payment_amount=$("#paymentAmount").val();
				let payment_date=$("#paymentDate").val();
				let note=$("#txtNote").val();
                $.ajax({
					url: "{{route('payments.store')}}",
							type: 'POST',
							data: {
								_token:token,
								_method:method,
								"cmbSupplier": cmb_supplier,
								"paymentType": payment_type,
								"paymentAmount": payment_amount,
								"paymentDate": payment_date,
								"txtNote": note,
							
							},
							success: function(res) {
								console.log(res);
								console.log('okkj');
								console.log(res.view);
								var win = window.open("","_top");
								win.document.write(res.view);
								self.focus();
								win.print();
								win.close();
								clearCart();
								//location.reload();

							}
				});
				
            }
        })
		

	});
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

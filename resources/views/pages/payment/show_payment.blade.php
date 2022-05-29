@extends('layout.erp.home')
@section('page')

<a class='btn btn-success' href="{{route('payments.index')}}">Manage</a>
<table class='table'>
	<tr><th>Id</th><td>{{$payment->id}}</td></tr>
	<tr><th>Customer Id</th><td>{{$payment->customer_id}}</td></tr>
	<tr><th>Amount</th><td>{{$payment->amount}}</td></tr>
	<tr><th>Bank Id</th><td>{{$payment->bank_id}}</td></tr>
	<tr><th>Payment Date</th><td>{{$payment->payment_date}}</td></tr>
	<tr><th>Payment Note</th><td>{{$payment->payment_note}}</td></tr>
	<tr><th>Created At</th><td>{{$payment->created_at}}</td></tr>
	<tr><th>Updated At</th><td>{{$payment->updated_at}}</td></tr>

</table>

@endsection

@extends('layout.erp.home')
@section('content')
<div style="width:250px; padding:20px; height:300px; background-color:blue; color:#fff; margin: 0px auto; border:2px solid #f7b407;">
    <table style="">
        <tr>
            <th></th>
            <td></td>
            <td><img src="{{asset('img/product')}}/{{$product[0]->photo}}" class='img-thumbnail' width='100' alt=""></td>
        </tr>
        <tr>
            <th style="text-align:right">ID </th>
            <td>:</td>
            <td>{{$product[0]->id}}</td>
        </tr>

        <tr>
            <th style="text-align:right">Name </th>
            <td>:</td>
            <td>{{$product[0]->name}}</td>
        </tr>
        <tr>
            <th style="text-align:right">Price </th>
            <td>:</td>
            <td>{{$product[0]->price}}</td>
        </tr>
    </table>
</div>
@endsection
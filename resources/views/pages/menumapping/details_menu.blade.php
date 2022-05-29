@extends('layout.erp.home')
@section('content')
<div style="width:250px; padding:20px; height:300px; background-color:blue; color:#fff; margin: 0px auto; border:2px solid #f7b407;">
    <table style="">
        <tr>
            <th></th>
            <td></td>
            <td><img src="{{asset('img')}}/{{$user[0]->photo}}" class='img-thumbnail' width='100' alt=""></td>
        </tr>
        <tr>
            <th style="text-align:right">ID </th>
            <td>:</td>
            <td>{{$user[0]->id}}</td>
        </tr>

        <tr>
            <th style="text-align:right">Name </th>
            <td>:</td>
            <td>{{$user[0]->username}}</td>
        </tr>
        <tr>
            <th style="text-align:right">Email </th>
            <td>:</td>
            <td>{{$user[0]->email}}</td>
        </tr>
        <tr>
            <th style="text-align:right">Role </th>
            <td>:</td>
            <td>{{$user[0]->role}}</td>
        </tr>
    </table>
</div>
@endsection
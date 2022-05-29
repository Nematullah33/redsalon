
    <style>
        .table-responsive {
            display: inline-block;
            width: 100%;
            overflow-x: auto;
        }
        table {
            border-collapse: collapse;
        }
        table tr td{
            border:1px solid #ccc; 
            padding: 5px;
        }
        table tr th{
            border:1px solid #ccc; 
            padding: 5px;
        }
        .table-border td{
            border: none !important;
            /* border-bottom: 1px solid #ccc !important; */
        }
        
    </style>

            
                
                    <div style="text-align: center;">
                        <img src="{{asset('img/setting/'.$site->photo)}}" style="width:50px;">
                        <p>Company Name: {{$site->name}} <br>
                        Mobile: {{$site->mobile}} <br>
                        Email: {{$site->email}} <br>
                        Address: {{$site->address}}</p>
                    </div>
                    <div>
                        <p style="line-height: 25px;">Booking ID: {{$bookings->id}}<br>
                        Date : {{$bookings->booking_date}}<br>
                        Customer Name : {{$bookings->customer->name}}<br>
                        Mobile : {{$bookings->customer->mobile}}<br>
                        Membership ID: {{$bookings->customer->membership_id}}<br>
                        Address : {{$bookings->customer->address}}
                        </p>
                    </div>
                    
                 
                
                <div style="padding-top:20px;">
                    <table class="table" style="width: 100%; float: right;">
                            
                        <tr style="background-color: rgb(217, 230, 241);">
                            
                            <th>#</th>
                            <th>Booking Service items</th>
                            <th>Price</th>
                        </tr>
                            @php
                            $sn=1;
                            $total=0;
                            @endphp
                            
                              @foreach($bookings->bookingdetail as $item)  
                                <tr>

                                     <td>{{$sn++}}</td>
                                    <td>{{$item->service->name}}</td>
                                    <td>{{$item->service->price}}</td>

                                </tr>
                                @php($total+=$item->service->price)  
                            @endforeach
                           <div style="margin-top:10px;">
                                <tr class="table-border">
                                    <td colspan="2" style="text-align: right;">Total :</td>
                                    <td>{{$total}}</td>
                                </tr>
                                
                                <tr class="table-border">
                                    <td colspan="2" style="text-align: right;">Advance :</td>
                                    <td>{{$bookings->advance ?? 0}}</td>
                                </tr>
                                <tr class="table-border">
                                    <td colspan="2" style="text-align: right;">Due Amount :</td>
                                    <td>{{$total-$bookings->advance}}</td>
                                </tr>
                           </div> 
                            
                    </table>
                </div>
                <div style="float: right; margin-top:100px; margin-right:40px;">
                    <h5 style=" border-top:1px dotted #000; font-weight:bold; text-align:center;">Signature</h5>
                </div>
                        
                    
                        

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Service Sale Pdf</title>
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
    </style>
</head>
<body>
                    <div style="text-align: center;">
                        <img src="{{public_path('img/setting/'.$site->photo)}}" style="width:50px;">
                        <p>Company Name: {{$site->name}} <br>
                        Mobile: {{$site->mobile}} <br>
                        Email: {{$site->email}} <br>
                        Address: {{$site->address}}</p>
                    </div>
                    
                    <div>Product Sale Report</div>
                    <div>{{$from}} <?php if($from!=''){ echo "To ";}?> {{$to}}</div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr style="background-color: #ccc;">
                            <th>#</th>
                            <th>Date</th>
                            <th>Number Of Transaction</th>
                            <th>Total Sale</th>
            
                        </tr>
                    @php
                        $sn=1;
                        $sale_total=0;
                    @endphp
                    @foreach($dailyexpenses as $dailyexp)
                    <tr>
                        <td>{{$sn++}}</td>
                        <td>{{$dailyexp->Date}}</td>
                        <td>{{$dailyexp->no_of_transactions}}</td>
                        <td>{{$dailyexp->total_expense}}</td>

                    </tr>
                    
                    @php
                        $sale_total+=$dailyexp->total_expense;
                    @endphp
                    @endforeach
                    <tr>
                        
                        <td></td>
                        <td></td>
                        <td class="text-right text-info"><b>Total </b></td>
                        <td class="text-info"><b>{{$sale_total}}</b></td>
                    </tr>
                    </table>
                </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
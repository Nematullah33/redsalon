@extends('layout.erp.home')
@section('title', 'Add Purchase')
@section('content')
<style>
.invoice-header {
    height: 30px;
    background-color: #E9118F;
    border-bottom: 2px solid #000;
}

.invoice-top {
    margin-top: 50px;
}

.invoice-mid {
    min-height: 100px;
    margin-top: 20px;
}

.invoice-footer {
    height: 10px;
    width: 100%;
    box-sizing: border-box;
    border-top: 5px solid #000;
    border-radius: 70% 70% 0px 0px;
    background-color: #E9118F;
}

.invoice-footer1 {
    border-top: 2px solid #a5a49e;
    border-radius: 70% 70% 0px 0px;
}


.invoice-item tr td {
    color: #fff;
    font-weight: bold;
    border-radius: 20%;
    border-right: 3px solid #f52ea2;
    padding: 0px 20px 0px 5px;

}

.invoice-item {
    width: 100%;
}

.invoice-item1 {
    width: 100%;
    margin-top: 10px;
}

.invoice-item1 tr td {

    color: #000;
    font-weight: bold;
    padding: 0px 30px 0px 5px;


}

.invoice-price tr td {
    color: #000;
    border-bottom: 1px solid #000;
    font-weight: bold;
    padding: 10px 23px 0px 10px;
    border-radius: 10px;
}

.invoice-area {
    margin-top: 30px;
    background-color: #E9118F;
    padding: 5px;
}
</style>

<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <div class="row" style="box-shadow: rgba(0, 0, 0, 0.45) 0px 25px 20px -20px;">
                <div class="col-md-12">
                    <div class="invoice-header"></div>
                    <div class="container" style="background-color:#fff;">
                        <div class="row">
                            <div class="col-md-4">
                                <h2 style='color:#f52ea2;font-weight:bold;margin-top:30px;'>Purchase</h2>
                                <form action="" method='post'>
                                    @csrf
                                    <table>
                                        <tr>
                                            <td>Purchase ID</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" style="border-radius:40px;width:70px;"
                                                    class="form-control form-control-round"
                                                    value="{{$purchase_id[0]->id+1}}" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Purchase Date</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" id='txtpurchaseDate' style='border-radius:40px;'
                                                    size='15' class="form-control form-control-round"
                                                    value="<?php echo date("d-m-Y");?>" autocomplete="off">

                                            </td>

                                        </tr>
                                    </table>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-5" style="float:right;">
                                <h3 style='font-weight:bold;margin-top:30px;'>PURCHASE FROM</h3>
                                <table>
                                    <tr>
                                        <td>Supplier</td>
                                        <td>:</td>
                                        <td>
                                            
                                                <select id="cmbSupplier" class="form-control"
                                                    style=''>
                                                    <option value="0">Select</option>
                                                    @foreach ($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->name}} ({{$supplier->mobile}}) </option>
                                                    @endforeach

                                                </select>
                                           
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td>Name</td>
                                        <td>:</td>
                                        <td id='txtName'></td>   
                                    </tr> -->
                                    
                                    <tr>
                                        <td>Mobile</td>
                                        <td>:</td>
                                        <td id='txtMobile'></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td id='txtEmail'></td>
                                    </tr>
                                    <tr>
                                        <td>Company</td>
                                        <td>:</td>
                                        <td id='txtCompany'></td>   
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="container" style="background-color:#fff;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="invoice-area">
                                    <table class="invoice-item">
                                        <tr>
                                            <td>SN</td>
                                            <td style="text-align:left;">Product Item</td>
                                            <td>Unit Price</td>
                                            <td>Quantity</td>
                                            <td>Discount</td>

                                            <td style='border-right:none;'><button
                                                    style="float:right; border: 3px solid red; border-radius:40px;"
                                                    type="button" id="clearAll"> Clear</button></td>
                                        </tr>
                                    </table>

                                </div>
                                <table class="invoice-item1">
                                    </thead>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="form-group row">
                                                <select id="cmbProduct" class="form-control form-control-round"
                                                    style='border-radius:40px;'>
                                                    <option>Select Product</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <input type="text" id='txtPrice' class="form-control form-control-round"
                                                    placeholder="Price" autocomplete="off">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <input type="text" id='txtQty' class="form-control form-control-round"
                                                    value="1" autocomplete="off">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <input type="text" id="txtDiscount"
                                                    class="form-control form-control-round" value="0" autocomplete="off">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <input type="button" class="form-control form-control-round"
                                                    id="btnAddToCart" value=" + " autocomplete="off">
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    </thead>
                                    <hr>
                                    <tbody id="items">

                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <div class="row invoice-top">
                            
                            <div class="col-md-8">
                                
                            </div>
                            <div class="col-md-4">
                                <table class="invoice-price">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>:</td>
                                        <td id="subtotal">0</td>
                                    </tr>
                                    <tr>
                                        <td>Vat</td>
                                        <td>:</td>
                                        <td id="tax">0</td>
                                    </tr>
                                    <tr>
                                        <td style="color:red;">Grand Total</td>
                                        <td style="color:red;">:</td>
                                        <td id="net-total">0</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row invoice-mid">
                            
                            <div class="col-md-8">
                            
                            </div>
                            <div class="col-md-3">
                                <p id="select-alert" class="text-danger p-2"></p>
                                <button style="margin-top:20px; margin-bottom:20px; font-size:20px; border-radius:40px; font-weight:bold;"
                                class="btn waves-effect waves-light btn-info btn-outline-info"
                                id="btnProcesspurchase"><i class="icofont icofont-check-circled"></i> Purchase Save
                                </button>
                            </div>
                            
                        </div>
                        </form>
                    </div>
                    <div style="background-color:#fff;">
                        <div class="invoice-footer">
                            <div class="invoice-footer1"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<script>


    $(function() {  
        $("#cmbSupplier").select2();
        $("#cmbProduct").select2();
        //Show calander in textbox
        $("#txtOrderDate").datepicker({dateFormat: 'dd-mm-yy'});
        $("#txtDueDate").datepicker({dateFormat: 'dd-mm-yy'});

        printCart();

        //Save into database table
        $("#btnProcesspurchase").on("click",function(e){
           
            e.preventDefault();            
              let supplier_id=$("#cmbSupplier").val();
              
              if(supplier_id==0){
                $('#select-alert').html('Not saved! Please select supplier first!!');
              }
              var token = $("input[name='_token']").val();
              var method = $("input[name='_method']").val();
              let note=$("#txtNote").val();         
              let order_date=$("#txtpurchaseDate").val();
              let subtotal = $("#net-total").html();
              let discount=0;
              let vat=0;
              let shipping_address="na";

              
              let products=JSON.parse(localStorage.getItem("cart"));

              //console.log(order_date);
              
              $.ajax({
                url:"{{route('purchase.store')}}",
                type:'POST',               
                data:{
                  _token:token,
                  _method:method,
                  "cmbSupplier":supplier_id,
                  "txtpurchaseDate":order_date,
                  "txtDiscount":discount,
                  "txtVat":vat,
                  "txtNote":note,
                  "subtotal":subtotal,
                  "txtProducts":products
                },
                success:function(res){
                  console.log(res);
                  clearCart();
                  location.reload();
                  $("#items").html("");
                }
              });
              
             
        });       



        //Show customer other information
        $("#cmbProduct").on("change",function(){        
           $.ajax({
             url:"<?php echo url("getproduct")?>",
             type:'GET',
             data:{"id":$(this).val()},
             success:function(res){
               //console.log(res);
              let product=JSON.parse(res);
              $("#txtQty").val(1);
              $("#txtPrice").focus();
             }
           });
        });   
        
        $("#txtQty").on("keyup",function(e){           
          if(e.which==13){
            $("#txtDiscount").focus();
          }
        });


        //Show customer other information
        $("#cmbSupplier").on("change", function() {

            let customer_id = $(this).val();
            $.ajax({
                url: "{{url('get-supplier')}}",
                type: "get",
                data: {
                    "id": customer_id 
                },
                success: function(res) {
                    console.log(res);
                    let customer=JSON.parse(res);
                    $("#txtName").html(customer.name);
                    $("#txtEmail").html(customer.email);
                    $("#txtMobile").html(customer.mobile);
                    $("#txtCompany").html(customer.company);
                }
            });
            });
       
    
      
      //Add item to bill temporarily
        $("#btnAddToCart").on("click",function(){
          
          addToCart();
          
        });

        
        // $("#txtDiscount").on("keyup",function(e){           
        //   if(e.which==13){
        //     addToCart();
        //   }
        // });


        $("body").on("click",".delete",function(){
           let id=$(this).data("id");        
           delItem(id)
           printCart();
        });
     
        $("#clearAll").on("click",function(){
          clearCart();
          printCart();
        });


    //------------------Cart Functions----------//      

      function addToCart(){
            let item_id=$("#cmbProduct").val(); 
            let name=  $("#cmbProduct option:selected").text();          
            let price=$("#txtPrice").val();
            let qty=$("#txtQty").val();
            let discount=$("#txtDiscount").val();
            let total_discount=discount*qty;
            let subtotal=price*qty-total_discount;
           
            let item={
              "name":name,
              "item_id":item_id,
              "price":price,
              "qty":parseFloat(qty),
              "discount":discount,
              'total_discount':total_discount,
              "subtotal":subtotal
            }; 
            
            console.log(item);
            
             save(item);
             printCart();      
      }

       function printCart(){
          let cart= getCart();            
           let sn=1;          
           let $bill="";  
           let subtotal=0;
           $.each(cart,function(i,item){
                //console.log(item.name);
             subtotal+=item.price*item.qty-item.discount;
             let $html="<tr>";            
             $html+="<td>";
             $html+=sn;
             $html+="</td>";
             $html+="<td>";
             $html+=item.name;
             $html+="</td>";
             $html+="<td data-field='price'>";
             $html+=item.price;
             $html+="</td>";
             $html+="<td data-field='qty'>";
             $html+=item.qty;
             $html+="</td>";
             $html+="<td data-field='discount'>";
             $html+=item.total_discount;
             $html+="</td>";
             $html+="<td data-field='subtotal'>";
             $html+=item.subtotal;
             $html+="</td>";
             $html+="<td>";
             $html+="<input type='button' class='delete' data-id='"+item.item_id+"' value='-'/>";
             $html+="</td>";
             $html+="</tr>";
             $bill+=$html;
             sn++;
           });      
                      
           $("#items").html($bill); 

           //Order Summary
           $("#subtotal").html(subtotal);
            let tax=0;
        //    let tax=(subtotal*0.05).toFixed(2);
        //    $("#tax").html(tax);
           $("#net-total").html(parseFloat(subtotal)+parseFloat(tax));
        }

});
</script>
@endsection
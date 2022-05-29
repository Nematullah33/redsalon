@extends('layout.erp.home')
@section('title', 'Product Sales')
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
    height: 200px;
    margin-top: 50px;
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
    border-top: 2px solid #ecf2f3;
    border-radius: 70% 70% 0px 0px;
}


.invoice-item tr td {
    color: #fff;
    font-weight: bold;
    border-radius: 20%;
    border-right: 3px solid #fa3eac;
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
                                <h2 style='color:#c20774;font-weight:bold;margin-top:30px;'>Product Sales</h2>
                                <form action="" method='post'>
                                    @csrf
                                    <table>
                                        <tr>
                                            <td>Invoice ID</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" name='invoice_id' id="invoice_id" style="border-radius:40px;width:100px;"
                                                    class="form-control form-control-round"
                                                    value="">
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Sales Date</td>
                                            <td>:</td>
                                            <td>
                                                <input type="text" id='txtSaleDate' style='border-radius:40px;'
                                                    size='15' class="form-control form-control-round"
                                                    value="<?php echo date("d-m-Y");?>" autocomplete="off">

                                            </td>

                                        </tr>
                                    </table>
                            </div>
                            <div class="col-md-3">
                                <div style='margin-top:35px;'>
                                    <a href="{{url('customers/create')}}" class="btn-sm btn-info fa fa-plus" title="Add Customer" style="line-height: 10px; padding:8px;"> Customer</a>
                                </div>
                            </div>
                            <div class="col-md-5" style="float:right;">
                                <h3 style='color:#c20774;font-weight:bold;margin-top:30px;'>Sales TO</h3>
                                <table>
                                    <tr>
                                        <td>Customer</td>
                                        <td>:</td>
                                        <td>
                                            
                                                <select id="cmbCustomer" class="form-control form-control-round"
                                                    style='border-radius:40px;'>
                                                    <option value="0">Select</option>
                                                    @foreach ($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}} ({{$customer->mobile}}) ({{$customer->membership_id}})</option>
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
                                        <td>Address</td>
                                        <td>:</td>
                                        <td id='txtAddress'></td>   
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
                                                    style="float:right; border: 3px solid #e8359d; border-radius:40px;"
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
                                                    @if ($product->stocks()->sum('qty')>0)
                                                       <option value="{{$product->id}}">{{$product->name}}</option>
                                                    @endif
                                                    
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
                                                     autocomplete="off">
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
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body border-info">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="">Discount</label><br>
                                                <select name="cmbDiscount" id="cmbDiscount" class="form-control" style='width:100%'>
                                                    <option value="0">Select Discount %</option>
                                                    <option value="5">5%</option>
                                                    <option value="10">10%</option>
                                                    <option value="15">15%</option>
                                                    <option value="20">20%</option>
                                                    <option value="25">25%</option>
                                                    <option value="30">30%</option>
                                                    <option value="35">35%</option>
                                                    <option value="40">40%</option>
                                                    <option value="45">45%</option>
                                                    <option value="50">50%</option>
                                                </select>
                                            </div>
                                             <div class="col-md-6 mb-1">
                                                <label for="">Advance</label><br>
                                                <input type="text" style="padding: 0.2rem 0.75rem; border-radius:4px;" class="form-control" id='advPaidAmount' name='advPaidAmount'>
                                            </div>
                                            <div class="col-md-6 mb-1">
                                                <label for="">Payable Amount</label><br>
                                                <input type="text" style="padding: 0.2rem 0.75rem; border-radius:4px;" class="form-control" id='paidAmount' name='paidAmount'>
                                            </div>
                                            
                                            <div class="col-md-6 mb-1">
                                                <label for="">Payment Type</label><br>
                                                <select class="form-control" id='paymentType' name='paymentType' style='width:100%'>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Bkash">Bkash</option>
                                                    <option value="Card">Card</option>
                                                </select>
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
                                            <p id="select-alert" class="text-danger p-2"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
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
                                        <td style="color:#E9118F;">Grand Total</td>
                                        <td style="color:#E9118F;">:</td>
                                        <td id="net-total">0</td>
                                    </tr>
                                </table>
                                
                                
                            </div>
                        </div>
                        <div class="row">
                            
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

    // Initialize select2
    $("#cmbCustomer").select2();
    $("#cmbProduct").select2();
    $("#paymentType").select2();
    $("#cmbDiscount").select2();
    // Read selected option
    $("#cmbCustomer").on("change", function() {

        let customer_id = $(this).val();
        $.ajax({
            url: "{{url('get-customer')}}",
            type: "get",
            data: {
                "id": customer_id 
            },
            success: function(res) {
                console.log(res);
                let customer=JSON.parse(res);
                $("#txtEmail").html(customer.email);
                $("#txtMobile").html(customer.mobile);
                $("#txtAddress").html(customer.address);
            }
        });
    });

    $("#cmbDiscount").on("change", function() {

            let discount_id = $(this).val();
            let total = $("#net-total").html();
            //let paid = total-(total*discount_id/100);
            let paid = Math.round(total-(total*discount_id/100));
            $("#paidAmount").val(paid);

    });
    $("#advPaidAmount").on("blur",function(e){
    let a= $("#paidAmount").val();
        if(a == ''){
            
            let advpaid = $("#advPaidAmount").val();
            
            let b = $("#net-total").html();
            console.log(advpaid);
            $("#paidAmount").val(b-advpaid);
        }else{
            let advpaid = $("#advPaidAmount").val();
            let c = $("#paidAmount").val();
            $("#paidAmount").val(c-advpaid);
            console.log('else');
        }
    
    });

    $("#cmbProduct").on("change",function(){        
           $.ajax({
             url:"<?php echo url("getproduct")?>",
             type:'GET',
             data:{"id":$(this).val()},
             success:function(res){
               //console.log(res);
              let service=JSON.parse(res);
               console.log(service);
              $("#txtPrice").val(service.price);
              $("#txtQty").val(1);
              $("#txtQty").focus();
             }
           });
        }); 
    //Show calander in textbox

    $("#txtSaleDate").datepicker({
        dateFormat: 'dd-mm-yy'
    });
    $("#txtDueDate").datepicker({
        dateFormat: 'dd-mm-yy'
    });

    printCart();

    //Save into database table
    $("#btnProcessOrder").on("click", function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Confirm?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Save!'
            }).then((result) => {
            if (result.isConfirmed) {
                let token = $("input[name='_token']").val();
                let method = $("input[name='_method']").val();
                let customer_id = $("#cmbCustomer").val();
                let invoice_id = $("#invoice_id").val();
                let sale_date = $("#txtSaleDate").val();
                //let discount=0;
                if(customer_id==0){
                    $('#select-alert').html('Not saved! Please select customer first!!');
                }
                if($("#paidAmount").val()==''){
                    $('#select-alert').html('Not saved! Please Paid Amount first!!');
                }
                if($("#invoice_id").val()==''){
                    $('#select-alert').html('Not saved! Please fill Invoice first!!');
                }
                let note = $("#txtNote").val();
                let price = $("#txtPrice").val();
                let paid_amount= $("#paidAmount").val();
                let payment_type= $("#paymentType").val();
                let qty = $("#txtQty").val();
                let discount = $("#txtDiscount").val();
                let main_discount = $("#cmbDiscount").val();
                let total_discount = discount * qty;
                let subtotal = $("#net-total").html();
                let advPaid = $("#advPaidAmount").val();
                //let vat = (subtotal * 0.05);
                let vat = 0;

                if(customer_id==0){
                    $('#select-alert').html('Not saved! Please select customer first!!');
                }

                let products = JSON.parse(localStorage.getItem("cart"));

                $.ajax({
                    url: "{{route('productsale.store')}}",
                    type: 'POST',
                    data: {
                        _token:token,
                        _method:method,
                        "invoice_id": invoice_id,
                        "cmbCustomer": customer_id,
                        "txtSaleDate": sale_date,
                        "txtDiscount": discount,
                        "totalDiscount": main_discount,
                        "txtVat": vat,
                        "txtNote": note,
                        "subtotal": subtotal,
                        "txtProduct": products,
                        "paidAmount":paid_amount,
                        "paymentType":payment_type,
                        "advPaid":advPaid,
                        
                    },
                    success: function(res) {
                        
                        console.log(res.view);
                        var win = window.open("","_top");
                        win.document.write(res.view);
                        self.focus();
                        win.print();
                        win.close();
                        clearCart();
                        location.reload();

                    }
                });
            }
        })


    });
    //Add Customer..............................  
    $("#btnSubmit").on("click", function() {
        let name = $("#txtName").val();
        let phone = $("#txtPhone").val();
        let city = $("#cmbCity").val();
        let area = $("#cmbArea").val();
        let n_id = $("#cmbN").val();

        $.ajax({
            url: 'library/ajax_customer.php',
            type: 'POST',
            data: {
                "txtName": name,
                "txtPhone": phone,
                "cmbCity": city,
                "cmbArea": area,
                "cmbN": n_id,
                'btn-Submit': 'Submit'
            },
            success: function(res) {
                alert(res);
                location.reload();


            }
        });
    });
    //Show customer other information    

    /*
      //cart
      [
       {'name':'jahid','item_id':20,'price':30,'qty':1,'discount':0,'subtotal':30},
       {'name':'jahid','item_id':20,'price':30,'qty':1,'discount':0,'subtotal':30},
       {'name':'jahid','item_id':20,'price':30,'qty':1,'discount':0,'subtotal':30},
       {'name':'jahid','item_id':20,'price':30,'qty':1,'discount':0,'subtotal':30}          
      ]
     */

    //Add item to bill temporarily
    $("#btnAddToCart").on("click", function() {

        let item_id = $("#cmbProduct").val();
        let name = $("#cmbProduct option:selected").text();
        let price = $("#txtPrice").val();
        let qty = $("#txtQty").val();
        let discount = $("#txtDiscount").val();
        let total_discount = discount * qty;
        let subtotal = price * qty - total_discount;
        let item = {
            "name": name,
            "item_id": item_id,
            "price": price,
            "qty": parseFloat(qty),
            "discount": discount,
            'total_discount': total_discount,
            "subtotal": subtotal
        };
        save(item);
        printCart();

    });



    $("body").on("click", ".delete", function() {
        let id = $(this).data("id");
        delItem(id)
        printCart();
    });

    $("#clearAll").on("click", function() {
        clearCart();
    });


    //------------------Cart Functions----------//      


    function printCart() {
        let cart = localStorage.getItem("cart");
        cart = JSON.parse(cart);
        let sn = 1;
        let $bill = "";
        let subtotal = 0;
        $.each(cart, function(i, item) {
            console.log(item.name);
            subtotal += item.price * item.qty - item.discount;
            let $html = "<tr>";
            $html += "<td>";
            $html += sn;
            $html += "</td>";
            $html += "<td>";
            $html += item.name;
            $html += "</td>";
            $html += "<td data-field='price'>";
            $html += item.price;
            $html += "</td>";
            $html += "<td data-field='qty'>";
            $html += item.qty;
            $html += "</td>";
            $html += "<td data-field='discount'>";
            $html += item.total_discount;
            $html += "</td>";
            $html += "<td data-field='subtotal'>";
            $html += item.subtotal;
            $html += "</td>";
            $html += "<td>";
            $html += "<input type='button' class='delete' data-id='" + item.item_id + "' value='-'/>";
            $html += "</td>";
            $html += "</tr>";
            $bill += $html;
            sn++;
        });

        $("#items").html($bill);
        $("#paidAmount").val(subtotal);
        //Order Summary
        $("#subtotal").html(subtotal);
        //let tax = (subtotal * 0.05).toFixed(2);
        let tax = 0.00;
        $("#tax").html(tax);
        $("#net-total").html(parseFloat(subtotal) + parseFloat(tax));
    }





    function save(item) {
        let cart = localStorage.getItem("cart");

        if (cart != null) {
            if (!itemExists(item.item_id)) {
                cart = JSON.parse(cart);
                cart.push(item);
                localStorage.setItem("cart", JSON.stringify(cart));
            } else {
                QtyUp(item.item_id, item.qty);
            }

        } else {
            cart = [];
            cart.push(item);
            localStorage.setItem("cart", JSON.stringify(cart));
        }
    }


    function QtyUp(id, qty) {
        console.log(id)
        let cart = localStorage.getItem("cart");
        if (cart != null) {
            cart = JSON.parse(cart);
            let tmp = [];

            $.each(cart, function(i, item) {
                if (id == item.item_id) {
                    item.qty += qty;
                    discount = item.discount * item.qty;
                    item.total_discount = discount;
                    item.subtotal = (item.qty * item.price) - (discount);

                    console.log(item);
                    tmp.push(item);
                } else {
                    tmp.push(item);
                }
            });

            localStorage.setItem("cart", JSON.stringify(tmp));
        }
    }


    function itemExists(id) {
        let found = 0;
        let cart = localStorage.getItem("cart");
        if (cart != null) {
            cart = JSON.parse(cart);
            $.each(cart, function(i, item) {
                if (id == item.item_id) {
                    found = 1;
                }
            });
        } else {
            found = 0;
        }

        return found;
    }

    function delItem(id) {
        let cart = localStorage.getItem("cart");
        if (cart != null) {
            cart = JSON.parse(cart);
            let tmp = [];
            $.each(cart, function(i, item) {
                if (id != item.item_id) {
                    tmp.push(item);
                }
            });
            localStorage.setItem("cart", JSON.stringify(tmp));
        }
    }


    function clearCart() {
        localStorage.removeItem("cart");
        cart = [];
        localStorage.setItem("cart", JSON.stringify(cart));
        printCart();
    }


});
</script>
@endsection
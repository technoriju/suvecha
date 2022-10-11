<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";
 $page="bill";
 $page2="bill";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Office Management</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <?php include 'header.php'; ?>
    <style>
        #panel {
            padding: 10px;
            display: none;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ navigation menu ] start -->
    <?php include 'menu.php'; ?>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <form id="idForm" action="print.php" method="post">
                                            <div class="card-header">
                                                <div class="row">

                                                    <div class="col-sm-3">
                                                        <h5>Add Bill</h5>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <select name="customer" id="customer" class="form-control search-select" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" required="">
                                                                <option value="">Select any Customer</option>
                                                                <?php
         $qryd=mysqli_query($con,"select supplier_name,supplier_id from `add-supplier` order by `supplier_name` desc");
         while($rowd=mysqli_fetch_assoc($qryd)) {
            echo "<option value='$rowd[supplier_id]'>$rowd[supplier_name]</option>";         } ?>

                                                            </select>

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <?php
                                                          $qry=mysqli_query($con,"select `invoice_no` from `report` order by `id` desc");
                                                          $row_qry=mysqli_fetch_assoc($qry);
                                                         ?>
                                                            <input type="text" id="invoice_no" name="invoice_no" class="form-control" placeholder="Invoice No" aria-label="Invoice No" aria-describedby="basic-addon2" required="" value="<?php if(isset($row_qry[invoice_no])){echo $row_qry[invoice_no]+1; } else { echo "1";} ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group">
                                                            <input type="date" id="invoice_date" required name="invoice_date" value="<?= date("Y-m-d"); ?>" class="form-control" aria-describedby="basic-addon2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center mb-3">
                                                    <button class="btn btn-md btn-info" id="bu1">Free Product</button>

                                                    <button class="btn btn-md btn-danger" id="bu2">Discount</button>
                                                </div>
                                                <table id="myTable" class="bill-table table order-list">
                                                    <thead>
                                                        <tr>
                                                            <td>Product Name</td>
                                                            <td>Quantity</td>
                                                            <td>Rate</td>                                           
                                                            <td>Total Amount</td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="countrow">
                                                        <tr>

                                                            <td><select class="form-control search-select" name="name[]" id="name0" required="" onchange="Total(this.value,getAttribute('id'));">
                                                                    <option value="">Select any Product</option>
                                                                    <?php
         $qry=mysqli_query($con,"select product_name,product_id from `product` order by `product_id` desc");
         while($row=mysqli_fetch_assoc($qry)) {
            echo "<option value='$row[product_id]'>$row[product_name]</option>";
         } ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="qnt[]" id="qnt0" placeholder="Quantity" class="form-control" onkeyup="Calcu(this.value,this.id);" /></td>
                                                            <td><input type="text" name="price[]" id="price0" placeholder="Price" class="form-control" /></td> 
                                                            <td><input type="text" name="tprice[]" id="tprice0" placeholder="Total Amount" class="form-control" /></td>
                                                            <td><a class="deleteRow"></a>
                                                                <input type="button" class="btn btn-md btn-success" id="addrow" value="Add Row" />
                                                            </td>
                                                        </tr>




                                                    </tbody>
                                                </table>
                                                <table class="table discount-table">
                                                    <tbody>

                                                        <tr id="sh11">
                                                            <td><select name="free_name" placeholder="Product Name" class="form-control">
                                                                    <option value="">Choose Free Product</option>
                                                                    <?php
                                                                     $qry=mysqli_query($con,"select product_name,product_id from `product` order by `product_id` desc");
                                                                     while($row=mysqli_fetch_assoc($qry)) {
                                                                        echo "<option>$row[product_name]</option>";
                                                                     } ?>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="free_qnt" placeholder="Quantity" class="form-control" /></td>
                                                            <td><input type="text" name="" placeholder="00" class="form-control" value="00" /></td>
                                                        </tr>
                                                        <tr id="sh12">
                                                            <td><input type="text" value="Discount" class="form-control" /></td>
                                                            <td></td>
                                                            <td><input type="text" name="discount" id="discounts" placeholder="Amount" class="form-control" onkeyup="Calcu(this.value,this.id);"/></td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td><input type="text" name="totalamt" id="totalamt" placeholder="Total Amount" class="form-control" value="0"/></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>



                                            <div class="text-center mb-5">
                                                <!--<button class="btn btn-md btn-info" name="payment_status[]" value="f" id="button1" onclick="return Fullpayment();">Full Payment</button>-->

                                                <!--<button class="btn btn-md btn-warning" id="button2">Step Payment</button>-->

                                                <!--<button class="btn btn-md btn-danger" name="payment_status[]" value="d" id="button3" type="submit" onclick="return Fullpayment();">Due</button>-->
                                                <button class="btn btn-md btn-success" name="payment_status[]" value="p" id="button3" type="submit" onclick="return Fullpayment();">Print</button>
                                                <!--<div id="panel" class="w-100">-->

                                                <!--    <div class="pice-form">-->
                                                <!--        <input type="text" name="due_payment" class="form-control w-25" placeholder="Price" value="0">-->
                                                <!--        <button name="payment_status[]" value="s" class="btn btn-md btn-success" onclick="return Fullpayment();">Submit</button>-->
                                                <!--    </div>-->

                                                <!--</div>-->
                                            </div>
                                        </form>

                                    </div>



                                </div>
                            </div>
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Required Js -->
    <?php include'footer.php'; ?>
    <!--<script src="assets/js/script.js"></script>-->
    
    <script src="assets/js/select-search.js"></script>

    <script>
        $('#sh11').hide();
        $('#sh12').hide();
        $("#bu1").click(function(e) {
            e.preventDefault();
            $('#sh11').slideToggle("slow");
        });
        $("#bu2").click(function(e) {
            e.preventDefault();
            $('#sh12').slideToggle("slow");
        });

        $(document).ready(function() {
            var counter = 1;

            $("#addrow").on("click", function() {
                var newRow = $("<tr>");
                var cols = "";

                cols += '<td><select class="form-control search-select" name="name[]" id="name' + counter + '" onchange="Total(this.value,this.id);"><option>Select any Product</option><?php
         $qry=mysqli_query($con,"select product_name,product_id from `product` order by `product_id` desc");
         while($row=mysqli_fetch_assoc($qry)) {
            echo "<option value=$row[product_id]>$row[product_name]</option>";
         } ?></select></td>';
                cols += '<td><input type="text" class="form-control" placeholder="Quantity" id="qnt' + counter + '" name="qnt[]" onkeyup="Calcu(this.value,this.id);"/></td>';
                cols += '<td><input type="text" class="form-control" placeholder="Price" id="price' + counter + '" name="price[]"/></td>';                
                cols += '<td><input type="text" class="form-control" placeholder="Total price" id="tprice' + counter + '" name="tprice[]"/></td>';


                cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
                newRow.append(cols);
                $("table.order-list").append(newRow);
                counter++;
            });

            $("table.order-list").on("click", ".ibtnDel", function(event) {
                $(this).closest("tr").remove();
                counter -= 1
            });
        });

        function calculateRow(row) {
            var price = +row.find('input[name^="price"]').val();
        }

        function calculateGrandTotal() {
            var grandTotal = 0;
            $("table.order-list").find('input[name^="price"]').each(function() {
                grandTotal += +$(this).val();
            });
            $("#grandtotal").text(grandTotal.toFixed(2));
        }


        function Total(val, val2) {
            var suffix = val2.match(/\d+/);
            $.ajax({
                type: "POST",
                url: "ajax2.php",
                data: {
                    product_id: val
                },
                dataType: "JSON",
                success: function(data) {
                    $("#price" + suffix).val(data.purchase_price); 
                    $("#qnt" + suffix).val(data.qty);                    
                }
            })
        }

        function Calcu(val, val2) {
            var suffix = val2.match(/\d+/);
            var price = $('#price' + suffix).val();                      
            var total = val * price;
            var total2 = total.toFixed(2);
            $('#tprice' + suffix).val(total2);
           
            $.ajax({
                type: "POST",
                url: "ajax2.php",
                data: $("#idForm").serialize(),
                dataType: "JSON",
                success: function(data) {                   
                    $("#totalamt").val(data.sum);                    
                }
            })
        } 


        $("#button2").on('click', function(e) {
            e.preventDefault();
            $("#panel").slideToggle("slow");
        });

        function Fullpayment() {
            var x = confirm("Are you sure want to Submit?");
            if (x) {
                return true;
            } else {
                return false;
            }
        }        

    </script>
</body>

</html>

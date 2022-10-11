<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";
 $page="add-product";
 $page2="product";
 date_default_timezone_set("Asia/Kolkata");                                  
if(isset($_GET['view'])){
    $view_product=mysqli_query($con,"select * from `product` where `product_id`='$_GET[view]'");
    $row_product=mysqli_fetch_assoc($view_product);
}
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
    <meta name="keywords" content=""/>

    <?php include 'header.php'; ?>
    <style type="text/css">
        #output{ font-size: medium; font-weight: 500; }
    </style>
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
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <h5>Sell Product</h5>
                                                </div>
                                                <div class="col-sm-4">
                                                     <form action="" method="post">
                                                    <div class="input-group">                      
                                                        <input type="text" id="" list="browsers" class="form-control" placeholder="Product Id" aria-label="Recipient's username" aria-describedby="basic-addon2" onchange="Search(this.value);">
                                                        <datalist id="browsers">
                                                            <?php 
                $seaw=mysqli_query($con,"select `workorder` from `product`");
                while($row_seaw=mysqli_fetch_assoc($seaw))
                {
                   echo "<option value='$row_seaw[workorder]'>Work Order</option>";
                }
                $seac=mysqli_query($con,"select `challan` from `product`");
                while($row_seac=mysqli_fetch_assoc($seac))
                {
                    echo "<option value='$row_seac[challan]'>Challan</option>";
                }
                $seap=mysqli_query($con,"select `product_name` from `product`");
                while($row_seap=mysqli_fetch_assoc($seap))
                {
                    echo "<option value='$row_seap[product_name]'>Product Name</option>";
                }    
                                                             ?>
                                                        </datalist>
                                                        <!-- <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button">Search</button>
                                                        </div>  -->                                           
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                       
        <div class="card-body sell">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Work Order</label>
                            <input name="workorder" type="text" class="form-control" id="workorder" placeholder="Work Order No" <?php if(isset($row_product)){ echo "value='$row_product[workorder]'"; } ?>>
                            <input type="hidden" name="hid" value="<?php if(isset($row_product)){ echo $row_product[product_id]; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Supplier Name</label>
                            <select name="supplier_name" class="form-control" id="" placeholder="choose Supplier">
                                <option value="">Select Supplier</option>
                                <?php
                                   $addsupp=mysqli_query($con,"select * from `add-supplier` order by `supplier_id` desc");
                                   while($row_supp=mysqli_fetch_assoc($addsupp)) { ?>
                                    <option <?php if($row_product['supplier']==$row_supp['supplier_id']){ echo "selected"; } ?> value="<?php echo $row_supp['supplier_id'] ?>"><?php echo $row_supp['supplier_name'] ?></option>
                                <?php } ?>                     
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="exampleInputEmail1">Quantity</label>
                            <input name="qty" type="text" class="form-control" id="qty" placeholder="Put Quantity" required value="<?php if(isset($row_product)){ echo $row_product[qty];} ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Purchase Price &copy;<span id="output"></span></label>
                            <input name="purchase_price" type="text" class="form-control" id="input" placeholder="Put Purchase Price" value="<?php if(isset($row_product)){ echo $row_product[purchase_price];} ?>" required onkeyup="calculateTotal();">
                        </div>
                       <div class="form-group">
                            <label for="exampleInputPassword1">GST</label>
                             <select name="gst" class="form-control" id="" placeholder="choose GST" required>
                                <option value="">Select GST%</option>
                                <?php
                                   $addgst=mysqli_query($con,"select * from gst order by gst_id desc");
                                   while($row_addgst=mysqli_fetch_assoc($addgst)) { ?>
                                    <option <?php echo ($row_product[gst]==$row_addgst[gst_value])?"selected":"null"; ?> value='<?php echo $row_addgst[gst_value] ?>'><?php echo $row_addgst[gst_per] ?></option>
                                <?php } ?>                     
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input name="description" type="text" class="form-control" id="" placeholder="Description" value="<?php if(isset($row_product)){ echo $row_product[description]; } ?>" required>
                        </div>   
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                            <label for="exampleInputEmail1">Challan No</label>
                            <input name="challan" type="text" class="form-control" id="" placeholder="Put Challan"  value="<?php if(isset($row_product)){ echo $row_product[challan]; } ?>">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input name="product_name" type="text" class="form-control" id="product_name" placeholder="Name"  value="<?php if(isset($row_product)){ echo $row_product[product_name]; } ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Unit</label>
                            <select name="unit" class="form-control" id="" placeholder="Name" required>
                                <option value="">Select any Unit</option>
                                <?php
                                   $addpro=mysqli_query($con,"select * from unit order by unit_id desc");
                                   while($row_addpro=mysqli_fetch_assoc($addpro)) { ?>
                                    <option <?php echo ($row_product[unit])?"selected":"null"; ?>><?php echo $row_addpro[unit_name] ?></option>
                                <?php } ?>                     
                            </select>
                        </div>  
                      
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sell Price</label>
                            <input name="sell_price" type="text" class="form-control" id="" placeholder="Put Sell Price" value="<?php if(isset($row_product)){ echo $row_product[sell_price];} ?>" required>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">HSN/SAC Code</label>
                            <input name="hsn" type="text" class="form-control" id="" placeholder="HSN/SAC Code" value="<?php if(isset($row_product)){ echo $row_product[hsn];} ?>" required>
                        </div>  
                         <div class="form-group">
                            <label for="exampleInputEmail1">Date</label>
                            <input name="date" type="date" class="form-control" id="" value="<?php if(isset($row_product)) { echo $row_product[date]; } else { echo date('Y-m-d'); } ?>" placeholder="Y-m-d" required>
                        </div>      
                    </div>
                     <div class="col-md-6">
                     <div class="form-group">                      
                      <button type="submit" name="sub" value="submit" class="btn btn-primary" title="Choose anyone workorder/product_name" disabled>Sell</button>
                     </div>
                    </div>
                </div>
            </form>
        </div>
                                    </div>
                                    <?php
                                      if($_POST['sub']=="submit")
                                      {
                                        $hid=htmlspecialchars($_POST['hid']);
                                        $workorder=htmlspecialchars($_POST['workorder']);
                                        $challan=htmlspecialchars($_POST['challan']);
                                        $supplier_name=htmlspecialchars($_POST['supplier_name']);
                                        $seller_name=htmlspecialchars($_POST['seller_name']);
                                        $product_name=htmlspecialchars($_POST['product_name']);
                                        $qty=htmlspecialchars($_POST['qty']);
                                        $purchase_price=htmlspecialchars($_POST['purchase_price']);
                                        $gst=htmlspecialchars($_POST['gst']);
                                        $description=htmlspecialchars($_POST['description']);
                                        $unit=htmlspecialchars($_POST['unit']);
                                        $Price=htmlspecialchars($_POST['Price']);
                                        $sell_price=htmlspecialchars($_POST['sell_price']);
                                        $hsn=htmlspecialchars($_POST['hsn']);
                                        $date=htmlspecialchars($_POST['date']);
                                        $total=$qty*$sell_price;
                                        
                                        $qry=mysqli_query($con,"insert into `sell` values('','$workorder','$challan','$supplier_name','$seller_name','$product_name','$qty','$purchase_price','$total','$gst','$description','$unit','$Price','$sell_price','$hsn','$date','$hid','1')");
                                        $qry=mysqli_query($con,"update `product` set `qty`=`qty`-'$qty',`total_price`='$total' where `product_id`='$hid'");
                                        
                                    ?>
                                          <script>              
                                              swal({
                                                    title: "Great job!",
                                                    text: "Product Sell!",
                                                    type: "success"
                                                }).then(function() {
                                                    window.location = "stock-report.php";
                                                });
                                          </script>
                                           
                                    <?php  }
                                    ?>
                                    <!-- Input group -->
                                    
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
    <script>
          
       function Search(val)
       {
          $.ajax({
            type: "POST",
            url: "ajax.php",
            data: {search:val},  
            success: function(data) {
             $(".sell").html(data);
            }
            });

       }
    </script>  
</body>
</html>

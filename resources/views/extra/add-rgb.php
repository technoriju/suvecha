<?php
  ob_start();
?>

<?php
 error_reporting(0);
 include_once "conn.php";
 $page="add-product";
 $page2="rgb";
 date_default_timezone_set("Asia/Kolkata"); 
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

                                            <h5><?php if($_GET[ret]){ echo "Return RGB Product"; } else { echo "Add RGB Product"; } ?></h5>
                                        </div>
                      <?php 
                      if(isset($_GET['ret'])){

                    $view_product=mysqli_query($con,"select * from `rgb` where `product_id`='$_GET[ret]'");
                    $row_product=mysqli_fetch_assoc($view_product);
                      } ?>                 



        <div class="card-body">



            <form action="" method="post">



                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" class="form-control" id="" value="RGB" placeholder="Name" readonly>
                            <input name="product_name" type="hidden" class="form-control" id="" value="RGB" placeholder="Name">
                        </div>

                        <div class="form-group">

                            <label for="exampleInputEmail1">Quantity</label>

                            <input name="qty" type="text" class="form-control" id="qty" placeholder="Put Quantity" required >

                        </div>

                    </div>



                    <div class="col-md-6"> 

                         <div class="form-group">

                            <label for="exampleInputEmail1">Vehicle</label>

                        <input name="vehicle_no" type="text" class="form-control" id="" placeholder="Vehicle No" required>

                        </div>

                         <div class="form-group">

                            <label for="exampleInputEmail1">Date</label>

                            <input name="date" type="date" class="form-control" id="" value="<?= date("Y-m-d") ?>" placeholder="Y-m-d" required>

                        </div> 

                    </div>

                    

                    <div class="col-md-6">

                     <div class="form-group">

                       <?php 
                      if($_GET[ret]){ ?>

                      <button type="submit" name="sub" value="return" class="btn btn-primary">Return</button>

                       <?php } else { ?>

                      <button type="submit" name="sub" value="submit" class="btn btn-primary">Submit</button>

                       <?php } ?> 

                     </div>

                    </div>



                </div>



            </form>



        </div>



                                    </div>



                                    <?php
                                    if($_POST['sub']=="return")
                                    {
                                        $product_name=$row_product['product_name'];   
                                        $qty=htmlspecialchars($_POST['qty']);
                                        $vehicle_no=htmlspecialchars($_POST['vehicle_no']);
                                        $date=htmlspecialchars($_POST['date']); 
                                        
                                        mysqli_query($con,"insert into `rgb_return` values('','$qty','$vehicle_no','$date','Return')");
                                        $qry=mysqli_query($con,"update `rgb` set `qty`=`qty`-'$qty' where `product_name`='$product_name'");
                                        if($qry){
                                        echo "<script>              
                                          swal({
                                                title: 'Great job!',
                                                text: 'Return Successful',
                                                type: 'success'
                                            }).then(function() {
                                                window.location = 'stock-rgb.php';
                                            });
                                      </script>"; }
                                    }

                                      if($_POST['sub']=="submit")
                                      {
                                        $product_name=htmlspecialchars($_POST['product_name']);
                                        $qty=htmlspecialchars($_POST['qty']);
                                        $vehicle_no=htmlspecialchars($_POST['vehicle_no']);
                                        $date=htmlspecialchars($_POST['date']);
                                        
                                        $qry=mysqli_query($con,"update `rgb` set `qty`=`qty`+'$qty' where `product_name`='$product_name'");
                                        
                                        mysqli_query($con,"insert into `rgb_return` values('','$qty','$vehicle_no','$date','Entry')");
                                    ?>
                                      <script>              
                                          swal({
                                                title: "Great job!",
                                                text: "RGB Data Inserted!",
                                                type: "success"
                                            }).then(function() {
                                                window.location = "stock-rgb.php";
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



          function calculateTotal(){



           var bla = document.getElementById("input").value;



           var qty = document.getElementById("qty").value;



           var total=bla*qty;



           document.getElementById("output").innerHTML = total;



           



       }



    </script>  



</body>



</html>




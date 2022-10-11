<?php

  ob_start();

?>

<?php

 error_reporting(0);

 include_once "conn.php";

 $page="product-list";

 $page2="rgb";

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
        #btncss {
            margin-top: 29px;
                }

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

<?php

         if($_GET[del])

         {           

            $qry_del=mysqli_query($con,"select * from `rgb_return` where `ret_id`='$_GET[del]'");

            while($row_del=mysqli_fetch_assoc($qry_del))

            {

               mysqli_query($con,"delete from `rgb_return` where `product_id`='$row_del[product_id]'"); 

            }

            $del=mysqli_query($con,"delete from `rgb` where `product_id`='$_GET[del]'");

           if($del) { header("location:stock-rgb.php"); }

         }         



?>

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

                                                 <?php
                                                 
                                                    if($_GET['del'])
                                                    {
                                                         mysqli_query($con,"delete from `rgb_return` where `product_id`= '$_GET[del]'"); 
                                                         if($_GET['status']=="Entry"){
                                                         mysqli_query($con,"update `rgb` set `qty`=`qty`-'$_GET[qty]' where `product_id`='3'");
                                                         } else { 
                                                          mysqli_query($con,"update `rgb` set `qty`=`qty`+'$_GET[qty]' where `product_id`='3'");
                                                         }
                                                         header("location:stock-rgb.php");
                                                    }

                                                    $qry=mysqli_query($con,"select sum(qty) as qty from `rgb_return` where `status` = 'entry'"); 
                                                    $row=mysqli_fetch_assoc($qry);                      

                                                    $qry2=mysqli_query($con,"select sum(qty) as qty from `rgb_return` where `status` = 'return'");
                                                    $row2=mysqli_fetch_assoc($qry2);

                                                    $qry3=mysqli_query($con,"select product_id,qty from `rgb`");
                                                    $row3=mysqli_fetch_assoc($qry3);                

                                                 ?>   

    <div class="col-sm-3">
    	<div class="form-group">
          <label>RGB in Stock</label>
          <input name="amount" type="text" class="form-control" value="<?= $row3['qty'] ?>" placeholder="Amount">
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          <label>RGB Entry</label>
          <input name="amount" type="text" class="form-control" value="<?= $row['qty'] ?>" placeholder="Amount">
        </div>
    </div>
    <div class="col-sm-3">
    	<div class="form-group">
          <label>RGB Return</label>
          <input name="amount" type="text" class="form-control" value="<?= $row2['qty'] ?>" placeholder="Amount">
        </div>
    </div>
    <div class="col-sm-3">
         <a href="add-rgb.php?ret=<?= $row3['product_id'] ?>" id="btncss" class="btn btn-primary">Return</a>
    </div>

                                            </div>

                                        </div>

                                        <div class="card-body data-tablee">

                                            <div class="row">

                                                <div class="col-sm-6">

                                            <table class="table table-hover responsive">

                                                <thead>

                                                    <tr>

                                                        <th class="disableSort">#</th>

                                                        <th>Vehicle No</th>

                                                        <th>Date</th>

                                                        <th>Status</th>

                                                        <th>Qty</th>
                                                        <th>Del</th>
                                                    </tr>

                                                </thead>

                                                <tbody>

    <?php

    $c=0; $sum=0; $sum2=0;

     $qry=mysqli_query($con,"select * from `rgb_return` where `status`='Entry' order by `date` desc");

    while($row=mysqli_fetch_assoc($qry)) { $c++;

    $sum = $sum + $row[qty];

?>                                               

<tr>

    <td><?php echo $c ?></td>

    <td><?php echo $row[vehicle_no] ?></td>

    <td><?php echo date("d-m-Y",strtotime($row[date])); ?></td>

    <td><?php echo $row[status] ?></td>

     <td><?php echo $row[qty] ?></td>
     <td><a href='stock-rgb.php?del=<?= $row[product_id] ?>&qty=<?= $row[qty] ?>&status=<?= $row[status] ?>' onclick="return Delete();">Del</a></td>

</tr> <?php } ?><tr><td colspan=3></td><th><font size="4" color="red">Total</font></th><th><font size="4" color="red"><?= $sum ?></font></th></tr>

                                                                                                       

                                                </tbody>

                                            </table>

                                        </div>

                                                <div class="col-sm-6">

                                            <table class="table table-hover responsive">

                                                <thead>
                                                    <tr>
                                                        <th class="disableSort">#</th>
                                                        <th>Vehicle No</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Qty</th>
                                                        <th>Del</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

<?php
    $c2=0;  
    $qry2=mysqli_query($con,"select * from `rgb_return` where `status`='Return' order by `date` desc");
    while($row2=mysqli_fetch_assoc($qry2)) { $c2++;
    $sum2 = $sum2 + $row2[qty];
?>                                               

<tr>

    <td><?php echo $c2 ?></td>

    <td><?php echo $row2[vehicle_no] ?></td>

    <td><?php echo date("d-m-Y",strtotime($row2[date])); ?></td>

    <td><?php echo $row2[status] ?></td>

     <td><?php echo $row2[qty] ?></td>
      <td><a href='stock-rgb.php?del=<?= $row2[product_id] ?>&qty=<?= $row2[qty] ?>&status=<?= $row2[status] ?>' onclick="return Delete();">Del</a></td>
</tr> <?php } ?><tr><td colspan=3></td><th><font size="4" color="red">Total</font></th><th><font size="4" color="red"><?= $sum2 ?></font></th></tr>                                                                                                      

                                                </tbody>

                                            </table>

                                        </div>

                                        </div>

                                        </div>

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

    <!-- <script src="assets/js/script.js"></script>  -->



    <script src="assets/js/tableManager.js"></script>

    <script type="text/javascript">  

        function Delete()
        {
            var x=confirm("Are you sure want to Delete?");

            if(x) { return true; } else { return false; } 

        }

    </script>

</body>



</html>


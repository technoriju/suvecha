<?php

  ob_start();

?>

<?php

 error_reporting(0);

 include_once "conn.php";

 $page="product-list";

 $page2="account";

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

            $qry_del=mysqli_query($con,"select * from `account_report` where `account_id`='$_GET[del]'");

            while($row_del=mysqli_fetch_assoc($qry_del))

            {

               mysqli_query($con,"delete from `account_report` where `id`='$row_del[id]'"); 

            }

            $del=mysqli_query($con,"delete from `account` where `id`='$_GET[del]'");

           if($del) { header("location:account-details.php"); }

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

                                                <div class="col-sm-3">

                                                    <h5>Account Details</h5>

                                                </div>

                                                <div class="col-sm-3">

                                                    <h5><font color='red'><?= $_GET['show'] ?></font></h5>

                                                </div>

                                                <div class="col-sm-3">

                                                    <h5><a href='account-details.php'>Back</a></h5>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="card-body data-tablee">

                                            <div class="row">

                                                <div class="col-sm-6">

                                            <table class="table table-hover responsive">

                                                <thead>

                                                    <tr>

                                                        <th class="disableSort">Sl No</th>

                                                        <th>Bill No</th>

                                                        <th>Date</th>

                                                        <th>Status</th>

                                                        <th>Amount</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

    <?php

    $c=0; $sum=0; $sum2=0;

    if($_GET[show]){

     $qry=mysqli_query($con,"select * from `account_report` where `name`='$_GET[show]' and `status`='Credit'");

    }

    while($row=mysqli_fetch_assoc($qry)) { $c++;

    $sum = $sum + $row[amount];

?>                                               

<tr>

    <td><?php echo $c ?></td>

    <td><?php echo $row[bill] ?></td>

    <td><?php echo date("d-m-Y",strtotime($row[date])); ?></td>

    <td><?php echo $row[status] ?></td>

     <td><?php echo $row[amount] ?></td>

</tr> <?php } ?><tr><td colspan=3></td><th><font size="4" color="red">Total</font></th><th><font size="4" color="red"><?= $sum ?></font></th></tr>

                                                                                                       

                                                </tbody>

                                            </table>

                                        </div>

                                                <div class="col-sm-6">

                                            <table class="table table-hover responsive">

                                                <thead>

                                                    <tr>

                                                        <th class="disableSort">Sl No</th>

                                                        <th>Bill No</th>

                                                        <th>Date</th>

                                                        <th>Status</th>

                                                        <th>Amount</th> 

                                                    </tr>

                                                </thead>

                                                <tbody>

    <?php

    $c2=0;

    if($_GET[show]){

     $qry2=mysqli_query($con,"select * from `account_report` where `name`='$_GET[show]' and `status`='Debit'");

    }

    while($row2=mysqli_fetch_assoc($qry2)) { $c2++;

    $sum2 = $sum2 + $row2[amount];

?>                                               

<tr>

    <td><?php echo $c2 ?></td>

    <td><?php echo $row2[bill] ?></td>

    <td><?php echo date("d-m-Y",strtotime($row2[date])); ?></td>

    <td><?php echo $row2[status] ?></td>

    <td><?php echo $row2[amount] ?></td>

</tr> <?php } ?><tr><th><font size="4" color="red">Total</font></th><th><font size="4" color="red"><?= $sum2 ?></font></th></tr>

                                                                                                       

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

        // basic usage

        $('.tablemanager').tablemanager({

            

            disable: ["last"],

            appendFilterby: true,

            dateFormat: [

                [4, "mm-dd-yyyy"]

            ],

            debug: true,

            vocabulary: {

                voc_filter_by: 'Filter By',

                voc_type_here_filter: 'Filter...',

                voc_show_rows: 'Rows Per Page'

            },

            pagination: true,

            showrows: [5, 10, 20, 50, 100],

            disableFilterBy: [1]

        });

        // $('.tablemanager').tablemanager();



        function Delete()

        {

            var x=confirm("Are you sure want to Delete?");

            if(x) { return true; } else { return false; } 

        }

    </script>

</body>



</html>


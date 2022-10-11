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

                                                 <?php

                                                    $qry=mysqli_query($con,"select * from `account` where `name` like 'Global Acqua Pvt Ltd%'");   

                                                    $row=mysqli_fetch_assoc($qry);

                                                    

                                                    $qry2=mysqli_query($con,"select * from `account` where `name` like 'ROCKWELL INDUSTRIES LIMITED%'");   

                                                    $row2=mysqli_fetch_assoc($qry2);

                                                    

                                                    $qry3=mysqli_query($con,"select * from `account` where `name` like 'Bengal Beverages Pvt. Ltd.%'");   

                                                    $row3=mysqli_fetch_assoc($qry3);

                                                 ?>     

                                               <div class="col-sm-4">

                                                    <div class="form-group">

                                                      <label><a href="account-details2.php?show=<?= $row['name'] ?>">Global Acqua Pvt Ltd</a></label>

                                                      <input name="amount" type="text" class="form-control" value="<?= $row['amount'] ?>" placeholder="Amount">

                                                    </div>

                                               </div>

                                               <div class="col-sm-4">

                                                    <div class="form-group">

                                                      <label><a href="account-details2.php?show=<?= $row2['name'] ?>">ROCKWELL INDUSTRIES LIMITED</a></label>

                                                      <input name="amount" type="text" class="form-control" value="<?= $row2['amount'] ?>" placeholder="Amount">

                                                    </div>

                                               </div>

                                               <div class="col-sm-4">

                                                    <div class="form-group">

                                                      <label><a href="account-details2.php?show=<?= $row3['name'] ?>">Bengal Beverages Pvt. Ltd.</a></label>

                                                      <input name="amount" type="text" class="form-control" value="<?= $row3['amount'] ?>" placeholder="Amount">

                                                    </div>

                                               </div>

                                            </div>

                                        </div>

                                        <div class="card-body data-tablee">

                                            <table class="table table-hover tablemanager">

                                                <thead>

                                                    <tr>

                                                        <th class="disableSort">Sl No</th>                            

                                                        <th>Company Name</th>

                                                        <th>Bill No</th>

                                                        <th>Date</th>

                                                        <th class="disableFilterBy">Action</th>

                                                    </tr>

                                                </thead>

                                                <tbody>

    <?php

     $qry=mysqli_query($con,"select * from `account_report` group by `name`,`bill` order by date desc");   

    while($row=mysqli_fetch_assoc($qry)) { $c++;

?>                                               

<tr>

    <td><?php echo $c ?></td>

    <td><?php echo $row['name'] ?></td>

    <td><?php echo $row['bill'] ?></td>

    <td><?php echo date("d-m-Y",strtotime($row['date'])); ?></td>

    <td>

        <a href="account.php?adj=<?php echo $row['bill'] ?>&name=<?php echo $row['name'] ?>">Payment</a>

    </td>

</tr> <?php } ?>

                                                                                                       

                                                </tbody>

                                            </table>

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


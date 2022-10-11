<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";
 $page="free";
 $page2="free";
 date_default_timezone_set('Asia/Kolkata');
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
                                   $sel=mysqli_query($con,"select * from `report2` where `invoice_no`='$_GET[inv]'");
                                   while($row_sel=mysqli_fetch_assoc($sel))
                                   {
                                   	 mysqli_query($con,"delete from `report2` where `id`='$row_sel[id]'");
                                   }	
                                   $del=mysqli_query($con,"delete from `report` where `id`='$_GET[del]'");
                                   if($del){  if($_GET[pag]==1) { header("location:report.php?page=1"); } else { header("location:report.php"); } 
                                 } }
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
                                            <form method="POST" action="">
                                            <div class="row">
                                                 <div class="col-sm-4">
                                                    <div class="form-group">
                                                          <label></label>Date From:</label>
                                                          <input name="date1" type="date" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                          <label></label>Date To:</label>
                                                          <input name="date2" type="date" class="form-control">
                                                    </div>
                                                </div>
                                                 <div class="col-sm-4">
                                                    <div class="form-group">
                                                          <label></label>Search:</label>
                                                          <input name="sub" value="Submit" type="submit" class="form-control btn btn-primary">
                                                    </div>
                                                </div>
                                            </div>
                                             </form>
                                        </div>
                                        <div class="card-body data-tablee">
                                            <table class="table table-hover tablemanager">
                                               
                                                <tbody>
 <?php
 if($_POST['sub']=="Submit")
 {
 $qry = mysqli_query($con,"select SUM(free_qty) as qty from `report` where `invoice_date` BETWEEN '$_POST[date1]' AND '$_POST[date2]'");
 $row=mysqli_fetch_assoc($qry);
?>                                               
<tr>
    <td>Total Quantity of Product From Date <?= $_POST[date1] ?> To <?= $_POST[date2] ?> is: <b><h1><?php echo $row['qty'] ?></h1></b></td>
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

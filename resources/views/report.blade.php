<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";
 $page="product-list";
 $page2="report";
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
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <h5>All Product List</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body data-tablee">
                                            <table class="table table-hover tablemanager">
                                                <thead>
                                                    <tr>
                                                        <th class="disableSort">Sl No</th> 
                                                        <th>Seller Name</th>
                                                        <th>Invoice No</th>
                                                        <th>Invoice Date</th>
                                                        <?php if($_GET[page]){ ?>
                                                        <th>Due Report</th>   
                                                        <?php } ?>
                                                        <th class="disableFilterBy">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
 if($_GET[page]==1) { 
    $qry=mysqli_query($con,"select `id`,`invoice_no`,`invoice_date`,`supplier_name`,`due_payment` from `report` INNER JOIN `add-supplier` ON `report`.`customer`=`add-supplier`.`supplier_id` where `report`.`payment_status`='s' or `report`.`payment_status`='d' or `report`.`payment_status`='p' order by invoice_date desc");
  } else {                                                     
$qry=mysqli_query($con,"select `id`,`invoice_no`,`invoice_date`,`supplier_name`,`due_payment` from `report` INNER JOIN `add-supplier` ON `report`.`customer`=`add-supplier`.`supplier_id` where `report`.`payment_status`!='s' and `report`.`payment_status`!='d' and `report`.`payment_status`!='p' order by invoice_date desc");
}
while($row=mysqli_fetch_assoc($qry)) { $c++;
?>                                               
<tr>
    <td><?php echo $c ?></td>
    <td><?php echo $row[supplier_name] ?></td>
    <td><?php echo $row[invoice_no] ?></td>
    <td><?php echo date("d-m-Y",strtotime($row[invoice_date])); ?></td>
    <?php if($_GET[page]){ ?>
    <td><?php echo $row[due_payment] ?></td> 
    <?php } ?>    
    <td>
        <a href="print2.php?view=<?php echo $row[id] ?>">Print</a> |
        <?php if($_GET[page]){ ?>
        <a href="bill2.php?view=<?php echo $row[id] ?>">Pay</a> | <?php } ?>
        <a href="report.php?del=<?php echo $row[id] ?>&inv=<?php echo $row[invoice_no] ?>&pag=<?= $_GET[page] ?>" onclick="return Delete();">Delete</a>                
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

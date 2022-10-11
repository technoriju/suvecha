<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";
 $page="";
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
    <meta name="keywords" content=""/>

    <?php include 'header.php'; ?>
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
                                                <h5><?php if($_GET[adj]){ echo "Payment"; } elseif($_GET[upd]){ echo "Update Account"; } else { echo "Account";} ?></h5>
                                              </div>
                                        </div>
                                    </div>
                                        
                                        <?php
                                            if(isset($_GET['adj'])){              
                                            $qry=mysqli_query($con,"select * from `account_report` where `bill`='$_GET[adj]' and `name`='$_GET[name]'"); }
                                            $row=mysqli_fetch_assoc($qry);
                                        ?>
                                        <div class="card-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <?php if(!$_GET[adj]) { ?>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Company Name</label>
                                                            <select name="name" class="form-control" required>
                                                                <option value="">Select Company</option>
                                                                <option>Global Acqua Pvt Ltd</option>
                                                                <option>ROCKWELL INDUSTRIES LIMITED</option>
                                                                <option>Bengal Beverages Pvt. Ltd.</option>
                                                            </select>
                                                            <input type="hidden" name="hid" value="<?= $row[id] ?>">
                                                        </div> <?php } ?>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">Amount</label>
                                                            <input name="amount" type="text" class="form-control" id="" placeholder="Amount" value="<?php if(!$_GET[adj]) { echo $row[amount]; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> 
                                                     <?php if(!$_GET[adj]) { ?> 
                                                      <div class="form-group">
                                                            <label for="exampleInputPassword1">Bill No</label>
                                                            <input name="bill" type="text" class="form-control" id="" placeholder="Bill No" value="<?= $row[bill] ?>" required>
                                                      </div>  <?php } ?>                              
                                                      <div class="form-group">
                                                        <label for="exampleInputPassword1">Date</label>
                                                        <input name="date" type="date" class="form-control" id="" placeholder="Date" required value="<?= date('Y-m-d') ?>">
                                                      </div>                                                       
                                                    </div>
                                                    <div class="col-md-6">
                                                     <div class="form-group">
                                                      <?php if($_GET[adj]) { ?>
                                                      <button type="submit" name="sub" value="payment" class="btn btn-primary">Payment</button> <?php } else { ?>
                                                      <button type="submit" name="sub" value="submit" class="btn btn-primary">Submit</button> <?php } ?>  
                                                     </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php
                                    if($_POST['sub']=="payment")
                                    {
                                        $name=$row['name'];
                                        $bill=$row['bill'];
                                        $amount=htmlspecialchars($_POST['amount']);
                                        $date=htmlspecialchars($_POST['date']);
                                        $hid=$row['id'];
                                        mysqli_query($con,"insert into `account_report` values('','$name','$bill','$amount','$date','Debit')");
                                        $qry=mysqli_query($con,"update `account` set `amount`=`amount`-'$amount' where `name`='$name'");
                                        if($qry){
                                        echo "<script>              
                                          swal({
                                                title: 'Great job!',
                                                text: 'Payment Successful',
                                                type: 'success'
                                            }).then(function() {
                                                window.location = 'account-details.php';
                                            });
                                      </script>"; }
                                    }

                                      if($_POST['sub']=="submit")
                                      {
                                        $name=htmlspecialchars($_POST['name']);
                                        $bill=htmlspecialchars($_POST['bill']);
                                        $amount=htmlspecialchars($_POST['amount']);
                                        $date=htmlspecialchars($_POST['date']);
                                        $status=htmlspecialchars($_POST['status']);
                                        $hid=htmlspecialchars($_POST['hid']);                                    
                                        
                                        $qry3=mysqli_query($con,"select * from `account` where `name`='$name'");
                                        $count = mysqli_num_rows($qry3);
                                        $row3=mysqli_fetch_assoc($qry3);
                                        if($count > 0) {
                                        $qry=mysqli_query($con,"update `account` set `amount`=`amount`+'$amount' where `id`='$row3[id]'");
                                        } else {
                                        $qry=mysqli_query($con,"insert into `account` values('','$name','$amount')");    
                                        }
                                        mysqli_query($con,"insert into `account_report` values('','$name','$bill','$amount','$date','Credit')");
                                    ?>
                                      <script>              
                                          swal({
                                                title: "Great job!",
                                                text: "Account Data <?php if($_GET[upd]){ echo 'Updated'; } else { echo 'Inserted!'; } ?>",
                                                type: "success"
                                            }).then(function() {
                                                window.location = "account-details.php";
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

</body>
</html>

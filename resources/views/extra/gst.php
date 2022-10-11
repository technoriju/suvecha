<?php

  ob_start();

?>

<?php

 error_reporting(0);

 include_once "conn.php";

 $page="gst";

 $page2="master";

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

    <section class="pcoded-main-container">

        <div class="pcoded-wrapper">

            <div class="pcoded-content">

                <div class="pcoded-inner-content">

                    

                    <div class="main-body">

                        <div class="page-wrapper">

                            

                                <?php

                                 if($_GET[del])

                                 {

                                   $del=mysqli_query($con,"delete from `gst` where `gst_id`='$_GET[del]'");

                                   if($del){ header("location:gst.php"); } 

                                 }

                                ?>

            <div class="row">

                                <div class="col-sm-12">

                    <div class="card">

                        <div class="card-header">

                            <h5>Add GST/IGST</h5>

                        </div>

                        <div class="card-body">

                            <form action="" method="post">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="exampleInputEmail1">GST %</label>

                                            <input name="gst" type="text" class="form-control" id="" placeholder="Put only Number" required>

                                        </div>                                       

                                        <button type="submit" name="sub" value="submit" class="btn btn-primary">Submit</button> 

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                                    <?php

                                      if($_POST['sub']=="submit")

                                      {

                                        $gst=htmlspecialchars($_POST['gst']);

                                        $val=$gst/100;

                                        $qry=mysqli_query($con,"insert into `gst` values('','GST@$gst%','$val')");

                                    ?>

                                          <script>              

                                              swal({

                                                    title: "Great job!",

                                                    text: "GST Data Inserted!",

                                                    type: "success"

                                                }).then(function() {

                                                    window.location = "gst.php";

                                                });

                                          </script>

                                           

                                    <?php  }

                                    ?>

                                    <!-- Input group -->

                                    

                                </div>

                            </div>

                                <div class="col-xl-12">

                                    <div class="card">

                                        <div class="card-header">

                                            <div class="row">

                                                <div class="col-sm-8">

                                                    <h5>All Unit List</h5>

                                                </div>                                               

                                        </div>

                                        <div class="card-block table-border-style">

                                            <div class="table-responsive">

                                                <table class="table table-hover">

                                                    <thead>

                                                        <tr>

                                                            <th>Sl No</th>                              

                                                            <th>GST</th>               

                                                            <th>Action</th>

                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                        <?php

                                                        $c=0;

                                                        $qry=mysqli_query($con,"select * from `gst` order by `gst_id` desc");

                                                        while($row=mysqli_fetch_assoc($qry)) { $c++;

                                                        ?>

                                                        <tr>

                                                            <th scope="row"><?php echo $c ?></th>

                                                            <td><?php echo $row[gst_per] ?></td>

                                                            <td>

                                                                <div class="btn-group mb-2 mr-2">

                                                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>

                                                                    <div class="dropdown-menu">

                                                                        <a class="dropdown-item" href="gst.php?del=<?php echo $row[gst_id] ?>" onclick="return Delete();">Delete</a>

                                                                    </div>

                                                                </div>

                                                            </td>

                                                        </tr><?php } ?>                                      

                                                    </tbody>

                                                </table>

                                            </div>

                                        </div>                                      

                                        

                                        

                                    </div>

                                </div>

                                <!-- [ Hover-table ] end -->



                            </div>

                            <!-- [ Main Content ] end -->

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- [ Main Content ] end -->



    <!-- Required Js -->

    <script>

        function Delete()

        {

            var x=confirm("Are you sure want to Delete?");

            if(x) { return true; } else { return false; } 

        }

    </script>

    <?php include'footer.php'; ?>



</body>

</html>


<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";
 $page="raw-material";
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
                            <!-- [ Main Content ] start -->
                            <!-- <div class="row">
                                <div class="col-md-12 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-user-friends text-primary f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>Total User</h3>
                                                    <h5 class="text-primary mb-0">3682</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-user-friends text-c-green f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>Active User</h3>
                                                    <h5 class="text-c-green mb-0">5855</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xl-4">
                                    <div class="card card-social">
                                        <div class="card-block border-bottom">
                                            <div class="row align-items-center justify-content-center">
                                                <div class="col-auto">
                                                    <i class="fas fa-user-friends text-c-red f-36"></i>
                                                </div>
                                                <div class="col text-right">
                                                    <h3>Inactive user</h3>
                                                    <h5 class="text-c-red mb-0">258</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- [ Hover-table ] start -->
                                <?php
                                 if($_GET[del])
                                 {
                                   $del=mysqli_query($con,"delete from `row_material` where `row_material_id`='$_GET[del]'");
                                   if($del){ header("location:raw-material.php"); } 
                                 }
                                ?>
                                 <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Add Raw-Material</h5>
                                        </div>
                                        <div class="card-body">
                                            <form action="" method="post">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Add Material</label>
                                                            <input name="material" type="text" class="form-control" id="" placeholder="Put Material Name" required>
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
                                        $material=htmlspecialchars($_POST['material']);  
                                        $qry=mysqli_query($con,"insert into `row_material` values('','$material')");
                                    ?>
                                          <script>              
                                              swal({
                                                    title: "Great job!",
                                                    text: "Raw-Material Inserted!",
                                                    type: "success"
                                                }).then(function() {
                                                    window.location = "raw-material.php";
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
                                                <div class="col-sm-4">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-secondary" type="button">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Sl No</th>                              
                                                            <th>Material Name</th>               
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $c=0;
                                                        $qry=mysqli_query($con,"select * from `row_material` order by `row_material_id` desc");
                                                        while($row=mysqli_fetch_assoc($qry)) { $c++;
                                                        ?>
                                                        <tr>
                                                            <th scope="row"><?php echo $c ?></th>
                                                            <td><?php echo $row[material_name] ?></td>
                                                            <td>
                                                                <div class="btn-group mb-2 mr-2">
                                                                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="raw-material.php?del=<?php echo $row[row_material_id] ?>" onclick="return Delete();">Delete</a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr><?php } ?>                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                        <nav aria-label="..." class="ml-4">
                                            <ul class="pagination">
                                                <li class="page-item disabled"><span class="page-link">Previous</span></li>
                                                <li class="page-item"><a class="page-link" href="#!">1</a></li>
                                                <li class="page-item active"><span class="page-link">2<span class="sr-only">(current)</span></span>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#!">Next</a></li>
                                            </ul>
                                        </nav>
                                        
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

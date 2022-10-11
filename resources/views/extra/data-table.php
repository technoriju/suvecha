<?php
  ob_start();
?>
<?php
 error_reporting(0);
 include_once "conn.php";
 $page="bill";
 $page2="bill";
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
                                                    <h5>Add Bill</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body data-tablee">
                                            <table class="table table-hover tablemanager">
                                                <thead>
                                                    <tr>
                                                        <th class="disableSort">Number</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Date</th>
                                                        <th>Points</th>
                                                        <th class="disableFilterBy">Controls</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="prova">1</td>
                                                        <td class="prova">Sara</td>
                                                        <td class="prova">Jackson</td>
                                                        <td class="prova">08-06-1989</td>
                                                        <td class="prova">94</td>
                                                        <td class="prova"><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>John</td>
                                                        <td>Doe</td>
                                                        <td>10-05-1987</td>
                                                        <td>80</td>
                                                        <td><a href="">Edit</a>||<a href="">delete</a>||<a href="">Print</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>3</td>
                                                        <td>Adam</td>
                                                        <td>Johnson</td>
                                                        <td>10-05-1987</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>4</td>
                                                        <td>Jill</td>
                                                        <td>Smith</td>
                                                        <td>11-11-1972</td>
                                                        <td>50</td>
                                                        <td><a href="">Edit</a></td>
                                                    </tr>
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
            firstSort: [
                [3, 0],
                [2, 0],
                [1, 'asc']
            ],
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

    </script>
</body>

</html>

<?php
session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$error = "";
$success = "";

if (isset($_POST['submit'])) {
    if (empty($_POST['c_name'])) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Field Required!</strong>
                        </div>';
    } else {
        $check_cat_query = "SELECT c_name FROM res_category WHERE c_name = :c_name";
        $check_cat_params = [':c_name' => $_POST['c_name']];

        $check_cat = $db->query($check_cat_query, $check_cat_params);

        if ($check_cat->rowCount() > 0) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Category already exists!</strong>
                        </div>';
        } else {
            $insert_cat_query = "INSERT INTO res_category (c_name) VALUES (:c_name)";
            $insert_cat_params = [
                ':c_name' => $_POST['c_name']
            ];

            try {
                $statement = $db->query($insert_cat_query, $insert_cat_params);
                if ($statement) {
                    $success = '<div class="alert alert-success alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    New Category Added Successfully.
                                </div>';
                } else {
                    $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error adding category!</strong>
                            </div>';
                }
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    // Duplicate entry error
                    $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Category already exists!</strong>
                            </div>';
                } else {
                    // Other database error
                    $error = '<div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Error adding category: ' . $e->getMessage() . '</strong>
                            </div>';
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/icon.ico" type="image/x-icon">
    <title>Add Category | Admin</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<body class="fix-header">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <div id="main-wrapper">

        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                    <span><img class="img-rounded" src="images/finallogo-admin.png" alt=""  width="270px;"></span>
                    </a>
                </div>
                <div class="navbar-collapse">

                    <ul class="navbar-nav mr-auto mt-md-0">

                    </ul>

                    <ul class="navbar-nav my-lg-0">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/admin-logo-final.png" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

            <!-- LEFT SIDEBAR -->
        <div class="left-sidebar">

            <div class="scroll-sidebar">

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span class="hide-menu">Stalls</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_restaurant.php">All Stalls</a></li>
                                <li><a href="add_category.php">Add Category</a></li>
                                <li><a href="add_restaurant.php">Add Stall</a></li>

                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menues</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>


                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>

                    </ul>
                </nav>

            </div>

        </div>

        <div class="page-wrapper">
    <div style="padding-top: 10px;"></div>

    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <?php  
                echo $error;
                echo $success;
                ?>

                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Add Stall Category</h4>
                        </div>
                        <form action="" method="post">
                            <div class="form-body">
                                <hr>
                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label">Category</label>
                                            <input type="text" name="c_name" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" name="submit" class="btn btn-success" value="Save">
                                    <a href="add_category.php" class="btn btn-inverse">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Listed Categories</h4>
                    <div class="table-responsive m-t-40">
                        <table id="myTable" class="table table-bordered table-hover table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Category Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM res_category ORDER BY c_id DESC";
                                $categories = $db->query($query);

                                if ($categories->rowCount() > 0) {
                                    while ($rows = $categories->fetch()) {
                                        echo '<tr>
                                                <td>' . $rows['c_name'] . '</td>
                                                <td>' . $rows['date'] . '</td>
                                                <td>
                                                    <a href="delete_category.php?cat_del=' . $rows['c_id'] . '" onclick="return confirm(\'Are you sure?\');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                                        <i class="fa fa-trash-o" style="font-size:16px"></i></a> 
                                                    <a href="update_category.php?cat_upd=' . $rows['c_id'] . '" class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo '<tr>
                                            <td colspan="3"><center>No Categories-Data!</center></td>
                                          </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <?php require "partials/footer.php" ?>

    </div>

    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>


</html>

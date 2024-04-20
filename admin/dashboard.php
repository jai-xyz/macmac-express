
<?php

require '../Database.php';
$config = require '../config.php';

$db = new Database($config['database']);

session_start();

if (!isset($_SESSION["adm_id"])) {
    header('"refresh:1;url=http://localhost:8888/admin"');
    exit();
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
    <title>Dashboard | Admin</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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

        <div class="left-sidebar">

            <div class="scroll-sidebar">

                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a>
                        </li>
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
                                <li><a href="all_menu.php">All Menus</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>

                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>

                    </ul>
                </nav>

            </div>

        </div>

        <div class="page-wrapper">

            <div style="padding-top: 10px;">
            </div>

            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Admin Dashboard</h4>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-home f-s-40 "></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM restaurant";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Stalls</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-cutlery f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM dishes";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Dishes</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-users f-s-40"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM users";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Users</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-shopping-cart f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM users_orders";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Total Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-th-large f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM res_category";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Food Categories</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-spinner f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM users_orders WHERE status = 'in process'";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Processing Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM users_orders WHERE status = 'closed'";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Delivered Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT COUNT(*) AS count FROM users_orders WHERE status = 'rejected'";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $count = $result['count'];
                                            ?>
                                            <h2><?php echo $count; ?></h2>
                                            <p class="m-b-0">Cancelled Orders</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card p-30">
                                    <div class="media">
                                        <div class="media-left meida media-middle">
                                            <span><i class="fa fa-peso-sign f-s-40" aria-hidden="true"></i></span>
                                        </div>
                                        <div class="media-body media-text-right">
                                            <?php
                                            $query = "SELECT SUM(price) AS total_earnings FROM users_orders WHERE status = 'closed'";
                                            $statement = $db->query($query);
                                            $result = $statement->fetch();
                                            $totalEarnings = $result['total_earnings'];
                                            ?>
                                            <h2><?php echo $totalEarnings; ?></h2>
                                            <p class="m-b-0">Total Earnings</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require "partials/footer.php" ?>
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

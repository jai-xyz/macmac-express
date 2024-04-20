<?php
session_start();

error_reporting(0);

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$error = "";
$success = "";
if (isset($_POST['submit'])) {
    // Check if all required fields are filled
    if (empty($_POST['uname']) || empty($_POST['fname']) || empty($_POST['lname']) || empty($_POST['address']) ||  empty($_POST['email']) || empty($_POST['phone'])) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields are required!</strong>
                </div>';
    } else {
        // Update user details
        $uname = filter_input(INPUT_POST, "uname", FILTER_SANITIZE_SPECIAL_CHARS);
        $fname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
        $lname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
        $address =  filter_input(INPUT_POST, "address", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_SPECIAL_CHARS);

        $query = "UPDATE users SET username=:uname, f_name=:fname, l_name=:lname, address=:address, email=:email, phone=:phone";



        $params = array(
            ':uname' => $uname,
            ':fname' => $fname,
            ':lname' => $lname,
            ':address' => $address,
            ':email' => $email,
            ':phone' => $phone,
     
        );

   
        $statement = $db->query($query, $params);

        // Check if the update was successful
        if ($statement) {
            $success = '<div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>User Updated!</strong>
                        </div>';
        } else {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Error updating user!</strong>
                    </div>';
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
                     <title>Update Users | Admin</title>
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

                        <div class="page-wrapper" style="height:1200px;">
                            <div style="padding-top: 10px;">
                                         </div>

                         
                         
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
                                                    <h4 class="m-b-0 text-white">Update Users</h4>
                                                </div>
                                                <div class="card-body">
                                                <?php
                                                    $query = "SELECT * FROM users WHERE u_id = :user_upd";
                                                    $params = array(':user_upd' => $_GET['user_upd']);
                                                    $statement = $db->query($query, $params);
                                                    $newrow = $statement->fetch();
                                                    ?>
                                                   <form action='' method='post'>
    <div class="form-body">
        <hr>
        <div class="row p-t-20">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Username</label>
                    <input type="text" name="uname" class="form-control" value="<?php echo $newrow['username']; ?>" placeholder="Username" autocomplete="off">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-danger">
                    <label class="control-label">First Name</label>
                    <input type="text" name="fname" class="form-control form-control-danger" value="<?php echo $newrow['f_name']; ?>" placeholder="First Name" autocomplete="off">
                </div>
            </div>
        </div>

        <div class="row p-t-20">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Last Name</label>
                    <input type="text" name="lname" class="form-control" placeholder="Last Name" autocomplete="off" value="<?php echo $newrow['l_name']; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-danger">
                    <label class="control-label">Email</label>
                    <input type="text" name="email" class="form-control form-control-danger" value="<?php echo $newrow['email']; ?>" autocomplete="off" placeholder="Email">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Address</label>
                    <input type="text" name="address" class="form-control form-control-danger"  value="<?php echo $newrow['address']; ?>" autocomplete="off" placeholder="Email">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">Phone</label>
                    <input type="text" name="phone" class="form-control form-control-danger" value="<?php echo $newrow['phone']; ?>"  autocomplete="off" placeholder="Phone">
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions">
    <input type="submit" name="submit" class="btn btn-success" value="Save">
        <a href="all_users.php" class="btn btn-inverse">Cancel</a>
    </div>
</form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php require "partials/footer.php" ?>
                                </div>

                            </div>
          
                            

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
                
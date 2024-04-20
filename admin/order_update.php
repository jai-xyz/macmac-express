<?php

session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);


if(strlen($_SESSION['user_id'])==0) { 
    header('location:../login.php');
  } else {
    if(isset($_POST['update'])) {
      $form_id = filter_input(INPUT_GET, "form_id", FILTER_VALIDATE_INT);
      $status =  filter_input(INPUT_POST, "status", FILTER_SANITIZE_SPECIAL_CHARS);
      $remark =  filter_input(INPUT_POST, "remark", FILTER_SANITIZE_SPECIAL_CHARS);
      
      $query1 = $db->query("INSERT INTO remark(frm_id, status, remark) VALUES (:form_id, :status, :remark)", [
        'form_id' => $form_id,
        'status' => $status,
        'remark' => $remark
      ]);
      
      $query2 = $db->query("UPDATE users_orders SET status = :status WHERE o_id = :form_id", [
        'status' => $status,
        'form_id' => $form_id
      ]);
  
      echo "<script>alert('Form details updated successfully');</script>";
    }
  }
  ?>

                <script language="javascript" type="text/javascript">
function f2() {
    window.close();
}
ser

function f3() {
    window.print();
}
                </script>

                <head>
               
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <meta name="description" content="">
                    <meta name="author" content="">
                    <link rel="icon" href="../images/icon.ico" type="image/x-icon">
                    <title>Order Update | Admin</title>
                    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
                    <link href="css/helper.css" rel="stylesheet">
                    <link href="css/style.css" rel="stylesheet">
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

                    <style type="text/css" rel="stylesheet">
                    .indent-small {
                        margin-left: 5px;
                    }

                    .form-group.internal {
                        margin-bottom: 0;
                    }

                    .dialog-panel {
                        margin: 10px;
                    }

                    .datepicker-dropdown {
                        z-index: 200 !important;
                    }

                    .panel-body {
                        background: #e5e5e5;
                        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
                        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
                        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
                        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
                        font: 600 15px "Open Sans", Arial, sans-serif;
                    }

                    label.control-label {
                        font-weight: 600;
                        color: #777;
                    }








                    table {
                        width: 650px;
                        border-collapse: collapse;
                        margin: auto;
                        margin-top: 50px;
                    }


                    tr:nth-of-type(odd) {
                        background: #eee;
                    }

                    th {
                        background: #004684;
                        color: white;
                        font-weight: bold;
                    }

                    td,
                    th {
                        padding: 10px;
                        border: 1px solid #ccc;
                        text-align: left;
                        font-size: 14px;
                    }
                    </style>
                </head>

                <body>
              
                    <div style="margin-left:50px;">
                        <form name="updateticket" id="updatecomplaint" method="post">




                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><b>Form Number</b></td>
                                    <td><?php echo htmlentities($_GET['form_id']); ?></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>

                                    <td>&nbsp;</td>
                                </tr>

                                <tr>
                                    <td><b>Status</b></td>
                                    <td><select name="status" required="required">
                                            <option value="">Select Status</option>
                                            <option value="in process">On the way</option>
                                            <option value="closed">Delivered</option>
                                            <option value="rejected">Cancelled</option>

                                        </select></td>
                                </tr>

                                <tr>
                                    <td><b>Message</b></td>
                                    <td><textarea name="remark" cols="50" rows="10" ></textarea></td>
                                </tr>

                                <tr>
                                    <td><b>Action</b></td>
                                    <td><input type="submit" name="update" class="btn btn-success" value="Submit">

                                        <input name="Submit2" type="submit" class="btn btn-danger" value="Close this window " onClick="return f2();" style="cursor: pointer;" />
                                    </td>
                                </tr>


                            </table>
                        </form>
                    </div>

                </body>


                </html>

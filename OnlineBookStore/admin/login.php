<?php
include('../includes/connect.php');
@session_start();
if (isset($_POST['Admin_login'])) {
    $user_name = $_POST['Admin_name'];
    $user_pass = $_POST['Admin_password'];
    $select = "SELECT * FROM `admin` WHERE 	admin_name='$user_name'";
    $result = mysqli_query($con, $select);
    if ($result) 
    {
        $row_data = mysqli_fetch_assoc($result);
        if ($row_data) {
            $row_count = 1;
            $user_id = $row_data['admin_id'];

            if ($user_pass == $row_data['password']) {
                $_SESSION['admin_id'] = $user_id;
                $_SESSION['admin_name'] = $user_name;
                $id = $_SESSION['admin_id'];
                echo "<script>window.open('index.php','_self')</script>";
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Error:</strong>Invalid passowrd.
                 
              </div>';
            }

        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>Error:</strong>invalid credientials.
             
          </div>';
        }
       
        
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"
        integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="/Plugins/icon/favicon.ico" type="image/x-icon" />
    <title>Admin login</title>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container mt-4 p-0">
        <h2 class="text-center mt-2 mb-2">
            Admin login
        </h2>
        <div class="row">
            <div class="col-lg-12 col-xl-12 p-0">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- name -->
                    <div class="form-outline w-50 m-auto mb-3">
                        <label for="Admin_name" class="form-label">Admin_name</label>
                        <input type="text" id="Admin_name" class="form-control" placeholder="enter your Admin_name"
                            name="Admin_name" autocomplete="off" required="required">
                    </div>


                    <!-- passwod -->
                    <div class="form-outline  w-50 m-auto mb-3">
                        <label for="Admin_password" class="form-label">user_password</label>
                        <input type="password" id="Admin_password" class="form-control"
                            placeholder="enter your Admin_password" name="Admin_password" autocomplete="off"
                            required="required">
                    </div>
                    

                    <div class="form-outline w-50 m-auto mb-3">
                        <input type="submit" class="w-100 btn btn-danger" value="Admin_login"
                            class="btn btn-danger mb-3" name='Admin_login' id='Admin_login'>
                        <a href="registration.php" class="mt-2 text-decoration-none fw-bold text-success  ">
                            <p class="mb-5 " mt-2>register</p>
                        </a>
                    </div>


                </form>
            </div>
        </div>
    </div>
</body>

</html>
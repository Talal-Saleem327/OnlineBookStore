<?php
include('includes/connect.php');
include('functions/functions.php');
@session_start();

if (isset($_POST['user_login'])) {
    $user_name = $_POST['user_name'];
    $user_pass = $_POST['user_password'];
    $select = "SELECT * FROM `user` WHERE user_name='$user_name'";
    $result = mysqli_query($con, $select);
    
    if ($result) {
        $row_data = mysqli_fetch_assoc($result);
        
        if ($row_data) {
            $row_count = 1;
            $ip = getIPAddress();
            $user_id = $row_data['user_id'];

            if ($user_pass == $row_data['user_password']) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user_name;
                
                 
               $id = $_SESSION['user_id'];

                $select_cart = "SELECT * FROM `cart_details` WHERE user_id = $id";
                $result_cart = mysqli_query($con, $select_cart);
                $cart_row_count = mysqli_num_rows($result_cart);

                if ($cart_row_count > 0) {
                   
                    echo "<script>window.open('cart.php','_self')</script>";
                     
                } else {
                   
                    echo "<script>window.open('index.php','_self')</script>";
                }
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
    <title>user login</title>
    <style>
        body {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <div class="container mt-4 p-0">
        <h2 class="text-center mt-2 mb-2">
            user login
        </h2>
        <div class="row">
            <div class="col-lg-12 col-xl-12 p-0">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- name -->
                    <div class="form-outline w-50 m-auto mb-3">
                        <label for="user_name" class="form-label">user_name</label>
                        <input type="text" id="user_name" class="form-control" placeholder="enter your user_name"
                            name="user_name" autocomplete="off" required="required">
                    </div>


                    <!-- passwod -->
                    <div class="form-outline  w-50 m-auto mb-3">
                        <label for="user_password" class="form-label">user_password</label>
                        <input type="password" id="user_password" class="form-control"
                            placeholder="enter your user_password" name="user_password" autocomplete="off"
                            required="required">
                    </div>
                     
                  

                    <div class="form-outline w-50 m-auto mb-3">
                        <input type="submit" value="user_login" class="btn btn-danger mb-3" name='user_login'
                            id='user_login'>
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
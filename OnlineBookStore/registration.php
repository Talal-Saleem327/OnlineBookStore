<?php
include('includes/connect.php');
include('functions/functions.php');
if (isset($_POST['user_register'])) {
    $user_name = $_POST['user_name'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $user_confirm_password = $_POST['confirm_password'];
    $hash_passowrd=$user_password;
    $user_address = $_POST['user_address'];
    $user_cell = $_POST['user_cell'];
    $user_img = $_FILES['user_img']['name'];
    $user_temp_img = $_FILES['user_img']['tmp_name'];
    $user_ip_address = getIPAddress();
    $duplicate_check_query = "SELECT * FROM `user` WHERE user_name='$user_name' or user_email = '$user_email'";
    $duplicate_check_result = mysqli_query($con, $duplicate_check_query);

    if (mysqli_num_rows($duplicate_check_result) > 0) {
        echo "<script>alert('This email and username is already registered. Please use a different email.')</script>";
        echo "<script>window.open('registration.php','_self')</script>";
    } elseif ($user_password !== $user_confirm_password) {
        
        echo "<script>alert('Passwords do not match. Please re-enter the passwords.')</script>";
        echo "<script>window.open('registration.php','_self')</script>";
    } else {
       
        move_uploaded_file($user_temp_img, "./user_images/$user_img");
        $insert = "INSERT INTO user (user_name,user_lastname,user_email, user_password, user_img,user_address, user_cell) VALUES ('$user_name','$user_lastname','$user_email', '$hash_passowrd', '$user_img', '$user_address', '$user_cell')";
        $result = mysqli_query($con, $insert);
        if ($result) {
            echo "<script>alert('User inserted in table successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }


    $select_cart_items="SELECT * FROM `cart_details` where ip_address='$user_ip_address'";
    $result_cart=mysqli_query($con, $select_cart_items);
    $cart_row_count=mysqli_num_rows($result_cart);
    if ($cart_row_count > 0) 
    {
        $_SESSION['username']=$user_name;
        echo "<script>alert('you have items in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }
    else{
        echo "<script>window.open('index.php','_self')</script>";
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
    <title>user registration</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-2 mb-2">
            user registration
        </h2>
        <div class="row">
            <div class="col-lg-12 col-xl-12 ">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- name -->
                    <div class="form-outline w-50 m-auto mb-3">
                        <label for="user_name" class="form-label">user_name</label>
                        <input type="text" id="user_name" class="form-control" placeholder="enter your user_name"
                            name="user_name" autocomplete="off" required="required">
                    </div>
                      <!-- last name -->
                      <div class="form-outline w-50 m-auto mb-3">
                        <label for="user_lastname" class="form-label">user_name</label>
                        <input type="text" id="user_lastname" class="form-control" placeholder="enter your user_lastname"
                            name="user_lastname" autocomplete="off" required="required">
                    </div>
                    <!-- email -->
                    <div class="form-outline  w-50 m-auto mb-3">
                        <label for="user_email" class="form-label">user_email</label>
                        <input type="email" id="user_email" class="form-control" placeholder="enter your user_email"
                            name="user_email" autocomplete="off" required="required">
                    </div>
                  
                    <!-- passwod -->
                    <div class="form-outline  w-50 m-auto mb-3">
                        <label for="user_password" class="form-label">user_password</label>
                        <input type="password" id="user_password" class="form-control" placeholder="enter your user_password"
                            name="user_password" autocomplete="off" required="required">
                    </div>
                     <!-- confirm passwod -->
                     <div class="form-outline  w-50 m-auto mb-3">
                        <label for="confirm_password" class="form-label">confirm_password</label>
                        <input type="password" id="confirm_password" class="form-control" placeholder="enter your confirm_password"
                            name="confirm_password" autocomplete="off" required="required">
                    </div>
                      <!-- img -->
                      <div class="form-outline  w-50 m-auto mb-3">
                        <label for="user_img" class="form-label">user_img</label>
                        <input type="file" id="user_img" class="form-control" placeholder="enter your user_img"
                            name="user_img" autocomplete="off" required="required">
                    </div>
                    <!-- address -->
                    <div class="form-outline w-50 m-auto mb-3">
                        <label for="user_address" class="form-label">user_address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="enter your user_address"
                            name="user_address" autocomplete="off" required="required">
                    </div>
                    <!-- cell -->
                    <div class="form-outline w-50 m-auto mb-3">
                        <label for="user_cell" class="form-label">user_cell</label>
                        <input type="text" id="user_cell" class="form-control" placeholder="enter your user_cell"
                            name="user_cell" autocomplete="off" required="required">
                    </div>
                    <div class="form-outline w-50 m-auto mb-3">
                    <input type="submit" value="register" class="btn btn-danger mb-3" name='user_register' id='user_register'>
                    <a href="login.php" class="mt-2 text-decoration-none fw-bold text-success  " ><p class="mb-5 " mt-2>already have an account.login</p></a>
                    </div>

                   
                </form>
            </div>
        </div>
    </div>
</body>

</html>
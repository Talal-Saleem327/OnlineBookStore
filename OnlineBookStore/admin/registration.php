<?php
include('../includes/connect.php');
if (isset($_POST['Admin_register'])) {
    $user_name = $_POST['admin_name'];
    $user_lastname = $_POST['admin_lastname'];
    $user_email = $_POST['Admin_email'];
    $user_password = $_POST['Admin_password'];
    $user_confirm_password = $_POST['confirm_password'];
    $hash_passowrd=$user_password;
    $user_cell = $_POST['Admin_cell'];
    $user_img = $_FILES['Admin_img']['name'];
    $user_temp_img = $_FILES['Admin_img']['tmp_name'];
    $duplicate_check_query = "SELECT * FROM `admin` WHERE admin_name='$user_name' or email = '$user_email'";
    $duplicate_check_result = mysqli_query($con, $duplicate_check_query);

    if (mysqli_num_rows($duplicate_check_result) > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                <strong>Error:</strong>email or username already exist.  
              </div>';
        echo "<script>window.open('registration.php','_self')</script>";
    } elseif ($user_password !== $user_confirm_password) {
        
        echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
        <strong>Error:</strong>confirm password doesnot match.TRY AGAIN.  
      </div>';
        echo "<script>window.open('registration.php','_self')</script>";
    } else {
       
        move_uploaded_file($user_temp_img, "./admin_images/$user_img");
        $insert = "INSERT INTO `admin` (admin_name,last_name,email,password,cell,img) VALUES ('$user_name','$user_lastname','$user_email','$user_password','$user_cell','$user_img')";
        $result = mysqli_query($con, $insert);
        if ($result) {
            echo "<script>alert('Admin inserted in table successfully')</script>";
        } else {
            die(mysqli_error($con));
        }
    }
    
    echo "<script>window.open('login.php','_self')</script>";
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
    <title>Admin registration</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-2 mb-2">
            Admin registration
        </h2>
        <div class="row">
            <div class="col-lg-12 col-xl-12 ">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- name -->
                    <div class="form-outline w-50 m-auto mb-3">
                        <label for="admin_name" class="form-label">admin_name</label>
                        <input type="text" id="admin_name" class="form-control" placeholder="enter your admin_name"
                            name="admin_name" autocomplete="off" required="required">
                    </div>
                      <!-- last name -->
                      <div class="form-outline w-50 m-auto mb-3">
                        <label for="admin_lastname" class="form-label">admin_last_name</label>
                        <input type="text" id="admin_lastname" class="form-control" placeholder="enter your user_lastname"
                            name="admin_lastname" autocomplete="off" required="required">
                    </div>
                    <!-- email -->
                    <div class="form-outline  w-50 m-auto mb-3">
                        <label for="admin_email" class="form-label">admin_email</label>
                        <input type="email" id="Admin_email" class="form-control" placeholder="enter your Admin_email"
                            name="Admin_email" autocomplete="off" required="required">
                    </div>
                  
                    <!-- passwod -->
                    <div class="form-outline  w-50 m-auto mb-3">
                        <label for="Admin_password" class="form-label">Admin_password</label>
                        <input type="password" id="Admin_password" class="form-control" placeholder="enter your Admin_password"
                            name="Admin_password" autocomplete="off" required="required">
                    </div>
                     <!-- confirm passwod -->
                     <div class="form-outline  w-50 m-auto mb-3">
                        <label for="confirm_password" class="form-label">confirm_password</label>
                        <input type="password" id="confirm_password" class="form-control" placeholder="enter your confirm_password"
                            name="confirm_password" autocomplete="off" required="required">
                    </div>
                      <!-- img -->
                      <div class="form-outline  w-50 m-auto mb-3">
                        <label for="Admin_img" class="form-label">Admin_img</label>
                        <input type="file" id="Admin_img" class="form-control" placeholder="enter your Admin_img"
                            name="Admin_img" autocomplete="off" required="required">
                    </div>
                    
                    <!-- cell -->
                    <div class="form-outline w-50 m-auto mb-3">
                        <label for="user_cell" class="form-label">user_cell</label>
                        <input type="text" id="Admin_cell" class="form-control" placeholder="enter your Admin_cell"
                            name="Admin_cell" autocomplete="off" required="required">
                    </div>
                    <div class="form-outline w-50 m-auto mb-3">
                    <input type="submit" class="w-100 btn btn-danger" value="register" class="btn btn-danger mb-3" name='Admin_register' id='Admin_register'>
                    <a href="login.php" class="mt-2 text-decoration-none fw-bold text-success  " ><p class="mb-5 " mt-2>already have an account.login</p></a>
                    </div>

                   
                </form>
            </div>
        </div>
    </div>
</body>

</html>
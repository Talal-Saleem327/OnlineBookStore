<?php
include('includes/connect.php');
@session_start();
if (!isset($_SESSION['username'])) {
    
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
$user_id1 = $_SESSION['user_id'];
$user_name = $_SESSION['username'];
 
$select_img = "SELECT * FROM `user` WHERE user_name='$user_name'";
$result_img = mysqli_query($con, $select_img);
if ($result_img) {
    $row_img = mysqli_fetch_assoc($result_img);
    if ($row_img) {
        
        $user_pass = $row_img['user_password'];
        $user_img = $row_img['user_img'];
        $lastname = $row_img['user_lastname'];
        $email = $row_img['user_email'];
        $address = $row_img['user_address'];
        $cell = $row_img['user_cell'];
    }
}  
echo"$user_id1";

if (isset($_POST['update'])) {
    $update_id =$_SESSION['user_id'];
    $update_name = (string) $_POST['user_name'];
    $update_lastname = (string) $_POST['last_name'];
    $update_email = (string) $_POST['email'];
    $update_password =(string) $_POST['password'];
    $update_img = $_FILES['user_img']['name'];
    $temp_img = $_FILES['user_img']['tmp_name'];
    $update_address = (string) $_POST['address'];
    $update_cell = (string)$_POST['cell'];

    if (!empty($_FILES['user_img']['name'])) {
        $update_img = $_FILES['user_img']['name'];
        $temp_img = $_FILES['user_img']['tmp_name'];
        move_uploaded_file($temp_img, "./user_images/$update_img");
    } else {
        $update_img = $user_img;
    }

    $select_update = "UPDATE `user` SET user_address='$update_address',user_cell='$update_cell', user_email='$update_email', user_img='$update_img', user_name='$update_name', user_lastname='$update_lastname', user_password='$update_password' WHERE user_id=$update_id";

    $result_update = mysqli_query($con, $select_update);
    
    if ($result_update) {
        echo "<script>alert('User table updated successfully')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <title>Welcome <?php echo $_SESSION['username']?> </title>
    <style>
         .user_img
        {
            width: 100px;
            height: 100px;
            object-fit: contain;
             
        }
    </style>
</head>

<body>
 
    <h3 class="text-center text-success fw-bold mt-4">Edit your account</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline mt-4">
          <input type="text" class="w-50 form-control mx-auto" name='user_name' value='<?php 
          echo"$user_name";?>'>
        </div>
        <div class="form-outline mt-4">
          <input type="text" class="w-50 form-control mx-auto" name='last_name' value='<?php 
          echo"$lastname";?>'>
        </div>
        <div class="form-outline mt-4">
          <input type="email" class="w-50 form-control mx-auto" name='email' value='<?php 
          echo"$email";?>'>
        </div>

        <div class="form-outline mt-4">
          <input type="text" class="w-50 form-control mx-auto" name='password' value='<?php 
          echo"$user_pass";?>'>
        </div>
        <div class="form-outline mt-4 d-flex w-50 m-auto">
           
          <input type="file" class=" form-control mx-auto" name='user_img' value='user img'>
          <img src='./user_images/<?php echo"$user_img"; ?>' class='img-thumbnail mt-3 img-fluid user_img' alt='user_img'>
        </div>
        <div class="form-outline mt-4">
          <input type="text" class="w-50 form-control mx-auto" name='address' value='<?php 
          echo"$address";?>'>
        </div>
        <div class="form-outline mt-4">
          <input type="text" class="w-50 form-control mx-auto" name='cell' value='<?php 
          echo"$cell";?>'>
        </div>
        <div class="form-outline mx-auto d-flex justify-content-center mt-4 mb-5">
           <input type="submit" class="btn btn-success w-50" value="update" name='update'>
        </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>

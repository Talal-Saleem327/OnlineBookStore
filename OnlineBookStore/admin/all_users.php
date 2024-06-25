<?php
include('../includes/connect.php');
@session_start();
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
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
    <meta charset="UTF-8">
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
    <title>Admin</title>
    <style>
        .img
        {
            height: 50px;
            width: 50px;
        }
    </style>
</head>

<body>

    <h1 class="text-center text-success text-uppercase fw-bold">userss info</h1>
    <table class="table table-bordered mt-4">
        <thead class="bg-success text-white text-center">
            <tr>
                <th>serial no</th>
                <th>customer name</th>
                <th>customer email</th>
                <th>customer img</th>
                <th>customer address</th>
                <th>customer cell</th>
                <th>delete</th>
            </tr>
        </thead>
        <tbody class=" text-success text-center">
             
                

                <?php
                  $select="select * from `user`";
                  $result=mysqli_query($con, $select);
                  $serial=1;
                  while($row=mysqli_fetch_array($result))
                  {
                     $id=$row['user_id'];
                     $name=$row['user_name'];
                     $lastname=$row['user_lastname'];
                     $email=$row['user_email'];
                     $img=$row['user_img'];
                     $address=$row['user_address'];
                     $cell=$row['user_cell'];
                     echo"
                     <tr>
                     <th>$serial</th>
                     <th>$name $lastname</th>
                     <th>$email</th>
                     <th><img src='../user_images/$img' class='img' alt='user_img'></th>
                     <th>$address</th>
                     <th>$cell</th>
                     <th><a href='deleteuser.php?userid=$id' class='text-decoration-none'><i class='fas fa-trash text-success'></i></a></th>
                     </tr>
                     ";

                    $serial++;
                  }
                ?>
                
             
              
            
       
            
        </tbody>
    </table>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
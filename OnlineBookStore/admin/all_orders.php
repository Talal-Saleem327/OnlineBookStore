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
</head>

<body>

    <h1 class="text-center text-success text-uppercase fw-bold">Orders info</h1>
    <table class="table table-bordered mt-4">
        <thead class="bg-success text-white text-center">
            <tr>
                <th>serial no</th>
                <th>customer name</th>
                <th>customer invoice id</th>
                <th>amount paid</th>
                <th>no of products</th>
                <th>date</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody class=" text-success text-center">
            <?php
            $select="select * from `user_orders`";
            $result=mysqli_query($con, $select);
            $serial=1;
            while($row=mysqli_fetch_array($result))
            {
               $customerid=$row['user_id'];
               $selectcus="select * from `user` where user_id=$customerid";
               $resultcus=mysqli_query($con, $selectcus);
               $cusdata=mysqli_fetch_array($resultcus);
               $user_name=$cusdata['user_name'];
               $user_lastname=$cusdata['user_lastname'];

               $invoice=$row['invoice_number'];
               $amount=$row['amount_remaining'];
               $productcount=$row['product_total'];
               $date=$row['order_date'];
               $status=$row['order_status'];

               echo"
               <tr>
               <th>$serial</th>
               <th>$user_name $user_lastname</th>
               <th>$invoice</th>
               <th>$amount</th>
               <th>$productcount</th>
               <th>$date</th>
               <th>$status</th>
               ";

                $serial++;
            }
            ?>
       
            </tr>
        </tbody>
    </table>
     
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
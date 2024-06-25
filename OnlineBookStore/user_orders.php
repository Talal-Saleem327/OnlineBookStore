<?php
include('includes/connect.php');
@session_start();
if (!isset($_SESSION['username'])) {

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
    <title>Welcome
        <?php echo $_SESSION['username'] ?>
    </title>
    <style>

    </style>
</head>

<body>

    <h1 class="text-center text-success mt-5">All orders</h1>
    <table class="table table-bordered mt-5">
        <thead class="bg-success  text-uppercase text-light text-center">
            <tr>
                <th>serial no</th>
                <th>amount due</th>
                <th>total products</th>
                <th>invoice number</th>
                <th class="my-auto">date</th>
                <th>complete/uncomplete</th>
                <th>status</th>
                <th>operation</th>
            </tr>
        </thead>
        <tbody class="text-success text-center">
            <?php
            $user_id1 = $_SESSION['user_id'];
            $get_order_details = "select * from `user_orders` WHERE user_id= $user_id1";
            //echo $user_id1;
            $result = mysqli_query($con, $get_order_details);
            $serial = 1;
            while ($order_data = mysqli_fetch_assoc($result))
             {
                $order_id = $order_data['order_id'];
                $amount_due = $order_data['amount_remaining'];
                $total_products = $order_data['product_total'];
                $invoice_number = $order_data['invoice_number'];
                $date = $order_data['order_date'];
                $status = $order_data['order_status'];
                 if($status=='pending')
                 {
                    $status='incomplete';
                 }
                 else{
                    $status='complete';
                 }
                 
                echo "
                <tr>
                <th>$serial</th>
                <th>$amount_due</th>
                <th>$total_products</th>
                <th>$invoice_number</th>
                <th>$date</th>
                
               
                <th>$status</th>";

                if($status=='complete')
                {
                    echo"
                <th>paid</th>
                <th><a href='feedback.php' class= ' text-success'>FEEDBACK</a></th>
                </tr>";
                }
                else{
                echo"
                <th><a href='confirmpayment.php?order_id=$order_id'class= ' text-success'>pay</a></th>
               ";
                echo"<th><a href='online.php?invoice_number=$invoice_number' class='text-success'>remove</a></th> </tr>";
                ;}
                
                
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
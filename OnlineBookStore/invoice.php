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
    <title>pdf
    </title>
    <style>
        .bg {
            background-color: white;
        }
    </style>
</head>

<body class="bg">

    <div class="container">
        <h1 class="text-center text-success mt-5 text-uppercase">
            Invoice
        </h1>
        <div class="mt-3 text-success text-uppercase fw-bold">
        <?php
        if (isset($_GET["invoice_number"])) {
            $invoice = $_GET["invoice_number"];
            $name = $_SESSION['username'];
            $id = $_SESSION['user_id'];
            $select = "select * from `user` where user_id=$id";
            $result = mysqli_query($con, $select);
            $user_data = mysqli_fetch_assoc($result);
            $lastname = $user_data['user_lastname'];
            $cell = $user_data['user_cell'];
            $email = $user_data['user_email'];
            $address = $user_data['user_address'];
            $date = date('Y-m-d');
            echo "
                    <div class='d-flex justify-content-between'>
                    <p>name: $name $lastname</p>
                    <p class='text-end '>invoice number: $invoice</p></div>
                    <div class='d-flex justify-content-between'>
                    <p>email: $email</p>
                    
        
        <p class='text-end '>
            date: $date
        </p>
                    </div>
                    <p>cell: $cell</p>
                    <p>address: $address</p>
                    
                    ";
        }
        ?>

</div>

        <table class="table table-bordered mt-4 p-3">
            <thead class="text-center text-uppercase bg-success text-light">
                <tr>
                    <th>serial no</th>
                    <th>book name</th>
                    <th>quanity</th>
                    <th>price</th>
                    <th>total</th>
                </tr>
            </thead>
            <tbody class="text-center text-uppercase text-success bg-light fw-bold">
                <?php
                if (isset($_GET["invoice_number"])) {
                    $invoice = $_GET["invoice_number"];
                    $name = $_SESSION['username'];
                    $id = $_SESSION['user_id'];
                    $serial = 1;
                    $grandtotal = 0;
                    $select1 = "select * from `pending_order` where invoice_number=$invoice and user_id=$id";
                    $result1 = mysqli_query($con, $select1);
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $bookid = $row1['product_id'];
                        $quantity = $row1['quantity'];

                        $selectproducts = "select * from `products` where product_id = $bookid";
                        $resultproducts = mysqli_query($con, $selectproducts);
                        $products = mysqli_fetch_assoc($resultproducts);
                        $bookname = $products["product_title"];
                        $price = $products["product_price"];
                        $rowprice = $price * $quantity;
                        echo "
                      <tr>
                      <td>$serial</td>
                      <td>$bookname</td>
                      <td>$quantity</td>
                      <td>$price</td>
                      <td>$rowprice</td>
                  </tr>
                      ";
                        $grandtotal += $rowprice;
                        $serial++;
                    }
                }
                ?>

            </tbody>

        </table>
        <p class="text-end mt-4 text-success fw-bold text-uppercase">
            <?php echo "Amount paid: $grandtotal"; ?>
        </p>


    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
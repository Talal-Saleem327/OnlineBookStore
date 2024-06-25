<?php
include('includes/connect.php');
@session_start();
if (!isset($_SESSION['username'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if(isset($_GET["order_id"]))
{
    $order_id=$_GET["order_id"];
    $select="select * from `user_orders` where order_id=$order_id";
    $result=mysqli_query($con,$select);
    $row_data=mysqli_fetch_assoc($result);
    $invoice=$row_data['invoice_number'];
    $amount=$row_data['amount_remaining']; 
}
if(isset($_POST['pay']))
{
    if (!isset($_POST['payemnt_mode']) || ($_POST['payemnt_mode'] !== 'by card' && $_POST['payemnt_mode'] !== 'by cash')) {
        echo '<div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                <strong>Error:</strong> Please select a payment mode (by card or by cash).
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    } else {
    $user_id1 = $_SESSION['user_id'];
    // $invoice1=$_POST['invoice_number'];
    // $amount1=$_POST['amount'];
    $mode=$_POST['payemnt_mode'];
    $insert="insert into `user_payment_details`(user_id,invoice,amount,mode,date,order_id) values($user_id1,$invoice,$amount,'$mode',NOW(),$order_id)";
    $insert_result=mysqli_query($con,$insert);
    if($insert_result) {
        echo "<script>window.open('invoice.php?invoice_number=$invoice', '_blank')</script>";
        echo "<script>window.open('user_profile.php?my_orders', '_self')</script>";
    }
    
    
    else{
        echo"<script>alert('error')</script>";
    }
    $update_orders="update `user_orders` set order_status='completed' where order_id=$order_id";
    $resukt_update=mysqli_query($con,$update_orders);
    $updateorder1="update `pending_order` set order_status='completed' where invoice_number	= $invoice";
    $resukt_update1=mysqli_query($con,$updateorder1);
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
    <title>Welcome
        <?php echo $_SESSION['username'] ?>
    </title>
    <style>

    </style>
</head>

<body class='bg-success text-light text-uppercase text-uppercase'>
 
    <div class="container-fluid">
        <h1 class="text-center  mt-5 text-uppercase">
         confirm payment
        </h1>
        <form action="" method="post">
        <table class="table table-bordered text-light text-uppercase fw-bold text-center mt-3 p-3">
            <thead>
                <tr>
                    <th>serial no</th>
                    <th>book name</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>total price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 if(isset($_GET["order_id"]))
                 {
                     $order_id=$_GET["order_id"];
                     $selectdata="select * from `user_orders` where order_id=$order_id";
                     $resultdata=mysqli_query($con,$selectdata);
                     $rowdata1=mysqli_fetch_array($resultdata);
                     $invoice=$rowdata1['invoice_number'];

                     $select_invoice="select * from `pending_order` where invoice_number=$invoice";
                     $result_invoice=mysqli_query($con,$select_invoice);
                     $serial=1;
                     while($row_invoice=mysqli_fetch_assoc($result_invoice))
                     {
                        $bookid=$row_invoice['product_id'];
                        $quantity=$row_invoice['quantity'];

                        $selectproducts="select * from `products` where product_id = $bookid";
                        $resultproducts=mysqli_query($con,$selectproducts);
                        $products=mysqli_fetch_assoc($resultproducts);
                        $bookname=$products["product_title"];
                        $price=$products["product_price"];
                        $rowprice=$price*$quantity;

                        echo"
                        <tr>
                        <td>$serial</td>
                        <td>$bookname</td>
                        <td>$quantity</td>
                        <td>$price</td>
                        <td>$rowprice</td>
                    </tr>
                        ";
                        $serial++;
                     }
                     
                 }
                ?>
               
            </tbody>
        </table>
          <div class="form-outline my-4 text-center m-auto w-50">
            <label for="">invoice number</label>
          <input type='text' class='w-50 form-control text-center mx-auto' name='invoice_number' value='
          <?php echo"$invoice";?>' disabled>
          </div>
          <div class="form-outline my-4 text-center m-auto w-50">
            <label for="amount" name='label_amount'>total amount</label>
          <input type='text' class='w-50 form-control text-center mx-auto' name='amount' 
          value='<?php echo"$amount";?>' disabled>
          </div>
          <div class="form-outline my-4 text-center m-auto w-50">
            <select name="payemnt_mode" class="text-center form-select w-50 mx-auto" id="payemnt_mode">
                <option>select payment mode</option>
                <option name='by_card'>by card</option>
                <option name='by_cash'>by cash</option>

            </select>
          </div>
          
          <div class="form-outline my-4 text-center m-auto w-50">
          <input type="submit" class="btn btn-warning w-50" value="confirm payemnt" name='pay'>
          </div>
        </form>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
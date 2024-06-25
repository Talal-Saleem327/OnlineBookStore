<?php
 $user_name = $_SESSION['username'];
 $userid = $_SESSION['user_id'];
if(isset($_POST['deluser']))
{
    $delete="delete from `user` where user_id =$userid";
    $result=mysqli_query($con,$delete);
    $deleteorder="delete from `user_orders` where user_id=$userid";
    $result1=mysqli_query($con,$deleteorder);
    $deletepayment="delete from `user_payment_details` where user_id=$userid";
    $result2=mysqli_query($con,$deletepayment);
    $deletecart="delete from `cart_details` where user_id=$userid";
    $result3=mysqli_query($con,$deletecart);
    $deletepending="delete from `pending_order` where user_id=$userid";
    $result4=mysqli_query($con,$deletepending);
    
echo "<script>window.open('logout.php','_self')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2 class="text-center text-success text-uppercase mt-3 fw-bold">delete account</h2>
    <form action="" method="post" class="mt-4">
        <div class="form-outline">
        <input type="submit" class="btn btn-danger form-control fw-bold text-uppercase text-center" value="confirm account deletion" name="deluser">
        </div>
      
    </form>
</body>
</html>
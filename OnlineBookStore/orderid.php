<?php
include('includes/connect.php');
$select="select * from `user_orders`";
$result=mysqli_query($con,$select);
while($row=mysqli_fetch_array($result)){
$id=$row['order_id'];
}
$order_id=$id;
echo "<script>window.open('confirmpayment.php?order_id=$order_id','_self')</script>";
?>
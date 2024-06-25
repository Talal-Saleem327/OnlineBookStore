<?php
session_start();
if (isset($_SESSION['admin_name'])) {
    if (isset($_SESSION['admin_name'])) {
        unset($_SESSION['admin_name']);
    }
    if (isset($_SESSION['admin_name'])) {
        session_destroy();
        
    }
    echo "<script>window.open('index.php','_self')</script>";
  
}
?>
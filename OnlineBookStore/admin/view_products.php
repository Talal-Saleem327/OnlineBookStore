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

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"
        integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <title>Welcome

    </title>
    <style>
        .img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <h1 class="text-center mt-3 text-success text-uppercase">all products</h1>
    <table class="table table-bordered mt-4">
        <thead class="bg-success text-light text-uppercase">
            <tr class="text-center">
                <th>products id</th>
                <th>product title</th>
                <th>product image</th>
                <th>product price</th>
                <th>total sold</th>
                <th>edit</th>
                <th>delete</th>

            </tr>
        </thead>
        <tbody class="text-success text-center fw-bold">
            <?php
            $select = "SELECT * FROM `products`";
            $result = mysqli_query($con, $select);
            $serial = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_image = $row['product_image_1'];
                $product_price = $row['product_price'];
                ?>
                <tr class='text-center'>
                    <td>
                        <?php echo "$serial"; ?>
                    </td>
                    <td>
                        <?php echo "$product_title"; ?>
                    </td>
                    <td><img src='./books_images/<?php echo "$product_image"; ?>' class='img img-fluid' alt='img'></td>
                    <td>
                        <?php echo "$product_price" ?>
                    </td>
                    <td>
                        <?php
                        $select_count = "select * from `pending_order` where	product_id=$product_id and order_status='completed'";
                        $result_count = mysqli_query($con, $select_count);
                        $allproductcount = 0;
                        while ($row_count = mysqli_fetch_assoc($result_count)) {
                            $quanity = $row_count['quantity'];
                            $allproductcount += $quanity;
                        }
                        $count = mysqli_num_rows($result_count);
                        echo "$allproductcount";
                        ?>
                    </td>

                    <td><a href='index.php?edit_products=<?php echo $product_id ?>' class='text-success'><i
                                class='fas fa-edit'></i></a></td>
                    <td><a href='index.php?delete_products=<?php echo $product_id ?>' class='text-success'  ><i
                                class='fas fa-trash'></i></a></td>
                </tr>
                <?php
                $serial++;
            }
            ?>

        </tbody>
    </table>
     



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>
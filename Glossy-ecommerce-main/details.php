<?php 
include 'navbar.php';
$con = mysqli_connect('localhost','root');
mysqli_select_db($con, 'glossy');
$id = $_GET['id'];
$sql = "SELECT * FROM `products` WHERE id='$id'";
$featured = $con->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title> Glossy - Shop </title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/details.css"/>
    <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<!-- <div class="col-md-2"></div> -->
    <h2 class="text-center">Product Details</h2>
    <hr style="width: 80%; margin: 10px auto;">
    <div class="container">
        <?php 
            while($product = mysqli_fetch_assoc($featured)):
        ?>
        <div class="part-1">
            <img src="<?= $product['image'];?>" alt="<?= $product['title']; ?>" width="200px" height="200px"/>
        </div>
        <div class="part-2">
            <h2><?= $product['title'] ?></h2>
            <p class="lprice">$ <?=$product['price']; ?></p>
            <p class="bname">Brand: <b><?=$product['brandname']; ?></b></p>
            <p class="desc"><b>Description</b>: <?=$product['description']; ?></p>
        </div>
          <?php endwhile; ?>
    </div>
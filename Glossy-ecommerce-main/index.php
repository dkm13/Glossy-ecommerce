<?php include 'navbar.php';
$con = mysqli_connect('localhost','root');
mysqli_select_db($con, 'glossy');
$sql = "SELECT * FROM `products`";
$featured = $con->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title> Glossy - Shop </title>
    <link rel="stylesheet" href="styles/style.css"/>
    <script src="https://ajax.com.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  

    <form class="d-flex" method="GET" action="search.php">
        <input class="form-control me-2" name="query" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" name="sub" type="submit" onclick="submit()">Search</button>
    </form>


<!-- <div class="col-md-2"></div> -->

<h2 class="text-center">Top products</h2><br/>
<div class="container">
    <div class="products">
        <?php 
            while($product = mysqli_fetch_assoc($featured)):
        ?>
        <div class="product">
            <h4><?= $product['title'];?></h4>
            <img src="<?= $product['image'];?>" alt="<?= $product['title']; ?>" width='200px' height='200px'/>
            <p class="lprice"><b>$ <?=$product['price']; ?></b></p>
            <a href="details.php?id=<?= $product['id'] ?>">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#details-1" >More</button>
            </a>
        </div>
          <?php endwhile; ?>
    </div>
</div>

</body>
</html>
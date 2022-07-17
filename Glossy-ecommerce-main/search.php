<?php 
include 'navbar.php';
$searchquery = $_GET['query'];
$con = mysqli_connect('localhost','root');
mysqli_select_db($con, 'glossy');
$sql = "SELECT * FROM `products` WHERE `title` LIKE '%$searchquery%'";
$featured = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/search.css"/>
    <title>Document</title>
</head>
<body>
    <h2>Search results for: <?php echo $searchquery ?></h2>

    <div class="container" style="width: 85%">
    <div class="products">
        <?php 
            while($product = mysqli_fetch_assoc($featured)):
        ?>
        <div class="product" style="width: 50%">
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
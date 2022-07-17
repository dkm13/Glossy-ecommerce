<?php

session_start();

$mysqli = new mysqli("localhost", "root", "", "glossy");

     //cookies
if(isset($_COOKIE['is_logged_in'])){
    if(isset($_COOKIE['user_email'])) {
        // echo "Welcome " . $_COOKIE['user_email'] . " " . '<a href="?action=logout">Logout</a>';
        // echo "<br/> You are the administartor";
    }
}else{
    header("location: login.php");
}

if(isset($_GET['action'])){
    if($_GET['action'] === "logout"){
        unset($_SESSION['user_email']);
        unset($_SESSION['is_logged_in']);
        session_destroy();

        setcookie("user_email", null, time()-1);
        setcookie("is_logged_in", null, time()-1);

        header("location: login.php");
    }
}


//db

if($mysqli->connect_errno == 0) {
    // READ
    $sql = "SELECT * FROM `products`";
    $result = $mysqli->query($sql);
    $results = [];
    
    if($result->num_rows) {
        while($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        echo "Table is empty!";
    }

    // search form
}


//delete
if(isset($_GET['action']) && isset($_GET['id'])) {
    if($_GET['action'] == "delete") {
        $ids = $_GET['id'];
        $sql = "DELETE FROM `products` WHERE `id`=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->execute([$ids]);
        
        if($stmt->execute([$ids])) {
            header("Location: ?action=delete&status=1");
        } else {
            header("Location: ?action=delete&status=0");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles/log-styles.css"/>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<!-- 

navbar
-->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
     <img src="images/logo.svg" class="img-fluid" width="200px" height="90px" alt="logo">
  </div>
</nav>

<a class="btn btn-success" href="?action=logout">Logout</a>
<a class="btn btn-success" href="add.php">Add product</a>



<h1>Table</h1>
    <hr/>
    <?php if(count($results )): ?>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Price</th>
            <th>Brand</th>
            <th>Image</th>
            <th>description</th>
            <th></th>
        </tr>
        <?php foreach($results as $row): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['title'] ?></td>
            <td><?= $row['price'] ?></td>
            <td><?= $row['brandname'] ?></td>
            <td><?= $row['image'] ?></td>
            <td><?= $row['description'] ?></td>
            <td><a href="?action=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-link">
               Delete
             </a></td> 
        </tr>
         <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>
</body>

</body>
</html>
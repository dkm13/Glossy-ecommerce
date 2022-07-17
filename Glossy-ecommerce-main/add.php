<?php 


session_start();

$mysqli = new mysqli("localhost", "root", "", "glossy");

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


//create

if(isset($_POST['add_btn'])){
    $title = $_POST['title'];
    $price = $_POST['price'];
    $brandname = $_POST['brandname'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $featured = $_POST['featured'];
    // if(isset($fullname) && !empty($fullname) && isset($diagnose) && !empty($diagnose) && isset($location) && !empty($location) && isset($number) && !empty($number) && isset($date) && !empty($date) && isset($price) && !empty($price)) {
        $sql = "INSERT INTO `products` (`title`, `price`, `brandname`, `image`, `description`, `featured`) VALUES ('$title', '$price', '$brandname', '$image', '$description', '$featured')";
        if($mysqli->query($sql)) {
           header("location: dashboard.php");
        }else{
            echo "something went wrong";
        }
    // }else{
    //     echo "please fill all the fields";
    // }
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


<body  class="text-center">

    <main class="form-signin w-100 m-auto">
    <form method="POST" class="log">
        <h1 class="h3 mb-3 fw-normal">Please Fill all the fields</h1>

        <div class="form-floating">
            <input name="title" type="text" class="form-control" id="floatingInput" placeholder="name@example.com" required>
            <label for="floatingInput">Title</label>
        </div>
        <br/>
        <div class="form-floating">
            <input name="Price" type="number" class="form-control" id="floatingPassword" placeholder="Price" required>
            <label for="floatingPassword">price</label>
        </div>
        <div class="form-floating">
            <input name="brand" type="text" class="form-control" id="floatingPassword" placeholder="text" required>
            <label for="floatingPassword">Brand</label>
        </div>
        <div class="form-floating">
            <input name="image" type="text" class="form-control" id="floatingPassword" placeholder="Image/path" required>
            <label for="floatingPassword">Image</label>
        </div>
        <div class="form-floating">
            <input name="description" type="text" class="form-control" id="floatingPassword" placeholder="description" required>
            <label for="floatingPassword">description</label>
        </div>
        <div class="form-floating">
            <input name="featured" type="number" class="form-control" id="floatingPassword" placeholder="featured" min="1" max="2" required>
            <label for="floatingPassword">featured</label>
        </div>
        <br/>
            <button class="w-100 btn btn-lg btn-primary" name="add_btn" type="submit">Add</button>
    </form>
    </main>


</body>
</html>
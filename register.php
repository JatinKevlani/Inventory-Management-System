<?php
    $message = "";
    if($_POST){
        include('database/connection.php');
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = "INSERT INTO `new_users` VALUES ('$username', '$email', '$password', current_timestamp(), current_timestamp())";
        if($conn->query($query) == TRUE){
            $message = "Registered successfully!\nYour account will be created once admin approves you.";
            header('Location: index.php');
        } else {
            echo "Error : " . $conn->error;
        }
        header('Location: landing.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>singup</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/f28d00d089.js" crossorigin="anonymous"></script>
    <!-- google font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
    </style>
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/style-singup.css">
</head>
<body>
    <div class="container">
        <h1 class="title-h1">Create <br> Account</h1>
        <form action="register.php" method="post">
            <div class="input-box">
                <i class="fas fa-user"></i>
                <input class="name" type="text" name="username" placeholder=" Enter your username" />
                <i class="fas fa-envelope"></i>
                <input class="email" type="email" name="email" placeholder="Enter your email" />
                <i class="fas fa-lock"></i>
                <input class="password" type="password" name="password" placeholder="Create your password" />
            </div>
            <h3 class="title-h3">Sign up</h3>
            <button class="btn" type="submit"><i class="fas fa-arrow-right"></i></button>
        </form>
        <h5 class="title-h5">singup or <a href="login.php">login</a></h5>
    </div>
</body>
</html>
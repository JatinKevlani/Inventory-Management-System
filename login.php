<?php
    session_start();
    $error_message = '';
    if($_POST){
        include('database/connection.php');
        $username = $_POST['username'];
        $password = $_POST['password'];
        $database_name = 'inventory';
        if (!mysqli_select_db($conn, $database_name)) {
            die("Database selection failed: " . mysqli_error($conn));
        }
        $query = "SELECT * FROM users WHERE user_username='$username' AND user_password='$password'";
        $result = $conn->query($query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }  
        if ($result->num_rows > 0) {
            $user = $result->fetch_all()[0];
            $_SESSION['user'] = $user;
            header('Location: index.php');
        } else {
            $query = "SELECT * FROM new_users WHERE user_username='$username' AND user_password='$password'";
            $result = $conn->query($query);
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            if ($result->num_rows > 0){
                $error_message = "User already registered! Please wait for admin approval.";
            } else {
                $error_message = "Invalid username or password!";
            }
        }
        $conn->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/f28d00d089.js" crossorigin="anonymous"></script>
    <!-- google font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
    </style>
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style-login.css">
</head>
<body>
    <div class="container">
        <h1 class="title-h1">Login</h1>
        <form action="login.php" method="post">
            <i class="fas fa-envelope"></i>
            <div class="input-box">
                <input class="email" type="text" name="username" placeholder="Enter your username" />
                <i class="fas fa-lock"></i>
                <input class="password" type="password" name="password" placeholder="Enter your password" />
            </div>
            <?php if(!empty($error_message)) { ?>
                <div class="errorMessage">
                    <p><strong>Error :</strong> <?= $error_message ?></p>
                </div>
            <?php } ?>
            <h3 class="title-h3">Login</h3>
            <button class="btn" type="submit"><i class="fas fa-arrow-right"></i></button>
        </form>
        <h5 class="title-h5">Login or <a href="register.php">Sign up</a></h5>
    </div>
</body>
</html>
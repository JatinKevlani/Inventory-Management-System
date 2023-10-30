<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>singup</title>
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/f28d00d089.js" crossorigin="anonymous"></script>
    <!-- google font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
    </style>
    <!-- Custom Styles -->
    <link rel="stylesheet" href="style-singup.css">
</head>
<body>
    <div class="container">
        <h1 class="title-h1">Create <br> Account</h1>
        <form action="#" method="get" accept-charset="utf-8">
            <div class="input-box">
                <i class="fas fa-user"></i>
                <input class="name" type="text" name="name" placeholder=" Enter your username" />
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
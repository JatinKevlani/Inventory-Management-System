<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        $user = array();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= isset($user[1]) ? "User : $user[1]<a href='logout.php'>logout</" : "<a href='register.php'>Signup</a><a href='login.php'>Login</a>" ?>
</body>
</html>
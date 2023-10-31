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
    <?php if(isset($user[1])){ ?>
        <p>User : <?= $user[1]?></p>
        <a href="logout.php">Logout</a>
    <?php } ?>
</body>
</html>
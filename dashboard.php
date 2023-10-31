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
    <title>IMS - Dashbord</title>
</head>
<body>
    <?php if (isset($user[1])) { ?>
        <a href="logout.php">Logout</a>
        <ul>
            <li>ID : <?= $user[0]?></li>
            <li>Username : <?= $user[1]?></li>
            <li>Email : <?= $user[2]?></li>
            <li>Password : <?= $user[3]?></li>
            <li>Created at : <?= $user[4]?></li>
            <li>Updated at : <?= $user[5]?></li>
        </ul>
    <?php } ?>
</body>
</html>
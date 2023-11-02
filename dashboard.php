<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        $user = array();
    }
    if(!isset($user[1])){
        echo "<h1>Please <a href='login.php'>Login</a> first</h1>";
    }
    else{
        include('database/connection.php');
        $database_name = 'inventory';
        if (!mysqli_select_db($conn, $database_name)) {
            die("Database selection failed: " . mysqli_error($conn));
        }
        $query = "SELECT * FROM products";
        $result = $conn->query($query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        $data = $result->fetch_all();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <?php if(isset($user[1])) { ?>
        <p>
            <h1>Hello, <?= $user[1]?></h1> <br>
            User ID : <?= $user[0]?> <br>
            Email : <?= $user[2]?> <br>
            Password : <?= $user[3]?> <br>
            Created at : <?= $user[4]?> <br>
            Updated at : <?= $user[5]?> <br>
        </p>
        <a href="logout.php">Logout</a>
        <?php if(isset($data)) { ?>
            <div class="products">
                <table>
                    <thead>
                        <tr>
                            <th>Prod ID</th>
                            <th>Prod Category</th>
                            <th>Prod Brand</th>
                            <th>Prod Name</th>
                            <th>Prod Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $product) { ?>
                            <tr>
                                <td><?= $product[0] ?></td>
                                <td><?= $product[1] ?></td>
                                <td><?= $product[2] ?></td>
                                <td><?= $product[3] ?></td>
                                <td><?= $product[4] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    <?php } ?>
</body>
</html>
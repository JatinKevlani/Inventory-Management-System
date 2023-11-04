<?php
    $newusername = $_POST['rejectusername'];
    var_dump($newusername);
    include('database/connection.php');
    $query = "DELETE FROM new_users WHERE user_username='$newusername'";
    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    header('Location: admin/index.php');
?>
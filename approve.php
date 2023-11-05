<?php
    $newusername = $_POST['approveusername'];
    include('database/connection.php');
    $query = "SELECT * FROM new_users WHERE user_username='$newusername'";
    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $query = "INSERT INTO users (user_username, user_email, user_password, user_created_at, user_updated_at) SELECT * FROM new_users WHERE user_username = '$newusername'";
    $conn->query($query);
    $query = "DELETE FROM new_users WHERE user_username = '$newusername'";
    $conn->query($query);
    header('Location: admin/index.php#user-approve');
    exit;
?>
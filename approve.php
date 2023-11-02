<?php
    $newusername = $_POST['approveusername'];
    include('database/connection.php');
    $database_name = 'inventory';
    if (!mysqli_select_db($conn, $database_name)) {
        die("Database selection failed: " . mysqli_error($conn));
    }
    $query = "SELECT * FROM new_users WHERE user_username='$newusername'";
    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $query = "INSERT INTO users (user_username, user_email, user_password, user_created_at, user_updated_at) SELECT * FROM new_users WHERE user_username = '$newusername'";
    $conn->query($query);
    $query = "DELETE FROM new_users WHERE user_username = '$newusername'";
    $conn->query($query);
    header('Location: admin_approval.php');
?>
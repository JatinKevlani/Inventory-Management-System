<?php
    $newusername = $_POST['rejectusername'];
    include('database/connection.php');
    $database_name = 'inventory';
    if (!mysqli_select_db($conn, $database_name)) {
        die("Database selection failed: " . mysqli_error($conn));
    }
    $query = "DELETE FROM new_users WHERE user_username='$newusername'";
    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    header('Location: admin_approval.php');
?>
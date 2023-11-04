<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        die("Please <a href='login.php'>Login</a> First");
    }
    if($user[1] != "admin"){
        die("You don't have access to this page!");
    }
    include('database/connection.php');
    $database_name = 'inventory';
    if (!mysqli_select_db($conn, $database_name)) {
        die("Database selection failed: " . mysqli_error($conn));
    }
    $query = "SELECT * FROM new_users";
    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    $data = $result->fetch_all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin approval</title>
    <style>
        .approvehiddenform {
            display: none;
        }
        .rejecthiddenform {
            display: none;
        }
    </style>
</head>
<body>
    <?php if(isset($data)) { ?>
        <div class="new_users">
            <table border="4">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $value) { ?>
                        <tr>
                            <td><?= $value[0] ?></td>
                            <td><?= $value[1] ?></td>
                            <td><?= $value[3] ?></td>
                            <td><button onclick="approve_user('<?= $value[0] ?>')">Approve</button></td>
                            <td><button onclick="reject_user('<?= $value[0] ?>')">Reject</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
    <form action="approve.php" class="approvehiddenform" method="post">
        <textarea name="approveusername" id="approveusername" cols="30" rows="10"></textarea>
    </form>
    <form action="reject.php" class="rejecthiddenform" method="post">
        <textarea name="rejectusername" id="rejectusername" cols="30" rows="10"></textarea>
    </form>
    <script>
        function approve_user(username){
            if(confirm(`Are you sure you want to approve ${username} user?`)){
                alert("User added successfully!");
                document.getElementById("approveusername").value = username;
                document.querySelector(".approvehiddenform").submit();
            }
        }
        function reject_user(username){
            if(confirm(`Are you sure you want to reject ${username} user?`)){
                alert("User rejected successfully!");
                document.getElementById("rejectusername").value = username;
                document.querySelector(".rejecthiddenform").submit();
            }
        }
    </script>
</body>
</html>
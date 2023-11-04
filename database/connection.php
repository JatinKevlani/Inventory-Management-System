<?php
    $server_name = 'localhost';
    $username = 'root';
    $password = '';
    $database_name = 'inventory';
    // Connecting to database.
    try{
        $conn = mysqli_connect($server_name, $username, $password, $database_name);
    }catch(\Exception $e){
        $error_message = $e->getMessage();
    }
?>
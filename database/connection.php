<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    // Connecting to database.
    try{
        $conn = mysqli_connect($servername, $username, $password);
    }catch(\Exception $e){
        $error_message = $e->getMessage();
    }
?>
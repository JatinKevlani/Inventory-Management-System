<?php 
    if ($_POST){
        include('../database/connection.php');
        $prod_name = $_POST['productName'];
        $supp_name = $_POST['supplier_name'];
        $prod_category = $_POST['Category'];
        $prod_price = $_POST['price'];
        $prod_brand = $_POST['brand'];
        $prod_quantity = $_POST['quantity'];
        $prod_type = $_POST['hiddentype'];
        // var_dump($prod_name . "<br>" . $supp_name . "<br>" . $prod_category . "<br>" . $prod_price . "<br>" . $prod_brand . "<br>" . $prod_quantity . "<br>" . $prod_type);
        function RandomString()
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randstring = '';
            for ($i = 0; $i < 5; $i++) {
                $randstring .= $characters[rand(0, strlen($characters))];
            }
            return $randstring;
        }

        $randstring = RandomString();
        // echo $randstring;
        var_dump($randstring);
        date_default_timezone_set('Asia/Calcutta');
        $date = date('Y-m-d H:i:s');
        // var_dump($date);
        // die;
        $query = "INSERT INTO products (prod_code, prod_type, prod_category, prod_brand, prod_name, prod_price, prod_quantity, prod_supp_date) VALUES ('$randstring', '$prod_type', '$prod_category', '$prod_brand', '$prod_name', '$prod_price', '$prod_quantity', '$date')";
        $result = $conn->query($query);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        header('Location: index.php');
    }
?>
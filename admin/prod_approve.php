<?php
$reqid = $_POST['reqid'];
// var_dump($reqid);
$boool = $_POST['reqbool'];
// var_dump($boool);
$supqty = $_POST['supqty'];
// var_dump($supqty);

include('../database/connection.php');
if ($boool) {
    $query = "SELECT * FROM requests WHERE req_id = $reqid";
    $result = $conn->query($query);
    var_dump($result);
    $req_tab_data_fetched = $result->fetch_all();
    $req_tab_data = $req_tab_data_fetched[0];
    var_dump($req_tab_data_fetched);
    var_dump($req_tab_data);
    date_default_timezone_set('Asia/Calcutta');
    $date = date('Y-m-d H:i:s');
    echo $date;
    $query = "INSERT INTO transactions VALUES ('$req_tab_data[0]', '$req_tab_data[1]', '$req_tab_data[2]', '$req_tab_data[3]', '$supqty', '$date')";
    $result = $conn->query($query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    // $query = "DELETE FROM requests WHERE req_id = $reqid";
    // $result = $conn->query($query);
    // if (!$result) {
    //     die("Query failed: " . mysqli_error($conn));
    // }

}
?>
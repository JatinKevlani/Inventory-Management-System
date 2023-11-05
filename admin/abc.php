<?php
session_start();
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
} else {
  die("Please <a href='../login.php'>Login</a> First");
}
if ($user[1] != "admin") {
  die("You don't have access to this page!");
}
include('../database/connection.php');
$query = "SELECT * FROM new_users";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$user_data = $result->fetch_all();
$query = "SELECT * FROM products WHERE prod_type = 'Expandable'";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$expandable_products_data = $result->fetch_all();
$query = "SELECT * FROM products WHERE prod_type = 'Consumable'";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$consumable_products_data = $result->fetch_all();
$query = "SELECT * FROM products WHERE prod_type = 'Furniture'";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$furniture_products_data = $result->fetch_all();
$query = "SELECT * FROM requests";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$req_table_data = $result->fetch_all();
$query = "SELECT requests.user_id, users.user_username FROM requests JOIN users ON requests.user_id = users.user_id;";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$req_table_user = $result->fetch_all();
$query = "SELECT * FROM supplier";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$supplier_data = $result->fetch_all();
$query = "SELECT * FROM transactions";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$transaction_data = $result->fetch_all();
$query = "SELECT COUNT(*) FROM requests";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$number_of_requests_fetched = $result->fetch_all();
$number_of_requests = $number_of_requests_fetched[0];
$query = "SELECT COUNT(*) FROM supplier";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$number_of_suppliers_fetched = $result->fetch_all();
$number_of_suppliers = $number_of_requests_fetched[0];
$query = "SELECT COUNT(*) FROM new_users";
$result = $conn->query($query);
if (!$result) {
  die("Query failed: " . mysqli_error($conn));
}
$number_of_pending_users_fetched = $result->fetch_all();
$pending_users_count = $number_of_pending_users_fetched[0];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" page="IE=edge" />
  <meta name="viewport" page="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <title>Admin Panel</title>
</head>

<body>
  <!-- top navigation bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas"
        data-bs-target="#sidebar" aria-controls="offcanvasExample">
        <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
      </button>
      <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Inventory management System</a>
      <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="collapse"
        data-bs-target="#topNavBar" aria-controls="topNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="topNavBar">
        <form class="d-flex ms-auto my-3 my-lg-0">
          <div class="input-group">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
            <button class="btn btn-primary" type="submit">
              <i class="bi bi-search"></i>
            </button>
          </div>
        </form>
        <p id="username-text" class="text-white" style="padding-top: 13px; padding-left: 10px;">Hello,
          <?= $user[1] ?>
        </p>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item product-nav" href="#profile">Profile</a></li>
              <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- top navigation bar -->
  <!-- offcanvas -->
  <div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-body p-0">
      <nav class="navbar-dark">
        <ul class="navbar-nav">
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3">
              TOOLS
            </div>
          </li>
          <li>
            <a href="#dashboard" class="product-nav nav-link px-3 active">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a href="#requests" class="product-nav nav-link px-3 active">
              <span class="me-2"><i class="bi bi-speedometer2"></i></span>
              <span>Supplies Request</span>
            </a>
          </li>
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Interface
            </div>
          </li>
          <li>
            <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#layouts">
              <span class="me-2"><i class="bi bi-layout-split"></i></span>
              <span>Inventory</span>
              <span class="ms-auto">
                <span class="right-icon">
                  <i class="bi bi-chevron-down"></i>
                </span>
              </span>
            </a>
            <div class="collapse" id="layouts">
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="#expandableProducts" class="product-nav nav-link px-3">
                    <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                    <span>Expandable Products</span>
                  </a>
                </li>
                <li>
                  <a href="#consumableProducts" class="product-nav nav-link px-3">
                    <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                    <span>Consumable Products</span>
                  </a>
                </li>
                <li>
                  <a href="#furnitureProducts" class="product-nav nav-link px-3">
                    <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                    <span>Furniture Products</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a class="product-nav nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#allocatedInventory">
              <span class="me-2"><i class="bi bi-layout-split"></i></span>
              <span>Allocated Inventory</span>
            </a>
          </li>
          <li>
            <a href="#suppliers" class="product-nav nav-link px-3">
              <span class="me-2"><i class="bi bi-book-fill"></i></span>
              <span>Suppliers</span>
            </a>
          </li>
          <li class="my-4">
            <hr class="dropdown-divider bg-light" />
          </li>
          <li>
            <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
              Addons
            </div>
          </li>
          <li>
            <a href="#user-approve" class="product-nav nav-link px-3">
              <span class="me-2"><i class="bi bi-graph-up"></i></span>
              <span>Users</span>
            </a>
          </li>
          <li>
            <a href="#records" class="product-nav nav-link px-3">
              <span class="me-2"><i class="bi bi-table"></i></span>
              <span>Records</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- offcanvas -->
  <main class="mt-5 pt-3">
    <!-- <div id="dashboard" class="page container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4 style="padding-top: 15px;">Dashboard</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 mb-3">
          <div class="card bg-primary text-white h-100">
            <div class="card-body">
              <div class="d-flex flex-row justify-content-between align-items-center">
                <p class="fs-4" style="padding-right: 25px;">Inventory Items</p>
                <div class="flex-grow-1 justify-content-center align-items-center">
                  <h1 class="display-2">42</h1>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex">
              <a href="#invItem"></a>
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-3">
          <div class="card bg-warning text-dark h-100">
            <div class="card-body py-5">Turnover</div>
            <div class="card-footer d-flex">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-success text-white h-100">
            <div class="card-body py-5">Total employees</div>
            <div class="card-footer d-flex">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
        <div class="col-md-3 mb-3">
          <div class="card bg-danger text-white h-100">
            <div class="card-body py-5">User requests</div>
            <div class="card-footer d-flex">
              View Details
              <span class="ms-auto">
                <i class="bi bi-chevron-right"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 offset-md-2 mb-3">
          <div class="card h-100">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Sales in Last week
            </div>
            <div class="card-body">
              <canvas class="chart" width="400" height="200"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-plus"></i></span> Add new data
            </div>
            <div class="card-body">
              <form action="#" method="post" class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name:</label>
                      <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="position">Position:</label>
                      <input type="text" id="position" name="position" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="office">Office:</label>
                      <input type="text" id="office" name="office" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="age">Age:</label>
                      <input type="number" id="age" name="age" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="startdate">Start Date:</label>
                      <input type="date" id="startdate" name="startdate" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="salary">Salary:</label>
                      <input type="number" id="salary" name="salary" class="form-control" required>
                    </div>
                  </div>
                </div>
                <input type="submit" value="Submit" class="btn btn-primary " style="margin-top: 15px;">
              </form>
            </div>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span> data Table
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Cedric Kelly</td>
                      <td>Senior Javascript Developer</td>
                      <td>Edinburgh</td>
                      <td>22</td>
                      <td>2012/03/29</td>
                      <td>$433,060</td>
                    </tr>
                    <tr>
                      <td>Airi Satou</td>
                      <td>Accountant</td>
                      <td>Tokyo</td>
                      <td>33</td>
                      <td>2008/11/28</td>
                      <td>$162,700</td>
                    </tr>
                    <tr>
                      <td>Brielle Williamson</td>
                      <td>Integration Specialist</td>
                      <td>New York</td>
                      <td>61</td>
                      <td>2012/12/02</td>
                      <td>$372,000</td>
                    </tr>
                    <tr>
                      <td>Herrod Chandler</td>
                      <td>Sales Assistant</td>
                      <td>San Francisco</td>
                      <td>59</td>
                      <td>2012/08/06</td>
                      <td>$137,500</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
    <div id="dashboard" class="page container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4 style="padding-top: 15px;">Dashboard</h4>
        </div>
      </div>
      <div class="row">


        <div class="col-md-4 mb-4">
          <div class="card bg-warning text-black h-100">
            <div class="card-body">
              <div class="d-flex flex-row justify-content-between align-items-center">
                <p class="fs-4" style="padding-right: 25px;">Pending Supply request</p>
                <div class="flex-grow-1 justify-content-center align-items-center">
                  <h1 class="display-2"><?= $number_of_requests[0] ?></h1>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
              <a href="#requests" class="details-link-black card-redirect">View Details
                <span class="ms-1">
                  <i class=" bi bi-chevron-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card bg-success text-white h-100">
            <div class="card-body">
              <div class="d-flex flex-row justify-content-between align-items-center">
                <p class="fs-4" style="padding-right: 25px;">Suppliers</p>
                <div class="flex-grow-1 justify-content-center align-items-center">
                  <h1 class="display-2"><?= $number_of_suppliers[0] ?>
                  
                </h1>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
              <a href="#suppliers" class="details-link card-redirect">View Details
                <span class="ms-1">
                  <i class=" bi bi-chevron-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card bg-danger text-white h-100">
            <div class="card-body">
              <div class="d-flex flex-row justify-content-between align-items-center">
                <p class="fs-4" style="padding-right: 25px;">Pending User Request</p>
                <div class="flex-grow-1 justify-content-center align-items-center">
                  <h1 class="display-2"><?= $pending_users_count[0] ?></h1>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
              <a href="#user-approve" class="details-link card-redirect">View Details
                <span class="ms-1">
                  <i class=" bi bi-chevron-right"></i>
                </span>
              </a>
            </div>


          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-6">
          <div class="card border-0 bg-primary text-white h-100">
            <div class="card-body border-0">
              <div style="padding-top: 20px;" class="d-flex flex-row justify-content-between align-items-center">
                <p class="fs-4" style="padding-right: 25px;">Inventory Items</p>
                <!-- <div class="flex-grow-1 justify-content-center align-items-center"> -->
                <h1 class="display-2">42</h1>
                <!-- </div> -->
              </div>
            </div>




          </div>
        </div>
        <div class="col-md-6 mb-6">
          <div class="card border-0 bg-primary text-white h-100">
            <div class="card-body">
              <ul class="list-group list-group-flush bg-primary">
                <li class="list-group-item bg-primary text-white ">
                  <div class="d-flex justify-content-between">
                    <p style="font-size: 20px;">Expandable Items</p>
                    <p style="font-size: 20px;">69</p>
                  </div>
                </li>
                <li class="list-group-item bg-primary text-white ">
                  <div class="d-flex justify-content-between">
                    <p style="font-size: 20px;">Expandable Items</p>
                    <p style="font-size: 20px;">69</p>
                  </div>
                </li>
                <li class="list-group-item bg-primary text-white ">
                  <div class="d-flex justify-content-between">
                    <p style="font-size: 20px;">Expandable Items</p>
                    <p style="font-size: 20px;">69</p>
                  </div>
                </li>

              </ul>
            </div>

          </div>
        </div>
      </div>
      <!-- price , deadstock num -->
      <!-- <div style="padding-top: 20px;" class="row">
        <div class="col-md-8 offset-md-2 mb-3">
          <div class="card" style="height: 300px !important;">
            <div class="card-header">
              <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
              Sales in Last week
            </div>
            <div class="card-body">
              <canvas class="chart" width="400" height="200"></canvas>
            </div>
          </div>
        </div>
      </div> -->
      <div style="padding-top:30px;" class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-plus"></i></span> Add new product to the store
            </div>
            <div class="card-body">
              <form action="add_product.php" method="post" class="container" id="addingProd">
                <div class="row">
                  <div class="form-group">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="productName" class="form-control" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label style="padding-top: 10px;" for="name">Supplier Name:</label>
                      <input type="text" id="supplier_name" name="supplier_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label style="padding-top: 10px;" for="Category">Category:</label>
                      <input type="text" id="Category" name="Category" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label style="padding-top: 10px;" for="price">Price:</label>
                      <input type="number" id="price" name="price" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group ">
                      <label style="padding-top: 10px;" for="type">Type of Product</label>
                      <select id="type-select" class="form-select">
                        <option value="Expandable">Expandable</option>
                        <option value="Consumable">Consumable</option>
                        <option value="Furniture">Furniture</option>
                      </select>
                      <div style="display: none;">
                        <textarea name="hiddentype" id="hiddentype" cols="30" rows="10"></textarea>
                      </div>

                    </div>
                    <div class="form-group">
                      <label style="padding-top: 10px;" for="brand">Brand:</label>
                      <input type="text" id="brand" name="brand" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label style="padding-top: 10px;" for="quantity">Quantity:</label>
                      <input type="number" id="quantity" name="quantity" class="form-control" required>
                    </div>
                  </div>
                </div>
                <button onclick="addProd()" value="Submit" class="btn btn-primary "
                  style="margin-top: 15px;">Submit</button>
              </form>
            </div>
          </div>
        </div>

      </div>

    </div>

    </div>
    <div id="expandableProducts" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Expandable Product List
            </div>
            <div class="card-body">
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Code</th>
                      <th>Product Type</th>
                      <th>Product Category</th>
                      <th>Product Brand</th>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Product Quantity</th>
                      <!-- <th>Supplied Date</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($expandable_products_data as $value) { ?>
                      <tr>
                        <td>
                          <?= $value[0] ?>
                        </td>
                        <td>
                          <?= $value[1] ?>
                        </td>
                        <td>
                          <?= $value[2] ?>
                        </td>
                        <td>
                          <?= $value[3] ?>
                        </td>
                        <td>
                          <?= $value[4] ?>
                        </td>
                        <td>
                          <?= $value[5] ?>
                        </td>
                        <td>
                          <?= $value[6] ?>
                        </td>
                        <td>
                          <?= $value[7] ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="consumableProducts" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Consumable Product List
            </div>
            <div class="card-body">
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Code</th>
                      <th>Product Category</th>
                      <th>Product Brand</th>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Product Quantity</th>
                      <!-- <th>Supplied Date</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($consumable_products_data as $value) { ?>
                      <tr>
                        <td>
                          <?= $value[0] ?>
                        </td>
                        <td>
                          <?= $value[1] ?>
                        </td>
                        <td>
                          <?= $value[3] ?>
                        </td>
                        <td>
                          <?= $value[4] ?>
                        </td>
                        <td>
                          <?= $value[5] ?>
                        </td>
                        <td>
                          <?= $value[6] ?>
                        </td>
                        <td>
                          <?= $value[7] ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="furnitureProducts" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Furniture Product List
            </div>
            <div class="card-body">
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Code</th>
                      <th>Product Category</th>
                      <th>Product Brand</th>
                      <th>Product Name</th>
                      <th>Product Price</th>
                      <th>Product Quantity</th>
                      <!-- <th>Supplied Date</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($furniture_products_data as $value) { ?>
                      <tr>
                        <td>
                          <?= $value[0] ?>
                        </td>
                        <td>
                          <?= $value[1] ?>
                        </td>
                        <td>
                          <?= $value[3] ?>
                        </td>
                        <td>
                          <?= $value[4] ?>
                        </td>
                        <td>
                          <?= $value[5] ?>
                        </td>
                        <td>
                          <?= $value[6] ?>
                        </td>
                        <td>
                          <?= $value[7] ?>
                        </td>
                        <td>
                          <?= $value[8] ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="allocatedInventory" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Inventory List
            </div>
            <div class="card-body">
              <div style="margin-bottom: 15px;">
                <label for="department-select" class="form-label">Select Department</label>
                <select id="department-select" class="form-select">
                  <option value="all">All Departments</option>
                  <option value="Computer">Computer Engineering</option>
                  <option value="IT">Information Technology Engineering</option>
                  <option value="Automobilr">Automobile Engineering</option>
                  <option value="Civil">Civil Engineering</option>
                  <option value="Biomedical">Biomedical Engineering</option>
                  <option value="Electronics And Communication">Electronics and Communication Engineering</option>
                  <option value="Electrical">Electrical Engineering</option>
                  <option value="Mechanical">Mechanical Engineering</option>
                </select>

              </div>
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Product Type</th>
                      <th>Product Brand</th>
                      <th>Product Category</th>
                      <th>Product Name</th>
                      <th>Requested Quantity</th>
                      <th>Supplied Quantity</th>
                      <th>Faculty</th>
                      <th>Supplied at</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($transaction_data as $val) { ?>
                      <?php
                      $query = "SELECT prod_type, prod_brand, prod_category, prod_name FROM products WHERE prod_id = $val[2]";
                      $result = $conn->query($query);
                      if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                      }
                      $prod_trans_fetched = $result->fetch_all();
                      $prod_trans = $prod_trans_fetched[0];
                      ?>
                      <td>
                        <?= $prod_trans[0] ?>
                      </td>
                      <td>
                        <?= $prod_trans[1] ?>
                      </td>
                      <td>
                        <?= $prod_trans[2] ?>
                      </td>
                      <td>
                        <?= $prod_trans[3] ?>
                      </td>
                      <?php
                      $query = "SELECT req_prod_quantity FROM requests WHERE req_id = $val[0]";
                      $result = $conn->query($query);
                      if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                      }
                      $req_trans_fetched = $result->fetch_all();
                      $req_trans = $req_trans_fetched[0];
                      ?>
                      <td>
                        <?= $req_trans[0] ?>
                      </td>
                      <td>
                        <?= $val[3] ?>
                      </td>
                      <td>
                        <h1>Work in progress</h1>
                      </td>
                      <td>
                        <?= $val[4] ?>
                      </td>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="user-approve" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Inventory List
            </div>
            <div class="card-body">
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Email</th>
                      <th>Request Date</th>

                      <th class="">Action</th>
                      <!-- <th>Reject</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($user_data as $value) { ?>
                      <tr>
                        <td>
                          <?= $value[0] ?>
                        </td>
                        <td>
                          <?= $value[1] ?>
                        </td>
                        <td>
                          <?= $value[3] ?>
                        </td>
                        <td>
                          <button class="btn btn-success" onclick="approve_user('<?= $value[0] ?>')">
                            <i class="bi bi-check-circle"></i> Approve
                          </button>
                          <button class="btn btn-danger" onclick="reject_user('<?= $value[0] ?>')">
                            <i class="bi bi-x-circle"></i> Reject
                          </button>
                        </td>
                      </tr>
                    <?php } ?>

                    <!-- Add more rows as needed -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="suppliers" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Suppliers List
            </div>
            <div class="card-body">
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Supplier Id</th>
                      <th>Name</th>
                      <th>Area</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($supplier_data as $value) { ?>
                      <tr>
                        <td>
                          <?= $value[0] ?>
                        </td>
                        <td>
                          <?= $value[1] ?>
                        </td>
                        <td>
                          <?= $value[2] ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="requests" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Incoming Supply Requests
            </div>
            <div class="card-body">
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Request Id</th>
                      <th>Username</th>
                      <th>Product Category</th>
                      <th>Product Name</th>
                      <th>Requested Quantity</th>
                      <th>Requested at</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($req_table_data as $value) { ?>
                      <tr>
                        <td>
                          <?= $value[0] ?>
                        </td>
                        <?php
                        $query = "SELECT user_username FROM users WHERE user_id = $value[1]";
                        $result = $conn->query($query);
                        if (!$result) {
                          die("Query failed: " . mysqli_error($conn));
                        }
                        $req_username_fetched = $result->fetch_all();
                        $req_username = $req_username_fetched[0];
                        ?>
                        <td>
                          <?= $req_username[0] ?>
                        </td>
                        <td>
                          <?= $value[2] ?>
                        </td>
                        <td>
                          <?= $value[3] ?>
                        </td>
                        <td>
                          <?= $value[4] ?>
                        </td>
                        <td>
                          <?= $value[5] ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="records" class="page container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 p-4">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-table me-2"></i></span>Records
            </div>
            <div class="card-body">
              <div style="margin-bottom: 15px;">
                <label for="transaction-select" class="form-label">Transaction</label>
                <select id="transaction-select" class="form-select">
                  <option value="all">All</option>
                  <option value="Incoming">Incoming</option>
                  <option value="Outgoing">Outgoing</option>
                </select>

              </div>
              <!-- add jaints table sccript -->
              <div class="table-responsive">
                <table id="example" class="table table-striped data-table" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Request ID</th>
                      <th>Username</th>
                      <th>Product Type</th>
                      <th>Product Brand</th>
                      <th>Product Category</th>
                      <th>Product Name</th>
                      <th>Requested Quantity</th>
                      <th>Supplied Quantity</th>
                      <th>Supplied at</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($transaction_data as $value) { ?>
                      <tr>
                        <td>
                          <?= $value[0] ?>
                        </td>
                        <?php
                        $query = "SELECT user_username FROM users WHERE user_id = $value[1]";
                        $result = $conn->query($query);
                        if (!$result) {
                          die("Query failed: " . mysqli_error($conn));
                        }
                        $username_trans_fetched = $result->fetch_all();
                        $username_trans = $username_trans_fetched[0];
                        ?>
                        <td>
                          <?= $username_trans[0] ?>
                        </td>
                        <?php
                        $query = "SELECT prod_type, prod_brand, prod_category, prod_name FROM products WHERE prod_id = $value[2]";
                        $result = $conn->query($query);
                        if (!$result) {
                          die("Query failed: " . mysqli_error($conn));
                        }
                        $prod_trans_fetched = $result->fetch_all();
                        $prod_trans = $prod_trans_fetched[0];
                        ?>
                        <td>
                          <?= $prod_trans[0] ?>
                        </td>
                        <td>
                          <?= $prod_trans[1] ?>
                        </td>
                        <td>
                          <?= $prod_trans[2] ?>
                        </td>
                        <td>
                          <?= $prod_trans[3] ?>
                        </td>
                        <?php
                        $query = "SELECT req_prod_quantity FROM requests WHERE req_id = $value[0]";
                        $result = $conn->query($query);
                        if (!$result) {
                          die("Query failed: " . mysqli_error($conn));
                        }
                        $req_trans_fetched = $result->fetch_all();
                        $req_trans = $req_trans_fetched[0];
                        ?>
                        <td>
                          <?= $req_trans[0] ?>
                        </td>
                        <td>
                          <?= $value[3] ?>
                        </td>
                        <td>
                          <?= $value[4] ?>
                        </td>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="profile" class="page container-fluid">
      <div class="row" style="margin-top: 100px;">
        <div class="col-md-6 offset-md-3">
          <div class="card mt-5 fs-4">
            <div class="card-header">
              My Profile
            </div>
            <div class="card-body py-3">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Username:</strong>
                  <?= $user[1] ?>
                </li>
                <li class="list-group-item"><strong>Email:</strong>
                  <?= $user[2] ?>
                </li>
                <li class="list-group-item"><strong>Created At:</strong>
                  <?= $user[4] ?>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <div style="display: none;">
    <form action="../approve.php" class="approve" method="post">
      <textarea name="approveusername" id="approveusername" cols="30" rows="10"></textarea>
    </form>
    <form action="../reject.php" class="reject" method="post">
      <textarea name="rejectusername" id="rejectusername" cols="30" rows="10"></textarea>
    </form>
  </div>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
  <script>
    function approve_user(username) {
      if (confirm(`Are you sure you want to approve ${username} user?`)) {
        document.getElementById("approveusername").value = username;
        document.querySelector(".approve").submit();
        alert("User added successfully!");
      }
    }
    function reject_user(username) {
      if (confirm(`Are you sure you want to reject ${username} user?`)) {
        document.getElementById("rejectusername").value = username;
        document.querySelector(".reject").submit();
        alert("User rejected successfully!");
      }
    }
    function addProd() {
      let prod_type = document.getElementById("type-select").value;
      console.log(prod_type);
      document.getElementById("hiddentype").value = prod_type;
      document.querySelector(".addingProd").submit();
      alert("Product added successfully!");
    }
  </script>
</body>

</html>
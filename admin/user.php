<?php 
  session_start();
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
  } else {
    die("Please <a href='../login.php'>Login</a> First");
  }
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
        <p id="username-text" class="text-white" style="padding-top: 13px; padding-left: 10px;">Hello, <?= $user[1] ?></p>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ms-2" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="bi bi-person-fill"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="product-nav dropdown-item" href="#profile">Profile</a></li>
              <li><a class="dropdown-item" href="#">Logout</a></li>
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
          
        </ul>
      </nav>
    </div>
  </div>
  <!-- offcanvas -->
  <main class="mt-5 pt-3">
    <div id="dashboard" class="page container-fluid">
      <div class="row">
        <div class="col-md-12">
          <h4 style="padding-top: 15px;">Dashboard</h4>
        </div>
      </div>
      <div class="row">
        

        <div class="col-md-6 mb-6">
          <div class="card bg-warning text-black h-100">
            <div class="card-body">
              <div class="d-flex flex-lg-row flex-md-row flex-sm-column justify-content-between align-items-center">
                <p class="fs-4" style="padding-right: 25px;">Pending Supply request</p>
                <div class="justify-content-center align-items-center">
                  <h1 class="display-2">42</h1>
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
        <div class="col-md-6 mb-6">
          <div class="card bg-danger text-white h-100">
            <div class="card-body">
              <div class="d-flex flex-lg-row flex-md-row flex-sm-column justify-content-between align-items-center ">
                <p class="fs-4" style="padding-right: 25px;">Pending User Request</p>
                <div class="flex-justify-content-center align-items-center">
                  <h1 class="display-2">42</h1>
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
                    <p  style="font-size: 20px;">Expandable Items</p>
                    <p  style="font-size: 20px;">69</p>
                  </div>
                </li>
                <li class="list-group-item bg-primary text-white ">
                  <div class="d-flex justify-content-between">
                    <p  style="font-size: 20px;">Expandable Items</p>
                    <p  style="font-size: 20px;">69</p>
                  </div>
                </li>
                <li class="list-group-item bg-primary text-white ">
                  <div class="d-flex justify-content-between">
                    <p  style="font-size: 20px;">Expandable Items</p>
                    <p  style="font-size: 20px;">69</p>
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
<!-- pr-d ,pr code,type (drop) catregotry ,brand,name,price,qty,dayte -->

      <div style="padding-top:30px;" class="row">
        <div class="col-md-12 mb-3">
          <div class="card">
            <div class="card-header">
              <span><i class="bi bi-plus"></i></span> Add new data to the Inventory
            </div>
            <div class="card-body">
              <form action="#" method="post" class="container">
                <div class="row">
                  <div class="form-group">
                    <label for="productName">Product Name:</label>
                    <input type="text" id="productName" name="productName" class="form-control" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label style="padding-top: 10px;" for="name">Name:</label>
                      <input type="text" id="name" name="name" class="form-control" required>
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
                      <select id="department-select" class="form-select">
                        <option value="Expandable Items">Expandable Items</option>
                        <option value="Consumable Items">Consumable Items</option>
                        <option value="Furniture Items">Furniture Items</option>
                      </select>
      
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
                <input type="submit" value="Submit" class="btn btn-primary " style="margin-top: 15px;">
              </form>
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
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Delivered Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>12345</td>
                      <td>Product A</td>
                      <td>Brand X</td>
                      <td>Gadgets</td>
                      <td>100</td>
                      <td>2023-10-15</td>
                    </tr>
                    <tr>
                      <td>56789</td>
                      <td>Product B</td>
                      <td>Brand Y</td>
                      <td>Apparel</td>
                      <td>50</td>
                      <td>2023-10-16</td>
                    </tr>
                    <tr>
                      <td>23456</td>
                      <td>Product C</td>
                      <td>Brand Z</td>
                      <td>Home Decor</td>
                      <td>75</td>
                      <td>2023-10-17</td>
                    </tr>
                    <tr>
                      <td>78901</td>
                      <td>Product D</td>
                      <td>Brand X</td>
                      <td>Gadgets</td>
                      <td>120</td>
                      <td>2023-10-18</td>
                    </tr>
                    <tr>
                      <td>34567</td>
                      <td>Product E</td>
                      <td>Brand P</td>
                      <td>Cosmetics</td>
                      <td>90</td>
                      <td>2023-10-19</td>
                    </tr>
                    <tr>
                      <td>89012</td>
                      <td>Product F</td>
                      <td>Brand Q</td>
                      <td>Apparel</td>
                      <td>60</td>
                      <td>2023-10-20</td>
                    </tr>
                    <tr>
                      <td>65432</td>
                      <td>Product G</td>
                      <td>Brand M</td>
                      <td>Appliances</td>
                      <td>25</td>
                      <td>2023-10-21</td>
                    </tr>
                    <tr>
                      <td>43210</td>
                      <td>Product H</td>
                      <td>Brand N</td>
                      <td>Computers</td>
                      <td>80</td>
                      <td>2023-10-22</td>
                    </tr>
                    <tr>
                      <td>87654</td>
                      <td>Product I</td>
                      <td>Brand O</td>
                      <td>Home Decor</td>
                      <td>45</td>
                      <td>2023-10-23</td>
                    </tr>
                    <tr>
                      <td>54321</td>
                      <td>Product J</td>
                      <td>Brand P</td>
                      <td>Apparel</td>
                      <td>110</td>
                      <td>2023-10-24</td>
                    </tr>
                    <tr>
                      <td>21098</td>
                      <td>Product K</td>
                      <td>Brand Q</td>
                      <td>Cosmetics</td>
                      <td>70</td>
                      <td>2023-10-25</td>
                    </tr>
                    <tr>
                      <td>98765</td>
                      <td>Product L</td>
                      <td>Brand R</td>
                      <td>Equipment</td>
                      <td>35</td>
                      <td>2023-10-26</td>
                    </tr>
                    <tr>
                      <td>87654</td>
                      <td>Product M</td>
                      <td>Brand S</td>
                      <td>Appliances</td>
                      <td>50</td>
                      <td>2023-10-27</td>
                    </tr>
                    <tr>
                      <td>76543</td>
                      <td>Product N</td>
                      <td>Brand T</td>
                      <td>Computers</td>
                      <td>90</td>
                      <td>2023-10-28</td>
                    </tr>
                    <tr>
                      <td>65432</td>
                      <td>Product O</td>
                      <td>Brand U</td>
                      <td>Home Decor</td>
                      <td>40</td>
                      <td>2023-10-29</td>
                    </tr>
                    <tr>
                      <td>54321</td>
                      <td>Product P</td>
                      <td>Brand V</td>
                      <td>Apparel</td>
                      <td>105</td>
                      <td>2023-10-30</td>
                    </tr>
                    <tr>
                      <td>43210</td>
                      <td>Product Q</td>
                      <td>Brand W</td>
                      <td>Cosmetics</td>
                      <td>65</td>
                      <td>2023-10-31</td>
                    </tr>
                    <tr>
                      <td>98765</td>
                      <td>Product R</td>
                      <td>Sports & Outdoors</td>
                      <td>Brand X</td>
                      <td>Equipment</td>
                      <td>30</td>
                      <td>2023-11-01</td>
                    </tr>
                    <tr>
                      <td>87654</td>
                      <td>Product S</td>
                      <td>Brand Y</td>
                      <td>Appliances</td>
                      <td>55</td>
                      <td>2023-11-02</td>
                    </tr>
                    <tr>
                      <td>76543</td>
                      <td>Product T</td>
                      <td>Brand Z</td>
                      <td>Computers</td>
                      <td>100</td>
                      <td>2023-11-03</td>
                    </tr>
                    <tr>
                      <td>65432</td>
                      <td>Product U</td>
                      <td>Brand AA</td>
                      <td>Home Decor</td>
                      <td>60</td>
                      <td>2023-11-04</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Delivered Date</th>
                    </tr>
                  </tfoot>
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
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Faculty</th>
                      <th>Delivered Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>12345</td>
                      <td>Product A</td>
                      <td>Brand X</td>
                      <td>Gadgets</td>
                      <td>50</td>
                      <td>50</td>
                      <td>2023-10-01</td>
                    </tr>
                    <tr>
                      <td>23456</td>
                      <td>Product B</td>
                      <td>Brand Y</td>
                      <td>Home Decor</td>
                      <td>30</td>
                      <td>30</td>
                      <td>2023-10-02</td>
                    </tr>
                    <tr>
                      <td>34567</td>
                      <td>Product C</td>
                      <td>Brand Z</td>
                      <td>Apparel</td>
                      <td>Apparel</td>
                      <td>70</td>
                      <td>2023-10-03</td>
                    </tr>
                    <tr>
                      <td>45678</td>
                      <td>Product D</td>
                      <td>Product D</td>
                      <td>Brand A</td>
                      <td>Cosmetics</td>
                      <td>40</td>
                      <td>2023-10-04</td>
                    </tr>
                    <tr>
                      <td>56789</td>
                      <td>Product E</td>
                      <td>Brand B</td>
                      <td>Equipment</td>
                      <td>Equipment</td>
                      <td>25</td>
                      <td>2023-10-05</td>
                    </tr>
                    <tr>
                      <td>67890</td>
                      <td>Product F</td>
                      <td>Brand C</td>
                      <td>Appliances</td>
                      <td>60</td>
                      <td>2023-10-06</td>
                      <td>2023-10-06</td>
                    </tr>
                    <tr>
                      <td>78901</td>
                      <td>Product G</td>
                      <td>Brand D</td>
                      <td>Brand D</td>
                      <td>Computers</td>
                      <td>80</td>
                      <td>2023-10-07</td>
                    </tr>
                    <tr>
                      <td>89012</td>
                      <td>Product H</td>
                      <td>Brand E</td>
                      <td>Home Decor</td>
                      <td>35</td>
                      <td>35</td>
                      <td>2023-10-08</td>
                    </tr>
                    <tr>
                      <td>90123</td>
                      <td>Product I</td>
                      <td>Brand F</td>
                      <td>Apparel</td>
                      <td>55</td>
                      <td>55</td>
                      <td>2023-10-09</td>
                    </tr>
                    <tr>
                      <td>12345</td>
                      <td>Product J</td>
                      <td>Brand G</td>
                      <td>Cosmetics</td>
                      <td>45</td>
                      <td>2023-10-10</td>
                      <td>2023-10-10</td>
                    </tr>
                    <tr>
                      <td>23456</td>
                      <td>Product K</td>
                      <td>Brand H</td>
                      <td>Brand H</td>
                      <td>Equipment</td>
                      <td>70</td>
                      <td>2023-10-11</td>
                    </tr>
                    <tr>
                      <td>34567</td>
                      <td>Product L</td>
                      <td>Product L</td>
                      <td>Brand I</td>
                      <td>Appliances</td>
                      <td>55</td>
                      <td>2023-10-12</td>
                    </tr>
                    <tr>
                      <td>45678</td>
                      <td>Product M</td>
                      <td>Brand J</td>
                      <td>Brand J</td>
                      <td>Computers</td>
                      <td>90</td>
                      <td>2023-10-13</td>
                    </tr>
                    <tr>
                      <td>56789</td>
                      <td>Product N</td>
                      <td>Brand K</td>
                      <td>Home Decor</td>
                      <td>40</td>
                      <td>40</td>
                      <td>2023-10-14</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Faculty</th>
                      <th>Delivered Date</th>
                    </tr>
                  </tfoot>
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
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Delivered Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>12345</td>
                      <td>Product A</td>
                      <td>Brand X</td>
                      <td>Gadgets</td>
                      <td>50</td>
                      <td>2023-10-01</td>
                    </tr>
                    <tr>
                      <td>23456</td>
                      <td>Product B</td>
                      <td>Brand Y</td>
                      <td>Home Decor</td>
                      <td>30</td>
                      <td>2023-10-02</td>
                    </tr>
                    <tr>
                      <td>34567</td>
                      <td>Product C</td>
                      <td>Brand Z</td>
                      <td>Apparel</td>
                      <td>70</td>
                      <td>2023-10-03</td>
                    </tr>
                    <tr>
                      <td>45678</td>
                      <td>Product D</td>
                      <td>Brand A</td>
                      <td>Cosmetics</td>
                      <td>40</td>
                      <td>2023-10-04</td>
                    </tr>
                    <tr>
                      <td>56789</td>
                      <td>Product E</td>
                      <td>Brand B</td>
                      <td>Equipment</td>
                      <td>25</td>
                      <td>2023-10-05</td>
                    </tr>
                    <tr>
                      <td>67890</td>
                      <td>Product F</td>
                      <td>Brand C</td>
                      <td>Appliances</td>
                      <td>60</td>
                      <td>2023-10-06</td>
                    </tr>
                    <tr>
                      <td>78901</td>
                      <td>Product G</td>
                      <td>Brand D</td>
                      <td>Computers</td>
                      <td>80</td>
                      <td>2023-10-07</td>
                    </tr>
                    <tr>
                      <td>89012</td>
                      <td>Product H</td>
                      <td>Brand E</td>
                      <td>Home Decor</td>
                      <td>35</td>
                      <td>2023-10-08</td>
                    </tr>
                    <tr>
                      <td>90123</td>
                      <td>Product I</td>
                      <td>Brand F</td>
                      <td>Apparel</td>
                      <td>55</td>
                      <td>2023-10-09</td>
                    </tr>
                    <tr>
                      <td>12345</td>
                      <td>Product J</td>
                      <td>Brand G</td>
                      <td>Cosmetics</td>
                      <td>45</td>
                      <td>2023-10-10</td>
                    </tr>
                    <tr>
                      <td>23456</td>
                      <td>Product K</td>
                      <td>Brand H</td>
                      <td>Equipment</td>
                      <td>70</td>
                      <td>2023-10-11</td>
                    </tr>
                    <tr>
                      <td>34567</td>
                      <td>Product L</td>
                      <td>Brand I</td>
                      <td>Appliances</td>
                      <td>55</td>
                      <td>2023-10-12</td>
                    </tr>
                    <tr>
                      <td>45678</td>
                      <td>Product M</td>
                      <td>Brand J</td>
                      <td>Computers</td>
                      <td>90</td>
                      <td>2023-10-13</td>
                    </tr>
                    <tr>
                      <td>56789</td>
                      <td>Product N</td>
                      <td>Brand K</td>
                      <td>Home Decor</td>
                      <td>40</td>
                      <td>2023-10-14</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Delivered Date</th>
                    </tr>
                  </tfoot>
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
                      <th>Product Id</th>
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Type</th>
                      <th>Faculty</th>
                      <th>Delivered Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>12345</td>
                      <td>Product A</td>
                      <td>Brand X</td>
                      <td>Computer</td>
                      <td>50</td>
                      <td>Consumable</td>
                      <td>Akash Patel</td>
                      <td>2023-10-01</td>
                    </tr>
                    <tr>
                      <td>3422</td>
                      <td>Product B</td>
                      <td>Brand X</td>
                      <td>IT</td>
                      <td>10</td>
                      <td>Expandable</td>
                      <td>-</td>
                      <td>2023-10-01</td>
                    </tr>
                    <tr>
                      <td>3422</td>
                      <td>Product B</td>
                      <td>Brand X</td>
                      <td>Automobile</td>
                      <td>10</td>
                      <td>Expandable</td>
                      <td>-</td>
                      <td>2023-10-01</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Product Id</th>
                      <th>Product Name</th>
                      <th>Brand</th>
                      <th>Category</th>
                      <th>Quantity</th>
                      <th>Type</th>
                      <th>Faculty</th>
                      <th>Delivered Date</th>
                    </tr>
                  </tfoot>
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
                      <th>Name</th>
                      <th>Category</th>
                      <th>Department</th>
                      <th>Request Quantity</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>12345</td>
                      <td>Product A</td>
                      <td>Brand X</td>
                      <td>Brand X</td>
                      <td>Gadgets</td>
                      <td>5023-10-01</td>
                    </tr>
                    <tr>
                      <td>23456</td>
                      <td>Product B</td>
                      <td>Brand Y</td>
                      <td>Brand Y</td>
                      <td>Home Decor</td>
                      <td>30/-10-02</td>
                    </tr>
                    <tr>
                      <td>56789</td>
                      <td>Product N</td>
                      <td>Product N</td>
                      <td>Bran d K</td>
                      <td>Home Decor</td>
                      <td>Home Decor</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Request Id</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Department</th>
                      <th>Request Quantity</th>
                      <th>Date</th>
                    </tr>
                  </tfoot>
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
          <div class="card mt-5 fs-4" >
            <div class="card-header">
              My Profile
            </div>
            <div class="card-body py-3">
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Username:</strong> <?= $user[1] ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= $user[2] ?></li>
                <li class="list-group-item"><strong>Created At:</strong> <?= $user[4] ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </main>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
  <script src="./js/jquery-3.5.1.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap5.min.js"></script>
  <script src="./js/script.js"></script>
</body>

</html>
<?php
    session_start();
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    } else {
        $user = array();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Input Form</title>
    <link rel="shortcut icon" href="Images/icon.webp" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <section class="home-screen">
        <nav class="navigation-bar navbar navbar-expand-lg">
            <img src="Images/icon.webp" alt="icon" srcset="">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav" id="navigation-bar">
                    <li class="nav-item" id="navigation-item">
                        <a id="navigation-link" class="nav-link text-*" href="#" rel="noopener noreferrer">Home</a>
                    </li>
                    <li class="nav-item" id="navigation-item">
                        <a id="navigation-link" class="nav-link text-*" href="#" target="_blank" rel="noopener noreferrer">About Us</a>
                    </li>
                    <li class="nav-item" id="navigation-item">
                        <a id="navigation-link" class="nav-link text-*" href="#" target="_blank" rel="noopener noreferrer">Contact Us</a>
                    </li>
                </ul>
                </div>
                <?= isset($user[1]) ? "
                <ul class='navbar-nav ms-auto' id='navigation-bar' style='margin-right: 15px;'>
                    <li class='nav-item' id='navigation-item'>
                        User : $user[1]
                    </li>
                    <li class='nav-item' id='navigation-item'>
                        <a id='navigation-link' class='nav-link text-*' href='logout.php' rel='noopener noreferrer'>logout</a>
                    </li>
                </ul>" : "
                <ul class='navbar-nav ms-auto' id='navigation-bar' style='margin-right: 15px;'>
                    <li class='nav-item' id='navigation-item'>
                        <a id='navigation-link' class='nav-link text-*' href='register.php' rel='noopener noreferrer'>Signup</a>
                    </li>
                    <li class='nav-item' id='navigation-item'>
                        <a id='navigation-link' class='nav-link text-*' href='login.php' rel='noopener noreferrer'>Login</a>
                    </li>
                </ul>" ?>
            </div>
        </nav>
        <div class="main">2</div>
        <div class="footer">3</div>
    </section>
</body>
</html>
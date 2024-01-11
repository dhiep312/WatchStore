<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>WatchStore</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="icon" href="../Public/logo-watchstore.webp">
    <script src="https://kit.fontawesome.com/623c50a3c8.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>
<div id="top_header">

    <a href="../View/index.php"><img class="img_header" src="../Public/logo-watchstore.webp" alt="" width="200px"></a>

    <div class="login_signin_menu">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="../View/user.php">Account</a></li>
                <li><a class="dropdown-item" href="../Controllers/Login.php">Login</a></li>
                <li><a class="dropdown-item" href="../Controllers/SignUp.php">SignUp</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
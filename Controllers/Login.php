<?php
include_once ('../Model/Database.php')
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>

<a href="../View/home.php"><img class="img_header" src="../Public/logo-watchstore.webp" alt="" width="200px"></a>

<div class="login_page">
    <div id="signup_login_contact_form">
        <h1>Login</h1>
        <div class="signup_login_contact_form_box">
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (empty($_POST['username'])) {
                        echo "<p class=".htmlspecialchars('text-warning').">Please enter your username</p> ";
                    }
                    elseif (empty($_POST['email'])) {
                        echo "<p class=".htmlspecialchars('text-warning').">Please enter your email</p> ";
                    }
                    elseif (empty($_POST['password'])) {
                        echo "<p class=".htmlspecialchars('text-warning').">Please enter your password</p> ";
                    }
                    else {
                        $email = filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
                        $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_SPECIAL_CHARS);
                        $password = $_POST['password'];
                        $sql = "select username,userpassword,email from tbl_user where email = '$email'";
                        $result = mysqli_query($conn,$sql);
                        if ($email == 'admin@gmail.com' && $username == 'admin' && $password == 'admin') {
                            header('Location:../Index.php');
                        }
                        elseif ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            if($row['username'] != $username) {
                                echo "<p class=".htmlspecialchars('text-danger').">Wrong username</p> ";
                            }elseif (!password_verify($password,$row['userpassword'])) {
                                echo "<p class=".htmlspecialchars('text-danger').">Wrong password</p> ";
                            }else {
                                $_SESSION['username'] = $username;
                                $_SESSION['email'] = $email;
                                header("Location:../View/home.php");
                            }
                        }else {
                            if(!filter_var($email,FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                                echo "<p class=".htmlspecialchars('text-danger').">That's not a valid format of an email</p> ";
                            }else {
                                echo "<p class=".htmlspecialchars('text-danger').">Your email you typed in is not registered</p> ";
                            }
                        }
                    }
                }?>
                <label for="">Email:</label> <br>
                <input type="text"  name="email"> <br>
                <label for="">Username:</label> <br>
                <input type="text"  name="username"> <br>
                <label for="">Password:</label> <br>
                <input type="password"  name="password"> <br> <br>
                <button type="submit" class="btn btn-primary">Login</button>
                <br>
                <br>
                <a href="" class="text-danger">Forgot password?</a>
            </form>
        </div>
    </div>
</div>

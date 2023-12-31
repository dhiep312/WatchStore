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
    <link rel="stylesheet" href="../css/signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>
<body>
<a href="../View/home.php"><img class="img_header" src="../Public/logo-watchstore.webp" alt="" width="200px"></a>

<div id="form_signup">
    <h1>Sign up</h1>
    <div class="signup_login_contact_form_box">
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <?php

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (empty($_POST['username'])) {
                    echo "<p class=".htmlspecialchars('text-danger').">Please enter your username</p> ";
                }

                elseif (empty($_POST['password'])) {
                    echo "<p class=".htmlspecialchars('text-danger').">Please enter your new password</p> ";
                }
                elseif (empty($_POST['password_retyped'])) {
                    echo "<p class=".htmlspecialchars('text-danger').">Retyped your password please</p> ";
                }
                elseif (empty($_POST['fullname'])) {
                    echo "<p class=".htmlspecialchars('text-danger').">Retyped your full name please</p> ";
                }
                elseif (empty($_POST['email'])) {
                    echo "<p class=".htmlspecialchars('text-danger').">Retyped your email please</p> ";
                }else {
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    $username = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
                    $password = $_POST['password'];
                    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
                    $retyped_password = $_POST['password_retyped'];
                    $fullname = $_POST['fullname'];
                    if($password != $retyped_password) {
                        echo "<p class=".htmlspecialchars('text-danger').">Password is not match</p> ";
                    }else {
                        if(!filter_var($email,FILTER_VALIDATE_EMAIL) || !preg_match('/@gmail\.com$/', $email)) {
                            echo "<p class=".htmlspecialchars('text-danger').">Your email is invalid</p> ";
                        }else {
                            $email = mysqli_real_escape_string($conn, $_POST['email']);
                            $sql = "select email from tbl_user where email = '$email'";
                            $result = $conn ->query($sql);
                            if ($result->num_rows == 0) {
                                $sql = "insert into tbl_user(username,userpassword,fullname,email) values('$username','$hashed_password','$fullname','$email')";
                                $result = $conn ->query($sql);
                                if ($result === TRUE) {
                                    echo "<p class=".htmlspecialchars('text-success').">Signed up succesfully</p> "; {
                                        header('Location:../View/home.php');
                                    }
                                }
                                else {
                                    echo "<p class=".htmlspecialchars('text-danger').">Error</p> ";
                                }
                            }
                            else {
                                echo "<p class=".htmlspecialchars('text-danger').">Email you typed in already existed</p> ";
                            }
                        }
                    }
                }

            }
            ?>
            <label for="">Username:</label> <br>
            <input type="text" name="username" placeholder="No more than 50 chars"> <br>
            <label for="">Password:</label> <br>
            <input type="password"  name="password"> <br>
            <label for="">Retype password:</label> <br>
            <input type="password"  name="password_retyped"> <br>
            <label for="">Full Name</label> <br>
            <input type="text" name="fullname" placeholder="No more than 50 chars"> <br>
            <label for="">Email</label> <br>
            <input type="text" name="email" placeholder="No more than 50 chars"> <br>
            <br>
            <button type="submit" class="btn btn-primary">Sign up</button>
        </form>
    </div>
</div>
</body>
<?php
?>

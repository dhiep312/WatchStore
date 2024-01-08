<?php
include_once ('../layout/header.php');
?>

<?php
include_once ('../Model/Database.php');
?>
<?php
$sql = "select * from tbl_user;";
$result = mysqli_query($conn,$sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>
<body>
<H1>Admin</H1>
<h1><a href="../View/home.php">Home</a></h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">
            <a href="../Admin/ManagementUser.php">Danh Sách Người Dùng</a></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Thêm Người Dùng</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
            Sửa Người Dùng</button>
    </li>
</ul>
<div class="AddUser">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12 col-md-6"></div>
                        <div class="col-sm-12 col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table  class="table table-bordered table-hover dataTable" role="grid" >
                                <thead>
                                <tr role="row">
                                    <th style="text-align: center;" class="sorting_asc" tabindex="0"  rowspan="1" colspan="1">ID</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Tên Người Dùng</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Mật khẩu</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Nhập lại Mật khẩu</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Full Name</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                                    <?php
                                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                        if (empty($_POST['username'])) {
                                            echo "<p class=".htmlspecialchars('text-danger').">Please enter your username</p> ";
                                        }elseif (empty($_POST['user_id'])){
                                            echo "<p class=".htmlspecialchars('text-danger').">Please enter your ID</p> ";
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
                                            $user_id = $_POST['user_id'];
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
                                                        $sql = "insert into tbl_user(user_id,username,userpassword,fullname,email) values('$user_id','$username','$hashed_password','$fullname','$email')";
                                                        $result = $conn ->query($sql);
                                                        if ($result === TRUE) {
                                                            echo "<p class=".htmlspecialchars('text-success').">Add succesfully</p> "; ?>
                                                            <script>
                                                                alert("Adding");
                                                                window.location.href = "../Admin/ManagementUser.php";
                                                            </script>
                                                            <?php
                                                        }
                                                        else {
                                                            echo "<p class=".htmlspecialchars('text-danger').">Error</p> ";
                                                        }
                                                    }else {
                                                        echo "<p class=".htmlspecialchars('text-danger').">Email you typed in already existed</p> ";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="text" name="user_id" placeholder="ID">
                                        </td>
                                        <td>
                                            <input type="text"  name="username" placeholder="Username">
                                        </td>
                                        <td>
                                            <input type="password" name="password" placeholder="Password">
                                        </td>
                                        <td>
                                            <input type="password" name="password_retyped" placeholder="RePassword">
                                        </td>
                                        <td>
                                            <input type="text" name="fullname" placeholder="Full name">
                                        </td>
                                        <td>
                                            <input type="text" name="email" placeholder="Email">
                                        </td>
                                        <td><button type="submit" class="btn btn-outline-primary">Add</button></td>
                                    </tr>
                                </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<?php
$conn->close();
?>

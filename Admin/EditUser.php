<?php
include_once ('../layout/header.php');
?>
<?php
include_once ('../Model/Database.php');
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
        <button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><a href="../Admin/AddUser.php">Thêm Người Dùng</a></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Sửa Người Dùng </button>
    </li>
</ul>
<div class="EditUser">
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
<!--                                    <th style="text-align: center;" class="sorting_asc" tabindex="0"  rowspan="1" colspan="1">ID</th>-->
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Tên Người Dùng</th>
<!--                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Mật khẩu</th>-->
<!--                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Nhập lại Mật khẩu</th>-->
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Full Name</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($_GET['user_id']))
                                {
                                    $user_id = $_GET['user_id'];
                                    $users = "SELECT * FROM tbl_user WHERE user_id='$user_id' ";
                                    $users_run = mysqli_query($conn , $users);

                                    if (mysqli_num_rows($users_run)>0){
                                        foreach ($users_run as $user)
                                        {
                                        ?>
                                <form action="" method="post">
                                    <tr>
<!--                                        <td>-->
<!--                                            <input type="text" name="user_id" placeholder="ID" value="--><?//=$user['user_id'];?><!--" class="form-control">-->
<!--                                        </td>-->
                                        <td>
                                            <input type="text"  name="username" placeholder="Username" value="<?=$user['username'];?>" class="form-control">
                                        </td>
<!--                                        <td>-->
<!--                                            <input type="password" name="password" placeholder="Password" class="form-control">-->
<!--                                        </td>-->
<!--                                        <td>-->
<!--                                            <input type="password" name="password_retyped" placeholder="RePassword"class="form-control">-->
<!--                                        </td>-->
                                        <td>
                                            <input type="text" name="fullname" placeholder="Full name" value="<?=$user['fullname'];?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="text" name="email" placeholder="Email" value="<?=$user['email'];?>" class="form-control">
                                        </td>
                                        <td><button type="submit" class="btn btn-outline-primary" name="update_user">Update</button></td>
                                    </tr>
                                </form>
                                            <?php
                                        }
                                    }
                                    else {
                                        ?>
                                        <h4>no record found</h4>
                                        <?php
                                    }
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="updateUserFunction">
    <?php
    if (isset($_POST['update_user'])){
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];

        $query = "Update tbl_user Set username ='$username', fullname='$fullname', email='$email' where user_id = '$user_id'";
        $query_run = mysqli_query($conn , $query);
        if ($query_run ) {
            $_SESSION['message'] = "Update successfully !";
            ?>
            <script>
                alert("Updating");
                window.location.href = "../Admin/ManagementUser.php";
            </script>
    <?php
            exit(0);
        }
    }
    ?>
</div>
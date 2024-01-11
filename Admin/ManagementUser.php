<?php
include_once ('../layout/HeaderAdmin.php');
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
<h1><a href="../View/index.php">Home</a></h1>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a href="../Admin/ManagementUser.php"><button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Danh Sách Người Dùng</button></a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="../Admin/AddUser.php"><button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Thêm Người Dùng</button></a>
    </li>
    <li class="nav-item" role="presentation">
        <a href=""><button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Sửa Người Dùng</button></a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="../Admin/ManagementProduct.php"><button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Quản Lí Sản Phẩm</button></a>
    </li>
</ul>
<div class="ManagementUser">
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
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Full Name</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Email</th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1"><i class="fa-solid fa-user-minus"></i></th>
                                    <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php while($row = $result->fetch_assoc()) {?>
                                    <tr role="row" class="odd">
                                        <td class="sorting_1"><?php echo $row['user_id']?></td>
                                        <td><?php echo $row['username']?></td>
                                        <td><?php echo $row['fullname']?></td>
                                        <td><?php echo $row['email']?></td>
                                                        <td><button type="button" class="btn btn-danger" onclick="delete_user(<?php echo $row['user_id']?>)">Delete</button></td>
                                                        <td><button type="button" class="btn btn-danger"><a
                                                                    href="../Admin/EditUser.php?user_id=<?php echo $row['user_id']; ?> ">Edit</a></button></td>
                                    </tr>
                                <?php
                                }
                                if (isset($_POST['user_id'])) {
                                    $user_id = $_POST['user_id'];
                                    $delete_user = "DELETE FROM tbl_user WHERE user_id ='$user_id' ";
                                    $deleted_user = mysqli_query($conn, $delete_user);
                                    if ($deleted_user) {
                                        $update_user = "UPDATE tbl_user SET user_id = user_id - 1 where user_id >'$user_id' ";
                                        $reorder_user = mysqli_multi_query($conn, $update_user);
                                        if ($reorder_user) {
                                            echo 'Add user successfully.';
                                        } else {
                                            echo 'Error Add user: ' . mysqli_error($conn);
                                        }
                                    }
                                    else {
                                        echo 'Error executing SQL script: ' . mysqli_error($conn);
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
<div class="FunctionDeleteUser">
    <script>
        function delete_user(user_id) {
            // Make AJAX request to the PHP file
            var xhr = new XMLHttpRequest();
            xhr.open('POST', window.location.href, true);
            // Create a new FormData object and append the value to it
            var formData = new FormData();
            formData.append('user_id', user_id);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    alert("Updating");
                    window.location.href = "../Admin/ManagementUser.php";
                }
            };
            xhr.send(formData);
        }
    </script>
</div>
</div>
</body>
</html>
<?php
$conn->close();
?>



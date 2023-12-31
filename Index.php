<?php
include_once('layout/headerAdmin.php');
include_once ('Model/Database.php');
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
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Danh Sách Người Dùng <i class="fa-solid fa-user-group"></i></button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Thêm Người Dùng <i class="fa-solid fa-user-plus"></i></button>
    </li>
</ul>
<div class="userlist">
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0"><div class="content-wrapper" >
            <section>
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
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
                                                </tr>

                                            <?php }
                                            if (isset($_POST['user_id'])) {
                                                $user_id = $_POST['user_id'];
                                                $delete_user = "DELETE FROM tbl_user WHERE user_id = ".$user_id;
                                                $deleted_user = mysqli_query($conn, $delete_user);
                                                if ($deleted_user) {
                                                    $update_user = "UPDATE tbl_user SET user_id = user_id - 1 where user_id > ".$user_id;
                                                    $reorder_user = mysqli_multi_query($conn, $update_user);
                                                    if ($reorder_user) {
                                                        echo 'Order of user_id updated successfully.';
                                                    } else {
                                                        echo 'Error updating order of user_id: ' . mysqli_error($conn);
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
            </section>
        </div>
    </div>
</div>
</div>
    <div class="adduser">
    <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
        <div class="content-wrapper" >
            <section>
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
                                                <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Full Name</th>
                                                <th style="text-align: center;" class="sorting" tabindex="0"  rowspan="1" colspan="1">Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><input type="text" placeholder="ID"></td>
                                                <td><input type="text" placeholder="Tên Người Dùng"></td>
                                                <td><input type="text" placeholder="Mật Khẩu"></td>
                                                <td><input type="text" placeholder="Full Name"></td>
                                                <td><input type="text" placeholder="Email"></td>
                                                <td><button type="button" class="btn btn-outline-primary" onclick="add_user()">Add</button></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

</body>
</html>





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
                    window.location.href = "Index.php";
                }
            };
            xhr.send(formData);
        }
    </script>
<?php
$conn->close();
?>
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
        <a href="../Admin/ManagementUser.php"><button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false">Danh Sách Người Dùng</button></a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="../Admin/AddUser.php"><button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Thêm Người Dùng</button></a>
    </li>
    <li class="nav-item" role="presentation">
        <a href=""><button class="nav-link " data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Sửa Người Dùng</button></a>
    </li>
    <li class="nav-item" role="presentation">
        <a href="../Admin/ManagementProduct.php"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Quản Lí Sản Phẩm</button></a>
    </li>
</ul>

<div class="management_product">
    <form class="form-horizontal">
        <fieldset>
            <br>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_id">ID</label>
                <div class="col-md-4">
                    <input id="prd_id" name="prd_id" placeholder="ID" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_name">Tên Sản Phẩm</label>
                <div class="col-md-4">
                    <input id="prd_name" name="prd_name" placeholder="Tên Sản Phẩm" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Select Basic -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_category">Phân Loại</label>
                <div class="col-md-4">
                    <input id="prd_category" name="prd_category" placeholder="Phân Loại" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_quantity">Số Lượng</label>
                <div class="col-md-4">
                    <input id="prd_quantity" name="prd_quantity" placeholder="Số Lượng" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_trademark">Thương Hiệu</label>
                <div class="col-md-4">
                    <input id="prd_trademark" name="prd_trademark" placeholder="Thương Hiệu" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_wirematerial">Chất liệu dây</label>
                <div class="col-md-4">
                    <input id="prd_wirematerial" name="prd_wirematerial" placeholder="Chất liệu dây" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_glassmaterial">Chất liệu kính</label>
                <div class="col-md-4">
                    <input id="prd_glassmaterial" name="prd_glassmaterial" placeholder="Chất liệu kính" class="form-control input-md" required="" type="text">

                </div>
            </div>

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_description">Mô Tả Sản Phẩm</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="prd_description" name="prd_description" placeholder="Mô Tả Sản Phẩm"></textarea>
                </div>
            </div>

            <!-- File Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="prd_img">Ảnh</label>
                <div class="col-md-4">
                    <input id="prd_img" name="prd_img" class="input-file" type="file">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" ></label>
                <div class="col-md-4">
                    <button id="Add" name="Add" type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>

        </fieldset>
    </form>
</div>

<div class="functionAddProduct">
    <?php
    if (isset($_POST['prd_id'])&& isset($_POST['prd_name']) && isset($_POST['prd_category']) && isset($_POST['prd_quantity']) && isset($_POST['prd_trademark']) && isset($_POST['prd_wirematerial']) && isset($_POST['prd_glassmaterial']) && isset($_POST['prd_description']) && isset($_POST['prd_img'])) {
        $prd_id = $_POST['prd_id'];
        $prd_name = $_POST['prd_name'];
        $prd_category = $_POST['prd_category'];
        $prd_quantity = $_POST['prd_quantity'];
        $prd_trademark = $_POST['prd_trademark'];
        $prd_wirematerial = $_POST['prd_wirematerial'];
        $prd_glassmaterial = $_POST['prd_glassmaterial'];
        $prd_description = $_POST['prd_description'];
        $prd_id = $_POST['prd_img'];


    }
    ?>
</div>
</body>
</html>
<?php
$conn->close();
?>



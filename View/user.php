<?php
include_once ('../layout/header.php');
?>
<?php
include_once ('../Model/Database.php');
if ($_SESSION['username'] == '') {
?>
    <script>
        alert("Please log in to view your account");
        window.location.href = '../Controllers/Login.php';
    </script>
<?php
}else { ?>
    <h1>Welcome,<?php echo $_SESSION['username'];?></h1>
    <div>
    <h3>User Information</h3>
    <hr>
    <p><strong>Username:<?php echo $_SESSION['username'];?></strong> </p>
    <p><strong>Email:<?php echo $_SESSION['email'];?></strong> </p>
    </div>
<?php
}
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location:../Controllers/Login.php");
    exit();
}
?>
<form id="logoutForm" method="post" action="user.php">
    <button type="submit" name="logout">Logout</button>
</form>
<?php
$conn->close();
?>

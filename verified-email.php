<?php
include_once("./config/constants.php");
?>
<p>Bạn đã xác nhận Email thành công</p>
<?php
//$sql = "INSERT INTO tbl_user{fullname, username, password, verified_email}"
if(isset($_POST['verified'])){
    $user_id = $_POST['user_id'];
    $sql = "UPDATE tbl_user SET verified_email='True' WHERE user_id = $user_id";
    $res = mysqli_query($conn,$sql);
    if($res == true){
        echo "<a href='login.php'>Đăng nhập</a>";
    }
   
}
?>

<?php
session_start();
include "../include/db_connect.php";

if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 후 이용 가능합니다.'); history.back();</script>";
    exit;
}

$userid = $_SESSION['userid'];

// 회원 정보 가져오기
$sql = "SELECT id, email, profile_img FROM _mem WHERE id='$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$id = $row['id'];
$email = $row['email'];
$profile_img = $row['profile_img'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>내 프로필</title>
</head>
<body>
    <h2>내 프로필</h2>

    <?php if ($profile_img) { ?>
        <img src="./profile_upload/<?=$profile_img?>" width="220" height="150"><br>
    <?php } else { ?>
        <img src="../img/default_profile.png" width="200" height="150"><br>
    <?php } ?>

    <p><b>아이디:</b> <?=$id?></p>
    <p><b>이메일:</b> <?=$email?></p>
</body>
</html>
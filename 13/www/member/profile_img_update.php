<?php
session_start();
include "../include/db_connect.php";

if (!isset($_SESSION['userid'])) {
    echo "<script>alert('로그인 후 이용 가능합니다.'); history.back();</script>";
    exit;
}

$userid = $_SESSION['userid'];

if (isset($_FILES['profile_img']) && $_FILES['profile_img']['name'] != "") {
    $upload_dir = "./profile_upload/";
    $file_name = $_FILES['profile_img']['name'];
    $file_tmp  = $_FILES['profile_img']['tmp_name'];

    // 파일명 중복 방지
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_name = $userid."_".time().".".$file_ext;

    move_uploaded_file($file_tmp, $upload_dir.$new_name);

    // DB 업데이트
    $sql = "UPDATE _mem SET profile_img='$new_name' WHERE id='$userid'";
    mysqli_query($con, $sql);
}

mysqli_close($con);
echo "<script>
    alert('프로필 사진이 업데이트되었습니다.');
    location.href='profile.php';
    </script>";
?>
<?php
session_start();
include "../include/db_connect.php";

if(!isset($_SESSION['userid'])) {
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

    <p><b>사용자가 쓴 게시글 목록</b></p>
    <?php
    $tables = ["_notice" => "공지 게시판", "_qna" => "QNA 게시판", "_youtube" => "유튜브 게시판"];
    foreach($tables as $table => $board_name) {
    ?>
        <?=$board_name?>
    <?php
        $sql = "SELECT num, subject, regist_day FROM $table WHERE id='$userid' ORDER BY num DESC LIMIT 5";  // 최근 5개만
        $result = mysqli_query($con, $sql);
    ?>
    <ul>
    <?php
    while($row = mysqli_fetch_assoc($result)){
        $num = $row["num"];
        $subject = htmlspecialchars($row["subject"]);
        $regist_day  = $row["regist_day"];

        //글 보기 링크
        $url = "../mboard/index.php?type=view&table=$table&num=$num";
    ?>
    <li><a href='<?=$url?>'><?=$subject?></a> (<?=$regist_day?>)</li>
    <?php
        }
        echo "</ul>";
    }
    ?>
</body>
</html>
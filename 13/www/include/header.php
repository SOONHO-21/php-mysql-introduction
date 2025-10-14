<?php
    session_start();

    $userid = isset($_SESSION["userid"]) ? $_SESSION["userid"] : "";
    $username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";
    $userlevel = isset($_SESSION["userlevel"]) ? $_SESSION["userlevel"] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PHP+MySQL 입문</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <h3 class="logo">
        <a href="../main/index.php">PHP+MySQL입문</a>
    </h3>
    <ul class="top_menu">
    <?php
        if(!$userid) {
            echo "<li>홈페이지에 오신 것을 환영합니다~~~ </li>";
        } else {
            $logged = $username."(Level:".$userlevel.")님 환영합니다. ";    //로그인 성공시 메시지
            echo "<li>$logged</li>";
        }
    ?>
    </ul>

    <ul class="main_menu">
    <?php
        if(!$userid) {
    ?>
    <li><a href="../member/index.php?type=form">회원 가입</a></li>
    <li><a href="../member/index.php?type=login_form">로그인</a></li>
    <?php
        } else {
    ?>
    <li><a href="../member/logout.php">로그아웃</a></li>
    <li><a href="../member/index.php?type=modify_form">정보 수정</a></li>
    <li><a href="../member/profile.php">프로필</a></li>
    <?php
        }
    ?>
    <li>|</li>
    <li><a href="../mboard/index.php?type=list&table=_notice">공지 게시판</a></li>
    <li><a href="../mboard/index.php?type=list&table=_qna">QNA 게시판</a></li>
    <li><a href="../mboard/index.php?type=list&table=_youtube">YOUTUBE 게시판</a></li>
    </ul>   <!-- main_menu -->
</header>
</body>
</html>
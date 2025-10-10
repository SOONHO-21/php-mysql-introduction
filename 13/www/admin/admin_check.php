<?php
session_start();
if(!isset($_SESSION['userid']) || $_SESSION['userlevel'] != 1) {    // 세션에 userid가 없거나 level 1 관리자가 아니면
    echo "<script>alert('관리자 전용 페이지입니다.'); history.back();</script>";
    exit;
}
?>
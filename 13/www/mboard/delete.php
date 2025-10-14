<?php
    $table = $_GET["table"];
    $num = $_GET["num"];
    $page = $_GET["page"];

    include "../include/db_connect.php";
    $sql = "DELETE FROM $table WHERE num=$num"; // 레코드 삭제 명령
    mysqli_query($con, $sql);     // SQL 명령 실행

    $table_ripple = $table."_ripple";

    $sql2 = "SELECT * FROM $table_ripple WHERE parent=$num";
    $result = mysqli_query($con, $sql2);     // SQL 명령 실행
    
    if(mysqli_num_rows($result) > 0){
        $sql = "DELETE FROM $table_ripple WHERE parent=$num";   // 레코드 삭제 명령
        mysqli_query($con, $sql);   // SQL 명령 실행
    }

    mysqli_close($con);     // DB 접속 해제

    // 목록보기 이동
    echo "<script>
	         location.href = 'index.php?type=list&table=$table&page=$page';      
	     </script>";
?>
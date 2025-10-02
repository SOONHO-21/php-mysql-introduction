<?php
include "../include/db_connect.php";
include "admin_check.php";

$table = $_GET['table'];
$sql = "SELECT num, subject, name, regist_day FROM $table ORDER BY num DESC";
$result = mysqli_query($con, $sql);
?>
<h2><?=$table?> 관리</h2>
<table>
<tr><th>번호</th><th>제목</th><th>작성자</th><th>등록일</th><th>관리</th></tr>
<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?=$row['num']?></td>       <!--게시글 번호-->
    <td><?=$row['subject']?></td>   <!--게시글 제목-->
    <td><?=$row['name']?></td>      <!--게시자 이름-->
    <td><?=$row['regist_day']?></td>    <!--게시일-->
    <td><a href="board_delete.php?table=<?=$table?>&num=<?=$row['num']?>" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a></td>  <!--삭제-->
</tr>
<?php } ?>
</table>
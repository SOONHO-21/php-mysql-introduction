<?php
include "../include/db_connect.php";
include "admin_check.php";

$sql = "SELECT num, id, name, email, level, profile_img FROM _mem ORDER BY num ASC";
$result = mysqli_query($con, $sql);
?>
<h2>회원 관리</h2>
<table>
    <tr><th>번호</th><th>아이디</th><th>이름</th><th>이메일</th><th>레벨</th><th>프로필</th><th>관리</th></tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?=$row['num']?></td>
        <td><?=$row['id']?></td>
        <td><?=$row['name']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['level'] == 1 ? "관리자" : "유저"?></td>
        <td>
        <?php if ($row['profile_img']) { ?>
            <img src="../member/profile_upload/<?=$row['profile_img']?>" width="40">
        <?php } ?>
        </td>
        <td>
        <?php if ($row['level'] != 1) { // 관리자 계정은 삭제 불가 ?>
            <a href="user_delete.php?num=<?=$row['num']?>" onclick="return confirm('정말 삭제하시겠습니까?')">삭제</a>
        <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>
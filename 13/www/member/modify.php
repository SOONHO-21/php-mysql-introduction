<?php
    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email = $_POST["email"];
          
    include "../include/db_connect.php";

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['name'] != "") {    // modify_form.php에서 <input type="file" name="profile_img"> 코드에 근거
        $upload_dir = "./profile_upload/";
        $file_name = $_FILES['profile_img']['name'];    // 클라이언트 머신에 존재하는 파일의 원래 이름
        $file_tmp  = $_FILES['profile_img']['tmp_name'];    // 서버에 저장된 업로드된 파일의 임시 파일 이름
        
        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = $id."_".time().".".$file_ext;

        move_uploaded_file($file_tmp, $upload_dir.$new_name);

        $sql = "UPDATE _mem SET pass='$pass', name='$name', email='$email', profile_img='$new_name' WHERE id='$id'";
    } else {
        $sql = "UPDATE _mem SET pass='$pass', name='$name', email='$email', WHERE id='$id'";
    }

    // DB 업데이트
    $sql = "UPDATE _mem SET pass='$pass', name='$name', email='$email', profile_img='$new_name'";
    $sql .= " WHERE id='$id'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
        <script>
            location.href = './profile.php';
        </script>
	  ";
?>
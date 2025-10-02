<?php
    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email = $_POST["email"];
          
    include "../include/db_connect.php";

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['name'] != "") {
        $upload_dir = "./profile_upload/";
        $file_name = $_FILES['profile_img']['name'];
        $file_tmp  = $_FILES['profile_img']['tmp_name'];

        $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = $id."_".time().".".$file_ext;

        move_uploaded_file($file_tmp, $upload_dir.$new_name);

        $sql = "UPDATE _mem 
                SET pass='$pass', name='$name', email='$email', profile_img='$new_name' 
                WHERE id='$id'";
    } else {
        $sql = "UPDATE _mem SET pass='$pass', name='$name', email='$email', WHERE id='$id'";
    }

    // DB 업데이트
    $sql = "UPDATE _mem SET pass='$pass', name='$name', email='$email', profile_img='$new_name'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
        <script>
            location.href = './profile.php';
        </script>
	  ";
?>
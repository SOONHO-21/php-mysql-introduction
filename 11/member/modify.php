<?php
    # 정보수정은 패스워드, 이름, 이메일만 가능
    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email = $_POST["email"];
          
    $con = mysqli_connect("localhost", "user", "12345", "sample");

    $sql = "update members set pass='$pass', name='$name', email='$email'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
        <script>
            location.href = 'index.php';
        </script>
        ";
?>
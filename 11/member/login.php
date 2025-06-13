<?php
    $id = $_POST["id"];
    $pass = $_POST["pass"];

    $con = mysqli_connect("localhost", "user", "12345", "sample");
    $sql = "select * from members where id='$id'";  //id는 유니크한 값이므로 결과는 하나
    $result = mysqli_query($con, $sql);

    $num_match = mysqli_num_rows($result);  //mysqli_num_rows : 레코드 개수 카운트

    if(!$num_match){    //num_match에 해당하는 ID가 없으면 = 레코드가 0이면
        echo "<script>
            window.alert('등록되지 않는 아이디입니다.');
            history.go(-1)
            </script>";
    }
    else {
        $row = mysqli_fetch_assoc($result); //쿼리 정보를 가져와 row에 저장(객체)
        $db_pass = $row["pass"];    //password 저장

        mysqli_close($con);

        if($pass != $db_pass) {     //password 틀리면
            echo  "<script>
                window.alert('비밀번호가 틀립니다.');
                history.go(-1)  //이전페이지로
                </script>";
            exit;
        }
        else {                      //password 가 맞으면
            session_start();        //세션 시작
            $_SESSION["userid"] = $row["id"];   //세션변수에 $row의 값 저장
            $_SESSION["username"] = $row["name"];

            echo "<script>
                location.href = 'index.php';
                </script>";
        }
    }
?>
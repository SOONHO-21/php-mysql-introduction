<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $_SESSION['userlevel'] = $row['level'];  // 중요!

    include "../include/db_connect.php";
    $sql = "select * from _mem where id='$id'"; //아이디가 존재하는지 체크
    $result = mysqli_query($con, $sql); //쿼리결과
    
    $num_match = mysqli_num_rows($result);  //쿼리결과 개수(1개 or 0개)

    if(!$num_match) {   //쿼리결과가 있어야 로그인 가능
        echo "<script>
            window.alert('등록되지 않는 아이디입니다!')
            history.go(-1)
            </script>";
    }
    else {
        $row = mysqli_fetch_assoc($result);
        $db_pass = $row["pass"];

        mysqli_close($con);

        if($pass != $db_pass) {   //비밀번호가 틀리면
        echo "<script>
            window.alert('비밀번호가 틀립니다!')
            history.go(-1)
            </script>";
        exit;
        }
        else {
            // 세션 저장
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];

            // 관리자 계정이면 관리자 페이지로 이동
            if($_SESSION["userlevel"] == 1){
                echo "<script>
                        location.href = '../admin/index.php';
                    </script>";
            } else {    // 일반 유저는 메인 index 페이지로
                echo "<script>
                        location.href = '../main/index.php';
                    </script>";
            }
        }
    }
?>
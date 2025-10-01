<?php
    $id   = $_POST["id"];		// 아이디
    $pass = $_POST["pass"];		// 비밀번호
    $name = $_POST["name"]; 	// 이름
    $email  = $_POST["email"];	// 이메일
    $regist_day = date("Y-m-d (H:i)");	// 가입일자
              
    include "../include/db_connect.php";
	$sql = "select * from _mem where id='$id'";	//중복된 아이디가 있는지 쿼리
	$result = mysqli_query($con, $sql);		//SQL 쿼리
	$num_record = mysqli_num_rows($result);	//SQL 쿼리 결과를 $result 변수에 저장

	if($num_record){	//중복된 기존 아이디가 있으면
		echo "<script>
			alert('아이디가 중복됩니다! 다른 아이디를 사용해주세요!');
			history.go(-1)
			</script>";
		exit;
	}

	$sql = "insert into _mem (id, pass, name, email, regist_day, level, point)";	//데이터 삽입 명령
	$sql .= "values('$id', '$pass', '$name', '$email', '$regist_day', 9, 100)";
	mysqli_query($con, $sql);	//SQL 명령 실행
    mysqli_close($con);

    echo "<script>
		location.href = 'index.php?type=login_form';
		</script>";
?>
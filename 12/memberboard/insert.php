<?php
	include "session.php"; 	// 세션 처리

	if (!$userid) {		//로그인이 안 되어있다면
		echo "
				<script>
				alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
				history.go(-1)
				</script>
		";	//로그인 요구
		exit;
	}
    $subject = $_POST["subject"];		// 제목
    $content = $_POST["content"];		// 내용

	$subject = htmlspecialchars($subject, ENT_QUOTES);	// 제목 HTML 특수문자 변환
	$content = htmlspecialchars($content, ENT_QUOTES);	// 내용 HTML 특수문자 변환 
	$regist_day = date("Y-m-d (H:i)");  // UTC 기준 현재의 '년-월-일 (시:분)'

	$upload_dir = './data/';	//첨부파일 저장 디렉토리

	$upfile_name	 = $_FILES["upfile"]["name"];		//업로드 파일명
	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];	//실제 서버에 저장되는 임시파일 명
	$upfile_type     = $_FILES["upfile"]["type"];		//업로드 파일 타입
	$upfile_size     = $_FILES["upfile"]["size"];		//업로드 파일 크기
	$upfile_error    = $_FILES["upfile"]["error"];		//발생된 오류

	if ($upfile_name && !$upfile_error)		//파일이름이 있고 오류가 없으면
	{
		$file = explode(".", $upfile_name);	//업로드 파일명과 확장자 분리. 배열 형태로 $file에 저장
		$file_name = $file[0];	//업로드 파일명
		$file_ext  = $file[1];	//확장자

		$copied_file_name = date("Y_m_d_H_i_s");	//업로드 날짜
		$copied_file_name .= ".".$file_ext;		//확장자
		$uploaded_file = $upload_dir.$copied_file_name;	//파일 명에 날짜 + 확장자

		if( $upfile_size  > 10000000 ) {
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(10MB)을 초과합니다!<br>파일 크기를 체크해주세요!');
				history.go(-1);
				</script>
				");
				exit;
		}

		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
		{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
		}
	}
	else 
	{
		$upfile_name      = "";
		$upfile_type      = "";
		$copied_file_name = "";
	}

    $con = mysqli_connect("localhost", "user", "12345", "sample");
	$sql = "insert into memberboard (id, name, subject, content, regist_day, ";
	$sql .= "file_name, file_type, file_copied) ";
	$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', ";
	$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";

	mysqli_query($con, $sql);  // $sql에 저장된 명령 실행

	mysqli_close($con);       // DB 연결 끊기

	// 목록 페이지로 이동
	echo "<script>
	    location.href = 'list.php';
		s</script>";
?>
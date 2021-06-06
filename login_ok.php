<meta charset="utf-8" />
<?php
	$host = 'localhost';
	$user = 'root';
	$pw = 'aksen756489';
	$dbName = 'training';

	$conn = mysqli_connect($host, $user, $pw, $dbName);
	//POST로 받아온 아이다와 비밀번호가 비었다면 알림창을 띄우고 전 페이지로 돌아갑니다.
	if($_POST["userid"] == "" || $_POST["userpw"] == ""){
		echo '<script> alert("아이디나 패스워드 입력하세요"); history.back(); </script>';
	}else{
	//password변수에 POST로 받아온 값을 저장하고 sql문으로 POST로 받아온 아이디값을 찾습니다.
		$password = $_POST['userpw'];
		$sql = "select * from member
		where ID='".$_POST['userid']."'";
		$reslut = mysqli_query($conn, $sql);
		$row = mysqli_fetch_array($reslut);
		$hashedPassword = $row['PassWord'];
		$row['ID'];
		$passwordResult = password_verify($password, $hashedPassword);
		if($passwordResult == true)#password_verify($password, $passok)) //만약 password변수와 hash_pw변수가 같다면 세션값을 저장하고 알림창을 띄운후 main.php파일로 넘어갑니다.
		{
			session_start();
			$_SESSION['userid'] = $row["ID"];
			$_SESSION['userpw'] = $row["PassWord"];

			echo "<script>alert('로그인되었습니다.'); location.href='/main.php';</script>";
		}else{ // 비밀번호가 같지 않다면 알림창을 띄우고 전 페이지로 돌아갑니다
			echo "<script>alert('아이디 혹은 비밀번호를 확인하세요.'); history.back();</script>";
		}
	}
?>

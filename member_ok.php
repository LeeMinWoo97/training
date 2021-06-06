<?php
	$host = 'localhost';
	$user = 'root';
	$pw = 'aksen756489';
	$dbName = 'training';

	$conn = mysqli_connect($host, $user, $pw, $dbName);

// Check connection
	// if (mysqli_connect_errno())
  // 	{
  // 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  // 	}

	$userid = $_POST['userid'];
	$userpw = password_hash($_POST['userpw'], PASSWORD_DEFAULT);
	$email = $_POST['email'].'@'.$_POST['emadress'];

	$sql = "
	INSERT INTO member(ID,PassWord,email)
	VALUES('$userid','$userpw','$email')";

	$reslut =mysqli_query($conn ,$sql );
  if($reslut === false)
  {
    echo mysqli_error($conn);
  }
?>
<meta charset="utf-8" />
<script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/">

<?php
	session_start();
	$ID =isset($_SESSION['userid']);
	$conn = mysqli_connect('localhost','root', 'aksen756489','training');
	$Exercise_Name = $_POST['Exercise_Name'];
	$Meal_Name= $_POST['Meal_Name'];
	$Years =$_POST['year'];
	$Month =$_POST['month'];
	$Day =$_POST['day'];

	$sql="
	SELECT * FROM exercise ";
	$reslut =mysqli_query($conn ,$sql );
	while($row = mysqli_fetch_array($reslut)){
		if($row['Exercise_Name']==$Exercise_Name){
			$Exercise_Num =$row['Exercise_Num'];
		}
	}

	$sql="
	SELECT * FROM meal ";
	$reslut =mysqli_query($conn ,$sql );
	while($row = mysqli_fetch_array($reslut)){
		if($row['Meal_Name']==$Meal_Name){
			$Meal_Num =$row['Meal_Num'];
		}
	}
	$sql="
	SELECT * FROM member ";
	$reslut =mysqli_query($conn ,$sql );
	while($row = mysqli_fetch_array($reslut)){
		if($row['ID']==$ID){
			$Member_Num =$row['Member_Num'];
		}
	}
	echo "'$Exercise_Num','$Meal_Num','$Member_Num','$Years','$Month','$Day'";
	$sql = "
	INSERT INTO calender(Exercise_Num,Meal_Num,Member_Num,Years,Month,Day)
	VALUES($Exercise_Num,$Meal_Num,$Member_Num,$Years,$Month,$Day)";

	$reslut =mysqli_query($conn ,$sql );
  if($reslut === false)
  {
    echo mysqli_error($conn);
  }
?>
<meta charset="utf-8" />
<script type="text/javascript">alert('추가되었습니다.');</script>
<meta http-equiv="refresh" content="0 url=/main.php">

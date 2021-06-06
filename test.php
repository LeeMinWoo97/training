<?php
$year = date('Y');
$month = 5;
$day =1;
  while($day<32){
    echo $year.$month.$day."<br/>";
    $conn = mysqli_connect('localhost','root', 'aksen756489','training');
    $sql = "SELECT e.Exercise_Kinds,e.Exercise_Name,e.Exercise_Set,e.Exercise_Calories,m.Meal_Name,m.Meal_Calories,c.Years,c.Month,c.Day
            FROM exercise e,meal m, calender c
            WHERE e.Exercise_Num=c.Exercise_Num and m.Meal_Num = c.Meal_Num";
    $reslut = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_array($reslut)){
      if($day==$row['Day']&&$month==$row['Month']&&$year==$row['Years']){
        echo "운동종류:".$row['Exercise_Kinds'].",운동이름:".$row['Exercise_Name'].",세트수:".$row['Exercise_Set'].
          "<br/>,운동소모칼로리:".$row['Exercise_Calories'].",식단이름:".$row['Meal_Name'].",식단열량".$row['Meal_Calories'];
      }
    }
    $day++;
  }
?>

<?php
session_start();
//---- 오늘 날짜
$thisyear = date('Y'); // 4자리 연도
$thismonth = date('n'); // 0을 포함하지 않는 월
$today = date('j'); // 0을 포함하지 않는 일

//------ $year, $month 값이 없으면 현재 날짜
$year = isset($_GET['year']) ? $_GET['year'] : $thisyear;
$month = isset($_GET['month']) ? $_GET['month'] : $thismonth;
$day = isset($_GET['day']) ? $_GET['day'] : $today;

$prev_month = $month - 1;
$next_month = $month + 1;
$prev_year = $next_year = $year;
if ($month == 1) {
    $prev_month = 12;
    $prev_year = $year - 1;
} else if ($month == 12) {
    $next_month = 1;
    $next_year = $year + 1;
}
$preyear = $year - 1;
$nextyear = $year + 1;

$predate = date("Y-m-d", mktime(0, 0, 0, $month - 1, 1, $year));
$nextdate = date("Y-m-d", mktime(0, 0, 0, $month + 1, 1, $year));

// 1. 총일수 구하기
$max_day = date('t', mktime(0, 0, 0, $month, 1, $year)); // 해당월의 마지막 날짜
//echo '총요일수'.$max_day.'<br />';

// 2. 시작요일 구하기
$start_week = date("w", mktime(0, 0, 0, $month, 1, $year)); // 일요일 0, 토요일 6

// 3. 총 몇 주인지 구하기
$total_week = ceil(($max_day + $start_week) / 7);

// 4. 마지막 요일 구하기
$last_week = date('w', mktime(0, 0, 0, $month, $max_day, $year));

$conn = mysqli_connect('localhost','root', 'aksen756489','training');
$sql = "SELECT e.Exercise_Kinds,e.Exercise_Name,e.Exercise_Set,e.Exercise_Calories,m.Meal_Name,m.Meal_Calories,c.Years,c.Month,c.Day
        FROM exercise e,meal m, calender c
        WHERE e.Exercise_Num=c.Exercise_Num and m.Meal_Num = c.Meal_Num";

?>

<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title>메인페이지</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <style>
    font.holy {font-family: tahoma;font-size: 20px;color: #FF6C21;}
    font.blue {font-family: tahoma;font-size: 20px;color: #0000FF;}
    font.black {font-family: tahoma;font-size: 20px;color: #000000;}
    font.green{font-family: tahoma;font-size: 20px;color: #9DFF33 ;}
  </style>
</head>
<body>
	<?php
	if(isset($_SESSION['userid'])){
		echo "<center><h1>{$_SESSION['userid']} 님의 운동 계획 캘린더</h1></center>";
	?>
	<div align="right"><a href="logout.php"><input type="button" value="로그아웃" /></a></div>

	<div class="container">
	<table class="table table-bordered table-responsive">
	  <tr align="center" >
	    <td>
	        <a href=<?php echo 'main.php?year='.$preyear.'&month='.$month . '&day=1'; ?>>◀◀</a>
	    </td>
	    <td>
	        <a href=<?php echo 'main.php?year='.$prev_year.'&month='.$prev_month . '&day=1'; ?>>◀</a>
	    </td>
	    <td height="50" bgcolor="#FFFFFF" colspan="3">
	        <a href=<?php echo 'main.php?year=' . $thisyear . '&month=' . $thismonth . '&day=1'; ?>>
	        <?php echo "&nbsp;&nbsp;" . $year . '년 ' . $month . '월 ' . "&nbsp;&nbsp;"; ?></a>
	    </td>
	    <td>
	        <a href=<?php echo 'main.php?year='.$next_year.'&month='.$next_month.'&day=1'; ?>>▶</a>
	    </td>
	    <td>
	        <a href=<?php echo 'main.php?year='.$nextyear.'&month='.$month.'&day=1'; ?>>▶▶</a>
	    </td>
	  </tr>
	  <tr class="info">
	    <th hight="30">일</td>
	    <th>월</th>
	    <th>화</th>
	    <th>수</th>
	    <th>목</th>
	    <th>금</th>
	    <th>토</th>
	  </tr>

	  <?php
	    // 5. 화면에 표시할 화면의 초기값을 1로 설정
	    $day=1;
      $day2=1;

	    // 6. 총 주 수에 맞춰서 세로줄 만들기
	    for($i=1; $i <= $total_week; $i++){?>
	  <tr>
	    <?php
	    // 7. 총 가로칸 만들기
	    for ($j = 0; $j < 7; $j++) {
	        // 8. 첫번째 주이고 시작요일보다 $j가 작거나 마지막주이고 $j가 마지막 요일보다 크면 표시하지 않음
	        echo '<td height="10" valign="top">';

	        if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))) {

	            if ($j == 0) {
	                // 9. $j가 0이면 일요일이므로 빨간색
	                $style = "holy";
	            } else if ($j == 6) {
	                // 10. $j가 0이면 토요일이므로 파란색
	                $style = "blue";
	            } else {
	                // 11. 그외는 평일이므로 검정색
	                $style = "black";
	            }

              if($day==$today&& $thismonth==$month&&$thisyear==$year){
                  $style="green";
              }

	            // 12. 오늘 날짜면 굵은 글씨
	            if ($year == $thisyear && $month == $thismonth && $day == date("j")) {
	                // 13. 날짜 출력
	                echo '<a class="p-2 text-muted" href="exercise.php?day='.$day.'&month='.$month.'&year='.$year.'" method="post"><font class='.$style.'>';
	                echo $day;
	                echo '</font></a>';
	            } else {
	                echo '<a class="p-2 text-muted" href="exercise.php?day='.$day.'&month='.$month.'&year='.$year.'" method="post"><font class='.$style.'>';
	                echo $day;
	                echo '</font></a>';
	            }
	            // 14. 날짜 증가
	            $day++;
	        }
	        echo '</td>';?>
          <?php } ?>
      <?php
      echo '<tr>';

  	    for ($j = 0; $j < 7; $j++) {
  	        // 8. 첫번째 주이고 시작요일보다 $j가 작거나 마지막주이고 $j가 마지막 요일보다 크면 표시하지 않음
  	        echo '<td height="auto+30" valign="top" width=50 style="word-break:break-all"">';
            if (!(($i == 1 && $j < $start_week) || ($i == $total_week && $j > $last_week))) {
              $reslut = mysqli_query($conn, $sql);
              while($row = mysqli_fetch_array($reslut)){
                if($day2==$row['Day']&&$month==$row['Month']&&$year==$row['Years']){
                  echo "운동종류:".$row['Exercise_Kinds']."<br/>운동이름:".$row['Exercise_Name']."<br/>세트수:".$row['Exercise_Set'].
                    "<br/>식단이름:".$row['Meal_Name']."<br/>운동소모칼로리:".$row['Exercise_Calories']."<br/>식단열량".$row['Meal_Calories'];
                }
              }

              $day2++;
            }
  	        echo '</td>';

  	    }
  	 ?></tr>
    </tr><?php

    }
	 ?>
	</table>
	</div>
	<?php
		}else{
		echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
	}
	?>
</body>
</html>

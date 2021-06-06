<!DOCTYPE html>
<head>
  <meta charset="utf-8" />
	<title>하고싶은 운동 고르기</title>
  <script>
  function Exercise_KindChange(e) {
    var emd =[
      <?php
        $conn = mysqli_connect('localhost', 'root', 'aksen756489', 'training');
        $sql = "Select * FROM exercise";//DISTINCT
        $reslut = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($reslut)){
          if($row['Exercise_Kinds']=='등'){
            $name=$row['Exercise_Name'];
            echo "'$name',";
          }
        }
        ?>
    ]; //등 배열
    var gkcp =[
      <?php
        $reslut = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($reslut)){
          if($row['Exercise_Kinds']=='하체'){
            $name=$row['Exercise_Name'];
            echo "'$name',";
          }
        }
        ?>
    ]; //하체 배열
    var djro =[
      <?php
        $reslut = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($reslut)){
          if($row['Exercise_Kinds']=='어깨'){
            $name=$row['Exercise_Name'];
            echo "'$name',";
          }
        }
        ?>
    ]; //어깨 배열
    var vkf =[
      <?php
        $reslut = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($reslut)){
          if($row['Exercise_Kinds']=='팔'){
            $name=$row['Exercise_Name'];
            echo "'$name',";
          }
        }
        ?>
    ]; //팔 배열
    var rktma =[
      <?php
        $reslut = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($reslut)){
          if($row['Exercise_Kinds']=='가슴'){
            $name=$row['Exercise_Name'];
            echo "'$name',";
          }
        }
        ?>
    ]; //가슴 배열
    var qhrqn =[
      <?php
        $reslut = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($reslut)){
          if($row['Exercise_Kinds']=='복부'){
            $name=$row['Exercise_Name'];
            echo "'$name',";
          }
        }
        ?>
    ]; //복부 배열
    var target = document.getElementById("Exercise_Name");
    if(e.value == "등") var d = emd;
    else if(e.value == "하체") var d = gkcp;
    else if(e.value == "어깨") var d = djro;
    else if(e.value == "팔") var d = vkf;
    else if(e.value == "가슴") var d = rktma;
    else if(e.value == "복부") var d = qhrqn;

    target.options.length = 0;

    for (x in d) {
      var opt = document.createElement("option");
      opt.value = d[x];
      opt.innerHTML = d[x];
      target.appendChild(opt);
    }
  }
  </script>
</head>
<body>
  <form method="post" action ="exercise_ok.php">
  <h1>운동,식단을 선택하세요</h1>
  <fieldset>
  <legend>운동,식단 추가</legend>
    <table>
      <tr>
      <td> 계획날 </td>
      <td>
        <input type= hidden name=year value=<?=$_GET['year'] ?>>
        <input type= hidden name=month value=<?=$_GET['month'] ?>>
        <input type= hidden name=day value=<?=$_GET['day'] ?>>
        <?php
        echo $_GET['year'].".".$_GET['month'].".".$_GET['day'] ;
        ?>
      </td>
      </tr>
      <tr>
      <td>운동 부위</td>
      <td>
        <select class="form-control" id="Exercise_Kinds" name="Exercise_Kinds" onchange="Exercise_KindChange(this)"><?php
      	$conn = mysqli_connect('localhost','root', 'aksen756489','training');
      	$sql = "Select DISTINCT Exercise_Kinds FROM exercise";//DISTINCT
        $reslut = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($reslut)){
        $article['Exercise_Kinds'] =$row['Exercise_Kinds'];
        echo "<option value=".$article['Exercise_Kinds'].">".$article['Exercise_Kinds']."</option>";
        }
        ?>
      </td>
      </tr>
      <tr>
        <td>운동 이름</td>
        <td><select class="form-control" id="Exercise_Name" name="Exercise_Name" >
          <option>운동을 선택해주세요</option>
      </td>
      </tr>
      <tr>
        <td>식단</td>
        <td><select class="form-control" id="Meal_Name" name="Meal_Name" >
          <?php
        	$conn = mysqli_connect('localhost','root', 'aksen756489','training');
        	$sql = "Select Meal_Name FROM meal";
          $reslut = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_array($reslut)){
          $article['Meal_Name'] =$row['Meal_Name'];
          echo "<option value=".$article['Meal_Name'].">".$article['Meal_Name']."</option>";
          }
          ?>
      </td>
      </tr>
    </table>
  <input type="submit" value="추가하기" />
</fieldset>
</form>
</body>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>搜索结果</title>
  </head>
  <body>
    <?php
    $school= $_GET['school'];
    $teacher= $_GET['teacher'];
    if(!$school and !$teacher){
      echo "Error: no data passed";
      exit;
    }
    if(!$school or !$teacher){
      echo "infomation not enough";
      exit;
    }


    $db=@ mysqli_connect('localhost', 'root', '', 'web')
    or die ('unable to connect to server');
    mysqli_query($db, 'set names utf8');
    if(mysqli_connect_errno()){
      echo 'Error: could not connect to database';
      exit;
    }

    $sq= "select * from main_info where school= '$school' and name = '$teacher'";
    $result= mysqli_query($db, $sq);
    $rownum= mysqli_num_rows($result);
    for($i=0; $i<$rownum; $i++){
      $row= mysqli_fetch_assoc($result);
    ?>
    <a href="/info_page/index2.php?name=<?php echo $teacher ?>&school=<?php echo $school ?>"><?php echo $row['school']. ": " . $row['name']; ?></a>
    <?php
    }
    mysqli_free_result($result);
    mysqli_close($db);
    ?>
  </body>
</html>

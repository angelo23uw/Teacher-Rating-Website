<!DOCTYPE html>
<!-- hancy July 28-->

<html lang="zh-CN">
<head>
  <!-- title of index-->
  <title>师论--学生自己的教师评价平台</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="keywords" content="教师，评教，国内，学生，教育，大学，课程，学习">
  <meta name="description" content="为中国学生建立的教师评价系统，只为了更优质的教学资源">

  <!-- the style of index-->
  <link rel="stylesheet" href="index2.css">

  <!-- the script of index-->
  <script src="index2.js"></script>

</head>
<body>
  <!-- starts php-->
  <?php
    //get the target professor and also make sure it exists;
    //
    //$prof_name= $_POST['prof_name'];
    //if(!$prof_name){
    //  echo "错误：暂时没有此教授的信息。";
    //  exit;
    //}

    //connect to database and also check whether error exists
    $db=@ mysqli_connect('localhost','root','rhx1198129562+','web')
    or die ('unable to connect to server');
    mysqli_query($db, "set names utf8");
    if(mysqli_connect_errno()){
      echo 'Error: could not connect to database';
      exit;
    }

    //query for professor main info
    $sq= "select * from main_info";
    $result1= mysqli_query($db, $sq);
    //here shoule add some fun for the searching query to get the target professor
    $row= mysqli_fetch_assoc($result1);


  ?>
  <div id="mainContainer">
  <header>
    <!-- this is the first block, where we can put the name of professor or the result of search-->
    <div id="container1">
      <img src="icon_noperson.jpg" alt="noperson" />
      <div class="topmargin">
        <p>教授</p>
        <h1><?php echo $row['name']; ?></h1>
        <p><?php echo $row['school']; ?><br/><?php echo $row['major']; ?></p>
      </div>
    </div>
    <!-- this is the second block, where it shows a switch bar-->
    <div id="container2">
      <div class="switch">
        <h3>老师</h3>
        <p>PROFS</p>
      </div>
      <div class="switch">
        <h3>学校</h3>
        <p>SCHOOL</p>
      </div>
      <div class="switch">
        <h3>评价</h3>
        <p>RATE</p>
      </div>
    </div>
  </header>
  <main>
    <!-- here is the third block, where it shows the content of the main page -->
    <div id="container3">
      <!-- the top part of the thrid block -->
      <div id="search-bar">
        <div class="writing">
          <h1>条学生的评论</h1>
          <input type="text" class="form-control" placeholder="发表你的评论" />
          <span class="input-group-btn">
            <button class="btn">完善你的评论</button>
          </span>
        </div>
      </div>

      <!-- the sorting bar-->
      <div class="filter">
      	<div id="sum">
      		<p>总评价</p>
      	</div>
        <div id="info">
        	<p>课程信息</p>
        </div>
        <div id="comment">
        	<p>评论</p>
        </div>
      </div>

      <!-- bug: while up to 2 comments, the division will be unsorted and not clear-->
      <?php
      //query for professor rate info
      $id= $row['id'];
      $id_sq= "select * from ".$id."_rate_info";
      $result2= mysqli_query($db, $id_sq);
      $rate_row_num= mysqli_num_rows($result2);
      for($i=0; $i< $rate_row_num; $i++){
        $rate_row= mysqli_fetch_assoc($result2);
         ?>
      <!-- starts one rate container-->
      <div class="comments-container">
        <ul>
          <li>
            <div class="comment">
              <div class="sum-c">
                <div class="time"><p><?php echo $rate_row['r_date'] ?></p></div>
                <p><img src="sadface.jpg" alt="bad" />

                <!--here should add a php fun for determining whether the professor is good or not
                    now, we need a rate table-->
                <span class="left-margin">不行</span><p>
                <p><span class="number"><?php echo $rate_row['rate'] ?></span><span class="left-margin">总评分</span></p>
                <p><span class="number"><?php echo $rate_row['hardness'] ?></span><span class="left-margin">难易程度</span></p>
              </div>
              <div class="info-c">
                <p><?php echo $rate_row['class_info'] ?></p>
                <br /><br />
                <p>学分: <?php echo $rate_row['credit'] ?></p>
                <p>考勤: <?php echo $rate_row['is_attend'] ?></p>
                <br />
                <p>该课程成绩: <?php echo $rate_row['grade'] ?></p>
              </div>
              <div class="comment-c">
                <div class="label"><?php echo $rate_row['tag1'] ?></div>
                <p><?php echo $rate_row['comment'] ?></p>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <?php } ?>
      <!-- ends one rate container-->

    </div>



    <!-- the last container which is like a side bar-->
    <div id="container4">
      <div id="overall">
      	<div class="score">
      		<p>最终评分<br >
      		<span class="bignumber"><?php echo $row['main_rate']; ?></span>
      		</p>
      	</div>
      	<div class="subtotal">
      		<p>
      			是否还会选择这位老师<br />
      			<span class="less-big-number">N/A</span>
      			<br />难易程度<br>
      			<span class="less-big-number"><?php echo $row['main_hardness']; ?></span>
      		</p>
      	</div>
      </div>
      <div class="labels">
      	<div class="label"><?php echo $row['main_tag1'] ?></div>
      	<div class="label"><?php echo $row['main_tag2'] ?></div>
      	<div class="label"><?php echo $row['main_tag3'] ?></div>
      </div>
    </div>
  </main>
  </div>
  <?php
  //free result and close DB
  mysqli_free_result($result1);
  mysqli_free_result($result2);
  mysqli_close($db);
  ?>
</body>
</html>

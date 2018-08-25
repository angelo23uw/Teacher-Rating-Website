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
  <link rel="stylesheet" href="index3.css">

  <!-- the script of index-->
  <script src="index3.js"></script>

</head>
<body>
  <!-- starts the php-->
  <?php
  $db= @mysqli_connect('localhost', 'root', 'rhx1198129562+', 'web')
  or die ('unable to connect to the server');
  mysqli_query($db, 'set names utf8');
  if(mysqli_connect_errno()){
    echo 'Error: could not connect to database';
    exit;
  }
  $sq= "select * from main_info";
  $result= mysqli_query($db, $sq);
  $row = mysqli_fetch_assoc($result);
  ?>

  <div id="mainContainer">

    <!-- starts the header-->
    <header>
      <!-- starts the intro block-->
      <div id="container1">
        <img src="icon_noperson.jpg" alt="noperson" />
        <div class="topmargin">
          <p>教授</p>
          <h1><?php echo $row['name'] ?></h1>
          <p><?php echo $row['school'] ?><br/><?php echo $row['major'] ?></p>
        </div>
      </div>
      <!-- ends the intro block-->

      <!-- starts the switch block-->
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
      <!-- ends the switch block-->
    </header>
    <!-- ends the header-->

    <!-- starts the main content  (also the rate block)-->
    <main>
      <!-- start the form -->
      <form action="submit.php" method="post">
        <!-- starts the rate block-->
        <div id="container3">
          <h3>开始给 <?php echo $row['name'] ?> 教授打分吧</h3>
          <div class="rate">

            <!-- starts the left part of rate block-->
            <div class="left-bar">
              <div class="subtitle">
                <div class="num">1</div>
                <div class="rate-input">
                  <p>课程名称</p>
                  <p class="explain">请保证课程名称正确，否则整条评论可能会被删除。例如：中华文化（艺术篇），信号与系统。</p>
                  <input type="text" name="class_info" placeholder="请输出课程名称" id="course-name"
                  onkeypress="change_input_color(this.id)" onkeyup="unchange_input_color(this.id)">
                </div>
              </div>
              <!-- here are some problems about the form type:
                    the subtitle should be used with multi-options but not div
              -->
              <div class="subtitle">
                <div class="num">2</div>
                <div class="rate-input">
                  <p>总评分</p>

                  <!-- here should be a multi-options with form type-->
                  <div class="wrap">
                    <div class="rate-number" id="num1-1">1</div>
                    <div class="rate-number" id="num2-1">2</div>
                    <div class="rate-number" id="num3-1">3</div>
                    <div class="rate-number" id="num4-1">4</div>
                    <div class="rate-number" id="num5-1">5</div>
                  </div>

                  <input type="hidden" id="overallrating" name="overallrating">
                </div>
              </div>
              <div class="subtitle">
                <div class="num">3</div>
                <div class="rate-input">
                  <p>难度评分</p>
                  <div class="wrap">
                    <div class="rate-number" id="num1-1">1</div>
                    <div class="rate-number" id="num2-1">2</div>
                    <div class="rate-number" id="num3-1">3</div>
                    <div class="rate-number" id="num4-1">4</div>
                    <div class="rate-number" id="num5-1">5</div>
                  </div>
                  <input type="hidden" id="hard-degree" name="hard-degree">
                </div>
              </div>
              <div class="subtitle">
                <div class="num">4</div>
                <div class="rate-input">
                  <p>是否会再次选择这个课程</p>
                  <div class="wrap">
                    <div class="btn" id="reselect-1">是</div>
                    <div class="btn" id="reselect-2">否</div>
                    <input type="hidden" name="reselect" id="rs">
                  </div>
                </div>
              </div>
              <div class="subtitle">
                <div class="num">5</div>
                <div class="rate-input">
                  <p>这门课程是否使用教材</p>
                  <div class="wrap">
                    <div class="btn" id="textbook-1">是</div>
                    <div class="btn" id="textbook-2">否</div>
                    <input type="hidden" name="textbook">
                  </div>
                </div>
              </div>
              <div class="subtitle">
                <div class="num">6</div>
                <div class="rate-input">
                  <p>这门课程考勤是否严格</p>
                  <div class="wrap">
                    <div class="btn" id="attendence-1">是</div>
                    <div class="btn" id="attendence-2">否</div>
                    <input type="hidden" name="attendence" id="at">
                  </div>
                </div>
              </div>
            </div>
            <!-- ends the left part of rate block-->

            <!-- starts the right part of rate block-->
            <div class="right-bar">
                  <div class="subtitle">
                    <div class="num">7</div>
                    <div class="rate-input">
                      <p>选择最多3个标签来描述老师</p>
                      <div class="labels">
                        <div class="label" id="easygoing">平易近人</div>
                        <input type="hidden" name="easygoing" id="eg" value="no">
                        <div class="label" id="respectful">令人尊敬</div>
                        <input type="hidden" name="respectful" id="rp" value="no">
                        <div class="label" id="humorous">风趣幽默</div>
                        <input type="hidden" name="humorous" id="hu" value="no">
                        <div class="label" id="demanding">作业繁重</div>
                        <input type="hidden" name="demanding" id="dm" value="no">
                        <div class="label" id="inspiring">富有灵感</div>
                        <input type="hidden" name="inspiring" id="is" value="no">
                        <div class="label" id="vivid">讲课生动</div>
                        <input type="hidden" name="vivid" id="vi" value="">
                        <div class="label" id="feedback">反馈及时</div>
                        <input type="hidden" name="feedback" id="fb" value="no">
                      </div>
                    </div>
                  </div>
                  <div class="subtitle">
                    <div class="num">8</div>
                    <div class="rate-input">
                      <p>具体评论</p>
                      <textarea id="detail" name="comments" maxlength="350" placeholder="请输入你对老师的评论"></textarea>
                    </div>
                  </div>
                  <p id="moreinfo">更多信息</p>
                  <div class="subtitle">
                    <div class="num">9</div>
                    <div class="rate-input">
                      <p>这门课获得的成绩（可不填）</p>
                      <input type="text" placeholder="请输入你的成绩" id="grade"
                      onkeypress="change_input_color(this.id)" onkeyup="unchange_input_color(this.id)">
                    </div>
                  </div>
                  <div class="subtitle">
                    <div class="num" id="num10">10</div>
                    <div class="rate-input" id="rate10">
                      <p>你的专业是什么（可不填）</p>
                      <input type="text" placeholder="请输入你的专业" id="major"
                      onkeypress="change_input_color(this.id)" onkeyup="unchange_input_color(this.id)">
                    </div>
                  </div>
                </div>
            <!-- ends the right part of rate block-->
          </div>
        </div>
        <!-- ends the rate block-->

        <!-- starts the submit block-->
        <div id="container4">
          <div class="tips">
            <h3>须知</h3>
              <p>请您</p>
              <p class="explain">
                在发表之前，再次检查您的评论，课程名称必须准确。评价时尽量做到客观公正，可以详细讨论老师的教学风格和表达能力。</p>
              <p>请勿</p>
              <p class="explain">
                使用脏话，谩骂，贬低性词语，极端性词语（如“总是”，“从不”，”一直“）。请不要评论时带有强烈情绪。
              </p>
          </div>
          <div class="before-submit">
            <p class="explain">
              通过点击提交按钮，我承认我已经阅读并同意了本网站指南、使用条款和隐私政策的内容。
              提交的数据归本网站所有，并有可能记录提交时的ip地址。
            </p>
          </div>
          <div id="submit">
            <input type="submit" id="rateProfessorBtn" name="rateProfessorBtn" class="save" value="提交">
            <p>取消</p>
          </div>
        </div>
        <!-- ends the submit block-->
      </form>
      <!-- ends the form-->
    </main>
    <!-- ends the main content-->
  </div>
</body>
</html>

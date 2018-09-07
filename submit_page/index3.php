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
  $name= $_REQUEST['name'];
  $school= $_REQUEST['school'];
  if(!$name and !$school){
    echo "no data passed";
    exit;
  }
  if(!$name or !$school){
    echo "data not enough";
    exit;
  }

  $db= @mysqli_connect('localhost', 'root', '', 'web')
  or die ('unable to connect to the server');
  mysqli_query($db, 'set names utf8');
  if(mysqli_connect_errno()){
    echo 'Error: could not connect to database';
    exit;
  }

  $sq= "select * from main_info where name= '$name' and school= '$school'";
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
          <p>教授:</p>
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
      <form action="submit.php"  method="post" id="form">
        <input type="hidden" name="id" value=<?php echo $row['id']; ?>>
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
                  <input type="text" name="class_info" placeholder="请写出课程名称" id="course-name" autocomplete="off" autofocus="on"
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
                    <div class="rate-number" id="num1-1">
                      1
                      <span class="main_rate_hint" style="width: 80px; margin-left: -50px">
                        发展空间很大
                        <img src="sad.png" alt="verysad" style="width: 20px">
                      </span>
                    </div>
                    <div class="rate-number" id="num2-1">
                      2
                      <span class="main_rate_hint" style="width: 60px; margin-left: -40px">
                        有待努力
                        <img src="sad.png" alt="sad" style="width: 20px">
                      </span>

                    </div>
                    <div class="rate-number" id="num3-1">
                      3
                      <span class="main_rate_hint">
                        不算亏
                        <img src="normal.png" alt="normal" style="width: 20px">
                      </span>

                    </div>
                    <div class="rate-number" id="num4-1">
                      4
                      <span class="main_rate_hint">
                        来对了
                        <img src="smile.png" alt="good" style="width: 20px">
                      </span>

                    </div>
                    <div class="rate-number" id="num5-1">
                      5
                      <span class="main_rate_hint">
                        太棒了
                        <img src="smile.png" alt="excellent" style="width: 20px">
                      </span>

                    </div>
                  </div>
                  <input type="hidden" id="overallrating" name="overallrating">
                </div>
              </div>
              <div class="subtitle">
                <div class="num">3</div>
                <div class="rate-input">
                  <p>难度评分</p>
                  <div class="wrap">
                    <div class="rate-number" id="num1-2">
                      1
                      <span class="main_rate_hint">简单</span>
                    </div>
                    <div class="rate-number" id="num2-2">
                      2
                      <span class="main_rate_hint">较简单</span>
                    </div>
                    <div class="rate-number" id="num3-2">
                      3
                      <span class="main_rate_hint">一般</span>
                    </div>
                    <div class="rate-number" id="num4-2">
                      4
                      <span class="main_rate_hint">较困难</span>
                    </div>
                    <div class="rate-number" id="num5-2">
                      5
                      <span class="main_rate_hint">很难</span>
                    </div>
                  </div>
                  <input type="hidden" id="hard-degree" name="hard-degree">
                </div>
              </div>
              <div class="subtitle">
                <div class="num">4</div>
                <div class="rate-input">
                  <p>这门课程的学分数量</p>
                    <select name="credit" class="listdown" id="credit">
                      <option value="0">0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                </div>
              </div>
              <div class="subtitle">
                <div class="num">5</div>
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
                    <div class="num">6</div>
                    <div class="rate-input">
                      <p>选择最多3个标签来描述老师<br>
                        <b>(注意:多出的标签将不会被录入)</b></p>
                      <div class="labels">
                        <div class="label" id="easygoing">
                          平易近人
                          <input type="hidden" name="easygoing" id="eg">
                        </div>
                        <div class="label" id="respectful">
                          令人尊敬
                          <input type="hidden" name="respectful" id="rp">
                        </div>
                        <div class="label" id="humorous">
                          风趣幽默
                          <input type="hidden" name="humorous" id="hu">
                        </div>
                        <div class="label" id="demanding">
                          作业繁重
                          <input type="hidden" name="demanding" id="dm">
                        </div>
                        <div class="label" id="inspiring">
                          富有灵感
                          <input type="hidden" name="inspiring" id="is">
                        </div>
                        <div class="label" id="vivid">
                          讲课生动
                          <input type="hidden" name="vivid" id="vi">
                        </div>
                        <div class="label" id="feedback">
                          反馈及时
                          <input type="hidden" name="feedback" id="fb">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="subtitle">
                    <div class="num">7</div>
                    <div class="rate-input">
                      <p>具体评论</p>
                      <textarea id="detail" name="comments" maxlength="350" placeholder="请输入你对老师的评论"></textarea>
                    </div>
                  </div>
                  <p id="moreinfo">更多信息</p>
                  <div class="subtitle">
                    <div class="num">8</div>
                    <div class="rate-input">
                      <p>这门课获得的成绩（可不填）</p>
                        <select name="grade" class="listdown" id="grade">
<<<<<<< HEAD
                          <option value="">无</option>
=======
                          <option value="0">无</option>
>>>>>>> develop
                          <option value="A">A(90-100)</option>
                          <option value="B">B(80-90)</option>
                          <option value="C">C(70-80)</option>
                          <option value="D">D(60-70)</option>
                          <option value="E">E(&lt60)</option>
                        </select>
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
            <div id="return">
              <a href="/info_page/index2.php?name=<?php echo $row['name'] ?>&school=<?php echo $row['school']; ?>">
                <div class="sub_return">
                  返回该教师评论页
                </div>
              </a>
            </div>
          </div>
        </div>
        <!-- ends the submit block-->
      </form>
      <!-- ends the form-->
    </main>
    <!-- ends the main content-->
  </div>
  <?php
  mysqli_free_result($result);
  mysqli_close($db);
   ?>
</body>
</html>

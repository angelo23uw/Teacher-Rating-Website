<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>submitted</title>
  </head>
  <body>
    <p>it is submitted</p>
    <?php
    $date= date("Y-m-d");
    $id= $_POST['id'];
    $class_info= $_POST['class_info'];
    $rate= $_POST['overallrating'];
    $hardness= $_POST['hard-degree'];
    $is_attend= $_POST['attendence'];
    $credit= $_POST['credit'];
    $comment= $_POST['comments'];

    //get three tags:tag1, tag2, tag3;
    //if there is no tag, three tags return null;
    //if there is any tag but less than or equal to 3, return the value by order on number;
    //if there is up to 3 tags; return the value to 3 tags and ignore the overflow values.
    $label= array('easygoing', 'respectful', 'humorous', 'demanding', 'inspiring', 'vivid', 'feedback');
    $label_num= count($label);
    $valued_label= array();
    $valued_label_index= 0;
    for ($i=0; $i < $label_num; $i++) {
      $label_val= $_POST[$label[$i]];
      if($label_val){
        $valued_label[$valued_label_index]= $label_val;
        $valued_label_index++;
      }
    }
    switch ($valued_label_index) {
      case 0:
        $tag1= null;
        $tag2= null;
        $tag3= null;
        break;
      case 1:
        $tag1= $valued_label[0];
        $tag2= null;
        $tag3= null;
        break;
      case 2:
        $tag1= $valued_label[0];
        $tag2= $valued_label[1];
        $tag3= null;
        break;
      default:
        $tag1= $valued_label[0];
        $tag2= $valued_label[1];
        $tag3= $valued_label[2];
        break;
    }


    //identify whether there's a grade input:
    //if exists, input into the DB; else, ignore input
    $grade= $_POST['grade'];
    if($grade == 0){
      $sq= "insert into ". $id . "_rate_info (r_date, rate, hardness, class_info, comment, tag1, tag2, tag3, credit, is_attend)
      values ('$date', '$rate', '$hardness', '$class_info', '$comment', '$tag1', '$tag2', '$tag3', '$credit', '$is_attend')";
    }else{
      $sq= "insert into ". $id . "_rate_info (r_date, rate, hardness, class_info, comment, tag1, tag2, tag3, credit, is_attend, grade)
      values ('$date', '$rate', '$hardness', '$class_info', '$comment', '$tag1', '$tag2', '$tag3', '$credit', '$is_attend', '$grade')";
    }


    $db=@ mysqli_connect('localhost', 'root', '', 'web')
    or die ('unable to connect to server');
    mysqli_query($db, 'set names utf8');
    if(mysqli_connect_errno()){
      echo "Error: cannot connect to database";
      exit;
    }
    mysqli_query($db, $sq);

    //get the average of rate from the id_rate_info,
    // and then update the main_rate in the main_info
    $sq_avg_rate= "select avg(rate) from ". $id. "_rate_info";
    $avg_rate_result= mysqli_query($db, $sq_avg_rate);
    $avg_rate_row= mysqli_fetch_assoc($avg_rate_result);
    $average_rate= $avg_rate_row['avg(rate)'];


    //get the average of hardness from the id_rate_info,
    // and then update the main_hardness in the main_info
    $sq_avg_hardness= "select avg(hardness) from ". $id. "_rate_info";
    $avg_hardness_result= mysqli_query($db, $sq_avg_hardness);
    $avg_hardness_row= mysqli_fetch_assoc($avg_hardness_result);
    $average_hardness= $avg_hardness_row['avg(hardness)'];

    //return the rounded main_rate and main_hardness
    $rounded_rate= round($average_rate, 1);
    $rounded_hardness= round($average_hardness, 1);


    //get the grades from the id_rate_info in the rules that:
    //A=4, B=3, C=2, D=1, E=0,
    //and avg them;
    //after avg them, try to rate the result into A,B,C,D,E;
    //and then update the main_grade in the main_info
    $sq_grade= "select grade from ". $id. "_rate_info";
    $grade_result= mysqli_query($db, $sq_grade);
    $grade_row_num= mysqli_num_rows($grade_result);
    $all_grades=0;
    $grades_no_null_num=0;
    for($i=0; $i< $grade_row_num; $i++){
      $grade_row= mysqli_fetch_row($grade_result);
      if($grade_row[0]){
        $grades_no_null_num++;
      }
      switch ($grade_row[0]) {
        case 'A':
          $all_grades+=4;
          break;
        case 'B':
          $all_grades+=3;
          break;
        case 'C':
          $all_grades+=2;
          break;
        case 'D':
          $all_grades+=1;
          break;
        case 'E':
          $all_grades+=0;
          break;
        default:
          break;
      }
    }
    if($grades_no_null_num == 0){
      $avg_grades= 0;
    }else{
      $avg_grades= round($all_grades/$grades_no_null_num, 2);
    }
    $final_grade;
    if($avg_grades<0.5){
      $final_grade= "E";
    }elseif($avg_grades>=0.5 and $avg_grades<1.5){
      $final_grade= "D";
    }elseif($avg_grades>=1.5 and $avg_grades<2.5){
      $final_grade= "C";
    }elseif($avg_grades>=2.5 and $avg_grades<3.5){
      $final_grade= "B";
    }else{
      $final_grade= "A";
    }


    //update the tags:
    //first of all, count each of the labels in a specific rate_info table(including tag1,tag2,tag3);
    //secondly, compare with each other and get the first three labels;
    //if there is no more than 3 labels in a rate_info, then just show 1 or 2 label(s);
    //finally, return the final tags and update the main_info table
    $label_cn= array('平易近人', '令人尊敬', '风趣幽默', '作业繁重', '富有灵感', '讲课生动', '反馈及时');
    $label_cn_num= array();
    $label_num= count($label_cn);
    for($i=0; $i<$label_num; $i++){
      $sq_tags= "select tag1, tag2, tag3 from ". $id. "_rate_info where tag1='$label_cn[$i]' or tag2='$label_cn[$i]' or tag3='$label_cn[$i]'";
      $tags_result= mysqli_query($db, $sq_tags);
      $label_cn_num[$label_cn[$i]]= mysqli_num_rows($tags_result);
    }
    arsort($label_cn_num);
    if(array_values($label_cn_num)[0] != 0){
      $main_tag1= array_keys($label_cn_num)[0];
    }else{
      $main_tag1= null;
    }
    if(array_values($label_cn_num)[1] != 0){
      $main_tag2= array_keys($label_cn_num)[1];
    }else{
      $main_tag2= null;
    }
    if(array_values($label_cn_num)[2] != 0){
      $main_tag3= array_keys($label_cn_num)[2];
    }else{
      $main_tag3= null;
    }



    //update main_rate and main_hardness(main_grade and main_tags also needed) in main_info table
    $sq_update= "update main_info set main_rate= '$rounded_rate', main_hardness= '$rounded_hardness',
    main_grade= '$final_grade', main_tag1= '$main_tag1', main_tag2= '$main_tag2', main_tag3= '$main_tag3' where id= '$id'";
    mysqli_query($db, $sq_update);


    mysqli_close($db);
    ?>
  </body>
</html>

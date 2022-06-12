<?php
require ('lib/init.php');
if (!acc()){
    header('location:login.html');
}
// get
$index = array();
$index['userid'] = trim($_GET['user_id']);
$index['courseid'] = trim($_GET['course_id']);
// find
$sql = "select count(*) from stu_course where stu_id = '$index[userid]' and course_id = '$index[courseid]'";
if (!mGetOne($sql)) error('对应的数据不存在！','scoreinfo.php');
// find parts
$sql = "select way1,way2,way3,way4 from scoresum where course_id = '$index[courseid]'";
$parts = mGetRow($sql);
// find stu
$sql = "select stunum,nick,course_name,sum,score1,score2,score3,score4 from users,course,stu_course where users.user_id = stu_course.stu_id and stu_course.course_id = course.course_id 
and user_id = '$index[userid]' and stu_course.course_id = '$index[courseid]'";
$stu = mGetRow($sql);
if (empty($_POST)){
    include (ROOT . '/view/admin/scoreedit.html');
}else{
    $score['score1'] = trim($_POST['score1']);
    $score['score2'] = trim($_POST['score2']);
    $score['score3'] = trim($_POST['score3']);
    $score['score4'] = trim($_POST['score4']);
    if (empty($score['score1'])) error('平时成绩错误！','javascript:history.back(-1)');
    if (empty($score['score2'])) error('期中成绩错误！','javascript:history.back(-1)');
    if (empty($score['score3'])) error('实验成绩错误！','javascript:history.back(-1)');
    if (empty($score['score4'])) error('期末成绩错误！','javascript:history.back(-1)');
    $score['sum'] = $score['score1']*$parts['way1'] + $score['score2']*$parts['way2']
        + $score['score3']*$parts['way3'] + $score['score4']*$parts['way4'];
    // update
    $sql = "update stu_course set score1 = '$score[score1]',score2 = '$score[score2]',score3 = '$score[score3]',
                      score4 = '$score[score4]',sum = '$score[sum]' where  stu_id = '$index[userid]' and course_id = '$index[courseid]'";
    if (!mQuery($sql)){
        error('更新成绩失败！','javascript:history.back(-1)');
    }else{
        succ('更新成绩成功！','scoreinfo.php');
    }
}

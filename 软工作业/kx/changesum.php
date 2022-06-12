<?php
require ('lib/init.php');
if (!acc()){
    header('location:login.php');
}
// get
$course_id = trim($_GET['course_id']);
if (empty($course_id)) error('参数错误！','javascript:history.back(-1)');
// find
$sql = "select count(*) from course where course_id = '$course_id'";
if (!mGetOne($sql)) error('课程id不存在！','javascript:history.back(-1)');
// get parts
$sql = "select course_name,way1,way2,way3,way4 from scoresum 
    left join course on scoresum.course_id = course.course_id where scoresum.course_id = '$course_id'";
$scoreparts = mGetRow($sql);
if (empty($_POST)){
    include(ROOT . '/view/admin/changesum.html');
}else{
    // 查询当前课程的成绩比例
    $newparts = array();
    $newparts['way1'] = trim($_POST['way1']);
    $newparts['way2'] = trim($_POST['way2']);
    $newparts['way3'] = trim($_POST['way3']);
    $newparts['way4'] = trim($_POST['way4']);
    if (empty($newparts['way1']) || $newparts['way1'] >= 1) error('平时成绩错误！','javascript:history.back(-1)');
    if (empty($newparts['way2']) || $newparts['way2'] >= 1) error('期中成绩错误！','javascript:history.back(-1)');
    if (empty($newparts['way3']) || $newparts['way3'] >= 1) error('实验成绩错误！','javascript:history.back(-1)');
    if (empty($newparts['way4']) || $newparts['way4'] >= 1) error('期末成绩错误！','javascript:history.back(-1)');
    // 查找该学科所有成绩并进行计算
    $sql = "select course_id,stu_id,score1,score2,score3,score4 from stu_course where course_id = '$course_id'";
    $oldscore = mGetAll($sql);
    foreach ($oldscore as $o){
        $stuid = $o['stu_id'];
        $courseid = $o['course_id'];
        $sum = $o['score1']*$newparts['way1'] + $o['score2']*$newparts['way2']
            + $o['score3']*$newparts['way3'] + $o['score4']*$newparts['way4'];
        $sql = "update stu_course set sum = '$sum' where stu_id = '$stuid' and course_id = '$course_id'";
        if (!mQuery($sql)) error('修改失败！','javascript:history.back(-1)');
    }
    succ('修改成功！成绩已经更新了！','scoreinfo.php');
}

<?php
require ('lib/init.php');
// 判断是否登录
if (!acc()){
    header('location:login.php');
}
// 加载老师名单
$sql = "select user_id,nick from users where role_id = 3";
$teachers = mGetAll($sql);
if (empty($_POST)){
    include (ROOT . '/view/admin/courseadd.html');
}else{
    // 取得post的值并且去掉空格
    $newcourse['course_name'] = trim($_POST['course_name']);
    $newcourse['course_teaid'] = trim($_POST['course_teaid']);
    if (empty($newcourse['course_name'])) error('课程名不能为空！','javascript:history.back(-1)');
    // 判断课程是否存在
    $sql = "select count(*) from course where course_name = '$newcourse[course_name]'";
    $rs = mGetOne($sql);
    if ($rs) error('课程已经存在！','javascript:history.back(-1)');
    // 判断教师是否存在
    $sql = "select role_id from users where user_id = '$newcourse[course_teaid]'";
    $rs = mGetRow($sql);
    if ($rs['role_id'] != 3) error('参数错误！','javascript:history.back(-1)');
    // 将课程信息插入表单
    $sql = "insert into course (course_name,course_teaid,stu_num) 
values ('$newcourse[course_name]','$newcourse[course_teaid]','0')";
    if (!mQuery($sql)) {
        error('添加课程失败！','javascript:history.back(-1)');
    }else{
        header('location:course.php');
    }
}
?>

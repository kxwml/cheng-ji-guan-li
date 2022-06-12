<?php
require ('lib/init.php');
// 判断是否登录
if(!acc()){
    header('location:login.php');
}
// 取得传递的值
$course_id = trim($_GET['course_id']);
if (empty($course_id)) error('参数错误！','javascript:history.back(-1)');
$sql = "select count(*) from course where course_id = '$course_id'";
if (!mGetOne($sql)) error('参数错误！','javascript:history.back(-1)');
$sql = "select course_name,course_teaid,course_id from course where course_id = '$course_id'";
$oldcourse = mGetRow($sql);
// 加载老师名单
$sql = "select user_id,nick from users where role_id = 3";
$teachers = mGetAll($sql);
if (empty($_POST)){
    include (ROOT . '/view/admin/courseedit.html');
}else{
    $newcourse['course_name'] = trim($_POST['course_name']);
    $newcourse['course_teaid'] = trim($_POST['course_teaid']);
    if (empty($newcourse['course_name'])) error('课程名不能为空！','javascript:history.back(-1)');
    // 判断教师是否存在
    $sql = "select role_id from users where user_id = '$newcourse[course_teaid]'";
    $rs = mGetRow($sql);
    if ($rs['role_id'] != 3) error('参数错误！','javascript:history.back(-1)');
    $sql = "update course set course_name = '$newcourse[course_name]',course_teaid = '$newcourse[course_teaid]'
    where course_id = '$oldcourse[course_id]'";
    if(!mQuery($sql)){
        error('修改失败！','javascript:history.back(-1)');
    }else{
        header('location:course.php');
    }
}

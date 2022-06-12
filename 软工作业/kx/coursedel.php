<?php
require ('lib/init.php');
// 判断用户是否登录
if (!acc()){
    header('location:login.php');
}
$course_id = trim($_GET['course_id']);
if (empty($course_id)) error('参数错误！','javascript:history.back(-1)');
// 存在与否
$sql = "select count(*) from course where course_id = '$course_id'";
if (!mGetOne($sql)) error('课程ID不存在','javascript:history.back(-1)');
// 是否有学生选课 有则无法删除
$sql = "select stu_num from course where course_id = '$course_id'";
$number = mGetRow($sql);
if ($number['stu_num'] > 0) error('有学生选修该门课，无法删除课程！','javascript:history.back(-1)');
//删除课程
$sql = "delete from course where course_id = '$course_id'";
if (!mQuery($sql)){
    error('删除失败！','javascript:history.back(-1)');
}else{
    header('location:course.php');
}

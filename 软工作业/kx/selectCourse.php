<?php
require ('lib/init.php');
// 检测用户是否登录
if (!acc()){
    header('location:login.php');
}
// 加载课程名单
$courseinfo = array();
$sql = "select course_name,stu_num,nick from course,users where users.user_id = course.course_teaid";
$courses = mGetAll($sql);

require (ROOT . '/view/admin/selectCourse.html');

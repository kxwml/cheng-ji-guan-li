<?php
require ('lib/init.php');
if (!acc()){
    header('location:login.php');
}
// 加载登录的老师的课程信息
$user['user_name'] = $_COOKIE['user'];
$sql = "select course_name,course_id from users,course where users.user_id = course.course_teaid and user_name = '$user[user_name]'";
$courses = mGetAll($sql);

require (ROOT . '/view/admin/scoreinfo.html');

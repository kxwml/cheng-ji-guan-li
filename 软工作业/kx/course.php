<?php
require ('lib/init.php');
// 检测用户是否登录
$num = 1;
if (!acc()) {
    header('location: login.php');
}
// 加载课程表与授课老师
$sql = "select user_name,course_name,course_id,user_id,stu_num,nick from users left join course on 
    users.user_id = course.course_teaid where course_name is not null";
$courses = mGetAll($sql);

require (ROOT . '/view/admin/course.html');


<?php
require ('lib/init.php');
if (!acc()){
    header('location:login.php');
}
$num = 1;
$user['user_name'] = $_COOKIE['user'];
$sql = "select stunum,nick,course_name,sum,score1,score2,score3,score4,user_id,stu_course.course_id 
from users,course,stu_course where users.user_id = stu_course.stu_id 
                               and stu_course.course_id = course.course_id and user_name = '$user[user_name]'";
$allscore = mGetAll($sql);
require (ROOT . '/view/admin/stuscore.html');

<?php
require ('lib/init.php');
if (!acc()){
    header('location:login.php');
}
$num = 1;
// load all
$sql = "select stunum,nick,course_name,sum,score1,score2,score3,score4,user_id,stu_course.course_id 
from users,course,stu_course where users.user_id = stu_course.stu_id and stu_course.course_id = course.course_id";
$allscore = mGetAll($sql);
require (ROOT . '/view/admin/scorelist.html');

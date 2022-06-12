<?php
require ('lib/init.php');
if (!acc()){
    header('location:login.php');
}
// 从cookie取得教师信息
$user['user_name'] = $_COOKIE['user'];
// 加载该用户权限
$sql = "select user_id,role_name,nick from users left join role on users.role_id = role.role_id where user_name = '$user[user_name]'";
$userinfo = mGetRow($sql);
if (!$userinfo){
    error('参数错误！');
}
$user['user_role'] = $userinfo['role_name'];
require (ROOT . '/view/admin/teacher.html');

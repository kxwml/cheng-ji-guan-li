<?php
require ('lib/init.php');
if (empty($_POST)){
    include (ROOT . '/view/admin/register.html');
}else{
    //get
    $user['username'] = $_POST['name'];
    $user['password'] = $_POST['password'];
    $user['salt'] = randStr(6);
    $user['role'] = $_POST['role'];
    if (empty($user['username'])) error('用户名不能为空！','javascript:history.back(-1)');
    if (empty($user['password'])) error('密码不能为空！','javascript:history.back(-1)');
    $user['pass'] = md5($user['password'].$user['salt']);
    $user['class'] = $_POST['class'];
    $user['nick'] = $_POST['nick'];
    $user['stunum'] = $_POST['stunum'];
    $sql = "insert into users (salt,user_name,user_password,role_id,nick,class,stunum) values (
        '$user[salt]','$user[username]','$user[pass]','$user[role]','$user[nick]','$user[class]','$user[stunum]')";
    if (!mQuery($sql)){
        error('注册失败！','register.php');
    }else{
        succ('注册成功！返回登录吧！','login.php');
    }

}

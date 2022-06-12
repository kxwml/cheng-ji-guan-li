<?php
require ('./lib/init.php');
$user = array();
if (empty($_POST)){
    require (ROOT . '/view/admin/login.html');
}else{
    $user['name'] = trim($_POST['name']);
    $user['password'] = trim($_POST['password']);
    if ($user['name'] == '' || $user['password'] ==''){
        error('用户名或者密码不能为空！','javascript:history.back(-1)');
    }
    $sql = "select * from users where user_name = '$user[name]'";
    $row = mGetRow($sql);
    if (!$row){
        error ('用户名错误','javascript:history.back(-1)');
    }else{
        if(md5($user['password'].$row['salt']) === $row['user_password']){
            setcookie('user',$user['name']);
            setcookie('ccode',cCode($user['name']));
            if ($row['role_id'] == 1) header('Location:admin.php');
            if ($row['role_id'] == 2) header('Location:student.php');
            if ($row['role_id'] == 3) header('Location:teacher.php');
        }else{
            error ('密码错误','javascript:history.back(-1)');
        }
    }
}
?>

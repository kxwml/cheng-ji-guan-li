<?php

/**
 * @param string $res
 * 成功的提示信息
 */

function succ($res = "成功",$url='#'){
    $result = "succ";
    require (ROOT . '/view/admin/info.html');
    exit();
}

/**
 * @param string $res
 * 失败返回的信息
 */
function error($res = "失败",$url='#'){
    $result = "fail";
    require (ROOT . '/view/admin/info.html');
    exit();
}

/**
 * 获取来访者的真实ip
 *
 */
function getRealIp(){
    static $realip = null;
    if ($realip !== null){
        return $realip;
    }
    if (getenv('REMOTE_ADDR')){
        $realip = getenv('REMOTE_ADDR');
    }else if(getenv('HTTP_CLIENT_IP')){
        $realip = getenv('HTTP_CLIENT_IP');
    }else if(getenv('HTTP_X_FROWARD_FOR')){
        $realip = getenv('HTTP_X_FROWARD_FOR');
    }
    return $realip;
}

/**
 * 生成分页代码
 * @param int $num 文章总数
 * @param int $curr 当前展示的页码数 $curr-2 $curr-1 $curr $curr+1 $curr+2
 * @param int $cnt 每页显示的条数
 */
function getPage(int $num, int $curr, int $cnt){
    //最大的页码
    $max = ceil($num/$cnt);
    //最左侧页码
    $left = max(1,$curr - 2);
    //最右侧页码
    $right = min($left + 4 , $max);
    $left = max(1,$right - 4);

    $page = array();
    for($i = $left;$i<=$right;$i++){
        $_GET['page'] = $i;
        $page[$i] = http_build_query($_GET);
    }
    return $page;
}

/**
 * 生成随机字符串
 * @param int $num 生成随机字符串的个数
 * @return str 生成的随机字符串
 */
function randStr($num = 6){
    $str = str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
    return substr($str,0,$num);
}

/**
 * 创建目录 ROOT . '/upload/****'
 */
function createDir()
{
    $path = '/upload/' . date('Y/m/d');
    $fpath = ROOT . $path;
    if (is_dir($fpath) || mkdir($fpath, 0777, true)) {
        return $path;
    } else {
        return false;
    }
}

/**
 * 获取文件后缀
 * @parma str $filename 文件名
 * @return str 文件的后缀名,带.
 */
function getExt($filename){
    return strrchr($filename,'.');
}

/**
 * 生成略缩图
 * @param str $oimg /upload/******
 * @param int $sw 生成缩略图的宽
 * @param int $sh 生成缩略图的高
 * @return str $path 缩略图的路径 /upload/*****
 */

function makeThemb($oimg,$sw = 200 ,$sh = 200){
//    略缩图存放的路径
    $simg = dirname($oimg) . '/' . randStr(6) . '.png';
// 获取大图和略缩图的绝地路径
    $opath = ROOT . $oimg;//原图的绝对路径
    $spath = ROOT . $simg;//最终生成的略缩图
//    创建小画布
    $spic = imagecreatetruecolor($sw,$sh);
//    创建白色
    $white = imagecolorallocate($spic,255,255,255);
    imagefill($spic,0,0,$white);
    //    获取大图信息
    list($bw,$bh,$btye) = getimagesize($opath);
    $map = array(
        1 => 'imagecreatefromgif',
        2 => 'imagecreatefromjpeg',
        3 => 'imagecreatefrompng',
        15 => 'imagecreatefromwbmp'
    );
    if (!isset($map[$btye])){
        return false;
    }
    $opic = $map[$btye]($opath);//大图资源
//   计算缩略图
    $rate = min($sw/$bw,$sh/$bh);
    $zw = $bw * $rate; //最终返回的略缩图宽
    $zh = $bh * $rate; //最终返回的略缩图高
    imagecopyresampled($spic,$opic,($sw - $zw)/2,($sh - $zh)/2,0,0,$zw,$zh,$bw,$bh);
    imagepng($spic,$spath);
    imagedestroy($spic);
    imagedestroy($opic);
    return $simg;
}

/**
 * 检测用户时候登录
 * @return bool
 */

function acc(){
    if (!isset($_COOKIE['user']) || !isset($_COOKIE['ccode'])){
        return false;
    }
    return $_COOKIE['ccode'] === cCode($_COOKIE['user']);
}

/**
 * 用反斜线转义字符串
 * @param arr 待转义的数组
 * @return arr 转义后的数组
 */

function _addslashes($arr){
    foreach ($arr as $k => $v){
        if (is_string($v)){
            $arr[$k] = addslashes($v);
        }else if(is_array($v)){
            $arr[$k] = _addslashes($v);
        }
    }
    return $arr;
}

/**
 * 加密用户名
 *
 * @param str $name 用户登录时 输入的用户名
 * @return str md5（用户名 + salt）
 */

function cCode($name){
    $salt = require (ROOT . '/lib/config.php');
    return md5($name . '|' . $salt['salt']);
}

?>

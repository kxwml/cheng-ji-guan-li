<?php
/**
 *
 * mysql.php mysql操作的系列函数
 * @author hasgenvts
 */

/**
  *
  * 连接数据库
  * @return resource 连接成功，返回资源
  *
 */

function mConn(){
    static $conn = null ;
    if ($conn === null){
        $cfg = require ('config.php');
        $conn = mysqli_connect($cfg['host'], $cfg['user'] , $cfg['pwd']);
        mysqli_query($conn,'use '.$cfg['db']);
        mysqli_query($conn,'set names ' . $cfg['charset']);
    }
    return $conn;
}

/**
 *  查询的函数
 * @return mixed resource/bool
 */
function mQuery($sql){
    $rs =  mysqli_query(mConn(),$sql);
    if (!$rs){
        mLog($sql);
    }else{
        mLog($sql . "\n" . mysqli_error(mConn()));
    }
    return $rs;
}

/**
 *
 * log日志记录功能
 * @param str $str 待记录的字符串
 */

function mlog($str){
    $filename = ROOT .'/log/' . date('Ymd') . '.txt';
    $log = "------------------------------\n" . date('Y/m/d H:i:s') . "\n" . $str . "\n" . "------------------------------\n\n";
    return file_put_contents($filename,$log,FILE_APPEND);
}
/**
 *
 * select 查询返回多行数据
 * @param str $sql select 待查询的sql语句
 *  @return mixed select 查询成功，返回二维数组，失败返回false
 */
function mGetAll($sql){
    $rs = mQuery($sql);
    if (!$rs){
        return false;
    }
    $data = array();
    while($row = mysqli_fetch_assoc($rs)){
        $data[] = $row;
    }
    return $data;
}

/**
 *
 * select 取出一行数据
 *
 * @param str $sql 待查询的sql语句
 * @return arr/false 查询成功返回一个一维数组
 */

function mGetRow($sql){
    $rs = mQuery($sql);
    if (!$rs){
        return false;
    }
    return mysqli_fetch_assoc($rs);
}

/**
 *  select 查询返回一个结果
 * @param str $str 待查询的select语句
 * @return mixed 成功,返回结果，失败返回false
 */

function mGetOne($sql){
    $rs = mQuery($sql);
    if (!$rs){
        return false;
    }
    return mysqli_fetch_row($rs)[0];
}

/**
 * 自动拼接 insert 和 update sql语句 ，并且调用mQuery() 去执行sql
 *
 * @param str $table 表名
 * @param arr $data 接收到的数据
 * @param str $act 动作 默认为‘insert’
 * @param str $where 防止update更改时少加where 条件
 * @return bool insert 或者 update 成功或者失败
 */

function mExec($table,$data,$act = 'insert',$where = 0){
    if ($act == 'insert'){
        $sql = "insert into $table (";
        $sql .= implode(',',array_keys($data)) . ") values ('" ;
        $sql .= implode("','",array_values($data)) . "')";
        return mQuery($sql);
    }else if($act == 'update'){
        $sql = "update $table set ";
        foreach($data as $k => $v){
            $sql .= $k . "='" . $v . "'," ;
        }
        $sql = rtrim($sql,',') . "  where  " .$where;
        return mQuery($sql);
    }
}


/**
 * 取得上一步insert操作产生的主键id
 *
 */

function getLastId(){
    return mysqli_insert_id(mConn());
}
?>

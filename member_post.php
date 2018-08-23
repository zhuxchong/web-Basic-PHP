<?php
/**
 * Created by PhpStorm.
 * User: Chong
 * Date: 2018/8/21
 * Time: 17:14
 */

require 'file/mysql.php';
require 'file/tool.php';

if (isset($_POST['send'])) {
    $face           =   $_POST['face'];
    $password       =   $_POST['password'];
    $notpassword    =   $_POST['notpassword'];
    if (empty($face.$password.$notpassword)){
        alert("no change");
    }
    $groupSql=empty($face) ?"" : "face='$face'";//if face is empty="" or face=face
    if(!empty($password.$notpassword)){
        if(strlen($password)<6){
            alert("password > 6");
        }
        else if($password!=$notpassword){
            alert("wrong password");
        }
        require 'file/config.php';
        $password = sha1(SALT.$password);
        $groupSql=empty($groupSql)?"password='$password'":$groupSql.",password='$password'";
    }
    $updataSql="UPDATE zhidao_users SET $groupSql WHERE id='{$_COOKIE['id']}'";
    //echo $updataSql;
    mysqli_query($db,$updataSql);
    if(mysqli_affected_rows($db)>0){
        location("changed",'member.php');
  }
   else{
        alert('no change');   }
}
else{
    exit('Wrong');
}
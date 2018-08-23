<?php

if (isset($_POST['submit'])) {

    require 'file/tool.php';


    require 'file/config.php';


    require 'file/mysql.php';


    $accounts       =    trim($_POST['accounts']);


    $password       =    sha1(SALT.$_POST['password']);


    $loginSQL = "SELECT id,nickname FROM zhidao_users WHERE accounts='$accounts' AND password='$password' LIMIT 1";

    $result = mysqli_query($db, $loginSQL);

    if ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        if (isset($_POST['state'])) {

            setcookie('id', $rows['id'], time() * 60 * 60 * 7);
            setcookie('nickname', $rows['nickname'], time() * 60 * 60 * 7);
        } else {

            setcookie('id', $rows['id']);
            setcookie('nickname', $rows['nickname']);
            //setcookie('nickname', xxx);
        }
        location('Successfully login！', './');
    } else {
        alert('Wrong Password or Username！');
    }

} else {
    exit('Invaild！');
}
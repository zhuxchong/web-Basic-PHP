<?php
/**
 * Created by PhpStorm.
 * User: Chong
 * Date: 2018/8/16
 * Time: 14:41
 */

$db = mysqli_connect('localhost', 'root', 'zxc19931118', 'zhidao');

if (mysqli_connect_errno() > 0) {
    exit('连接错误：'.mysqli_connect_error());
}
mysqli_set_charset($db, 'utf8');
?>
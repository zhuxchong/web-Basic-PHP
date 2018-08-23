<?php

if (isset($_POST['send'])) {

    require 'file/tool.php';

    //标题，不得为空
    $re_details        =    trim($_POST['re_details']);

    if (empty($re_details)) {
        alert('回答不得为空！');
    }
    $re_id             =    $_POST['re_id'];
    //echo $re_id ;
    $re_title          =    $_POST['re_title'];
    require 'file/mysql.php';

    $addSql =  "INSERT INTO zhidao_ask (title, details, users_id, re_id, create_time)
                           VALUES ('$re_title', '$re_details', '{$_COOKIE['id']}', '$re_id', NOW())";
    if (mysqli_query($db, $addSql)) {

        $updateSql="UPDATE zhidao_users SET re_count=re_count+1 WHERE id='{$_COOKIE['id']}'";
        mysqli_query($db,$updateSql);
        $updateSql1="UPDATE zhidao_ask SET comment=comment+1 WHERE id='$re_id'";
        mysqli_query($db,$updateSql1);

        location('Reply Success！', 'details.php?id='.$re_id);
    }


} else {
    exit('wrong');
}




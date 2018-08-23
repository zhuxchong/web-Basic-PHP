<?php

if (isset($_POST['send'])) {
    require 'file/tool.php';
    $title         =    trim($_POST['title']);
    if (empty($title)) {
        alert('title cannot empty！');
    }
    $details       =    trim($_POST['details']);
    if (empty($details)) {
        alert('question cannot empty！');
    }
    require 'file/mysql.php';
    $addSql =  "INSERT INTO zhidao_ask (title, details, users_id, create_time)
                           VALUES ('$title', '$details', '{$_COOKIE['id']}', NOW())";

    if(mysqli_query($db, $addSql)){
        $updateSql="UPDATE zhidao_users SET ask_count=ask_count+1 WHERE id='{$_COOKIE['id']}'";
        mysqli_query($db,$updateSql);
    }
    location('successful！', './');

} else {
    exit('wrong');
}

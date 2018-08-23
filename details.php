<?php
require 'file/tool.php';
if(!isset($_GET['id']) || empty($_GET['id'])) {
    alert("wrong noid");
}

require 'file/mysql.php';
$askSql = "SELECT title,details,users_id,reading,comment,create_time FROM zhidao_ask WHERE id='{$_GET['id']}'";
$askresult = mysqli_query($db, $askSql);

if ($askRows = mysqli_fetch_array($askresult, MYSQLI_ASSOC)) {
    if($askRows['re_id']>0){
        alert("wrong");
    }
    $updateSql = "UPDATE zhidao_ask SET reading=reading+1 WHERE id='{$_GET['id']}'";
    mysqli_query($db, $updateSql);
} else {
    alert('no question！');
}
$usersSql = "SELECT nickname,face FROM zhidao_users WHERE id='{$askRows['users_id']}'";
$usersArray = mysqli_fetch_array(mysqli_query($db, $usersSql), MYSQLI_ASSOC);
$hotSql="SELECT id,title FROM zhidao_ask ORDER BY reading DESC LIMIT 10";
$hotResult=mysqli_query($db,$hotSql);

$reSql = "SELECT id,details,users_id,create_time FROM zhidao_ask WHERE re_id='{$_GET['id']}'";
$reResult = mysqli_query($db, $reSql);
$reTotal = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) FROM zhidao_ask WHERE re_id='{$_GET['id']}'"))[0];
?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Details</title>
        <link rel="stylesheet" href="css/basic.css">
        <link rel="stylesheet" href="css/details.css">
    </head>
    <body>
    <?php require 'header.php'?>
    <div id="container">
        <div class="details">
            <dl class="question">
                <dt class="question_img">
                    <img src="img/<?=$usersArray['face']?>.png" alt="<?=$usersArray['nickname']?>" class="question_face">
                </dt>
                <dd class="question_title">
                    <h1><?=$askRows['title']?></h1>
                </dd>
                <dd class="question_info"><em>Read:<?=$askRows['reading']?> | Reply:<?=$askRows['comment']?></em><?=$usersArray['nickname']?> | <?=$askRows['create_time']?></dd>
            </dl>


            <div class="info"><em>Read:<?=$askRows['reading']?> | Reply:<?=$askRows['comment']?></em><?=$usersArray['nickname']?></div>

            <div class="content">
                <?=nl2br($askRows['details'])?>
            </div>


            <div class="re">
                <a href="#re" class="re_button">Reply</a>
            </div>
            <div class="re_total">
                Total <strong><?=$reTotal?></strong> Replies
            </div>
            <?php

            while ($reRows = mysqli_fetch_array($reResult, MYSQLI_ASSOC)):

                $reUsersSql = "SELECT face,nickname FROM zhidao_users WHERE id='{$reRows['users_id']}' LIMIT 1";

                $reUsersArray = mysqli_fetch_array(mysqli_query($db, $reUsersSql), MYSQLI_ASSOC);
                ?>
                <dl class="answer">
                    <dt class="answer_img">
                        <img src="img/<?=$reUsersArray['face']?>.png" alt="<?=$reUsersArray['nickname']?>" class="answer_face">
                    </dt>
                    <dd class="answer_info"><?=$reUsersArray['nickname']?> <span class="md-hidden">| Time <?=$reRows['create_time']?></span></dd>
                    <dd class="answer_content">
                        <?=nl2br($reRows['details'])?>
                    </dd>
                </dl>
            <?php endwhile;?>


            <form class="form" action="reask_post.php" method="post">
                <a name="#re"></a>
                <input type="hidden" name="re_id" value="<?=$_GET['id']?>">
                <input type="hidden" name="re_title" value="RE:<?=$askRows['title']?>">
                <label for="">
                    <textarea name="re_details" class="textarea"></textarea>
                </label>
                <label for="">
                    <button type="submit" class="submit" name="send">Submit Reply</button>
                </label>
            </form>








        </div>
        <aside class="sidebar">
            <h2>Hot Topic</h2>
                <ul class="hot">
                    <?php while($hotRows=mysqli_fetch_array($hotResult,MYSQLI_ASSOC)):?>
                    <li><a href="details.php?id=<?=$hotRows['id']?>" target="_blank"><?=$hotRows['title']?> </a></li>
                    <?php endwhile;?>


                </ul>
        </aside>
    </div>
    <?php require 'footer.php'?>

    </body>
    </html>



<?php
/**
 * Created by PhpStorm.
 * User: Chong
 * Date: 2018/8/22
 * Time: 11:45
 */
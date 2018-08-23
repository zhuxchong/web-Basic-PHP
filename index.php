<?php
//引入数据库连接
require 'file/mysql.php';
$pageSize = 10;
$page = 1;
$pageAbsolute = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (empty($page) || $page <= 0 || !is_numeric($page)) {
        $page = 1;
    } else {
        $page = intval($page);
    }
}
$totalSql = "SELECT COUNT(*) FROM zhidao_ask";
$total = mysqli_fetch_array(mysqli_query($db, $totalSql))[0];
if ($total != 0) {
    $pageAbsolute = ceil($total / $pageSize);
}

if ($page > $pageAbsolute) {
    $page = $pageAbsolute;
}
$num = ($page - 1) * $pageSize;
$limit = "$num, $pageSize";
$askSql = "SELECT id,title,reading,comment,users_id,create_time FROM zhidao_ask WHERE re_id=0 ORDER BY create_time DESC LIMIT $limit";
$result = mysqli_query($db, $askSql);

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asking</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <?php require 'header.php'?>
        <div class="container">
            <div class="list">
                <div class="button">
                    <a href="ask.php" class="ask">ASKing</a>
                </div>
                <?php
                while ($rows = mysqli_fetch_array($result, MYSQLI_ASSOC)):
                    $usersSql = "SELECT face,nickname FROM zhidao_users WHERE id='{$rows['users_id']}' LIMIT 1";
                    $usersArray = mysqli_fetch_array(mysqli_query($db, $usersSql), MYSQLI_ASSOC);

                    ?>
                    <dl class="question">
                        <dt class="question_img">
                            <img src="img/<?=$usersArray['face']?>.png" alt="<?=$usersArray['nickname']?>" class="question_face">
                        </dt>
                        <dd class="question_title">
                            <a href="details.php?id=<?=$rows['id']?>" target="_blank"><?=$rows['title']?></a>
                        </dd>
                        <dd class="question_info"><em>阅:<?=$rows['reading']?> | 评:<?=$rows['comment']?></em><?=$usersArray['nickname']?> | <?=$rows['create_time']?></dd>
                    </dl>
                <?php endwhile;?>

            </div>
            <div class="page">
                <ul>
                    <?php

                    if ($page == 1) {
                        echo '<li class="first"><a href="javascript:void(0)">&lt;</a></li>';
                    } else {
                        echo '<li class="first"><a href="?page='.($page - 1).'">&lt;</a></li>';
                    }
                    for ($i = 1; $i <= $pageAbsolute; $i++) {
                        if ($page == $i) {
                            echo '<li><a href="javascript:void(0)" class="active">'.$i.'</a></li>';
                        } else {
                            echo '<li><a href="?page='.$i.'">'.$i.'</a></li>';
                        }
                    }
                    if ($page == $pageAbsolute) {
                        echo '<li class="last"><a href="javascript:void(0)">&gt;</a></li>';
                    } else {
                        echo '<li class="last"><a href="?page='.($page + 1).'">&gt;</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <aside class="sidebar">
                <h2>Total Questions<em>Sum:120</em></h2>
                <div class="adv">
                    <img src="img/adver.png" alt="adv">
                </div>
            </aside>
        </div>
    <?php require 'footer.php'?>

</body>
</html>


<?php
/**
 * Created by PhpStorm.
 * User: Chong
 * Date: 2018/8/15
 * Time: 16:24
 */?>
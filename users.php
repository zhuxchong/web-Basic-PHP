

<?php
require 'file/mysql.php';
$pageSize=4;
$page=1;
$pageAbsolute = 1;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    if (empty($page) || $page <= 0 || !is_numeric($page)) {
        $page = 1;
    } else {
        $page = intval($page);
    }
}
$totalSql="select count(*) from zhidao_users";
$total= mysqli_fetch_array(mysqli_query($db,$totalSql))[0];
if($total!=0){
    $pageAbsolute=ceil($total/$pageSize);
}
if($page>$pageAbsolute){
    $page=$pageAbsolute;
}
$num=($page-1)*$pageSize;
$limit="$num,$pageSize";

$usersSql = "SELECT nickname,face,ask_count,re_count FROM zhidao_users order by create_time desc LIMIT $limit ";
$result = mysqli_query($db, $usersSql);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/users.css">
</head>
<body>
<?php require 'header.php'?>
<div id="container">
    <div class="figure" >
        <?php while($rows=mysqli_fetch_array($result,MYSQLI_ASSOC)):?>
        <figure>
            <img src="img/<?echo $rows['face']?>.png" alt="<?=$rows['nickname']?>">
            <figcaption>
                <div class="nickname">
                    <?=$rows['nickname']?>
                </div>
                <div class="inf">
                    question:<?=$rows['ask_count']?> | answer:<?=$rows['re_count']?>
                </div>
            </figcaption>
        </figure>
        <?php endwhile;?>
    </div>
    <div class="page">
        <ul>

            <?php

            if ($page == 1) {
                echo '<li class="first"><a href="javascript:void(0)">&lt;</a></li>';
            } else {
                echo '<li class="first"><a href="users.php?page='.($page-1).'">&lt;</a></li>';
            }

            for ($i = 1; $i <= $pageAbsolute; $i++) {
                if ($page == $i) {
                    echo '<li><a href="javascript:void(0)" class="active">'.$i.'</a></li>';
                } else {
                    echo '<li><a href="users.php?page='.$i.'">'.$i.'</a></li>';
                }
            }

            if ($page == $pageAbsolute) {
                echo '<li class="last"><a href="javascript:void(0)">&gt;</a></li>';
            } else {
                echo '<li class="last"><a href="users.php?page='.($page+1).'">&gt;</a></li>';
            }
            ?>

        </ul>
    </div>

</div>
<?php require 'footer.php'?>

</body>
</html>


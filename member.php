<?php
require 'file/tool.php';
if (!isset($_COOKIE['id'])) {
    location('尚未登录！', 'login.php');
}

require 'file/mysql.php';


$memberSql = "SELECT accounts,nickname,face FROM zhidao_users WHERE id='{$_COOKIE['id']}'";


$rows = mysqli_fetch_array(mysqli_query($db, $memberSql), MYSQLI_ASSOC);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Info</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/member.css">
</head>
<body>
<?php require 'header.php'?>
    <div id="container">
        <form class="form" action="member_post.php" method="post">
            <label for="">
                <img src="img/<?=$rows['face']?>.png" alt="<?=$rows['nickname']?>">
            </label>
            <label for="">
                <input type="text" class="text" value="account：<?=$rows['accounts']?>" disabled>
            </label>
            <label for="">
                <input type="text" class="text" value="nickname：<?=$rows['nickname']?>" disabled>
            </label>
            <label for="">
                <select name="face" class="select">
                    <option value="">--Choose a pic--</option>
                    <option value="1">pic1</option>
                    <option value="2">pic2</option>
                    <option value="3">pic3</option>
                    <option value="4">pic4</option>
                    <option value="5">pic5</option>
                    <option value="6">pic6</option>
                    <option value="7">pic7</option>
                    <option value="8">pic8</option>
                    <option value="9">pic9</option>
                    <option value="10">pic10</option>
                </select>
            </label>
            <label for="">
                <input type="password" name="password" class="text" placeholder="NO EMPTY">
            </label>
            <label for="">
                <input type="password" name="notpassword" class="text" placeholder="DOUBLE CHECK">
            </label>
            <label for="">
                <button type="submit" class="submit" name="send">Change</button>
            </label>

        </form>

    </div>
<?php require 'footer.php'?>

</body>
</html>


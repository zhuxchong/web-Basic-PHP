<?php
require 'file/tool.php';
if (isset($_COOKIE['id'])) {
    alert('already login！');
}
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
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<?php require 'header.php'?>
    <div id="container">
        <form class="form" action="register_post.php" method="post">
            <label for="">
                <input type="text" name="accounts" class="text" placeholder="must" >
            </label>
            <label for="">
                <input type="password" name="password" class="text" placeholder="*****" >
            </label>
            <label for="">
                <input type="password" name="notpassword" class="text" placeholder="same" >
            </label>
            <label for="">
                <input type="text" name="nickname" class="text" placeholder="####" >
            </label>
            <label for="">
                <select name="face" class="select">
                    <option>--请选择头像-- (可选)</option>
                    <option value="1">头像1</option>
                    <option value="2">头像2</option>
                    <option value="3">头像3</option>
                    <option value="4">头像4</option>
                    <option value="5">头像5</option>
                    <option value="6">头像6</option>
                    <option value="7">头像7</option>
                    <option value="8">头像8</option>
                    <option value="9">头像9</option>
                    <option value="10">头像10</option>
                </select>
            </label>
            <label for="">
                <button type="submit" class="submit" name="send">Register</button>
            </label>

        </form>

    </div>
<?php require 'footer.php'?>

</body>
</html>


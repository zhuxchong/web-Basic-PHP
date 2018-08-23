<?php
require 'file/tool.php';
if (isset($_COOKIE['id'])) {

    location('already login！', 'index.php');
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
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<?php require 'header.php'?>
<div id="container">
        <form class="form" action="login_post.php" method="post">
            <label for="">
                <input type="text" name="accounts" class="text" placeholder="username" >
            </label>
            <label for="">
                <input type="password" name="password" class="text" placeholder="password" >
            </label>
            <label><input type="checkbox" class="state" name="state">Remeber
            </label>
            <label><button type="submit" class="submit" name="submit">Login</button></label>

        </form>

</div>
<?php require 'footer.php'?>

</body>
</html>


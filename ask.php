<?php

require 'file/tool.php';

if (!isset($_COOKIE['id'])) {
    location('not login！', 'login.php');
}
?>
<!doctype html>
<html lang="zh-cn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Post a question</title>
    <link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/ask.css">
</head>
<body>

<?php require 'header.php'?>

<div id="container">
    <form class="form" action="ask_post.php" method="post">
        <label for="">
            <input type="text" name="title" class="text" placeholder="Input your question">
        </label>
        <label for="">
            <textarea name="details" class="textarea"></textarea>
        </label>
        <label for="">
            <button type="submit" class="submit" name="send">Submit</button>
        </label>
    </form>
</div>

<?php require 'footer.php'?>

</body>
</html>
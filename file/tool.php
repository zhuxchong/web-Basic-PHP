<?php
/**
 * Created by PhpStorm.
 * User: Chong
 * Date: 2018/8/16
 * Time: 15:05
 */
function alert($info)
{
    echo "<script>alert('$info');history.back();</script>";
    exit();
}
function location($info, $url)
{
    echo "<script>alert('$info');location.href='$url'</script>";
    exit();
}
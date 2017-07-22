<?php

header('Conteent-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$conn=@mysqli_connect('localhost','root','123456','shinytest') or die('网络有误');
mysqli_query($conn,'set names utf8');
function alert($str,$url){
    echo '<script>alert("'.$str.'");location.href="./'.$url.'";</script>';
}

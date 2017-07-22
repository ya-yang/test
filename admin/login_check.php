<?php

include('../conn.php');
//接收数据
$username=$_POST['username'];
$password=$_POST['password'];
//验证数据有效性
if(strlen($username)<5){
    echo '用户名不能小于5个字';exit;
}
//构造sql语句
$sql="select * from admin where username='$username' and password='$password'";
$res=mysqli_query($conn,$sql);
if($row=mysqli_fetch_assoc($res)){
    //登陆成功
    session_start();
    $_SESSION['userid']=$row['id'];
    $_SESSION['username']=$row['username'];
    $_SESSION['flag']=$row['flag'];
    alert('恭喜你登陆成功','index.php');
}
else{
    alert('登陆失败','login.php');
}
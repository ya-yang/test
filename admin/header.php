<?php
session_start();

if(!isset($_SESSION['userid'])){
    alert('你的登陆已超时，请重新登陆','login.php');
}


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>后台管理系统</title>
    <link href="images/index.css?id=<?php echo rand(100,999)?>" type="text/css" rel="stylesheet"/>
    <script src="images/jquery.js"></script></head>
<body>
<header>
    <h1>网站后台管理系统</h1>
    <p>
        <a href="#"><span class="icon home"></span>系统首页</a>
        <a href="logout.php"><span class="icon quit"></span>安全退出</a>
    </p>
</header>
<section>
    <nav>
        <h3>欢迎您来到管理后台</h3>
        <p>登陆名：<strong><?php echo $_SESSION['username'] ?></strong><br/>身　份：<strong><?php echo $_SESSION['flag']?></strong></p>
        <dl>
            <dt><span class="icon board"></span>文章分类</dt>
            <dd>
                <a href="cate_new.php">-&emsp;新增分类</a>
                <a href="cate_list.php">-&emsp;分类列表</a>
            </dd>
            <dt><span class="icon news"></span>文章管理</dt>
            <dd>
                <a href="article_new.php">-&emsp;发布文章</a>
                <a href="article_list.php">-&emsp;文章列表</a>
            </dd>

            <dt><span class="icon book"></span>留言管理</dt>
            <dd>
                <a href="guestbook_list.php">-&emsp;留言列表</a>
            </dd>
            <dt><span class="icon admin"></span>管理员管理</dt>
            <dd>
                <a href="#">-&emsp;新增管理员</a>
                <a href="#">-&emsp;管理员列表</a>
            </dd>
        </dl>
    </nav>


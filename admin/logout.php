<?php
require('../conn.php');
session_start();
$_SESSION=[];
session_destroy();
alert('注销成功','./login.php');
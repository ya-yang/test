<?php
include ('./conn.php');
$username = $_POST['username'];
$content = $_POST['content'];
$id = $_POST['id'];
//验证信息的有效性
if (strlen($username) < 4) {
    alert('失败！用户名太短','./content.php?id='.$id);
    exit;
}
if (strlen($content) < 1) {
    echo '留言内容不能为空';
    exit;
}
$sql="insert into guestbook(username,content,art_id) values('$username','$content',$id) ";
$rs= mysqli_query($conn, $sql);
if ($rs) {
    alert('回复成功.审核中.....','./content.php?id='.$id);
} else {
    echo '失败哟';
    echo mysqli_error($conn);
}

?>
<?php
require('../conn.php');
require('header.php');
$act=$_GET['act'];

if($act=='cate_new_save'){
    $cate_name=$_POST['cate_name'];
    $order_no=$_POST['order_no'];
    $sql="insert into category(cate_name,order_no) values('$cate_name','$order_no')";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        alert('新增成功','cate_list.php');
    }else{
        echo '新增失败';
    }

}
if($act=='delete'){
    $id=$_GET['id'];
    if(!is_numeric($id)){
        echo '你非法注入id了哦';exit;
    }
    $sql="delete from category where id=$id";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        alert('删除成功','cate_list.php');
    }else{
        echo '删除失败';
    }

}
if($act=='cate_edit_save'){
    $id=$_POST['id'];
    $cate_name=$_POST['cate_name'];
    $order_no=$_POST['order_no'];
    $sql="update category set cate_name='$cate_name',order_no=$order_no where id=$id";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        alert('修改成功','cate_list.php');
    }else{
        echo '修改失败';
    }

}

if($act=='article_new_save'){
    $title=$_POST['title'];
    $cate_id=$_POST['cate_id'];
    $author=$_POST['author'];
    $content=$_POST['content'];
    htmlspecialchars($content,ENT_QUOTES);
    $img=$_FILES['img'];
    if($img['name']){
    $ext=strrchr($img['name'],'.');
    $filename=time('YmdHis').rand(100,999).$ext;
    $a=['.jpg','.png','gif'.'.txt','.doc'];
    if(!in_array($ext,$a)){
        echo '文件格式出出错';
        exit;
    }

    move_uploaded_file($img['tmp_name'],'../upfiles/'.$filename);
    }else{
        $filename='';
    }
    $sql="insert into article(title,cate_id,author,content,img) values('$title',$cate_id,'$author','$content','$filename')";
    //var_dump($sql);
      //  exit;
    $rs=mysqli_query($conn,$sql);
    if($rs){
        alert('发表成功','article_list.php');
    }else{
        echo '发表失败';
        echo mysqli_error($conn);
    }

}
if($act=='artcle_edit_save'){
    $id=$_POST['id'];
    $title=$_POST['title'];
    $cate_id=$_POST['cate_id'];
    $author=$_POST['author'];
    $content=$_POST['content'];
    htmlspecialchars($content,ENT_QUOTES);
    $img=$_FILES['img'];
    if($img['name']){
        $ext=strrchr($img['name'],'.');
        $filename=time('YmdHis').rand(100,999).$ext;
        $a=['.jpg','.png','gif'.'.txt','.doc'];
        if(!in_array($ext,$a)){
            echo '文件格式出出错';
            exit;
        }

        move_uploaded_file($img['tmp_name'],'../upfiles/'.$filename);
    }else{
        $filename=$_POST['old_img'];
    }
    $sql="update article set title='$title',cate_id=$cate_id,author='$author',content='$content',img='$filename' where id=$id";


    $rs=mysqli_query($conn,$sql);
    if($rs){
        alert('修改成功','article_list.php');
    }else{
        echo '修改失败';
    }
}
if($act=='article_delete'){
    $id=$_GET['id'];
    $res=mysqli_query($conn,"select img from article where id=$id");
    $row=mysqli_fetch_assoc($res);
    if(strlen($row['img'])>1){
    unlink('../upfiles/'.$row['img']);
    }
    mysqli_free_result($res);
    if(!is_numeric($id)){
        echo '你非法注入id了哦';exit;
    }
    $sql="delete from article where id=$id";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        alert('删除成功','article_list.php');
    }else{
        echo '删除失败';
    }

}
if($act=='censor'){
    $id = $_GET['id'];
    $flag = $_GET['flag'];
        if (!is_numeric($id) || !is_numeric($flag)) {
            echo 'id不是一个数字';
            exit;
        }
        //var_dump($istop);
        //exit;
        //将审查符号写入数据库
        $sql = "update guestbook set flag=$flag where id=$id";
        $rs = mysqli_query($conn, $sql);
        if ($flag == 1) {
            alert('审查成功','guestbook_list.php');
        }elseif ($flag == 0) {
            alert('撤销审查','guestbook_list.php');
        } else {
            echo '置顶失败';
            echo mysqli_error($conn);
        }
}
if($act=='guestbook_delete'){
    $id=$_GET['id'];
    if (!is_numeric($id)) {
        echo 'id不是一个数字';
        exit;
    }
    $sql="delete from guestbook where id=$id";
    $rs=mysqli_query($conn,$sql);
    if($rs){
        alert('删除成功','guestbook_list.php');
    }else{
        echo '删除失败';
    }
}





require('footer.php');
?>
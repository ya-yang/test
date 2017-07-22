<?php
require('../conn.php');
require('./header.php');
$id=$_GET['id'];
if(!is_numeric($id)){
    echo '获取id错误';
    exit;
}



$sql="select * from category where id=$id";
$res=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($res);

?>
<div class="mainbox">

    <div class="note">
        <h4>修改内容</h4>
        <form action="action.php?act=cate_edit_save" method="post">
            <input type="hidden" name="id" value="<?php echo $id ?>">
            <table class="news_form">
                <tr>
                    <td>修改分类：</td>
                    <td><input type="text" name="cate_name" value="<?php echo $row['cate_name'] ?>" class="inbox"/></td>
                </tr>

                    <td>修改排序号：</td>
                    <td><input type="text" name="order_no" value="<?php echo $row['order_no'] ?>" class="inbox"/></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="提交"/></td>
                </tr>
            </table>
        </form>

    </div>
</div>
<?php
require('./footer.php');
?>
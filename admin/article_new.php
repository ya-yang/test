<?php
require('../conn.php');
require('./header.php');
?>
<div class="mainbox">
    <div class="note">
        <h4>发表文章</h4>
        <form action="action.php?act=article_new_save" method="post" enctype="multipart/form-data">
            <table class="news_form">
                <tr>
                    <td>文章标题：</td>
                    <td><input type="text" name="title" class="inbox"/></td>
                </tr>
                <tr>
                    <td>文章分类：</td>
                    <td>
                        <select name="cate_id" class="inbox">
                            <option value="0">请选择分类</option>
                            <?php
                            $sql="select * from category order by order_no asc,id desc";
                            $res=mysqli_query($conn,$sql);
                            while($row=mysqli_fetch_assoc($res)){
                                echo '<option value="'.$row['id'].'">'.$row['cate_name'].'</option>';
                            }
                            ?>
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>作　　者：</td>
                    <td><input type="text" name="author" class="inbox"/></td>
                </tr>
                <tr>
                    <td>文章内容：</td>
                    <td>
                        <textarea name="content" style="display:none;" id="content"><?php echo $row['content'];?></textarea>
                        <iframe id="FCK_Frame" src="../editor/editor/fckeditor.html?InstanceName=content&amp;Toolbar=Default" width="100%" height="350" frameborder="no" scrolling="no"></iframe>
                    </td>
                </tr>
                <tr>
                    <td>图片：</td>
                    <td><input type="file" name="img"> </td>
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
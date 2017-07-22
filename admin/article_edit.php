<?php
include('../conn.php');
include('./header.php');
$id=$_GET['id'];
if(!is_numeric($id)){
    echo '获取id错误';
    exit;
}
$sql="select * from article where id=$id ";

$res=mysqli_query($conn,$sql);

$row=mysqli_fetch_assoc($res);

?>
<div class="mainbox">

<div class="note">
	<h4>修改文章</h4>
	<form action="action.php?act=artcle_edit_save" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>">
		<table class="news_form">
			<tr>
				<td>文章标题：</td>
				<td><input type="text" name="title" value="<?php echo $row['title'] ?>" class="inbox"/></td>
			</tr>
			<tr>
				<td>文章分类：</td>
				<td>
					<select name="cate_id" class="inbox">
						<option value="0">请选择分类</option>
						<?php
						$sql2="select * from category order by order_no asc,id desc";
						$res2=mysqli_query($conn,$sql2);
						while($row2=mysqli_fetch_assoc($res2)){
						    if($row['cate_id']==$row2['id']){
							echo '<option value="'.$row2['id'].'" selected="selected">'.$row2['cate_name'].'</option>';

                            }else{
                                echo '<option value="'.$row2['id'].'">'.$row2['cate_name'].'</option>';
                            }
						}

						mysqli_free_result($res2);
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>作　　者：</td>
				<td><input type="text" name="author" value="<?php echo $row['author'] ?>" class="inbox"/></td>
			</tr>
			<tr>
				<td>文章内容：</td>
                <td>
                    <textarea name="content" style="display:none;" id="content"><?php echo $row['content'];?></textarea>
                    <iframe id="FCK_Frame" src="../editor/editor/fckeditor.html?InstanceName=content&amp;Toolbar=Default" width="100%" height="350" frameborder="no" scrolling="no"></iframe>
                </td>
			</tr>

				<td>上传图片：</td>
				<td>
                    <img  src="../upfiles<?php echo $row['img'] ?>"/><br/>
                    <input type="file" name="img"   class="inbox"/>
                    <input type="hidden" name="old_img" value="<?php echo $row['img'] ?>" >
                </td>
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
include('./footer.php');
?>
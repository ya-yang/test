<?php
require('../conn.php');
require('./header.php');



?>
<div class="mainbox">
    <div class="note">
        <h4>分类列表</h4>
        <form method="post" action="" class="search_form">
            <input type="text" name="keywords" placeholder="请输入要搜索的关键词"/>
            <input type="submit" value="搜索"/>
        </form>
        <table class="news_list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>分类名</th>
                    <th>排序号</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $pagesize=10;
            $page=isset($_GET['page'])? $_GET['page']:1;
            $sql="select * from category";
            $res=mysqli_query($conn,$sql);
            $records=mysqli_num_rows($res);
            $pagecount=ceil($records/$pagesize);
            $start=($page-1)*2;
            $sql.=" order by order_no asc,id desc limit $start,$pagesize";
            $res=mysqli_query($conn,$sql);

             while($row=mysqli_fetch_assoc($res)){
              ?><tr>
                    <td><?php echo $row['id'];?></td>
                    <td><?php echo $row['cate_name'];?></td>
                    <td><?php echo $row['order_no'];?></td>
                    <td>
                        <a href="cate_edit.php?id=<?php echo $row['id']?>">修改</a> /
                        <a href="action.php?id=<?php echo $row['id']?>&act=delete">删除</a>
                    </td>
                </tr>
                 <?php } ?>

            </tbody>
        </table>
        <div class="page">
            <?php

            for($i=1;$i<=$pagecount;$i++){
                echo '<a href="./cate_list.php?page='.$i.'">'.$i.'</a>';
            }
            ?>
        </div>
    </div>
</div>


<?php
require('./footer.php');
?>
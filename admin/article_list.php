<?php
require('../conn.php');
require('./header.php');
    $sql="select * from article order by id desc";
    $res=mysqli_query($conn,$sql);


?>
<div class="mainbox">
    <div class="note">

        <h4>文章列表</h4>
        <form method="post" action="" class="search_form">
            <input type="text" name="keywords" placeholder="请输入要搜索的关键词"/>
            <input type="submit" value="搜索"/>
        </form>
        <table class="news_list">
            <thead>
                <tr>
                    <th width="7%">ID</th>
                    <th width="15%">标题</th>
                    <th width="20%">分类名</th>
                    <th width="40%">内容摘要</th>
                    <th width="8%">点击率</th>
                    <th width="10%">操作</th>
                </tr>
            </thead>
            <tbody>
<?php
    $pagesize=4;
    $page=isset($_GET['page'])? $_GET['page']:1;
    $sql="select * from article";
    $res=mysqli_query($conn,$sql);
    $records=mysqli_num_rows($res);
    $pagecount=ceil($records/$pagesize);
    $start=($page-1)*$pagesize;

    $sql = "select article.*,category.cate_name from article,category where article.cate_id=category.id order by article.id desc limit $start,$pagesize";
    $res = mysqli_query($conn, $sql);
    //var_dump($sql);
    //exit;

    while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['cate_name']; ?></td>
        <td><?php echo mb_substr(strip_tags(htmlspecialchars_decode($row['content'])), 0, 40, 'utf-8'); ?></td>
        <td><?php echo $row['views']; ?></td>
        <td>
            <a href="article_edit.php?id=<?php echo $row['id'] ?>">修改</a> /
            <a href="action.php?id=<?php echo $row['id'] ?>&act=article_delete">删除</a>
        </td>
        </tr><?php

}
                 ?>

            </tbody>
        </table>
        <div class="page">
            <?php

            for($i=1;$i<=$pagecount;$i++){
                echo '<a href="./article_list.php?page='.$i.'">'.$i.'</a>';
            }
            ?>
        </div>






    </div>
</div>


<?php
require('./footer.php');
?>
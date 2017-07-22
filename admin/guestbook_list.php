<?php
require('../conn.php');
require('./header.php');
    $sql="select * from guestbook order by id desc";
    $res=mysqli_query($conn,$sql);


?>
<div class="mainbox">
    <div class="note">
        <h4>留言列表</h4>
        <form method="post" action="" class="search_form">
            <input type="text" name="keywords" placeholder="请输入要搜索的关键词"/>
            <input type="submit" value="搜索"/>
        </form>
        <table class="news_list">
            <thead>
                <tr>
                    <th width="5%">ID</th>
                    <th width="10%">用户名</th>
                    <th width="20%">文章标题</th>
                    <th width="30%">内容</th>
                    <th width="18%">时间</th>
                    <th width="17%">操作</th>
                </tr>
            </thead>
            <tbody>
<?php
if(isset($_POST['keywords'])) {
    $keywords = $_POST['keywords'];
    $sql = "select * from article where article.content like '%$keywords%'";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if (!empty($row)) {


        $sql = "select guestbook.*,article.title from guestbook,article where guestbook.art_id=article.id order by article.id desc";
        $res = mysqli_query($conn, $sql);
        //var_dump($sql);
        //exit;

        while ($row = mysqli_fetch_assoc($res)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo mb_substr($row['content'], 0, 40, 'utf-8'); ?></td>
                <td><?php echo $row['intime']; ?></td>
                <td>

                    <?php
                    echo $row['flag'] == 1 ? "<a href=action.php?id={$row['id']}&flag=1&act=censor>已审查</a> / " : "<a href=action.php?id={$row['id']}&flag=0&act=censor>待审查</a> / ";
                    ?>


                    <a href="action.php?id=<?php echo $row['id'] ?>&act=guestbook_delete">删除</a>

                </td>
            </tr>
        <?php }
    } else {
        echo '没有相关结果';
    }
}else {
    ?>


    <?php
    $sql = "select guestbook.*,article.title from guestbook,article where guestbook.art_id=article.id order by article.id desc";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo mb_substr($row['content'], 0, 40, 'utf-8'); ?></td>
            <td><?php echo $row['intime']; ?></td>
            <td>

                <?php
                echo $row['flag'] == 0 ? "<a href=action.php?id={$row['id']}&flag=1&act=censor>待审查</a> / " : "<a href=action.php?id={$row['id']}&flag=0&act=censor>已审查</a> / ";
                ?>


                <a href="action.php?id=<?php echo $row['id'] ?>&act=guestbook_delete">删除</a>

            </td>
        </tr>
        <?php
    }
}
            ?>

            </tbody>
        </table>
    </div>
</div>


<?php
require ('./footer.php');
?>
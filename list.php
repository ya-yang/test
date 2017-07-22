<?php
include('header.php');
include ('banner.php');
include ('left.php');

?>

<div class="col-xs-9 banner-body-right" style="margin-top: 24px;">
    <div class="msg-text-bottom">

        <?php
        $cate_id=$_GET['cate_id'];
        $res=mysqli_query($conn,"select cate_name from category where id=$cate_id");
        $row=mysqli_fetch_assoc($res);
        ?>

        <h3>您当前所在位置：<a href="index.php">首页</a> &gt <?php echo $row['cate_name'] ?> </h3>
        <?php
        $sql="select * from article where cate_id=$cate_id order by intime desc limit 6";
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($res)){
            echo '<div class="col-md-4 msg-text-bottom-left">';
            echo '<figure class="effect-winston">';
            echo '<a href="content.php?id=' . $row['id'] . '"><img src="./upfiles/'.$row['img'].'" alt="'.$row['title'].' class="img-responsive"/>';
            echo '<figcaption>';
            echo '</figcaption>';
            echo '</a>';
            echo '</figure>';
            echo '<h3><a href="content.php?id='.$row['id'].'"> '.mb_substr($row['title'],0,10,'utf-8').'</a></h3>';
            echo '<p>' . mb_substr(strip_tags(html_entity_decode($row['content'])), 0,30, 'utf-8') . '....</p> ';
            echo '</div>';
        }
        ?>




        <div class="clearfix"> </div>
    </div>

</div>
<div class="clearfix"> </div>
<?php
include('footer.php');

?>

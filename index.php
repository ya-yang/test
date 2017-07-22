<?php
include('header.php');
include ('banner.php');
include ('left.php');

?>

<div class="col-xs-9 banner-body-right" style="margin-top: 24px;">
    <div class="msg-text-bottom">


        <?php
        $pagesize=6;
        $page=isset($_GET['page'])? $_GET['page']:1;
        $sql="select * from article";
        $res=mysqli_query($conn,$sql);
        $records=mysqli_num_rows($res);
        $pagecount=ceil($records/$pagesize);
        $start=($page-1)*$pagesize;
        $sql.=" order by intime desc limit $start,$pagesize";
        $res=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($res)) {
            echo '<div class="col-md-4 msg-text-bottom-left">';
            echo '<figure class="effect-winston">';
            echo '<a href="content.php?id=' . $row['id'] . '"><img src="./upfiles/' . $row['img'] . '" alt="' . $row['title'] . '" class="img-responsive"/>';
            echo '<figcaption>';
            echo '</figcaption>';
            echo '</a>';
            echo '</figure>';
            echo '<h3><a href="content.php?id=' . $row['id'] . '"> ' . mb_substr($row['title'], 0, 10, 'utf-8') . '</a></h3>';
            echo '<p>' . mb_substr(strip_tags(html_entity_decode($row['content'])), 0,30, 'utf-8') . '....</p> ';
            echo '</div>';
        }
         ?>



        <div class="clearfix"> </div>
    </div>
    <div class="page">
        <?php

        for($i=1;$i<=$pagecount;$i++){
            echo '<a href="./index.php?page='.$i.'">'.$i.'</a>';
        }
        ?>
    </div>
</div>
<div class="clearfix"> </div>
<?php
include('footer.php');

?>


<?php
include ('./header.php');
include ('banner.php');
include ('./left.php');
?>
<div class="col-xs-9 banner-body-right">
    <!-- single -->
    <div class="single">
        <?php
        $id=$_GET['id'];
        if(!is_numeric($id)) {
            echo 'id不是一个数字';exit;
        }
        $sql="select a.*,c.cate_name from article a,category c where c.id=a.cate_id and a.id=$id ";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
        $sql="update article set views=views+1 where id=$id";
        mysqli_query($conn,$sql);

        ?>
        <h3 class="h3_tltle">您当前所在位置：<a href="index.php">首页</a> &gt <a href="article.php?cate_id=<?php echo $row['cate_id'] ?>"><?php echo $row['cate_name'] ?></a> &gt 文章列表  </h3>
        <?php
        $sql="select * from article where id=$id";
        $res=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($res);
        echo '<div class="single-left">';
        echo '<p><span>作者：'.$row['author'].'</span>  阅读量('.$row['views'].')   时间：'.$row['intime'].';</p>';

        echo '</div>';
        echo '<div class="single-right">';
        echo '<h4>'.$row['title'].'</h4>';

        echo '</div>';
        echo '<div class="clearfix"> </div>';
        echo '<div class="single-left"><img src="./upfiles/'.$row['img'].'" alt="'.$row['title'].'" class="img-responsive" /></div><br/>';
        echo '<p class="tortor">'.htmlspecialchars_decode($row['content']).'</p>';
        ?>
        <!-- <div class="tags-cate">
             <div class="cat-grid">
                 <h4><span>评论列表</span>ategories</h4>
                 <ul>
                     <li><a href="#">Donec rutrum curabitur</a></li>
                     <li><a href="#">Sed porttitorlactus nibh</a></li>
                     <li><a href="#">Curabitur aliquet quam id</a></li>
                     <li><a href="#">Nulla toraccumsan tincidunt</a></li>
                     <li><a href="#">which don't look even</a></li>
                     <li><a href="#">Sed porttitorlactus nibh</a></li>
                 </ul>
             </div>
             <div class="cat-grid">
                 <h4><span>A</span>rchives</h4>
                 <ul>
                     <li><a href="#">January 24,2012.</a></li>
                     <li><a href="#">April 15,2013.</a></li>
                     <li><a href="#">September 24,2014.</a></li>
                     <li><a href="#">May 24,2015.</a></li>
                     <li><a href="#">January 15,2016.</a></li>
                     <li><a href="#">March 24,2016.</a></li>
                 </ul>
             </div>
             <div class="cat-grid">
                 <h4><span>T</span>ags</h4>
                 <div class="top-social-icons">
                     <a href="#">Cards</a>
                     <a href="#">Website</a>
                     <a href="#">Icons</a>
                     <div class="clearfix"> </div>
                     <a href="#">Themeforest</a>
                     <a href="#">Interfaces</a>
                     <div class="clearfix"> </div>
                     <a href="#">Inspiration</a>
                     <div class="clearfix"> </div>
                 </div>
             </div>
             <div class="clearfix"> </div>
         </div>
        -->
         <div class="three-com">
             <h3>2评论列表： <label>看了文章你有什么想说的请畅所欲言吧~</label></h3>
             <?php
             $pagesize=10;
             $page=isset($_POST['page'])?$_POST['page']:1;
             $sql="select * from guestbook where art_id=$id and flag=0";
             $res=mysqli_query($conn,$sql);
             $records=mysqli_num_rows($res);
             $pagecount=ceil($records/$pagesize);
             $start=($page-1)*2;
             $sql.=" limit $start,$pagesize";
             $res=mysqli_query($conn,$sql);
             if(($n=mysqli_num_rows($res))>0){
                 while($row=mysqli_fetch_assoc($res)){
                     echo '<div class="tom-grid">';
                     echo '<div class="tom">';
                     echo '<img src="images/co.png" alt=" " />';
                     echo '</div>';
                     echo '<div class="tom-right">';
                     echo '<div class="Hardy">';
                     echo '<h4>'.$row['username'].'</h4>';
                     echo '<p><label>'.$row['intime'].'</label></p>';
                     echo '</div>';
                     echo '<div class="clearfix"> </div>';
                     echo '<p class="lorem">'.$row['content'].'</p>';
                     echo '</div> <div class="clearfix"> </div></div>';
                 }
             }else{
                 echo '<h3 class="h3_tltle">此文章还没人评论哟</h3>';
             }
             echo '<div class="page">';
             for($i=1;$i<=$pagecount;$i++){
                 echo '<a href="./index.php?page='.$i.'">'.$i.'</a>';
             }
             echo '</div>';
             ?>
         </div>
         <div class="leave-comment">
             <h4>留下你的脚印</h4>
             <p>你有什么想法可以在评论区里说哟,但是一定不要含敏感词，否则博主会吞掉的.</p>
             <form action="del.php" method="post">
                 <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <input type="text" name="username" placeholder="你的名字或昵称" required=" ">
                 <textarea name="content" placeholder="评论内容" required=" "></textarea>
                 <input type="submit" value="提交">
                 <div class="clearfix"> </div>
             </form>
         </div>
     </div>
     <!-- //single -->
</div>
<div class="clearfix"> </div>
<?php
include ('footer.php');
?>

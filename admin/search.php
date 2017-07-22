<?php
include('../conn.php');
include('./header.php');
$act=$_GET['act'];
$keywords = $_POST['keywords'];

            if($act=='cate') {
                ?>
                <div class="mainbox">
                <div class="note">
                    <h4>分类列表</h4>
                    <form method="post" action="search.php?act=cate" class="search_form">
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

                        $sql = "select * from category where cate_name like'%$keywords%' or order_no like'%$keywords%'";
                        //var_dump($sql);
                        //exit;
                        $res = mysqli_query($conn, $sql);
                        if (($n = mysqli_num_rows($res)) > 0) {

                            while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['cate_name']; ?></td>
                                    <td><?php echo $row['order_no']; ?></td>
                                    <td>
                                        <a href="cate_edit.php?id=<?php echo $row['id'] ?>">修改</a> /
                                        <a href="action.php?id=<?php echo $row['id'] ?>&act=delete>删除</a>
                 </td>
                 </tr>
                 <tr>
                     <td colspan=" 4">查询到 <?php echo $n ?> 条记录 <a href="cate_list.php">返回</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo '<tr><td colspan="4">';
                            echo '没有搜索到结果 ' . ' <a href="./cate_list.php">返回</a>';
                            echo '</td></tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
                </div>
                <?php
            }


include('./footer.php');
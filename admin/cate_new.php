<?php
require('../conn.php');
require('./header.php');
?>


<div class="mainbox">

    <div class="note">
        <h4>修改分类</h4>
        <form action="action.php?act=cate_new_save" method="post">
            <table class="news_form">
                <tr>
                    <td>新增分类名：</td>
                    <td><input type="text" name="cate_name" class="inbox"/></td>
                </tr>

                    <td>排序id：</td>
                    <td><input type="text" name="order_no" class="inbox"/></td>
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

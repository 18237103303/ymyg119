<?php if (!defined('THINK_PATH')) exit();?><!---->
<title>商品的详情信息</title>
<link rel="stylesheet" href="/Public/admin/assets/css/bootstrap.css">
<script src="/Public/admin/assets/js/jquery-1.11.1.min.js"></script>
<link href="/Public/tbbx/css/dataTables.foundation.css" rel="stylesheet" type="text/css">
<script src="/Public/tbbx/js/jquery.dataTables.js"></script>
<div class="panel panel-default" style="width: 100%;">
    <div class="panel-body" style="width: 95%;margin:0 auto;">
                <table id="example1" class="display" cellspacing="0" width="100%">
                    <thead>
                    <tr  style="height: 44px;font-size:12px">
                        <th>操作用户</th>
                        <th>属性</th>
                        <th>变动库存</th>
                        <th>变动后库存</th>
                        <th>变动时间</th>
                        <th>类型</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($data1)): foreach($data1 as $key=>$vo): ?><tr  style="height: 44px;font-size:12px">
                            <td><?php echo Name($vo['up_id']);?></td>
                            <td><?php echo ($vo["shux"]); ?></td>
                            <td><?php echo ($vo["kc"]); ?></td>
                            <td><?php echo ($vo["endnum"]); ?></td>
                            <td><?php echo ($vo["c_time"]); ?></td>
                            <td><?php echo ($vo["content"]); ?></td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
    </div>
    <input type="button" name="as" value="刷新"/>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var table =$('#example1').DataTable({
            "bPaginage":true,
//            "dom": '<"top"<"clear">><"bottom"<"clear">>',
            "aaSorting": [[4, "desc" ]]
        });
    } );
    $(function(){
        $('input[name=as]').click(function(){
           location.href="";
        })
    })
</script>
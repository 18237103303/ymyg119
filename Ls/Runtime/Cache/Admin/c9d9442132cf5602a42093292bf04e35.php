<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />	
        <title>优煤易购后台</title>
        <link rel="stylesheet" href="/Public/admin/assets/css/bootstrap.css">

        <link rel="stylesheet" href="/Public/admin/assets/css/xenon-core.css">
        <link rel="stylesheet" href="/Public/admin/assets/css/fonts/linecons/css/linecons.css">
        <link rel="stylesheet" href="/Public/admin/assets/css/fonts/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="/Public/admin/assets/css/xenon-forms.css">
        <link rel="stylesheet" href="/Public/admin/assets/css/xenon-components.css">
        <link rel="stylesheet" href="/Public/admin/assets/css/xenon-skins.css">
        <link rel="stylesheet" href="/Public/admin/assets/css/custom.css">
        <link rel="stylesheet" href="/Public/admin/assets/css/global.css">

        <script src="/Public/admin/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/Public/admin/assets/js/ckeditor/ckeditor.js"></script>
        <script src="/Public/admin/assets/js/jquery.treetable.js"></script>
        <script src="/Public/admin/assets/js/bootbox/bootbox.min.js"></script>
        <script src="/Public/js/123.js"></script>
    </head>
    <body class="page-body">
        <div class="settings-pane">	
            <a href="#" data-toggle="settings-pane" data-animate="true"></a>
            <div class="settings-pane-inner">
                <div class="row">
                    <div class="col-md-4">
                        <div class="user-info">
                            <div class="user-image">
                            </div>
                            <div class="user-details">
                                <h3>
                                    <a href="##"><?php echo Name(session('USER'));?></a>
                                    <span class="user-status is-online"></span>
                                </h3>
                                <div class="user-links">
                                    <a  href="##" onclick="jQuery('#modal-10').modal('show', {backdrop: 'static'}); $.cookies.set('user', < ?php echo session('USER'); ? > );" class="btn btn-success">修改密码</a>
                                    <br/>
                                    <a  href="<?php echo U('user/tc');?>" class="btn btn-warning btn-sm btn-icon icon-left">退出</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 link-blocks-env">

                        <div class="links-block left-sep">
                            <h4>
                                <span>注意事项</span>
                            </h4>

                            <ul class="list-unstyled">
                                <li>

                                    <label for="sp-chk1">不能擅自修改会员信息</label>
                                </li>
                                <li>

                                    <label for="sp-chk2">不能擅自修改群信息</label>
                                </li>
                                <li>

                                    <label for="sp-chk3">Updates</label>
                                </li>
                                <li>

                                    <label for="sp-chk4">Server Uptime</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-container">

            <div class="sidebar-menu toggle-others fixed">

                <div class="sidebar-menu-inner">	

                    <header class="logo-env">

                        <!-- logo -->
                        <div class="logo">
                            <a  class="logo-expanded" style="color:white;">
                                <img src="/Public/admin/assets/images/logo@2x.png" width="80" alt="" />
                                    <!--<h5>欢迎来到海之澜后台</h5>-->
								<!--<img src="/Public/admin/assets/images/index_11.png" style="width:173px;height:46px;">-->
                            </a>

                            <a href="dashboard-1.html" class="logo-collapsed">
                                <img src="/Public/admin/assets/images/logo-collapsed@2x.png" width="40" alt="" />
                            </a>
                        </div>

                        <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                        <div class="mobile-menu-toggle visible-xs">
                            <a href="#" data-toggle="user-info-menu">
                                <i class="fa-bell-o"></i>
                                <span class="badge badge-success">7</span>
                            </a>

                            <a href="#" data-toggle="mobile-menu">
                                <i class="fa-bars"></i>
                            </a>
                        </div>
                        <div class="settings-icon">
                            <a href="#" data-toggle="settings-pane" data-animate="true">
                                <i class="linecons-cog"></i>
                            </a>
                        </div>		

                    </header>
                    <!--主区域-->
                    <ul id="main-menu" class="main-menu">
                        <?php if($_GET['flag']== 'index'): ?><li class="opened active">
                            <?php else: ?>
                            <li class="opened">
                            <li><?php endif; ?>
                        <a href="<?php echo U('Index/index');?>">
                            <i class="fa fa-institution"></i>
                            <span class="title">系统主页 - System Main Page </span>
                        </a>
                        </li>
                        <!--/*主站分站切换的区域*/-->
                        <?php if(qx_amdin('xzfz',2)): endif; ?>
                            <?php if($_GET['flag']== 'zfz'): ?><li class="opened active">
                                <?php else: ?>
                                <li class="opened">
                                <li><?php endif; ?>
                            <a href="<?php echo U('Zfz/index');?>?flag=zfz">
                                <i class="fa fa-slideshare"></i>
                                <span class="title">配送区域 - Substation manage</span>
                            </a>
                            </li>
                        <!--/*主站分站切换的区域*/-->
                        <?php if(quanx('sys',2)): if(in_array(($_GET['flag']), explode(',',"sys,link,shuj"))): ?><li class='active opened active expanded has-sub'>
                            <?php else: ?>
                            <li><?php endif; ?>
                                <a href="#">
                                    <i class="fa fa-wrench"></i>
                                    <span class="title">系统管理 - System manage</span>
                                </a>
                                <ul>
                                    <?php if($_GET['flag']== 'sys'): ?><li class='active'>
                                            <?php else: ?>
                                        <li><?php endif; ?>

                                    <a href="<?php echo U('sys/sys');?>?flag=sys">
                                    <i class="entypo-flow-parallel"></i>
                                        <span class="title">区域比例设置 - System Set up</span>
                                    </a>
                                    </li>

                            <?php if($_GET['flag']== 'link'): ?><li class='active'>
                                <?php else: ?>
                                <li><?php endif; ?>

                            <a href="<?php echo U('Sys/link_list');?>?flag=link">
                                <i class="entypo-flow-parallel"></i>
                                <span class="title">友情链接设置 - Link setting</span>
                            </a>
                            </li>
                            <li>
                            <a href="<?php echo U('sys/db');?>">
                                <i class="entypo-flow-line"></i>
                                <span class="title">数据库设置 - Database settings</span>
                            </a>
                            </li>
                    </ul>
                    </li><?php endif; ?>
                    <!--6-->
                    <?php if(quanx('yhgl',2)): ?><li>
                            <a style="cursor:pointer;" href="<?php echo U('User/mlist');?>">
                                <i class="fa fa-qq"></i>
                                <span class="title">用户列表 - User manage</span>
                            </a>
                        </li><?php endif; ?>
                    <!--6-->
                    <!--5-->
                    <?php if(qx_amdin('quanxian',2)): endif; ?>
                        <?php if(in_array(($_GET['flag']), explode(',',"role,grand"))): ?><li class='active opened active expanded has-sub'>
                        <?php else: ?>
                        <li><?php endif; ?>
                            <a style="cursor:pointer;" >
                                <i class="fa fa-chain"></i>
                                <span class="title">权限管理 - Authority manage</span>
                            </a>
                            <ul>
                                <?php if($_GET['flag']== 'role'): ?><li class='active'>
                                    <?php else: ?>
                                    <li><?php endif; ?>
                                <a href="<?php echo U('Auth/index');?>?flag=role">
                                    <span class="title">权限角色 - Authority role</span>
                                </a>
                        </li>
                        <?php if($_GET['flag']== 'grand'): ?><li class='active'>
                            <?php else: ?>
                            <li><?php endif; ?>
                        <a href="<?php echo U('Auth/grand');?>?flag=grand">
                            <span class="title">角色分组 - Role grouping</span>
                        </a>
                        </li>
                        </ul>
                        </li>
                    <!--5-->
                    <!--4-->
                        <?php if(in_array(($_GET['flag']), explode(',',"leib,grand1,adds1,glist1,cate1,comment1,sy1"))): ?><li class='active opened active expanded has-sub'>
                                <?php else: ?>
                            <li><?php endif; ?>
                                     <a href="">
                                        <i class="fa fa-apple"></i>
                                        <span class="title">商品管理 - Commodity manage</span>
                                     </a>
                                        <ul>
                                            <!--属性组-->
                                            <?php if(in_array(($_GET['flag']), explode(',',"leib,grand1"))): ?><li class='active opened active expanded has-sub'>
                                                    <?php else: ?>
                                                <li><?php endif; ?>
                                                <a style="cursor:pointer;" >
                                                    <i class="fa fa-chain"></i>
                                                    <span class="title">属性管理 - Authority manage</span>
                                                </a>
                                                <ul>
                                                    <?php if($_GET['flag']== 'leib'): ?><li class='active'>
                                                            <?php else: ?>
                                                        <li><?php endif; ?>
                                                    <a href="<?php echo U('Attr/grand');?>?flag=leib">
                                                        <span class="title">类别属性 - Authority role</span>
                                                    </a>
                                                        </li>
                                            <?php if($_GET['flag']== 'grand1'): ?><li class='active'>
                                                    <?php else: ?>
                                                <li><?php endif; ?>
                                            <a href="<?php echo U('Attr/index');?>?flag=grand1">
                                                <span class="title">属性设置 - Role grouping</span>
                                            </a>
                                                </li>
                                                </ul>
                                            </li>
                                             <!--属性组-->
                            <?php if(quanx('gshop',2)): endif; ?>
                                <?php  if($_GET['flag']== 'adds1'){ ?>
                                    <li class='active'>
                                    <?php }else{ ?>
                                    <li>
                                <?php } ?>
                                <a href="<?php echo U('Goods/addgoods');?>?flag=adds1"><span class="title">添加商品- Add product</span></a>
                                </li>

                           <?php if(quanx('spin',2)): if($_GET['flag']== 'glist1'){ ?>
                                    <li class='active'>
                                   <?php }else{ ?>
                                    <li>
                                 <?php } ?>
                                <a href="<?php echo U('Goods/ceshi');?>?flag=glist1"><span class="title">商品列表 - Commodity list</span>
                                </a>
                               </li><?php endif; ?>
                            <?php if(quanx('gcate',2)): if($_GET['flag']== 'cate1'){ ?>
                                    <li class='active'>
                                   <?php }else{ ?>
                                    <li>
                                <?php } ?>
                                <a href="<?php echo U('Category/index');?>?flag=cate1"><span class="title">商品分类--Commodity classification</span></a>
                                </li><?php endif; ?>
                            <?php if(quanx('pshop',2)): if($_GET['flag']== 'comment1'){ ?>
                                    <li class='active'>
                                    <?php }else{ ?>
                                    <li>
                                <?php } ?><a href="<?php echo U('Comment/comment');?>?flag=comment1"><span class="title">商品评论 - Store comments</span></a></li><?php endif; ?>
                            <?php if(quanx('index_sys',2)): if($_GET['flag']== 'sy1'){ ?>
                                    <li class='active'>
                                    <?php }else{ ?>
                                    <li>
                                <?php } ?><a href="<?php echo U('Goods/index_sys');?>?flag=sy1"><span class="title">商品首页展示设置 - Home set</span></a>
                            </li><?php endif; ?>
                        </ul>
                        </li> 
                    <!--4-->
                    <!--3-->
                    <?php if(in_array(($_GET['flag']), explode(',',"order,pol,sol,fol,fzol"))): ?><li class='active opened active expanded has-sub'>
                    <?php else: ?>
                    <li><?php endif; ?>
                        <a href="">
                            <i class="fa fa-file-text-o"></i>
                            <span class="title">订单管理  - Order manage</span>
                        </a>
                        <ul>
                            <?php if(quanx('order',2)): if($_GET['flag']== 'order'): ?><li class='active'>
                                    <?php else: ?>
                                    <li><?php endif; ?>
                                <a href="<?php echo U('Order/index');?>?flag=order"><span class="title">订单列表 - Order list</span></a></li><?php endif; ?>                           
                        <!--    <?php if(quanx('sorder',2)): if($_GET['flag']== 'sol'): ?><li class='active'>
                                    <?php else: ?>
                                    <li><?php endif; ?><a href="<?php echo U('Order/index');?>?flag=sol"><span class="title">送货员订单列表 - Send order list</span></a></li><?php endif; ?> -->                           
                            <?php if(quanx('fz_order',2)): if($_GET['flag']== 'fzol'): ?><li class='active'>
                                    <?php else: ?>
                                    <li><?php endif; ?><a href="<?php echo U('Order/fzlist');?>?flag=fzol"><span class="title">分站订单列表 - Sub order list</span></a></li><?php endif; ?>
							<?php if(quanx('fw_order',2)): if($_GET['flag']== 'fol'): ?><li class='active'>
                                    <?php else: ?>
                                    <li><?php endif; ?><a href="<?php echo U('Order/fwlist');?>?flag=fol"><span class="title">推送人订单列表 -Service order list</span></a></li><?php endif; ?>
							<?php if(quanx('gorder',2)): if($_GET['flag']== 'pol'): ?><li class='active'>
                                    <?php else: ?>
                                    <li><?php endif; ?><a href="<?php echo U('Order/index');?>?flag=pol"><span class="title">售后服务订单列表 - Supplier order list</span></a></li><?php endif; ?>
                        </ul>
                    </li>
                    <!--3-->
                    <!--2-->
                   <?php if(quanx('ads',2)): if(in_array(($_GET['flag']), explode(',',"adw,adl"))): ?><li class='active opened active expanded has-sub'>
                    <?php else: ?>
                    <li><?php endif; ?>
                        <a href="#">
                            <i class="fa fa-ge"></i>
                            <span class="title">广告设置 - Advertisement setting</span>
                        </a>
                        <ul>
                            <?php if(quanx('adpos',2)): if($_GET['flag']== 'adw'){ ?>
                                    <li class='active'>
                                    <?php }else{ ?>
                                    <li>
                                      <?php } ?>   
                                <a href="<?php echo U('Ad/adposition');?>?flag=adw">
                                    <i class="entypo-flow-cascade"></i>
                                    <span class="title">广告位置 - Advertising position </span>
                                </a>
                                </li><?php endif; ?>
                            <?php if(quanx('ads',2)): if($_GET['flag']== 'adl'){ ?>
                                    <li class='active'>
                                   <?php }else{ ?>
                                    <li>
                                <?php } ?>   
                                <a href="<?php echo U('Ad/adsindex');?>?flag=adl">
                                    <i class="entypo-flow-cascade"></i>
                                    <span class="title">广告列表 - Advertising list</span>
                                </a>
                                </li><?php endif; ?>
                        </ul>
                    </li><?php endif; ?>
                    <!--2-->
                    <!--1-->
                        <?php if(quanx('article',2)): if(in_array(($_GET['flag']), explode(',',"a_cate,pub,pub1,a_list,a_list1"))): ?><li class='active opened active expanded has-sub'>
                                    <?php else: ?>
                                <li><?php endif; ?>
                            <a href="#">
                                <i class="fa fa-tencent-weibo"></i>
                                <span class="title">文章管理 - Article manage</span>
                            </a>
                            <ul>
                                <?php if($_GET['flag']== 'a_cate'): ?><li class='active'>
                                        <?php else: ?>
                                    <li><?php endif; ?>
                                <a href="<?php echo U('Article/artlist');?>?flag=a_cate">
                                    <span class="title">分类管理 - Classification manage</span>
                                </a>
                                </li>
                                <?php if($_GET['flag']== 'pub'): ?><li class='active'>
                                        <?php else: ?>
                                    <li><?php endif; ?>
                                <a href="<?php echo U('Article/addarticle');?>?flag=pub">
                                    <span class="title">发布文章 - Publish articles</span>
                                </a>
                                </li>
                                <?php if($_GET['flag']== 'a_list'): ?><li class='active'>
                                        <?php else: ?>
                                    <li><?php endif; ?>
                                <a href="<?php echo U('Article/article');?>?flag=a_list">
                                    <span class="title">文章列表 - Article list</span>
                                </a>
                                </li>
                                <?php if($_GET['flag']== 'pub1'): ?><li class='active'>
                                        <?php else: ?>
                                    <li><?php endif; ?>
                                <a href="<?php echo U('Article/bulletin');?>?flag=pub1">
                                    <span class="title">发布公告 - bulletin</span>
                                </a>
                                </li>

                                <?php if($_GET['flag']== 'a_list1'): ?><li class='active'>
                                        <?php else: ?>
                                    <li><?php endif; ?>
                                <a href="<?php echo U('Article/bulist');?>?flag=a_list1">
                                    <span class="title">公告列表 - bulletin list</span>
                                </a>
                                </li><?php endif; ?>

                        <!--1-->
                    </ul>
                </div>

            </div>

            <div class="main-content">
                <!-- User Info, Notifications and Menu Bar -->
                <nav class="navbar user-info-navbar" role="navigation">

                    <!-- Left links for user info navbar -->
                    <ul class="user-info-menu left-links list-inline list-unstyled">

                        <li class="hidden-sm hidden-xs">
                            <a href="#" data-toggle="sidebar">
                                <i class="fa-bars"></i>
                            </a>
                        </li>

                        <li class="dropdown hover-line">
                            <!--<a href="#" data-toggle="dropdown">-->
                                <!--<i class="fa-envelope-o"></i>-->
                                <!--<span class="badge badge-green">15</span>-->
                            <!--</a>-->

                            <ul class="dropdown-menu messages">
                                <li>

                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">

                                        <li class="active"><!-- "active" class means message is unread -->
                                            <a href="#">
                                                <span class="line">
                                                    <strong>Luc Chartier</strong>
                                                    <span class="light small">- yesterday</span>
                                                </span>

                                                <span class="line desc small">
                                                    This ain’t our first item, it is the best of the rest.
                                                </span>
                                            </a>
                                        </li>



                                        <li>
                                            <a href="#">
                                                <span class="line">
                                                    Hayden Cartwright
                                                    <span class="light small">- a week ago</span>
                                                </span>

                                                <span class="line desc small">
                                                    Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
                                                </span>
                                            </a>
                                        </li>
                                    </ul>

                                </li>
                                <li class="external">
                                    <a href="blank-sidebar.html">
                                        <span>所有信息 - All Messages</span>
                                        <i class="fa-link-ext"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown hover-line">
                            <a href="#" data-toggle="dropdown">
                                <i class="fa-bell-o"></i>
                                <span class="badge badge-purple">7</span>
                            </a>

                            <ul class="dropdown-menu notifications">
                                <li class="top">
                                    <p class="small">
                                        <a href="#" class="pull-right">标记已读 - Mark all Read</a>
                                        You have <strong>3</strong> new info.
                                    </p>
                                </li>

                                <li>
                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                        <li class="active notification-success">
                                            <a href="#">
                                                <i class="fa-user"></i>

                                                <span class="line">
                                                    <strong>用户注册 - New user registered</strong>
                                                </span>

                                                <span class="line small time">
                                                    30秒前 - 30 seconds ago
                                                </span>
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                                <li class="external">
                                    <a href="#">
                                        <span>查看所有提醒 - View all notifications</span>
                                        <i class="fa-link-ext"></i>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav> 

     <!-- Removing search and results count filter -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">送货员详情 - Member datail</h3>
				</div>
				<div class="panel-body">
					<table class="table table-bordered table-striped" id="example-2">
						<tr><td style="width:15%;">送货员编号</td><td id="bh"><?php echo ($row["id"]); ?></td></tr>
						<tr><td>送货员名字</td><td><?php echo ($row["name"]); ?></td></tr>
                        <tr><td>佣金</td><td>￥<em><?php echo ($row["jf"]); ?></em>&nbsp;&nbsp;<i id="jf" style="cursor:pointer;">[详情信息]</i></td></tr>
                        <tr><td>冻结佣金</td><td>￥<em><?php echo ($row["dj_jf"]); ?></em>&nbsp;&nbsp;<i id="dj_jf" style="cursor:pointer;">[详情信息]</i></td></td></tr>
                        <tr><td>密码操作</td><td><button class="btn btn-secondary btn-sm btn-icon icon-left" onclick="jQuery('#modal-9').modal('show', {backdrop: 'static'});$.cookies.set( 'user',<?php echo ($row["id"]); ?>);">修改</button></td></tr>
                        <tr><td>送货的订单</td><td><button id="dd" class="btn btn-secondary btn-sm btn-icon icon-left">查看</button></td></tr>
					</table>
				</div>
			</div>
<div class="panel panel-default">			
</div>
		<!-- 弹出层 -->		
<script>
$(function(){
//    开始
    //订单管理
    $('#dd').click(function(){
        var bh=$('#bh').text();
        location.href="/Admin/User/yjexe/id/"+bh+'?flag=user';
    })
//    积分状态查看
    $('#jf').click(function(){
        var bh=$('#bh').text();
        location.href="/Admin/User/yjexe/type/jf/id/"+bh+'?flag=user';
    })
    $('#dj_jf').click(function(){
        var bh=$('#bh').text();
        location.href="/Admin/User/yjexe/type/dj_jf/id/"+bh+'?flag=user';
    })
})
</script>

			
				
 
<!-- 公共footer包 -->

<footer class="main-footer sticky fixed footer-type-1">

    <div class="footer-inner">

        <!-- Add your copyright text here -->
        <div class="footer-text">
            &copy; 2015 
            <strong>Lingshow</strong> 
            河南灵秀网络科技有限公司 <a href="" target="_blank" title="zxc">For You</a> - Collect from myself
        </div>

        <!-- 顶置按钮  -->
        <div class="go-up">
            <a href="#" rel="go-top">
                <i class="fa-angle-up"></i>
            </a>					
        </div>				
    </div>				
</footer>
</div>
</div>


<!-- 动态弹窗，内容由JS来决定 -->
<div class="modal fade" id="modal-6">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="tanchuang-title">会员新增</h4>
            </div>
            <div class="modal-body" id="tanchuang-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">账号：</label>
                            <input type="text" class="form-control" id="field-1" placeholder="John">
                        </div>	
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">密码：</label>
                            <input type="text" class="form-control" id="field-2" placeholder="Doe">
                        </div>	
                    </div>
                </div>			
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-info">确定</button>
            </div>
        </div>
    </div>
</div> 
        
            
        
    
        
        
<div class="modal fade" id="modal-143">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <a  class="close" data-dismiss="modal" aria-hidden="true" href="###">&times;</a>
                            <h4 class="modal-title" id="tanchuang-title">属性库存添加</h4>
                        </div>
                        <div class="modal-body" id="tanchuang-contenttent">
                        <div class="row">
                                       
                                                       
                        </div>          
                        </div>
                        <br/><br/>
                        <div class="modal-footer">
                     <div class="col-sm-12">
                            <div class="col-sm-6"><a  class="btn btn-white col-sm-5" data-dismiss="modal" href="###">关闭</a></div>
                           <div class="col-sm-6"><a class="btn btn-info col-sm-5" onclick="getSubmits()" href="###">保存</a></div>
                        </div>
                    </div>
                    </div>
                </div>
        </div>

<!--商品属性修改-->
<div class="modal fade" id="modal-144">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            
                            <a  class="close" data-dismiss="modal" aria-hidden="true" href="###">&times;</a>
                            <h4 class="modal-title" id="tanchuang-title">商品属性修改</h4>
                        </div>
                        <div class="modal-body" id="tanchuang-contenttent">
                        <div class="row" id="attr_edit">
                                       
                                                       
                        </div>          
                        </div>
                    <div class="modal-footer">
                           
        
                     <div class="col-sm-12">
                            <div class="col-sm-6"><a  class="btn btn-white col-sm-5" data-dismiss="modal" href="###">关闭</a></div>
                            <div class="col-sm-6"><a class="btn btn-info col-sm-5" onclick="getSubmits1()" href="###">修改</a></div>
                        </div>
                    </div>
                    </div>
                </div>
        </div>  		
<!-- 2 -->
<div class="modal fade" id="modal-7">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="tanchuang-title">角色新增</h4>
            </div>
            <div class="modal-body" id="tanchuang-content">
                <div class="row">
                    <form name="qxfz" action="<?php echo U('Auth/index');?>" method="post">
                        <div class="col-md-6" style="margin-right:20%">
                            <div class="form-group">
                                <label for="field-1" class="control-label">角色名字：</label>
                                <input name="name" type="text" class="form-control" id="field1-1" placeholder="John">
                            </div>	
                        </div>


                        <div class="col-md-6" >
                            <div class="form-group">
                                <label for="field-2" class="control-label">备注：</label>
                                <textarea name="beiz" class="form-control" id="field1-2">
                                </textarea>
                                <input type="hidden" name="yc" value="asd"/>
                            </div>	
                        </div>
                </div>			
            </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" id="xz" class="btn btn-info">新增</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#field1-1').val('');
        $('#field1-2').val('');
        $('#xz').click(function () {
            var name = $('#field1-1').val();
            var beiz = $('#field1-2').val();
            if (name && name) {
                $('form[name=qxfz]').submit();
            }
        })
    })
</script>		
<!-- 2 -->
<!-- 3 -->
<div class="modal fade" id="modal-8">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="tanchuang-title">会员新增</h4>
            </div>
            <!--内容部分-->
            <div class="modal-body num1" id="tanchuang-content">
                <div class="row">
                    <form name="qxfz1" action="<?php echo U('User/user_add');?>" method="post">							
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="button" id="js" class="btn btn-info">管理员</button>
                                <button type="button" id="js1" class="btn btn-secondary">普通会员</button>
                            </div>
                        </div>
                    </form>								
                </div>			
            </div>
            <div class="modal-body num3" id="tanchuang-content" style="display: none;">
                <div class="row">
                    <form name="qxfz1" action="<?php echo U('User/user_add');?>" method="post">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-a" class="control-label">账号：</label>
                                <input name="name" type="text" class="form-control" id="field-a" placeholder="账号">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-b" class="control-label">密码：</label>
                                <input name="pas" type="text" class="form-control" id="field-b" placeholder="密码">
                            </div>
                        </div>
                            <input name="wd" type="hidden" val=""/>
                    </form>
                </div>
            </div>
            <div class="modal-body num2" id="tanchuang-content" style="display: none;">
                    <div class="row">
                        <div class="col-md-6" style="width:60%;">
                            <div class="form-group">
                                <label for="field-b" style="float: left;"  class="control-label">线下专员id：</label>
                                 <input type="text" name="wd1" value="" style="float: left;height: 32px;"  placeholder="线下专员的id"/>
                                <span style="float: left;margin-left: 3%;" id="wdqd" class="btn btn-info">确定</span>

                                <br/>
                                <p style="display: none; color:red;">您输入的id不存在</p>

                            </div>
                        </div>
                    </div>
                </div>

            <!--内容部分结束-->
            <div class="modal-footer num3" style="display: none;">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" id="xz1" class="btn btn-info">确定</button>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            /*对内容进行拓展*/
//管理员
     $('#js').click(function(){$('.num3').show();$('.num1').hide();$('.num2').hide();})
//普通会员
    $('#js1').click(function(){$('.num2').show();$('.num1').hide(); $('.num3').hide();})
    $('input[name=wd]').keyup(function () {var a = $(this).val().replace(/\W/g, '');$(this).val(a);$('.form-group p').hide();})
    $('#wdqd').click(function(){
       var wdid= $('input[name=wd1]').val();
        $.post("<?php echo U('User/pdwd');?>",{
            wdid:wdid
        },function(data){
//            alert(data);
          if(data==-1){
            $('.form-group p').show();
          }else{
              $('.num3').show();$('.num1').hide();$('.num2').hide();
              $('input[name=wd]').val(data);
          }
        })
    })
            /*内容的拓展结束*/
            $('#xz1').click(function () {
                var name1 = $('#field-a').val();
                var beiz1 = $('#field-b').val();

                var wd = $('input[name=wd]').val();
                var wd1=wd?wd:'-9';
                $('input[name=wd]').val(wd1);
                if (name1 && name1) {
                    $.post("<?php echo U('User/user_add');?>", {
                        name: name1,
                        type: 1
                    }, function (data) {
                        if (data == 1) {
                            alert('用户已经存在');
                        } else if (data == 0 && name1 && beiz1) {
                            $('form[name=qxfz1]').submit();
                        } else {
                            alert('出现错误。');
                        }
                    })
                }
            })
        })
    </script>					
</div>
<!-- 3 -->
<!--4 密码修改框-->
<div class="modal fade" id="modal-9">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close q5" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="tanchuang-title">密码修改</h4>
            </div>
            <div class="modal-body" id="tanchuang-content">
                <div class="row">
                    <form name="qxfz2" action="<?php echo U('User/user_edt');?>" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">请输入密码：</label>
                            <input type="password" name="mm" class="form-control mm" id="field-1" placeholder="密码 密码的长度大于5位">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">再次输入：</label>
                            <input type="password" name="mm1" class="form-control mm1" id="field-2" placeholder="确认密码">
                        </div>
                    </div>
                        <input type="hidden" name="id" value=""/>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white q5" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-info q4">确定</button>
            </div>
        </div>
    </div>
</div>
        <script>
            $(function(){
//                $.cookies.set( 'user',null);
                /*默认执行*/
                $('.mm').keyup(function () {
                    var a = $(this).val().replace(/\W/g, '');
                    $(this).val(a);
                });
                $('.q4').click(function(){
                    var zhi=$.cookies.get('user');
                    $('input[name=id]').val(zhi);
                    var mm= $('.mm').val();
                    var mm1= $('.mm1').val();
                    //长度判断
                    if(mm==mm1 && mm && mm1){
                     var mm_1= mm.length;
                     if(mm_1>5){
                       $('form[name=qxfz2]').submit();
                     }else{
                        alert('密码的长度应大于5位 不能使用特殊字符');
                     }
                    }else{
                        alert('两次输入不一致。。');
                    }
                })
            })

        </script>
<!--4-->
<!--5  管理员密码修改框-->
<div class="modal fade" id="modal-10">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close q55" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">密码修改</h4>
            </div>
            <label for="field-1" style="margin-top: 2%;" class="control-label">请输入原始密码：</label>
            <input type="password" name="mm0" class="form-control mm0" style="width: 50%;" placeholder="密码 密码的长度大于5位">

            <div class="modal-body">
                <div class="row">
                    <form name="qxfz3" action="<?php echo U('User/user_edt');?>" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">请输入密码：</label>
                            <input type="password" name="mm" class="form-control mm3" placeholder="密码 密码的长度大于5位">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">再次输入：</label>
                            <input type="password" name="mm1" class="form-control mm13" placeholder="确认密码">
                        </div>
                    </div>
                        <input type="hidden" name="id" value=""/>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white q55" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-info q45">确定</button>
            </div>
        </div>
    </div>
</div>
        <script>
            $(function(){
//                $.cookies.set( 'user',null);
                /*进行用户密码验证*/
                $('.mm0').blur(function(){
                    var zhi=$.cookies.get('user');
                    var zhi1= $('.mm0').val();
                    $.post("<?php echo U('User/admin_edt');?>",{
                        zhi:zhi,
                        zhi1:zhi1
                    },function(data){
                      if(data==1){
                          $('.mm13').removeAttr('disabled');
                          $('.mm3').removeAttr('disabled');
                         alert('原始密码正确');
                      }else{
                          $('.mm13').attr('disabled','true');
                          $('.mm3').attr('disabled','true');
                          alert('原始密码错误');
                      }
                    })
                })
                /*默认执行*/
                $('.q55').click(function(){
                  $('.linecons-cog').trigger('click');
                });
                $('.mm3').keyup(function () {
                    var a = $(this).val().replace(/\W/g, '');
                    $(this).val(a);
                });
                $('.q45').click(function(){
                    var zhi=$.cookies.get('user');
                    $('input[name=id]').val(zhi);
                    var mm0= $('.mm0').val();
                    var mm= $('.mm3').val();
                    var mm1= $('.mm13').val();
                    //长度判断
                    if(mm==mm1 && mm && mm1 && mm0){
                     var mm_1= mm.length;
                     if(mm_1>5){
                       $('form[name=qxfz3]').submit();
                     }else{
                        alert('密码的长度应大于5位 不能使用特殊字符');
                     }
                    }else{
                        alert('密码位置不能为空/两次输入不一致。。');
                    }
                })
            })

        </script>
<!--5-->
<!-- js核心包 -->
<script src="/Public/admin/assets/js/bootstrap.min.js"></script>
<script src="/Public/admin/assets/js/TweenMax.min.js"></script>
<script src="/Public/admin/assets/js/resizeable.js"></script>
<script src="/Public/admin/assets/js/joinable.js"></script>
<script src="/Public/admin/assets/js/xenon-api.js"></script>
<script src="/Public/admin/assets/js/xenon-toggles.js"></script>
<!-- 特殊加载包 -->
<link rel="stylesheet" href="/Public/admin/assets/css/fonts/meteocons/css/meteocons.css">
<!-- 特殊加载包/提示包 -->
<script src="/Public/admin/assets/js/toastr/toastr.min.js"></script>
<!-- 特殊加载包/首页样式块包 -->
<script src="/Public/admin/assets/js/xenon-widgets.js"></script>
<!-- 特殊加载包/模板样式通用包 -->
<script src="/Public/admin/assets/js/xenon-custom.js"></script>
</body>
</html>
<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Free Web tutorials">
<meta name="keywords" content="HTML,CSS,JavaScript">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>优煤易购</title>
<script type="text/javascript" src="/Public/home/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/Public/home/js/jquery.SuperSlide.2.1.1.source.js"></script>
<script type="text/javascript" src="/Public/home/js/base.js"></script>

<link rel="stylesheet" type="text/css" href="/Public/home/css/base.css" />
</head>
<body>

<!--客服开始-->
<div class="kefu">
	<div class="left">
    	<img src="/Public/home/images/index2_32.jpg">
    </div>
	<div class="right">
    	<div class="rbox">
            <img src="/Public/home/images/index2_29.jpg">
            <div class="linka">
                <a>购买咨询</a>
                <a>产品咨询</a>
                <a>QQ咨询</a>
            </div>
        </div>
    </div>
</div>
<!--客服结束-->

<!--右边悬浮信息开始-->
<div class="fxbox">
	<div class="fx">
    	<div class="box">
        	<a class="btna"><i><img src="/Public/home/images/index33_03.png" class="img1"><img src="/Public/home/images/index44_03.png" class="img2"></i><span>我</span></a>
            <!--登录后显示-->
            <div class="hidebox">
                <div class="weideng">
                	<div class="ming">
                    	<a class="touxiang"><img src="/Public/home/images/index33_06.png"></a>
                        <span>您好！<a class="namea">用户1234</a></span>
                    </div>
                </div>
                <div class="xinxi">
                	<a href="<?php echo U('Order/Order');?>"><img src="/Public/home/images/index33_13.png"><span>我的订单</span></a>
                    <a href="<?php echo U('User/Cooper');?>"><img src="/Public/home/images/index33_15.png"><span>我的优惠券</span></a>
                </div>
            </div>
        </div>
        <div class="box">
        	<a class="btna"><i><img src="/Public/home/images/index33_09.png" class="img1"><img src="/Public/home/images/index44_09.png" class="img2"></i><span>收藏</span></a>
            <div class="hidebox">
            	<div class="weideng">
                	<div class="ming">
                    	<a class="touxiang"><img src="/Public/home/images/index33_06.png"></a>
                        <span>您好！请<a class="namea">登录</a></span>
                    </div>
                </div>
            </div>
             <!--登录后显示-->
            <!--<div class="hidebox top2">
            	<p class="scp">您的收藏（<a href="#" href="center-shoucang.html">1</a>）</p>
            </div>-->
        </div>
        <div class="box">
        	<a class="btna"><i><img src="/Public/home/images/index33_18.png" class="img1"><img src="/Public/home/images/index44_18.png" class="img2"></i><span>购<br>物<br>车</span></a>
            <div class="hidebox top3">
            	<div class="cun">
                	<h2>购物车</h2>
                    <b class="close"><img src="/Public/home/images/gouygou_03.png"></b>
                    <div class="cpbox">
                    	<div class="mei">
                        	<span class="close"><img src="/Public/home/images/gouygou_07.png"></span>
                        	<a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/gouygou_10.png"></a>
                            <div class="text">
                            	<a class="namea" href="page02-mei-xq.html">烈焰牌硬质清洁无烟煤</a>
                                <div class="money">
                                	<div class="liang">
                                    	<span class="jian"><img src="/Public/home/images/gouygou_14.png"></span>
                                        <input type="text" class="num" value="5">
                                        <span class="jia"><img src="/Public/home/images/gouygou_16.png"></span>
                                        <b>袋</b>
                                    </div>
                                    <i>￥208.00</i>
                                </div>
                            </div>
                        </div>
                        <div class="mei">
                        	<span class="close"><img src="/Public/home/images/gouygou_07.png"></span>
                        	<a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/gouygou_10.png"></a>
                            <div class="text">
                            	<a class="namea" href="page02-mei-xq.html">烈焰牌硬质清洁无烟煤</a>
                                <div class="money">
                                	<div class="liang">
                                    	<span class="jian"><img src="/Public/home/images/gouygou_14.png"></span>
                                        <input type="text" class="num" value="5">
                                        <span class="jia"><img src="/Public/home/images/gouygou_16.png"></span>
                                        <b>袋</b>
                                    </div>
                                    <i>￥208.00</i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jiesuan">
                    	<p><span><b>2</b>件商品</span><i>￥516.00</i></p>
                        <a href="center-car.html">去购物车结算</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="box mt60">
        	<a class="weimaa"><img src="/Public/home/images/index33_23.png"></a>
            <div class="hidebox top4">
            	<div class="weixin">
            		<img class="weima" src="/Public/home/images/weima_03.jpg">
                	<p>扫一扫，加微信</p>
                </div>
            </div>
        </div>
        <div class="box">
        	<a class="weimaa topa"><img src="/Public/home/images/index33_27.png"></a>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>
<!--右边悬浮信息开始-->

<!--tanchuang开始-->
<!--<div class="tanchuangbox">
	<div class="tanchuang">
    	<h2>请选择您所在区域</h2>
        <div class="wei"><select name="province3"></select><select name="city3"></select><select name="area3"></select></div>
        <a class="sure">确认</a>
    </div>
</div>-->
<!--tanchuang结束-->
<script language="javascript" defer>
new PCAS("province3","city3","area3","山东省","菏泽市","定陶县");
</script>
<script>
$(function(){
	$(".tanchuangbox a.sure").click(function(){
		$(".tanchuangbox").hide();
		})
	})
</script>
<!--welcome开始-->
<div class="welcomebox">
	<div class="welcome">
        <p class="lp">欢迎来到优煤易购！<a href="<?php echo U('Public/Login');?>">请登录</a><a href="<?php echo U('Public/Register');?>">免费注册</a></p>
        <div class="rp"><a href="<?php echo U('User/Index');?>">个人中心</a><a class="car" href="<?php echo U('Cart/Index');?>">购物车（0）件</a><span>客服专线<i>400-000-0000</i></span></div>
    </div>
</div>
<!--welcome开始-->

<script type="text/javascript" src="/Public/home/js/jquery.kkPages.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/home/css/Css.css" />

<link rel="stylesheet" type="text/css" href="/Public/home/css/center.css" />
<script type="text/javascript" src="/Public/home/js/PCASClass.js"></script>

<script type="text/javascript" src="/Public/home/js/bday-picker.js"></script>

<!--headerbox--> 
<div class="headerbox">
	<div class="header">
    	<a class="logoa" href="<?php echo U('Index/Index');?>"><img src="/Public/home/images/index1_07.png"></a>
        <div class="weizhi">
        	<img src="/Public/home/images/index1_10.png">
            <div class="diming"><a href="page-city.html">山东省菏泽市定陶县</a></div>
        </div>
        <div class="sousuo">
        	<div class="ss">
        		<input type="text" value="请输入关键词" onClick="$(this).val('');">
            	<input type="button" value="搜索" onClick="document.location='<?php echo U('Search/Index');?>'">
            </div>
            <p><span>清洁无烟煤</span><i>清洁无烟煤</i><span>清洁无烟煤</span><i>清洁无烟煤</i></p>
        </div>
    </div>
</div> 
<!--headerbox--> 
<!--nav开始-->
<div class="navbox">
	<div class="nav">
    	<ul class="zuo">
        	<li><a href="<?php echo U('Index/Index');?>" class="current">首页</a></li>
            <li><a href="index.html#cp1">烈焰清洁无烟煤</a></li>
            <li><a href="index.html#cp1">2号无烟煤</a></li>
            <li><a href="index.html#cp1">3号无烟煤</a></li>
            <li><a href="index.html#cp1">4号无烟煤</a></li>
            <li><a href="index.html#cp1">5号无烟煤</a></li>
            <li><a href="index.html#cp1">6号无烟煤</a></li>
        </ul>
        <ul class="you">
        	<li><a href="<?php echo U('User/Index');?>">个人中心</a></li>
            <li><a href="<?php echo U('User/Integral');?>">我的积分</a></li>
        </ul>
    </div>
</div>
<!--nav结束-->

<!--Personal开始-->
<div class="personal">
	<div class="left">
    	<div class="face"><img src="/Public/home/images/center1_03.png"></div>
        <div class="person">
        	<h2><span>个人中心</span></h2>
            <div class="linkbox">
            	<h3>账号管理</h3>
                <div class="linka">
                	<a href="<?php echo U('User/Index');?>" <?php if($current == 'index'): ?>class="current"<?php endif; ?>><i>·</i>个人信息</a>
                	<a href="<?php echo U('User/ChangePsd');?>" <?php if($current == 'changepsd'): ?>class="current"<?php endif; ?>><i>·</i>密码修改</a>
                	<a href="<?php echo U('Order/Comment');?>" <?php if($current == 'comment'): ?>class="current"<?php endif; ?>><i>·</i>我的评价</a>
                </div>
            </div>
            <div class="linkbox">
            	<h3>订单信息</h3>
                <div class="linka">
                	<a href="<?php echo U('Order/Order');?>" <?php if($current == 'all'): ?>class="current"<?php endif; ?>><i>·</i>全部订单</a>
                	<a href="<?php echo U('Order/Order',array('status'=>1));?>" <?php if($current == 'pay'): ?>class="current"<?php endif; ?>><i>·</i>等待付款</a>
                	<a href="<?php echo U('Order/Order',array('status'=>2));?>" <?php if($current == 'fh'): ?>class="current"<?php endif; ?>><i>·</i>等待卖家发货</a>
                	<a href="<?php echo U('Order/Order',array('status'=>3));?>" <?php if($current == 'com'): ?>class="current"<?php endif; ?>><i>·</i>需要评价</a>
                    <a href="<?php echo U('Order/Order',array('status'=>4));?>" <?php if($current == 'done'): ?>class="current"<?php endif; ?>><i>·</i>交易完成</a>
                </div>
            </div>
            <div class="linkbox">
            	<h3>我的账户</h3>
                <div class="linka">
                	<a href="<?php echo U('User/Integral');?>" <?php if($current == 'integral'): ?>class="current"<?php endif; ?>><i>·</i>我的积分</a>
					<a href="<?php echo U('User/Award');?>" <?php if($current == 'award'): ?>class="current"<?php endif; ?>><i>·</i>我的抽奖</a>
                	<a href="<?php echo U('User/Collect');?>" <?php if($current == 'collect'): ?>class="current"<?php endif; ?>><i>·</i>我的收藏</a>
                	<a href="<?php echo U('User/Cooper');?>" <?php if($current == 'cooper'): ?>class="current"<?php endif; ?>><i>·</i>我的代金券</a>
                </div>
            </div>
            <div class="linkbox">
            	<h3>售后管理</h3>
                <div class="linka">
                	<a href="<?php echo U('User/Server');?>" <?php if($current == 'server'): ?>class="current"<?php endif; ?>><i>·</i>退货/退款管理</a>
                </div>
            </div>
        </div>
    </div>    

<!--Personal结束-->
<script language="javascript" defer>
new PCAS("province6","city6","area6","江苏省","苏州市","沧浪区");
new PCAS("province7","city7","area7","江苏省","苏州市","沧浪区");

</script>
<script type="text/javascript">
      $(document).ready(function(){
        $("#picker3").birthdaypicker({
          dateFormat: "bigEndian",
          monthFormat: "long",
          placeholder: false,
          hiddenDate: false
        });
      });
    </script>
	<div class="right">
		<div class="points">
			<ul>
				<li><span>可用积分</span><p><i>12345</i></p><a href="center-jifen.html">我的积分</a></li>
				<li><span>收藏</span><p><i>123</i>商品</p><a href="center-shoucang.html">查看收藏</a></li>
				<li><span>代金券</span><p><i>5</i>张</p><a href="center-daijin.html">查看代金券</a></li>
			</ul>
		</div>
		<div class="discussbox">
        	<h2>我的评价</h2>
            <div class="pinglunbox">
                <div class="plfl">
                    <span class="w40">商品信息</span>
                    <span class="w50">评价</span>
                    <span class="w10">操作</span>
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
                <div class="ping">
                	<div class="tw">
                        <a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/index1_41.png"></a>
                        <span>
                        	<a class="namea" href="page02-mei-xq.html">烈焰大量无烟煤 精致无烟煤 高品质无烟煤 品质保证 价格优惠</a>
                            <i>货号：12309310920</i>
                        </span>
                    </div>
                    <p>
                        <span>东西收到了，比想象中的还要好，这次购物物超所值，卖家的服务态度超好的，下次还</span>
                        <i>[2015-04-10 08:40:01]</i>
                    </p>
                    <input type="button" value="删除">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function(){
	$('.discussbox .pinglunbox ').kkPages({
		PagesClass:'.ping', //需要分页的元素
		PagesMth:6, //每页显示个数		
		PagesNavMth:3 //显示导航个数
	});
}); 
</script>
<script>
$(function(){
	$(".ping input").click(function(){
		$(this).parents(".ping").hide();
		})
})
</script>
 
<!--footerbox开始-->
<div class="footerbig">
	<div class="footbox">
    	<div class="foot">
    	<ul>
			<?php if(is_array($article)): $i = 0; $__LIST__ = $article;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$art): $mod = ($i % 2 );++$i;?><li>
            	<h2><?php echo ($art["type_name"]); ?></h2>
                <div class="linka">
					<?php if(is_array($art["info"])): $i = 0; $__LIST__ = $art["info"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Article/Detail',array('type_id'=>$a['type_id']));?>"><?php echo ($a["type_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        </div>
    </div>
    <div class="footerbox">
    	<div class="link">
        	<span>友情链接:</span>
            <div class="linka">
				<?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$link): $mod = ($i % 2 );++$i;?><a href="<?php echo ($link["link_url"]); ?>"><?php echo ($link["link_name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <p><?php echo C('WEB_BQ');?> <?php echo C('WEB_ICP');?></p>
    </div>
</div>
<!--footerbox开始-->
</body>
</html>
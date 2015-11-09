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

<link rel="stylesheet" type="text/css" href="/Public/home/css/page.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/Css.css" />
<script type="text/javascript" src="/Public/home/js/jquery.kkPages.js"></script>

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
<!--product开始-->
<div class="productbox">
	<div class="top">
    	<div class="left">
        	<div class="imga">
            	<img src="/Public/home/images/cpxq_21.jpg">
                <img src="/Public/home/images/cpxq_23.jpg">
                <img src="/Public/home/images/cpxq_21.jpg">
                <img src="/Public/home/images/cpxq_23.jpg">
            </div>
            <div class="bottom">
            	<img src="/Public/home/images/cpxq_21.jpg">
                <img src="/Public/home/images/cpxq_23.jpg">
                <img src="/Public/home/images/cpxq_21.jpg">
                <img src="/Public/home/images/cpxq_23.jpg">
            </div>
        </div>
        <script>
			jQuery(".top .left").slide({mainCell:".imga",effect:"leftLoop",titCell:".bottom img", autoPlay:true});
		</script>
		<div class="right">
        	<h2>硬质清洁无烟煤</h2>
            <!--<div class="zhong">
            	<p style="color:#126ab4;">重量选择：</p>
                <div class="xuan">
                	<label class="on"><input type="radio" name="ss"><span>400斤</span><i>0.52元一斤</i></label>
                    <label><input type="radio" name="ss"><span>1200斤</span><i>0.51元一斤</i></label>
                    <label><input type="radio" name="ss"><span>2000斤</span><i>0.50元一斤</i></label>
                </div>
            </div>-->
            <div class="tishi">
            	说明：本商品每袋80斤，5-14袋单价为0.52元/斤，15-24袋单价为0.50元/斤，25袋以上单价为0.48元/斤
            </div>
            <div class="zhong br">
            	<p>数量：</p>
                <div class="jisuan">
                	<span class="jian">-</span><input type="text" value="5" class="num"><span class="jia">+</span>
                </div>
                <p>袋</p>
            </div>
            <div class="zhong">
            	<p>金额：</p>
                <div class="jisuan"><input value="280" class="je"><i>元</i></div>
            </div>
            <div class="zhong">
                <i>配送至：山东省菏泽市定陶县</i>
            </div>
            <!--<div class="zhong">
            	<p>促销信息：</p>
                <div class="cuxiao">
                	<h6>购买200kg以上送山西陈醋一瓶</h6>
                    <a class="imga"><img src="/Public/home/images/cpxq_10.jpg"></a>
                </div>
            </div>-->
            
            <div class="caozuo">
            	<a href="<?php echo U('Order/Addorder',array('step'=>1));?>"><img src="/Public/home/images/cpxq_14.jpg"></a>
                <a href="#" class="carbtn"><img src="/Public/home/images/cpxq_16.jpg"></a>
            </div>
        </div>
    </div>
    <div class="zhanshi">
    	<h2>系列产品展示</h2>
        <ul>
        	<li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
        </ul>
    </div>
    <div class="cardbox">
    	<div class="title">
        	<span>详细信息</span>
            <span>产品评价<i>（48）</i></span>
            <span>售后保障</span>
        </div>
        <div class="qhcard">
        	<div class="card">
            	<p>由于无烟煤属高变质程度煤种，其固有的强度大、可塑性差、热态下不软化等特别性质，造成型煤生产过程中的难度也较大，受到业内人士的广泛关注。有关院所对此做过专门的研究、探索。晋城洁净煤技术研究所地处晋城无烟煤海，有着得天独厚的地理优势，在长期致力于煤炭转化产品的研究、开发、利用中，取得了一些成绩。先后研制出2种性能较优越、可操作性强的型煤粘结剂（已申请国家发明专利，其中一项已通过省级科技成果鉴 定）；新开发、研制的FG系列型煤干燥机较好地解决了型煤干燥过程中的几个难题，使用效果很好。许多生产厂家都将型煤质量不好片面地认为是粘结剂问题，而忽略了设备、工艺的不足或缺陷，走了许多弯路。现就型煤生产工艺路线及设备配置方
面谈一些切身经验和体会，</p>
				<div class="imgbox">
                	<img src="/Public/home/images/xqoim_03.jpg">
                    <img src="/Public/home/images/xqoim_05.jpg">
                    <img src="/Public/home/images/xqoim_09.jpg">
                    <img src="/Public/home/images/xqoim_11.jpg">
                </div>
                <p>由于无烟煤属高变质程度煤种，其固有的强度大、可塑性差、热态下不软化等特别性质，造成型煤生产过程中的难度也较大，受到业内人士的广泛关注。有关院所对此做过专门的研究、探索。晋城洁净煤技术研究所地处晋城无烟煤海，有着得天独厚的地理优势，在长期致力于煤炭转化产品的研究、开发、利用中，取得了一些成绩。先后研制出2种性能较优越、可操作性强的型煤粘结剂（已申请国家发明专利，其中一项已通过省级科技成果鉴 定）；新开发、研制的FG系列型煤干燥机较好地解决了型煤干燥过程中的几个难题，使用效果很好。许多生产厂家都将型煤质量不好片面地认为是粘结剂问题，而忽略了设备、工艺的不足或缺陷，走了许多弯路。现就型煤生产工艺路线及设备配置方
面谈一些切身经验和体会，</p>
            </div>
            <div class="card">
            	<div class="tt">
                	<span class="w1">评价心得</span>
                    <span class="w2 tac">顾客满意度</span>
                    <span class="w3">购买信息</span>
                    <span class="w4">评论者</span>
                </div>
                <div class="box">
                	<ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保很清洁环保很清洁环保很清洁环保很清洁环保很清洁环保 </span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                    <ul>
                    	<li class="w1">
                        	<h6><span>确实很不错，使用效率很高，很清洁环保</span><i>2015-08-26 14:38</i></h6>
                            <div class="tip"><span>效率高</span><span>清洁</span><span>环保</span></div>
                        </li>
                        <li class="w2 tac">
                        	<span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                            <span class="star"><img src="/Public/home/images/star_03.jpg"></span>
                        </li>
                        <li class="w3">
                        	<p>类型：<i>硬质清洁无烟煤</i></p>
                            <p>重量：<i>2000kg</i></p>
                        </li>
                        <li class="w4">
                        	<p>****083<br>会员<br>2015-03-02 21:08 购买</p>
                        </li>
                    </ul>
                </div>
                <script>
				$(function(){
					$('.qhcard .box').kkPages({
						PagesClass:'ul', //需要分页的元素
						PagesMth:5, //每页显示个数		
						PagesNavMth:3 //显示导航个数
					});
				}); 
				</script>
            </div>
            <div class="card">
            	<p>
                	<strong>服务承诺：</strong><br>优煤易购平台卖家销售并发货的商品，由平台卖家提供发票和相应的售后服务。请您放心购买！<br>
注：因厂家会在没有任何提前通知的情况下更改产品包装、产地或者一些附件，本司不能确保客户收到的货物与商城图片、产地、附件说明完全一致。只能确保为原厂正货！并且保证与当时市场上同样产品一致。若本商城没有及时更新，请大家谅解！

                </p>
            </div>
        </div>
    </div>
    <div class="zuijin">
    	<h2>最近浏览</h2>
        <ul>
        	<li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
            <li><a class="imga" href="page02-mei-xq.html"><img src="/Public/home/images/cpxq_28.jpg"></a><a class="namea" href="page02-mei-xq.html">硬质清洁无烟煤</a><p>0.52元/斤</p></li>
        </ul>
    </div>
</div>
<!--product开始-->
                       
<script>
$(function(){
	$(".zhong .xuan label").click(function(){
		var n =$(this).index();
		$(".zhong .xuan label").removeClass("on");
		$(this).addClass("on");
	})
})
$(function(){
	$(".right .caozuo .carbtn").click(function(){
		$(".tishibox").show();
	})
	$(".tishibox a").click(function(){
		$(".tishibox").hide();
	})
})
</script>

<script>
$(function(){
	$(".jisuan .jia").click(function(){
		var n=$(".num").val();
		n++;
		$(".num").val(n);
	})
	$(".jisuan .jian").click(function(){
		var n=$(".num").val();
			if(n<2){
				n==1;
			}else{
				n--;
			$(".num").val(n);
			}
	})
})
</script>


<script>
$(function(){
	$(".qhcard .card").eq(0).show();
	$(".cardbox .title span").eq(0).addClass("current");
	$(".cardbox .title span").click(function(){
		var n =$(this).index();
		$(".cardbox .title span").removeClass("current");
		$(this).addClass("current");
		$(".qhcard .card").hide();
		$(".qhcard .card").eq(n).show();
	})
})
</script>

<!--tipbox-->
<div class="tishibox">
	<div class="tishi">
        <h3>宝贝已经成功加入购物车</h3>
        <p>您可以到<a href="center-car.html">购物车</a>查看</p>
        <a class="guanbi">关闭</a>
    </div>
</div>
<!--tipbox--> 
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
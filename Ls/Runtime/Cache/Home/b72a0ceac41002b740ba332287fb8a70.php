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

<link rel="stylesheet" type="text/css" href="/Public/home/css/index.css" />
<script type="text/javascript" src="/Public/home/js/PCASClass.js"></script>

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

<!--jiaodian开始-->
<div class="focusbox">
	<div class="left">
    	<div class="imgbox">
        	<a class="imga"><img src="/Public/home/images/index66_03.jpg"></a>
            <a class="imga"><img src="/Public/home/images/index66_03.jpg"></a>
            <a class="imga"><img src="/Public/home/images/index66_03.jpg"></a>
        </div>
        <div class="btn">
        	<span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<script>
	jQuery(".focusbox .left").slide({mainCell:".imgbox",effect:"leftLoop",titCell:".btn span", autoPlay:true});
</script>
<!--jiaodian开始-->
<!--chanpin开始-->
<div class="chanpinbox">
	<div class="chanpin" id="cp1">
    	<h2><img src="/Public/home/images/index55_07.png"></h2>
        <ul>
        	<li>
            	<a class="imga" href="<?php echo U('Goods/Detail');?>"><img src="/Public/home/images/index66_18.jpg"></a>
                <div class="text">
                	<h3><a class="namea" href="<?php echo U('Goods/Detail');?>">硬质3-6清洁无烟煤</a><span>市场价：<i><b>0.52</b>元/斤</i></span></h3>
					<p><i>硬质3-6</i><a class="buy" href="<?php echo U('Goods/Detail');?>"></a></p>
                </div>
            </li>
            <li>
            	<a class="imga" href="<?php echo U('Goods/Detail');?>"><img src="/Public/home/images/index66_20.jpg"></a>
                <div class="text">
                	<h3><a class="namea" href="<?php echo U('Goods/Detail');?>">硬质3-6清洁无烟煤</a><span>市场价：<i><b>0.52</b>元/斤</i></span></h3>
					<p><i>硬质3-6</i><a class="buy" href="<?php echo U('Goods/Detail');?>"></a></p>
                </div>
            </li>
            <li>
            	<a class="imga" href="<?php echo U('Goods/Detail');?>"><img src="/Public/home/images/index66_22.jpg"></a>
                <div class="text">
                	<h3><a class="namea" href="<?php echo U('Goods/Detail');?>">硬质3-6清洁无烟煤</a><span>市场价：<i><b>0.52</b>元/斤</i></span></h3>
					<p><i>硬质3-6</i><a class="buy" href="<?php echo U('Goods/Detail');?>"></a></p>
                </div>
            </li>
            <li>
            	<a class="imga" href="<?php echo U('Goods/Detail');?>"><img src="/Public/home/images/index66_46.jpg"></a>
                <div class="text">
                	<h3><a class="namea" href="<?php echo U('Goods/Detail');?>">硬质3-6清洁无烟煤</a><span>市场价：<i><b>0.52</b>元/斤</i></span></h3>
					<p><i>硬质3-6</i><a class="buy" href="<?php echo U('Goods/Detail');?>"></a></p>
                </div>
            </li>
            <li>
            	<a class="imga" href="<?php echo U('Goods/Detail');?>"><img src="/Public/home/images/index66_48.jpg"></a>
                <div class="text">
                	<h3><a class="namea" href="<?php echo U('Goods/Detail');?>">硬质3-6清洁无烟煤</a><span>市场价：<i><b>0.52</b>元/斤</i></span></h3>
					<p><i>硬质3-6</i><a class="buy" href="<?php echo U('Goods/Detail');?>"></a></p>
                </div>
            </li>
            <li>
            	<a class="imga" href="<?php echo U('Goods/Detail');?>"><img src="/Public/home/images/index66_51.jpg"></a>
                <div class="text">
                	<h3><a class="namea" href="<?php echo U('Goods/Detail');?>">硬质3-6清洁无烟煤</a><span>市场价：<i><b>0.52</b>元/斤</i></span></h3>
					<p><i>硬质3-6</i><a class="buy" href="<?php echo U('Goods/Detail');?>"></a></p>
                </div>
            </li>
            
        </ul>
        
    </div>
    <div class="ssimg"><img src="/Public/home/images/index55_45.png"></div>
</div>
<!--chanpin结束-->
<!--iconbox开始-->
<div class="iconbox">
	<ul>
    	<li>
        	<a class="imga"><img src="/Public/home/images/index1_66.png"></a>
            <h2>优煤易购</h2>
            <p>网购无烟煤首选，方便快捷，让您省钱省心。</p>
        </li>
        <li>
        	<a class="imga"><img src="/Public/home/images/index1_60.png"></a>
            <h2>质量保障</h2>
            <p>产品来自无烟煤之乡山西晋城，精制加工保障质量</p>
        </li>
        <li>
        	<a class="imga"><img src="/Public/home/images/index1_53.png"></a>
            <h2>品种齐全</h2>
            <p>针对不同行业需求制定产品，更符合用户使用习惯</p>
        </li>
        <li>
        	<a class="imga"><img src="/Public/home/images/index1_63.png"></a>
            <h2>价格更低</h2>
            <p>厂家直销，省去中间环节，直达用户手中</p>
        </li>
        <li>
        	<a class="imga"><img src="/Public/home/images/index1_55.png"></a>
            <h2>购买安全</h2>
            <p>免费送货上门，免费退换货</p>
        </li>
        <li>
        	<a class="imga"><img src="/Public/home/images/index1_57.png"></a>
            <h2>配送及时</h2>
            <p>同城配送更快速及时</p>
        </li>
    </ul>
</div>
<!--iconbox结束--> 
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
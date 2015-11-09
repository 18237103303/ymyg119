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

<link rel="stylesheet" type="text/css" href="/Public/home/css/denglu.css" />
<!--headerbox--> 
<div class="headerbox">
	<div class="header">
    	<a class="logoa" href="<?php echo U('Index/Index');?>"><img src="/Public/home/images/index1_07.png"></a>
        <h2>注册</h2>
    </div>
</div> 
<!--headerbox--> 

<!--comebox-->
<div class="comebox">
	<div class="zhuce">
    	<h2>注册</h2>
        <div class="box">
        	<dl><dt>手机号</dt><dd><input type="text"><i>*</i></dd></dl>
            <dl><dt>推荐人手机号</dt><dd><input type="text"></dd></dl>
        	<dl><dt>密码</dt><dd><input type="password"><i>*</i></dd></dl>
        	<dl><dt>确认密码</dt><dd><input type="password"><i>*</i></dd></dl>
        	<dl><dt>验证码</dt><dd><input type="text" class="small"><span>发送验证码</span></dd></dl>
       		<dl><dt>&nbsp;</dt><dd><input type="checkbox">&nbsp;&nbsp;我已阅读并同意<a style=" cursor:pointer;" class="kuan">《用户服务协议》</a>条款</dd></dl>
       		<dl><dt>&nbsp;</dt><dd><input type="button" value="注册" onClick="document.location='<?php echo U('Public/Login');?>'"></dd></dl>
       </div>
    </div>
</div>

<!--comebox-->
<script>
$(function(){
	$(".comebox dl dd a.kuan").click(function(){
		$(".tiaokuanbox").show();
	})
	$(".tiaokuanbox .sure").click(function(){
		$(".tiaokuanbox").hide();
	})
})
</script>

<!--tikuan-->
<div class="tiaokuanbox">
	<div class="tiaokuan">
    	<h2>用户服务协议</h2>
        <div class="text">
        <p><span>1、</span><i>服务条款的确认和接纳<br>乐徒旅行网由北京乐徒科技发展有限公司运营，用户按照注册页面提示填写信息、阅读同意本协议且完成全部注册程序，或以乐徒旅行网允许的其他方式成为乐徒旅行网注册用户，即表示用 户已知晓并同意按照本服务条款就使用乐徒旅行网提供的服务与北京乐徒科技发展有限公司达成具有法律约乐徒旅行网由北京乐徒科技发展有限公司运营乐徒旅行网由北京乐徒科技发展有限公司运营束力的协议。</i></p>
        <p><span>2、</span><i>服务条款的确认和接纳<br>乐徒旅行网由北京乐徒科技发展有限公司运营，用户按照注册页面提示填写信息、阅读同意本协议且完成全部注册程序，或以乐徒旅行网允许的其他方式成为乐徒旅行网注册用户，即表示用 户已知晓并同意按照本服务条款就使用乐徒旅行网提供的服务与北京乐徒科技发展有限公司达成具有法律约乐徒旅行网由北京乐徒科技发展有限公司运营乐徒旅行网由北京乐徒科技发展有限公司运营束力的协议。</i></p>
        <p><span>3、</span><i>服务条款的确认和接纳<br>乐徒旅行网由北京乐徒科技发展有限公司运营，用户按照注册页面提示填写信息、阅读同意本协议且完成全部注册程序，或以乐徒旅行网允许的其他方式成为乐徒旅行网注册用户，即表示用 户已知晓并同意按照本服务条款就使用乐徒旅行网提供的服务与北京乐徒科技发展有限公司达成具有法律约乐徒旅行网由北京乐徒科技发展有限公司运营乐徒旅行网由北京乐徒科技发展有限公司运营束力的协议。</i></p>
        <p><span>4、</span><i>服务条款的确认和接纳<br>乐徒旅行网由北京乐徒科技发展有限公司运营，用户按照注册页面提示填写信息、阅读同意本协议且完成全部注册程序，或以乐徒旅行网允许的其他方式成为乐徒旅行网注册用户，即表示用 户已知晓并同意按照本服务条款就使用乐徒旅行网提供的服务与北京乐徒科技发展有限公司达成具有法律约乐徒旅行网由北京乐徒科技发展有限公司运营乐徒旅行网由北京乐徒科技发展有限公司运营束力的协议。</i></p>
        <p><span>5、</span><i>服务条款的确认和接纳<br>乐徒旅行网由北京乐徒科技发展有限公司运营，用户按照注册页面提示填写信息、阅读同意本协议且完成全部注册程序，或以乐徒旅行网允许的其他方式成为乐徒旅行网注册用户，即表示用 户已知晓并同意按照本服务条款就使用乐徒旅行网提供的服务与北京乐徒科技发展有限公司达成具有法律约乐徒旅行网由北京乐徒科技发展有限公司运营乐徒旅行网由北京乐徒科技发展有限公司运营束力的协议。</i></p>
        <p><span>6、</span><i>服务条款的确认和接纳<br>乐徒旅行网由北京乐徒科技发展有限公司运营，用户按照注册页面提示填写信息、阅读同意本协议且完成全部注册程序，或以乐徒旅行网允许的其他方式成为乐徒旅行网注册用户，即表示用 户已知晓并同意按照本服务条款就使用乐徒旅行网提供的服务与北京乐徒科技发展有限公司达成具有法律约乐徒旅行网由北京乐徒科技发展有限公司运营乐徒旅行网由北京乐徒科技发展有限公司运营束力的协议。</i></p>
        <p><span>7、</span><i>服务条款的确认和接纳<br>乐徒旅行网由北京乐徒科技发展有限公司运营，用户按照注册页面提示填写信息、阅读同意本协议且完成全部注册程序，或以乐徒旅行网允许的其他方式成为乐徒旅行网注册用户，即表示用 户已知晓并同意按照本服务条款就使用乐徒旅行网提供的服务与北京乐徒科技发展有限公司达成具有法律约乐徒旅行网由北京乐徒科技发展有限公司运营乐徒旅行网由北京乐徒科技发展有限公司运营束力的协议。</i></p>
        </div>
        <a class="sure">确定</a>
    </div>
</div>
<!--tikuan-->
 
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
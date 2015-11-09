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

<link rel="stylesheet" type="text/css" href="/Public/home/css/center.css" />
<link rel="stylesheet" type="text/css" href="/Public/home/css/Css.css" />

<script type="text/javascript" src="/Public/home/js/jquery.kkPages.js"></script>
<?php if($step == 1): ?><!--headerbox--> 
<div class="headerbox">
	<div class="header">
    	<a class="logoa" href="<?php echo U('Index/Index');?>"><img src="/Public/home/images/index1_07.png"></a>
        <div class="tjimg"><img src="/Public/home/images/tijiaotijiao_03.jpg"></div>
    </div>
</div> 
<!--headerbox--> 

<!--tijiaobox开始-->
<div class="tijiaobox">
	<h2><p>收货地址</p><!--<a>管理收货地址</a>--></h2>
    <div class="send">
    	<div class="divp"><span>地址</span><div class="sel"><select><option>河南省</option></select><select><option>郑州市</option></select><select><option>金水区</option></select></div></div>
        <div class="shifou"><p>是否运送到具体位置<select><option>否</option><option>玉米楼</option></select>运费：<select><option>0</option><option>20.00</option></select>元</p></div>
        <div class="shifou"><p>是否货到付款<label><input type="radio" name="bb">是</label><label><input type="radio" name="bb">否</label></p></div>
        <!--<a href="center-dizhi.html">修改本地址</a>-->
    </div>
    <!--<a class="new">使用新地址</a>-->
    <div class="sure">
    	<h3>确认订单信息</h3>
        <div class="liebiao">
            <ul class="ultitle">
                <li class="w2">商品信息</li>
                <li class="w3">类型</li>
                <li class="w4">单价（元）</li>
                <li class="w5">重量</li>
                <li class="w6">优惠</li>
                <li class="w7">金额（元）</li>
            </ul>
            <ul class="single">
                <li class="w2"><div class="cp"><a class="imga"><img src="/Public/home/images/cpxq_21.jpg"></a><a class="namea">硬质清洁无烟煤</a></div></li>
                <li class="w3"><strong>P-N666</strong></li>
                <li class="w4">0.52元/斤</li>
                <li class="w5">6000kg</li>
                <li class="w6"><select><option>省300：优惠价</option></select></li>
                <li class="w7"><b>6666.00</b></li>
                <!--<li class="w8">给卖家留言：<input type="text"> <span>配送方式：物流快运</span></li>-->
            </ul>
            <ul class="single">
                <li class="w2"><div class="cp"><a class="imga"><img src="/Public/home/images/cpxq_21.jpg"></a><a class="namea">硬质清洁无烟煤</a></div></li>
                <li class="w3"><strong>P-N666</strong></li>
                <li class="w4">0.52元/斤</li>
                <li class="w5">6000kg</li>
                <li class="w6"><select><option>省300：优惠价</option></select></li>
                <li class="w7"><b>6666.00</b></li>
                <!--<li class="w8">给卖家留言：<input type="text"> <span>配送方式：物流快运</span></li>-->
            </ul>
        </div>
        <div class="liuyantt">
        	给卖家留言：<input type="text">
        </div>
        <style>
        	.liuyantt{ height:30px; font-size:14px; line-height:30px; color:#444; background-color:#f5f5f5; padding:10px 15px;}
			.liuyantt input{ display:inline-block; height:28px; width:500px; line-height:28px; border:1px solid #ccc; margin-left:10px; }
        </style>
        <div class="qian">
                    <p><input type="checkbox">&nbsp;使用优煤易购积分:<input type="text">点<span>-0.12</span></p>
                    <p><i>(可用121点)</i><em>100积分可兑换10元</em></p>
                    <div class="sheng">
                        <p><input type="checkbox" class="xuan">&nbsp;<i>使用优煤易购优惠券</i>&nbsp;结算时扣除</p>
                        <div class="hide" style="display:none;">
                        <p><a class="all">全选</a></p>
                        <ul>
                            <li><img src="/Public/home/images/daijinquan_03.png"><p>有效时间：2015-07-32 至 2015-08-32</p><div class="dwimg2"><img src="/Public/home/images/dwerwr_11.png"></div></li>
                            <li><img src="/Public/home/images/daijinquan_03.png"><p>有效时间：2015-07-32 至 2015-08-32</p><div class="dwimg2"><img src="/Public/home/images/dwerwr_11.png"></div></li>
                            <li><img src="/Public/home/images/daijinquan_03.png"><p>有效时间：2015-07-32 至 2015-08-32</p><div class="dwimg2"><img src="/Public/home/images/dwerwr_11.png"></div></li>
                        </ul>
                        </div>
                    </div>
                    <p>应付金额（含运费）<b>¥136.00</b></p>
                    <p>可获得优煤易购积分：666点</p>
                    <p><a class="tijiao" href="<?php echo U('Order/Addorder',array('step'=>2));?>">提交订单</a><a class="back" href="center-car.html">返回购物车</a></p>
                    <p><i class="tip">若价格变动，请在提交订单后联系卖家改价，并查看已买到的产品</i></p>
                </div>
        
    </div>
</div>
<!--tijiaobox结束-->
<script>
$(function(){
	$(".sheng ul li").click(function(){
		$(this).children(".dwimg2").toggle();
		})
	$(".sheng p a.all").click(function(){
		$(".sheng ul li .dwimg2").show();
		})
		
	$(".tijiaobox a.new").click(function(){
		$(".windowbox").show();
		})
	$(".windowbox a.btn").click(function(){
		$(".windowbox").hide();
		})
	$(".sheng p input.xuan").click(function(){
		$(this).parents("p").siblings(".hide").toggle();
		})
	})
</script>

<!--弹窗-->
<div class="windowbox">
	<div class="xinzeng">
            	<dl><dt style="color:#ff0000;">新增收货地址</dt><dd>电话号码手机号选填一项，其余为必填</dd></dl>
            	<dl><dt>所在地区：</dt><dd><select><option>中国大陆</option></select><select><option>河南省</option></select></dd></dl>
                <dl><dt>详细地址：</dt><dd><textarea placeholder="建议您如实填写详细收货地址，例如街道名称，门牌号码，楼层和房间号等信息"></textarea></dd></dl>
                <dl><dt>邮政编码：</dt><dd><input placeholder="如您不清楚邮递区号，请填写000000"></dd></dl>
                <dl><dt>收货人姓名：</dt><dd><input placeholder="长度不超过25个字符"></dd></dl>
                <dl><dt>手机号码：</dt><dd><input placeholder=""></dd></dl>
                <dl><dt>电话号码：</dt><dd><input placeholder=""></dd></dl>
                <dl><dt>&nbsp;</dt><dd><input type="checkbox" class="ss">设置为默认收货地址</dd></dl>
                <dl><dt>&nbsp;</dt><dd><a class="btn">保存</a><a class="btn">取消</a></dd></dl>
            </div>
</div>
<!--弹窗-->
<?php elseif($step == 2): ?>
<!--tijiaobox开始-->
<div class="tijiaobox2">
    <div class="send">
    	<p><i>河南省郑州市管城回族区 商都路街道 中州大道商都路阿金洪格日阿华风格附件和古人（张三 收） 15415654545</i></p>
        <a>订单金额：<span>3600.00</span></a>
    </div>
    <table cellpadding="0" cellspacing="0" style="border-collapse:collapse" border="0">
    	<tr>
        	<th>订单号</th>
            <th>产品种类</th>
            <th>重量</th>
            <th>金额</th>
        </tr>
        <tr>
        	<td>231561454554</td>
            <td>硬质清洁无烟煤</td>
            <td>6000kg</td>
            <td>￥6666.00</td>
        </tr>
        <tr>
        	<td>231561454554</td>
            <td>硬质清洁无烟煤</td>
            <td>6000kg</td>
            <td>￥6666.00</td>
        </tr>
    </table>
    <div class="kuan">
    	<h2><input type="checkbox">&nbsp;&nbsp;优煤易购积分<span>可用积分：<i>1000</i><i></i></span></h2>
        <div class="fukuan">
    	<div class="top">
        	<div class="btnbox">
            	<span class="current">第三方支付</span>
                <span>储蓄卡</span>
                <span>微信支付</span>
            </div>
        </div>
        <div class="bottom">
        	<div class="ways">
            	<h4>在线支付</h4>
            	<ul>
                	<li><input type="radio" name="nn1" checked="checked"><a><img src="/Public/home/images/way1_07.jpg"></a></li>
                    <li><input type="radio" name="nn1" checked="checked"><a><img src="/Public/home/images/way1_09.jpg"></a></li>
                </ul>
                <h4>手机扫描支付</h4>
            	<ul>
                	<li><input type="radio" name="nn1" checked="checked"><a><img src="/Public/home/images/way1_13.jpg"></a></li>
                </ul>
                <a class="ben">立即支付</a>
            </div>
            <div class="ways">
            	<h4>提示 ：您的银行卡需要开通网银才能进行支付</h4>
            	<ul class="ul2">
                	<li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_03.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_05.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_07.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_09.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_11.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_19.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_21.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_22.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_23.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_24.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_30.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_31.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_32.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_33.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_34.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_40.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_41.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_42.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_43.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_44.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_50.jpg"></a></li>
                    <li><input type="radio" name="nn"><a><img src="/Public/home/images/way2_51.jpg"></a></li>
                </ul>
                <a class="ben">立即支付</a>
            </div>
            <div class="ways" style="width:200px;">
                    <h3>扫一扫付款（元）<br><span>12.00</span></h3>
                    <div class="weixin">
                        <img src="/Public/home/images/weixin-3301_03.jpg">
                        <h5>打开微信<br>扫一扫继续付款</h5>
                    </div>
                    <h3><a href="#">首次使用请下载微信</a></h3>
                    <a class="ben">立即支付</a>
                </div>
        </div>
    </div>
    </div>
</div>
<!--tijiaobox结束-->
<script>
	$(function(){
		$(".ways ul li").click(function(){
			$(".ways ul li a").removeClass("current");
			$(this).children("a").addClass("current");
			$(".ways ul li input").prop('checked',false);
			$(this).children("input").prop('checked',true);
			})
		})
	$(function(){
		$(".bottom .ways").eq(0).show();
		$(".fukuan .top .btnbox span").click(function(){
			var n= $(this).index();
			$(".fukuan .top .btnbox span").removeClass("current");
			$(this).addClass("current");
			$(".bottom .ways").hide();
			$(".bottom .ways").eq(n).fadeIn();
			})
		})
	$(function(){
		$(".ways a.ben").click(function(){
			$(".tishibox").show();
			})
	$(".tishibox a").click(function(){
			$(".tishibox").hide();
			})
		})
</script>
<!--tipbox-->
<div class="tishibox">
	<div class="tishi">
    	<h2>正在支付</h2>
        <h3>请在新开的页面完成支付，支付完成前不要关闭窗口</h3>
        <p style="background-image:url(images/frgrt_03.jpg);">如您已成功付款,请点击:<a class="wc" href="<?php echo U('Order/Addorder',array('status'=>3));?>">已完成付款</a></p>
        <p style="background-image:url(images/frgrt_06.jpg);">如您付款失败,请点击:<a class="cx">重新支付</a>或<a class="lx">联系客服</a></p>
        <a class="cj" href="<?php echo U('Article/Index');?>">常见问题</a>
    </div>
</div>
<!--tipbox-->
<?php else: ?>
<div class="tijiaobox3">
    <p><span>恭喜您，支付已经成功并且获得了一次抽奖机会。</span><a href="<?php echo U('Lottery/Index');?>">去抽奖吧</a></p>
</div><?php endif; ?>
 
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
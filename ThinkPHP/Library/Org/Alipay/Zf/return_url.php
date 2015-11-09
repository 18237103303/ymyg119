<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */
require_once("alipay.config.php");
require_once("lib/alipay_notify.class.php");
?>
<!DOCTYPE HTML>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php
//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//验证成功
    $out_trade_no   = $_GET['out_trade_no'];      //商户订单号
    $trade_no       = $_GET['trade_no'];          //支付宝交易号
    $trade_status   = $_GET['trade_status'];      //交易状态
    $total_fee      = $_GET['total_fee'];         //交易金额
    $notify_id      = $_GET['notify_id'];         //通知校验ID。
    $notify_time    = $_GET['notify_time'];       //通知的发送时间。
    $buyer_email    = $_GET['buyer_email'];       //买家支付宝帐号；

    $parameter = array(
        "out_trade_no"     => $out_trade_no,      //商户订单编号；
        "trade_no"     => $trade_no,          //支付宝交易号；
        "total_fee"      => $total_fee,         //交易金额；
        "trade_status"     => $trade_status,      //交易状态
        "notify_id"      => $notify_id,         //通知校验ID。
        "notify_time"    => $notify_time,       //通知的发送时间。
        "buyer_email"    => $buyer_email,       //买家支付宝帐号
    );
    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
           // orderhandle($parameter);  //进行订单处理，并传送从支付宝返回的参数；
              echo '成功';
    }
    else {
      echo "trade_status=".$_GET['trade_status'];
    }
     echo "验证成功<br />";
     echo '失败';
	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //验证失败
    //如要调试，请看alipay_notify.php页面的verifyReturn函数
    echo "验证失败";

}
?>
        <title>支付宝即时到账交易接口</title>
	</head>
    <body>
    </body>
</html>
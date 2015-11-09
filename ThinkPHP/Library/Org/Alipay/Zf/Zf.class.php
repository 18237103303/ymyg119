<?php
namespace Org\Alipay\Zf;
class Zf{
function index(){
require_once("/alipay.config.php");
require_once("/lib/alipay_submit.class.php");
//构造要请求的参数数组，无需改动 $_POST['pici_sn']$_POST['pici_fee']
$parameter = array(
		"service" => "create_direct_pay_by_user",
		"partner" => trim($alipay_config['partner']),
		"seller_email" => trim($alipay_config['seller_email']),
		"payment_type"	=> "1",
		"notify_url"	=> Org_PATH."/notify_url.php",
		"return_url"	=> Org_PATH."/return_url.php",
		"out_trade_no"	=> "4564561",
		"subject"	=>'海之澜订单',
		"total_fee"	=> "0.01",
		"body"	=> '无',
		"show_url"	=> "/",//展示的地址
		"anti_phishing_key"	=> "",//防钓鱼时间戳
		"exter_invoke_ip"	=> "",//ip
		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
);
//建立请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
header("Content-type:text/html;charset=utf-8");
echo $html_text;
}

}
?>
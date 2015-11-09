<?php

namespace Home\Controller;

use Think\Controller;

class PersonController extends PublicController {
//验证用户函数
       public function idcheck(){
	    $userids=session("Q_USER");
		$alist=array();
		$getorder=I('get.id');
		$checkorder=M('order_info')->where("user_id='$userids'")->field("order_id")->select();
	    for($i=0;$i<count($checkorder);$i++){
			$alist[]=$checkorder[$i]['order_id'];
		}
		if(!in_array($getorder,$alist)){
			$this->redirect('Public/error1');
		 }
       }
	   //地址验证
	   public function checkadrs(){
		$userids=session("Q_USER");
		$alist=array();
		$getorder=I('get.id');
		$checkorder=M('user_addrs')->where("aid='$userids'")->field("id")->select();
	    for($i=0;$i<count($checkorder);$i++){
			$alist[]=$checkorder[$i]['id'];
		}
		if(!in_array($getorder,$alist)){
			$this->redirect('User/Qtdz/login');
		 }
	   }
    public function person() {
        $userid = session("Q_USER"); //登录用户的id
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $showcount = $this->countlist();
            $this->assign('showcount', $showcount);
            $per = M('user');
            if (I('post.')) {

                $rsadd = I('post.');
                $rsadd['address'] = I('post.province') . I('post.city') . I('post.area');
                $data1 = $per->where("id='$userid'")->save($rsadd);
                if ($data1 > 0) {
                    $this->ajaxReturn('<span> [ 修改成功！ ]</span>', 'JSON');
                    //$data['status']=1;
                    //$this->redirect('Person/person');			
                } else {
                    $this->ajaxReturn('<span style="color:red;"> [ 修改失败！ ]</span>', 'JSON');
                    //$this->error('修改失败！');			
                }
            } else {
                 $rsdetail = $per->where("id='$userid'")->find();
                if(empty($rsdetail['pic'])){
                    $rsdetail['pic']='';
                }else{
                $dir = dirname($rsdetail['pic']);
                $name = basename($rsdetail['pic']);
                preg_match_all("/t_/", $name,$match);
		        if($match[0]){
                $rsdetail['pic']=$dir.'/'.$name;
                }else{
                $rsdetail['pic']=$dir.'/t_'.$name;
                 }
                }
                $this->assign('detail', $rsdetail);
                //var_dump($rsdetail);exit;
                $this->display();
            }
        }
    }

    //处理上传图片

    /**
     * 单图上传
     */
    public function upload() {
        if ($_FILES['upload']['error'] === 0) {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'swf', 'avi', 'flv');
            $upload->savePath = './userimg/';
            $upload->saveName = array('uniqid', '');
            $info = $upload->upload();
            var_dump($info);
            exit;
            if (!$info) {
                $this->error($upload->getError());
            } else {
                foreach ($info as $file) {
                    $imgpath = $file['savepath'];
                    $imgname = $file['savename'];
                    $path = $file['savepath'] . $file['savename'];
                }
                //$_POST['ad_code'] = $path;
                echo json_encode(array('info' => 1, 'path' => $path));
            }
        } else {
            $this->error('上传失败');
        }
    }

//添加会员
    public function addmember() {
        $userid = session("Q_USER");
        if (!empty($userid)) {
            $this->redirect('Index/index');
        } else {
            if (I('post.')) {
                $name = I('post.numb');
                $pwd = I('post.pwd');
                $data['password'] = $this->lx_ucenter_encrypt($pwd, $name);
                $data['name'] = I('post.numb');
                //$data['password']=I('post.pwd');
                /* $data['user_up']= */
                $data['up_id'] = $userid;
                $data['grand'] = 0;
                $rsaddmem = M('user')->create($data);
                //var_dump($rsaddmem);exit;
                if ($rsaddmem) {
                    $rs = M('user')->add();
                    $data['status'] = 1;
                } else {
                    $data['status'] = 0;
                }
                echo json_encode($data);
            }
        }
    }

    //密码加密

    function lx_ucenter_encrypt($data, $key, $expire = 0) {
        $key = md5($key);
        $data = base64_encode($data);
        $x = 0;
        $len = strlen($data);
        $l = strlen($key);
        $char = '';
        for ($i = 0; $i < $len; $i++) {
            if ($x == $l)
                $x = 0;
            $char .= substr($key, $x, 1);
            $x++;
        }
        $str = sprintf('%010d', $expire ? $expire + time() : 0);
        for ($i = 0; $i < $len; $i++) {
            $str .= chr(ord(substr($data, $i, 1)) + (ord(substr($char, $i, 1))) % 256);
        }
        return str_replace('=', '', base64_encode($str));
    }

    //验证用户名是否存在
    public function checkmember() {
        if (I('post.numb')) {
            $name = I('post.numb');
            $rsmember = M('user')->where("name='$name'")->count();
            if ($rsmember > 0) {
                $this->ajaxReturn('<span style="color:#c09853;"> [ 用户编号存在! ]</span>', 'JSON');
            }
        }
    }

//积分 店铺的个数
    public function countlist() {
        $userid = session("Q_USER");
        $coulist = array();
        if ($userid) {
            $coup = M('user')->where("id='$userid'")->field("jf")->find();
            $coulist['jf'] = $coup['jf'];
            $shopcount = M('collect_shop')->where("user_id='$userid'")->count();
            $coulist['shop'] = $shopcount;
            $goodscount = M('collect_goods')->where("user_id='$userid'")->count();
            $coulist['goods'] = $goodscount;
        }
        return $coulist;
    }

    //个人信息展示
    public function pesinfoshow() {
        $userid = session("Q_USER");
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $info = M('user');
            $showcount = $this->countlist();
            $this->assign('showcount', $showcount);
            //$id=$_SESSION('USER');
            $showlist = $info->where("id='$userid'")->find();
            $this->assign('info', $showlist);
            $this->display();
        }
    }

    //地址管理
    public function pesaddress() {
        $userid = $_SESSION['Q_USER'];
        $addr = M('user_addrs');
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $aid = session("Q_USER"); //登录用户Id
            $showcou = $this->countlist();
            $this->assign('showcou', $showcou);
            if (I('post.')) {
                $data = I('post.');
                $changid = $aid; //登录用户Id
                $data['aid'] = $aid; //登录用户Id
                $data['area'] = I('post.province') . I('post.city') . I('post.area');
                $data['lianxi'] = I('post.tel');
                if (I('post.status') == 3) {

                    $rschang = $addr->where("aid='$changid' and status='默认'")->find();
                    if ($rschang) {
                        $addrid = $rschang['id'];
                        $updata['status'] = 2;
                        $rsup = $addr->where("id='$addrid'")->save($updata);
                    }
                }
                $rsadd = $addr->add($data);

                if ($rsadd > 0) {

                    //$data['state']=1;
                    $this->redirect('Person/pesaddress');
                } else {
                    $this->ajaxReturn('<span style="color:#c09853;">添加失败！ </span>', 'JSON');
                    //$data['state']=0;
                    // $this->error('添加失败！');
                }
                //echo json_encode($data);
            } else {
                //$id=1;
                //历史记录
                $showlist = $addr->where("aid='$aid' and status='记录'")->order('id desc')->select();
                $this->assign('giveup', $showlist);
                //默认收货地址
                $show = $addr->where("aid='$aid' and status='默认'")->find();
                $this->assign('default', $show);
                //新增地址
                $shownew = $addr->where("aid='$aid'")->order('id desc')->limit(0, 1)->select();
                $this->assign('new', $shownew);
                $this->display();
            }
        }
    }

    //手机号验证
    //Ajax匹配手机号
    public function phone() {
        $phone = I('post.phone');
        $reg = "/^13\d{9}|15[0|1|2|3|5|6|7|8|9]\d{8}|18[0|2|3|5|6|7|8|9]\d{8}|14[5|7]\d{8}$/";

        if ($phone == null) {
            $this->ajaxReturn('<span style="color:#c09853;"> [ 手机号不能为空! ]</span>', 'JSON');
        } else if (!preg_match($reg, $phone)) {
            $this->ajaxReturn('<span style="color:#c09853;"> [ 手机号不正确！ ]</span>', 'JSON');
        } else {
            $this->ajaxReturn('<span style="color:#c09853;"></span>', 'JSON');
        }
    }

    //Ajax 邮编匹配
    public function email() {
        $email = I('post.email');
        $reg = "/\d{6}/";
        if ($email == null) {
            $this->ajaxReturn('<span style="color:#c09853;"> [ 邮编不能为空！]</span>', 'JSON');
        } else if (!preg_match($reg, $email)) {
            $this->ajaxReturn('<span style="color:#c09853;"> [ 邮编格式不正确 ]</span>', 'JSON');
        } else {
            $this->ajaxReturn('<span style="color:#c09853;"> </span>', 'JSON');
        }
    }

    //Ajax 姓名字符长度验证
    public function xingming() {
        $name = I('post.name');
        //$reg="/^([\u4E00-\u9FA5]/";
        if ($name == null) {
            $this->ajaxReturn('<span style="color:#c09853;"> [ 不能为空 ]</span>', 'JSON');
        } else {
            $this->ajaxReturn('<span style="color:#c09853;"> </span>', 'JSON');
        }
    }

    //Ajax 详细地址长度验证
    public function detail() {
        $detail = I('post.detail');

        if ($detail == null) {
            $this->ajaxReturn('<span style="color:#c09853;"> [ 不能为空 ]</span>', 'JSON');
        } else {
            $this->ajaxReturn('<span style="color:#c09853;"> </span>', 'JSON');
        }
    }

    //删除用户的地址
    function delete() {
        $delid = I('get.id');
        $rsdel = M('user_addrs')->where("id='$delid'")->delete();
        if ($rsdel > 0) {
            $this->redirect('Person/pesaddress');
        } else {
            $this->error('删除失败!');
        }
    }

    //修改用户地址
    public function edit() {
        $id = session("Q_USER"); //登录用户的id
		$this->checkadrs();
        if (empty($id)) {
            $this->redirect('Index/index');
        } else {
            $showlist = $this->countlist();
            $this->assign('showcount', $showlist);
            $editid = I('get.id'); //用户地址的id
            $editshow = M('user_addrs');
            if (I('post.')) {
                $datalist = I('post.');
                //var_dump($datalist);exit;
                $datalist['area'] = I('post.province') . I('post.city') . I('post.area');
                $status = I('post.status');
                //$rshis=$editshow->where("id='$id' and status='默认'")->find();
                if ($status == 3) {
                    $rshis = $editshow->where("aid='$id' and status='默认'")->find();
                    if ($rshis) {
                        $historyid = $rshis['id'];
                        $history['status'] = 2;
                        $uphis = $editshow->where("id='$historyid'")->save($history);
                    }
                }


                $uprs = $editshow->where("id='$editid'")->save($datalist);
                if ($uprs) {
                    //$data['state']=1;
                    $this->redirect('Person/pesaddress');
                } else {
                    $this->ajaxReturn('<span style="color:#c09853;"> [ 修改失败！ ]</span>', 'JSON');
                    //$data['state']=0;
                }

                // echo json_encode($data);
            } else {
                $editinfo = $editshow->where("id='$editid'")->find();
                $this->assign('editinfo', $editinfo);
                //默认收货地址			  
                $show = $editshow->where("aid='$id' and status='默认'")->find();
                $this->assign('default', $show);
                //新增地址
                $shownew = $editshow->where("aid='$id'")->order('id desc')->limit(0, 1)->select();
                $this->assign('new', $shownew);
                //历史记录
                $showlist = $editshow->where("aid='$id' and status='记录'")->select();
                $this->assign('giveup', $showlist);
                $this->display();
            }
        }
    }

    //所有的订单
    public function allorder() {
        $userid = session("Q_USER"); //登录用户Id
        if (empty($userid)) {
            $this->redirect("/User/Qtdz/login");
        } else {
            $topstatus = $this->statusorder($userid);
            $this->assign('shownum', $topstatus);
            $page = I('page')? : 1;
            $count = M("order_info")->where("user_id='$userid'")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
            $confirmlist1 = M('order_info')->where("user_id='$userid'")->limit("$rpage1,$rpage2")->order('order_id desc')->select();
            //var_dump($confirmlist1);       
            $attr_value = $this->shuxing($confirmlist1);
            //$this->assign('attr',$attr_value);
            $goodsdetail = $this->goodsdetail($attr_value);
            $this->assign('detail', $goodsdetail);
            $this->assign('page', $rpage['page']);
            $this->display();
        }
    }

    //未付款订单
    public function nopay() {
        $userid = session("Q_USER"); //登录用户Id
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $topstatus = $this->statusorder($userid);
            $this->assign('shownum', $topstatus);
            $page = I('page')? : 1;
            $count = M("order_info")->where("user_id='$userid' and pay_status=0 and order_status=0")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
            $confirmlist1 = M('order_info')->where("user_id='$userid' and pay_status=0 and order_status=0")->order("add_time desc")->limit("$rpage1,$rpage2")->select();
            for ($i = 0; $i < count($confirmlist1); $i++) {
                $endtime = strtotime("-30 minutes");
                if ($confirmlist1[$i]['add_time'] < $endtime) {
                    $where['order_id'] = $confirmlist1[$i]['order_id'];
                    $update['order_status'] = 3;
                    $rs = M('order_info')->where($where)->save($update);
                }
            }
            $attr_value = $this->shuxing($confirmlist1);
            $goodsdetails = $this->goodsdetail($attr_value);
            $this->assign('page', $rpage['page']);
            $this->assign('needpay', $goodsdetails);
            $this->display();
        }
    }

    //订单留言
    public function leavewords() {
        if (empty($_SESSION['Q_USER'])) {
            $this->redirect('Index/index');
        } else {
            if (I('post.')) {
                $where['order_id'] = I('post.order');
                $data['postscript'] = I('post.info');
                if (I('post.flag')) {
                    $data['order_status'] = 4;
                    $updt = M('order_info')->where($where)->save($data);
                    if ($updt > 0) {
                        $dat['status'] = 1;
                    } else {
                        $dat['status'] = 0;
                    }
                } else {
                    $leve = M('order_info')->where($where)->save($data);
                    if ($leve) {
                        $dat['status'] = 1;
                    } else {
                        $dat['status'] = 0;
                    }
                }

                echo json_encode($dat);
            }
        }
    }

    //取消订单
    public function cancel() {
        $canceid = I('post.order');
        $canceltb = M('order_info');
        $goodsorder = M('order_goods');
        $data['order_status'] = I('post.status');
        $rscancel = $canceltb->where("order_id='$canceid'")->save($data);
        // $goodsrs=$goodsorder->where("order_id='$canceid'")->delete();
        if ($rscancel) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    //等待卖家发货
    public function send() {
        $userid = session("Q_USER"); //登录用户id
        //$sendtb=M('order_info');
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $topstatus = $this->statusorder($userid);
            $this->assign('listshow', $topstatus);
            $page = I('page')? : 1;
            $count = M("order_info")->where("user_id='$userid'  and order_status=1")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
            $confirmlist1 = M('order_info')->where("user_id='$userid'  and order_status=1")->order("add_time desc")->limit("$rpage1,$rpage2")->select();
            $attr = $this->shuxing($confirmlist1);
            $goodsdetails = $this->goodsdetail($attr);
            $this->assign('page', $rpage['page']);
            $this->assign('sendgoods', $goodsdetails);
            $this->display();
        }
    }

    //支付订单钱数
    public function paymoney() {
        $userid = session("Q_USER"); //用户登录id
        $userinfo = M()->table(array('lx_user' => 'a', 'lx_user_addrs' => 'b'))->where("b.aid='$userid' and b.status='默认'")->find();
        $this->assign('addrs', $userinfo);
        if (I('get.id')) {
            $orderid = I('get.id');
            $confirmlist1 = M('order_info')->where("order_id='$orderid'")->find();
            $coup = $confirmlist1['profit'];
            $coupl = $this->getUser();
            $coupall = $coupl * $coup / 100;
            $this->assign('coup', $coupall);
            $this->assign('orderlist', $confirmlist1);
            //$att=$this->typeshuxing($confirmlist1);
            $goodstail = M('order_goods')->where("order_id='$orderid'")->select();
            for ($l = 0; $l < count($goodstail); $l++) {
                $goodsid = $goodstail[$l]['goods_id'];
                $gds = $goodstail[$l]['goods_attr_id'];
                //var_dump($goodsid);exit;
                $goodsdt = M('goods')->where("goods_id='$goodsid'")->field('goods_thumb,goods_name,goods_id,goods_sn')->select();
                $goodstail[$l]['goods'] = $goodsdt;
                $gd = $this->typeshuxing($gds);
                $goodstail[$l]['att'] = $gd;
            }
            $this->assign('order', $goodstail);
        }
        $this->display();
    }

    //确认发货详细页面
    public function aftersend() {
        $type = I('get.type');
        if ($type == 0) {
            $type = 0;
            $this->assign('type', $type);
        } else if ($type == 1) {
            $type = 1;
            $this->assign('type', $type);
        } else if ($type == 2) {
            $type = 2;
            $this->assign('type', $type);
        } else if ($type == 6) {
            $type = 6;
            $this->assign('type', $type);
        } else if ($type == 3) {
            $type = 3;
            $this->assign('type', $type);
        } else if ($type == 4) {
            $type = 4;
            $this->assign('type', $type);
        } else if ($type == 5) {
            $type = 5;
            $this->assign('type', $type);
        }
        $userid = session("Q_USER");
        $userinfo = M()->table(array('lx_user' => 'a', 'lx_user_addrs' => 'b'))->where("b.aid='$userid' and b.status='默认'")->find();
        /* 		if(!IsPostBack){
          $starttime=time();
          } */
        $time = strtotime("1800 seconds");
        $endtime = $userinfo['add_time'] + $time;
        $this->assign('endtime', $endtime);
        $this->assign('addrs', $userinfo);
        if (I('get.id')) {
            //$orderid=I('get.id');
            $orderid = I('get.id');
            $arinfo = array();
            $arinfo['goodsid'] = I('get.goodsid');
            $arinfo['orderid'] = I('get.id');
            $this->assign('goodsinfo', $arinfo);
            $confirmlist1 = M('order_info')->where("order_id='$orderid'")->find();
            $coup = $confirmlist1['profit'];
            $coupl = $this->getUser();
            $coupall = $coupl * $coup / 100;
            $this->assign('coup', $coupall);
            $this->assign('orderlist', $confirmlist1);
            //$att=$this->typeshuxing($confirmlist1);
            $goodstail = M('order_goods')->where("order_id='$orderid'")->select();
            for ($l = 0; $l < count($goodstail); $l++) {
                $goodsid = $goodstail[$l]['goods_id'];
                $gds = $goodstail[$l]['goods_attr_id'];
                //var_dump($goodsid);exit;
                $goodsdt = M('goods')->where("goods_id='$goodsid'")->field('goods_thumb,goods_name,goods_id,goods_sn')->select();
                $goodstail[$l]['goods'] = $goodsdt;
                $gd = $this->typeshuxing($gds);
                $goodstail[$l]['att'] = $gd;
            }
            $this->assign('order', $goodstail);
        }
        $this->display();
    }

    //用户评论
    public function comment() {
        $userid = session("Q_USER"); //用户登录id
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $shownum = $this->statusorder($userid);
            $this->assign('shownum', $shownum);
            $page = I('page')? : 1;
            $count = M("order_info")->where("is_comment=0 and order_status=6 and user_id='$userid'")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
            $confirmlist1 = M('order_info')->where("is_comment=0 and order_status=6 and user_id='$userid'")->order("add_time desc")->limit("$rpage1,$rpage2")->select();
            $listshow = $this->shuxing($confirmlist1);
            $show = $this->goodsdetail($listshow);
            $this->assign('page', $rpage['page']);
            $this->assign('com', $show);
            $this->display();
        }
    }

    //确认订单
    public function confirm() {
        $userid = session("Q_USER"); //用户登录id
        if (empty($userid)) {
            $this->redirect('/User/Qtdz/login');
        } else {
            $confirmnum = $this->statusorder($userid);
            $this->assign('shownum', $confirmnum);
            if (I('get.order')) {
                $orderid = I('get.order');
                $orderdata['shipping_status'] = 2;
                $orderdata['order_status'] = 6;
                $orderdata['confirm_time']=time();
                //积分送给用户
                $listname = M('user')->where("id='$userid'")->find();
                $sum = 0;
                $sum = $listname['jf'];
                //查询订单的利润
                $sellist = M('order_info')->where("order_id='$orderid'")->find();
                //冻结积分
                if ($sellist['pay_name'] == 2) {
                    $user_score=$this->getUser()/100;
                    $cool = $sellist['profit']*$user_score / $sellist['score'] * 100;
                    $de['dj_jf'] = $listname['dj_jf'] - $cool;
                }
                $couus = $this->getUser();
                $profi['jf'] = $sellist['profit'] * $couus / 100;
                $sum = $sum + $profi['jf'];
                $de['jf'] = $sum;
                $usercon = M('user')->where("id='$userid'")->save($de);

                //积分送用end
                $conrs = M('order_info')->where("order_id='$orderid'")->save($orderdata);
                if ($conrs > 0 && $usercon > 0) {
                    $sta['status'] = 1;
                } else {
                    $sta['status'] = 0;
                }
                echo json_encode($sta);
            } else {
                $page = I('page')? : 1;
                $count = M("order_info")->where("order_status=2 and user_id='$userid' and pay_status=1")->count();
                $rpage = Page($count, 8, $page);
                $rpage1 = $rpage['page_l'];
                $rpage2 = $rpage['page_r'];
                $confirmlist = M('order_info')->where("order_status=2 and user_id='$userid' and pay_status=1")->order("add_time desc")->limit("$rpage1,$rpage2")->select();
                $showlist = $this->shuxing($confirmlist);
                $comlist = $this->goodsdetail($showlist);
                $this->assign('page', $rpage['page']);
                $this->assign('confirm', $comlist);
                $this->display();
            }
        }
    }

    //商品评论
    public function goodscomment() {
		$this->idcheck();
        $userid = session("Q_USER"); //登录用户id
        $goodsid = I('get.type'); //商品id
        $type = I('get.id');
        // if(I('get.id')){
        $rslist = M()->table(array('lx_order_info' => 'a', 'lx_order_goods' => 'b'))->where("a.order_id='$type' and a.order_id=b.order_id")->find();
        $this->assign('tb', $rslist);
        $goodlist = M('goods')->where("goods_id='$goodsid'")->find();
        $this->assign('list', $goodlist);
        $end = strtotime("last month");
        $start = time();
        $count = M()->table(array('lx_order_info' => 'a', 'lx_order_goods' => 'b'))->where("a.add_time between '$end' and '$start' and a.order_status=6 and a.order_id=b.order_id and b.goods_id='$goodsid'")->count();
        $this->assign('number', $count);
        $rank = M("goods_comment")->where("goods_id='$goodsid'")->Avg('comment_rank');
        $this->assign('rank', $rank);
        $this->display();
    }

    //评论商品提交
    public function goodscomments() {
        $userid = session("Q_USER");
        $goodsid = I('post.goodsid'); //商品id

        if (I('post.')) {
            if (I('post.imgurl')) {
                $datarank['show_img'] = I('post.imgsrc');
            }
            $datarank['content'] = I('post.content');
            $datarank['comment_rank'] = I('post.comment_rank');
            $datarank['user_name'] = I('post.noname');
            $datarank['user_id'] = $userid;
            $datarank['goods_id'] = $goodsid;

            $number = M('goods_comment')->where("goods_id='$goodsid' and user_id='$userid'")->order('comment_id desc')->limit(0, 1)->select();
            if ($number) {
                $datarank['parent_id'] = $number[0]['comment_id'];
            } else {
                $datarank['parent_id'] = 0;
            }
            if ($datarank['user_name'] == 1) {
                $userinfo = M('user')->where("id='$userid'")->find();
                $datarank['user_name'] = $userinfo['nic'];
            } else {
                $datarank['user_name'] = "匿名用户";
            }
            $orderid = I('post.order_id');
            $comment['is_comment'] = 1;

            $rslut = M('order_info')->where("order_id='$orderid'")->save($comment);
            //var_dump($datarank);exit;
            $datalist = M('goods_comment')->add($datarank);
            if ($datalist > 0) {
                $sta['status'] = 1;
            } else {
                $sta['status'] = 0;
            }
            echo json_encode($sta);
        }
    }

//更换头像

    public function saveav() {
        $userid = session("Q_USER"); //登录用户id
        if (I('post.imgurl')) {
            $data['pic'] = I('post.imgurl');
            $rssave = M('user')->where("id='$userid'")->save($data);
            if ($rssave) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    //完成订单
    public function finish() {
        $userid = session("Q_USER"); //登录用户id
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $listshow = $this->statusorder($userid);
            $this->assign('show', $listshow);
            $page = I('page')? : 1;
            $count = M("order_info")->where("order_status=6 and user_id='$userid'")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
            $confirmlist = M('order_info')->where("order_status=6 and user_id='$userid'")->order("add_time desc")->limit("$rpage1,$rpage2")->select();
            $att = $this->shuxing($confirmlist);
            $goodsdetail = $this->goodsdetail($att);
            $this->assign('finish', $goodsdetail);
            $this->assign('page', $rpage['page']);
            $this->display();
        }
    }

    //按时间进行搜索
    public function search() {
        $userid = session("Q_USER"); //用户登录id
        //总的订单状态
        $listshow = $this->statusorder($userid);
        $this->assign('show', $listshow);
        //时间搜索
        if (I('post.changtime') != 0 || (I('post.shopgoods') && I('post.changtime') != 0)) {

            $start = time();
            $flag_t = I('post.changtime');
            if ($flag_t == 1) {
                $end = strtotime("-1 week");
            } else if ($flag_t == 2) {
                $end = strtotime("last month");
            } else if ($flag_t == 3) {
                $end = strtotime("-3 month");
            } else {
                $end = strtotime("-1 year");
            }
            if (I('post.changtime') != 0 && I('post.shopgoods') == NULL) {
                $schrs = M('order_info')->where("add_time between '$end' and '$start' and user_id='$userid' ")->select();
                $attr = $this->shuxing($schrs);
                $goods = $this->goodsdetail($attr);
            } else {
                //综合搜索	
                $goodsname = I('post.shopgoods');
                $schrs = M()->table(array('lx_order_info' => 'e', 'lx_order_goods' => 'f'))->where("goods_name like '%$goodsname%' and e.user_id='$userid' and e.order_id=f.order_id and e.add_time between '$end' and '$start' ")->select();
                $attr = $this->shuxing($schrs);
                $goods = $this->goodsdetail($attr);
            }
        }
        //商品名搜索
        if (I('post.shopgoods') && I('post.changtime') == 0) {
            //var_dump(I('post.shopgoods'));
            $goodsname = I('post.shopgoods');
            $schrs = M()->table(array('lx_order_info' => 'e', 'lx_order_goods' => 'f'))->where("f.goods_name like '%$goodsname%' and e.user_id='$userid' and e.order_id=f.order_id  ")->select();
            //echo "<pre>"; var_dump($schrs);exit;
            $attr = $this->shuxing($schrs);
            $goods = $this->goodsdetail($attr);
        }
        $this->assign('search', $goods);
        $this->display();
    }

    /* public function change(){
      $this->display();
      } */

    //退货管理
    public function refund() {
        $userid = session("Q_USER"); //用户登录id
        if (empty($userid)) {
            $this->redirect('Index/index');
        } else {
            $page = I('page')? : 1;
            $count = M("order_info")->where("user_id='$userid' and order_status in (1,2,4,5) ")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
            $confirmlist = M('order_info')->where(" user_id='$userid' and order_status in (1,2,4,5) ")->limit("$rpage1,$rpage2")->select();
            $attr = $this->shuxing($confirmlist);
            $goods = $this->goodsdetail($attr);
            $this->assign('page', $rpage['page']);
            $this->assign('refund', $goods);
            $this->display();
        }
        //$this->display();
    }

    //积分页面
    //积分页面
    public function coupon() {
        $userid = session("Q_USER"); //用户登录id
        if (empty($userid)) {
            $this->redirect('/User/Qtdz/login');
        } else {
            $userid = $_SESSION['Q_USER'];
            $coutb = M('user');
            $couorder = $coutb->where("id='$userid'")->find(); //id 用户名
            //var_dump($couorder);
            //获得积分
            $coup = M('order_info')->where("user_id='$userid' and order_status=6")->select();
            $gaincoup = 0;
            for ($i = 0; $i < count($coup); $i++) {
                $gaincoup = $coup[$i]['profit'] + $gaincoup;
            }
            $profit = $this->getUser();
            $allcoup = $profit * $gaincoup / 100;
            //echo "<pre>";var_dump($allcoup);exit;
            $this->assign('coup1', $allcoup);
            //消费积分
            $comsume = M('order_info')->where("user_id='$userid' and pay_name=2 and order_status=6")->select();
            $sum = 0;
            for ($i = 0; $i < count($comsume); $i++) {
                $sum = $sum + $comsume[$i]['order_amount'];
            }
            $sumpro = $sum / $comsume[0]['score'] * 100;
            $this->assign('consume', $sumpro);
            $this->assign('coupon1', $couorder);
            //下面的列表积分的详细信息
            $page = I('page')? : 1;
            $count = M("order_info")->where("user_id='$userid' and order_status not in(0,3,5)")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
            $couponlist = M('order_info')->where("user_id='$userid' and order_status not in(0,3,5)")->limit("$rpage1,$rpage2")->select();
            for ($i = 0; $i < count($couponlist); $i++) {
               // if ($couponlist[$i]['pay_name'] == 2) {
                    //$allprofit = $couponlist[$i]['order_amount'] / $couponlist[$i]['score'] * 100; //消费积分
               // } else {
                    $coup = $couponlist[$i]['profit'];
                    $profit = $this->getUser();
                    $allprofit = $profit * $coup / 100;
               // }
                $couponlist[$i]['coup'] = $allprofit;
            }
            $this->assign('bile', $profit);
            foreach ($couponlist as $k => $v) {

                $order = $v['order_id'];
                $couponlist[$k]['goods'] = M()->table(array('lx_order_goods' => 'a', 'lx_goods' => 'b'))->where("a.order_id='$order' and a.goods_id=b.goods_id")->select();
            }
            $this->assign('coupls', $couponlist);
            $this->assign('page', $rpage['page']);
            $this->display();
        }
    }

    //获得积分
    function gaincoup() {
        $userid = session("Q_USER");
        if (I('get.type')) {
            if (I('get.type') == 'gain') {
            $page = I('page')? : 1;
            $count = M("order_info")->where("order_status=6 and user_id='$userid'")->count();
            $rpage = Page($count, 8, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];
                $couplist = M('order_info')->where("order_status=6 and user_id='$userid'")->limit("$rpage1,$rpage2")->select();
                $type = 1;
                for ($i = 0; $i < count($couplist); $i++) {
                    $profit = $this->getUser();
                    $profitlist = $couplist[$i]['profit'] * $profit / 100;
                    $couplist[$i]['bili'] = $profitlist;
                }
            } else if (I('get.type') == 'consume') {
                 $page = I('page')? : 1;
               $count = M("order_info")->where("pay_name=2 and user_id='$userid' and order_status=6")->count();
               $rpage = Page($count, 8, $page);
               $rpage1 = $rpage['page_l'];
               $rpage2 = $rpage['page_r'];
                $couplist = M('order_info')->where("pay_name=2 and user_id='$userid' and order_status=6")->limit("$rpage1,$rpage2")->select();
                for ($i = 0; $i < count($couplist); $i++) {
                    $sum = $couplist[$i]['order_amount'];
                    $profitlist = $sum / $couplist[$i]['score'] * 100;
                    $couplist[$i]['bili'] = $profitlist;
                }
                $type = 2;
            } else if (I('get.type') == 'dj_jf') {
               $page = I('page')? : 1;
               $count = M("order_info")->where("user_id='$userid' and order_status in (1,2,4)")->count();
               $rpage = Page($count, 8, $page);
               $rpage1 = $rpage['page_l'];
               $rpage2 = $rpage['page_r'];
                $couplist = M('order_info')->where("user_id='$userid' and order_status in (1,2,4)")->limit("$rpage1,$rpage2")->select();
                for ($i = 0; $i < count($couplist); $i++) {
                    $profit = $this->getUser();
                    $profitlist = $couplist[$i]['profit'] * $profit / 100;
                    $couplist[$i]['bili'] = $profitlist;
                }
                $type = 3;
            }
            $this->assign('typelist', $type);
            $cmission = $this->shuxing($couplist);
            //$this->assign('type', $cmission);
            $this->assign('page', $rpage['page']);
            $goodsdetail = $this->goodsdetail($cmission);
            $this->assign('detail', $goodsdetail);
            $this->display();
        }
    }

    //服务网点会员列表
    public function members() {
        $userid = session("Q_USER"); //登录用户id
        $metb = M('user');
        $rsmeber = $metb->where("up_id='$userid'")->select();

        foreach ($rsmeber as $v => $k) {
            $id = $k['id'];
            $end = time();
            $start = strtotime("-1 month");
            if (I('get.desc') == 0) {
                $rsmeber[$v]['ds'] = M('order_info')->where("user_id='$id'")->order('order_id')->limit(0, 1)->field('order_amount')->select();
            } else if (I('get.desc') == 1) {
                $rsmeber[$v]['ds'] = M('order_info')->where("user_id='$id'")->order('order_id desc')->limit(0, 1)->field('order_amount')->select();
            } else if (I('get.desc') == 2) {
                $rsmeber[$v]['ds'] = M('order_info')->where("user_id='$id'")->order('order_amount ')->limit(0, 1)->field('order_amount')->select();
            } else if (I('get.desc') == 3) {
                $rsmeber[$v]['ds'] = M('order_info')->where("user_id='$id'")->order('order_amount  desc')->limit(0, 1)->field('order_amount')->select();
            } else {
                $rsmeber[$v]['ds'] = M('order_info')->where("user_id='$id'")->order('order_id desc')->limit(0, 1)->field('order_amount')->select();
            }
        }
        $this->assign('memberlist', $rsmeber);
        $this->display();
    }

    //删除会员购买记录
    function delmember() {
        if (I('post.orderid')) {
            $orderid = I('post.orderid');
            $rsdel = M('order_info')->where("order_id='$orderid'")->delete();
            if ($rsdel > 0) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    //下级用户列表购物时间进行排序
    /*  function timeasc(){
      $userid
      } */
    //商家发货
    function sendgoods() {
        $userid = session("Q_USER");
        $sendgds = M("order_info")->where("user_id='$userid' and agency_id='$userid' and shipping_status=0")->select();
        //echo "<pre>";
        //var_dump($sendgds);exit;
        for ($i = 0; $i < count($sendgds); $i++) {
            $order_id = $sendgds[$i]['order_id'];
            //var_dump($order_id);
            $row = M('order_goods')->where("order_id='$order_id'")->find();
            $attr_id = $row['goods_attr_id'];
            $attrrow = M('goods_attr')->where("id='$attr_id'")->find();
            //$this->content($attrrow);
            $number = explode('-', $attrrow['attr_id']);
            $attribute = explode('-', $attrrow['attr_value']);
            for ($rsi = 0; $rsi < count($number); $rsi++) {
                $attr_val = $attribute[$rsi];
                $attrid = $number[$rsi];
                $resattr = M('goods_attribute')->where("attr_id='$attrid'")->find();
                $listshow.="{$resattr['attr_name']}:{$attr_val}" . "<br/>";
            }
        }
        $this->assign('type', $listshow);
//信息		 
        foreach ($sendgds as $k => $v) {
            $order = $v['order_id'];
            $sendgds[$k]['goods'] = M()->table(array('lx_order_goods' => 'a', 'lx_goods' => 'b'))->where("a.order_id='$order' and a.goods_id=b.goods_id")->field('b.goods_thumb,b.goods_name,b.goods_id')->select();
        }
        foreach ($sendgds as $s => $vo) {
            $goodsid = $vo['goods_id'];
            $sendgds[$s]['gatt'] = M()->table(array('lx_goods' => 'c', 'lx_goods_attr' => 'd', 'lx_goods_attribute' => 'e'))->where("c.goods_id=d.goods_id and d.attr_id=e.attr_id")->field('e.attr_name,d.attr_value,d.id')->select();
        }
        $this->assign('orderlist', $sendgds);
        $this->display();
    }

    //确认发货
    function shipping() {
        if (I('post.')) {
            $orderid = I('post.order_id');
            $shippingid = I('post.shippingid');
            $data['shipping_status'] = 1;
            $data['order_status'] = 2;
            $rsult = M('order_info')->where("order_id='$orderid'")->save($data);
            if ($rsult > 0) {
                $statu['status'] = 1;
            } else {
                $statu['status'] = 0;
            }
            echo json_encode($statu);
        }
    }

    //处理退货订单
    function handle() {
        $userid = session("Q_USER");
        $hdorder = M('order_info')->where("user_id='$userid' and agency_id='$userid' and order_status=4")->select();
        for ($i = 0; $i < count($hdorder); $i++) {
            $order_id = $hdorder[$i]['order_id'];
            //var_dump($order_id);
            $row = M('order_goods')->where("order_id='$order_id'")->find();
            $attr_id = $row['goods_attr_id'];
            $attrrow = M('goods_attr')->where("id='$attr_id'")->find();
            //$this->content($attrrow);
            $number = explode('-', $attrrow['attr_id']);
            $attribute = explode('-', $attrrow['attr_value']);
            for ($rsi = 0; $rsi < count($number); $rsi++) {
                $attr_val = $attribute[$rsi];
                $attrid = $number[$rsi];
                $resattr = M('goods_attribute')->where("attr_id='$attrid'")->find();
                $listshow.="{$resattr['attr_name']}:{$attr_val}" . "<br/>";
            }
        }
        $this->assign('type', $listshow);
//商品详细信息		 
        foreach ($hdorder as $k => $v) {
            $order = $v['order_id'];

            $hdorder[$k]['goods'] = M()->table(array('lx_order_goods' => 'a', 'lx_goods' => 'b'))->where("a.order_id='$order' and a.goods_id=b.goods_id")->field('b.goods_thumb,b.goods_name,b.goods_id,a.goods_number,a.market_price')->select();
            //var_dump($hdorder);exit;
        }

        foreach ($hdorder as $s => $vo) {
            $goodsid = $vo['goods_id'];
            $hdorder[$s]['gatt'] = M()->table(array('lx_goods' => 'c', 'lx_goods_attr' => 'd', 'lx_goods_attribute' => 'e'))->where("c.goods_id=d.goods_id and d.attr_id=e.attr_id")->field('e.attr_name,d.attr_value,d.id')->select();
        }
        //echo "<pre>";
        //var_dump($hdorder);exit;
        $this->assign('orderlist', $hdorder);
        $this->display();
    }

    //同意退货
    function aggre() {
        if (I('get.id')) {
            $orderid = I('get.id');
            $data['order_status'] = 5;
            $agr = M('order_info')->where("order_id='$orderid'")->save($data);
            if ($agr > 0) {
                $this->redirect('Person/handle');
            } else {
                $this->error('处理失败！');
            }
        }
    }

    //佣金列表计算
    function commission() {
        $userid = session("Q_USER");
        //$type=I('get.type');//var_dump($type);exit;	   
        //总的可用佣金
        //$useraccount=M('user')->where("id='$userid'")->field('')->find();
        $useraccount = M('user')->where("id='$userid'")->field('yj')->find();
        $this->assign('account', $useraccount);
        //获得的佣金
        $useraccount = M('order_info')->where("agency_id='$userid' and order_status=6")->select();
        $commission = $this->getcom($useraccount);
        $this->assign('account2', $commission);
        //消费的佣金
        $useraccount = M('order_info')->where("agency_id='$userid' and order_status=5")->select();
        $rs = $this->getcom($useraccount);
        $this->assign('account1', $rs);
        //冻结的佣金
        $useraccount = M('user')->where("id='$userid'")->field('dj_yj')->find();
        $this->assign('account3', $useraccount);
        //订单佣金的变化
        $commission = M('order_info')->where("agency_id='$userid'")->select();
        for ($l = 0; $l < count($commission); $l++) {
            $reduce = $commission[$i]['fw_id'];
            if ($reduce) {
                //$id=$commission[$i]
                $pro = $this->getUserWeb1();
                $profitlist = $commission[$i]['profit'] * $profit / 100;
            } else {
                //for($i=0;$i<count($commission);$i++){

                $profit = $this->getUserWeb();
                $profitlist = $commission[$i]['profit'] * $profit / 100;


                //}
            }
            $commission[$i]['bili'] = $profitlist;
            $id = $commission[$i]['user_id'];
            $name = M('user')->where("id='$id'")->field('name')->find();
            $type = $name['name'];
            $commission[$i]['name'] = $type;
        }

        //echo "<pre>";var_dump($commission);exit;
        $cmission = $this->shuxing($commission);
        //$this->assign('type',$cmission);
        $goodsdetail = $this->goodsdetail($cmission);
        $this->assign('detail', $goodsdetail);
        $this->display();
    }

    //获得佣金的、消费佣金‘冻结佣金
    function gaincom() {
        $userid = session("Q_USER");
        if (I('get.type')) {
            if (I('get.type') == 'gain') {
                $commission = M('order_info')->where("agency_id='$userid' and order_status=6")->select();
                $this->assign('title', 1);
            } else if (I('get.type') == 'consume') {
                $commission = M('order_info')->where("agency_id='$userid' and (order_status=5 or order_status=4)")->select();
                $this->assign('title', 2);
            } else if (I('get.type' == 'dj_yj')) {
                $commission = M('order_info')->where("agency_id='$userid'  and order_status=2")->select();
                $this->assign('title', 3);
            }
            for ($i = 0; $i < count($commission); $i++) {
                $id = $commission[$i]['user_id'];
                $name = M('user')->where("id='$id'")->field('name')->find();
                $type = $name['name'];
                $profit = $this->getUserWeb();
                $profitlist = $commission[$i]['profit'] * $profit / 100;
                $commission[$i]['bili'] = $profitlist;
                $commission[$i]['name'] = $type;
            }
            //echo "<pre>";var_dump($commission);exit;
            $cmission = $this->shuxing($commission);
            //$this->assign('type',$cmission);
            $goodsdetail = $this->goodsdetail($cmission);
            $this->assign('detail', $goodsdetail);
            $this->display();
        }
    }

    //利润的计算
    function getcom($v) {
        $sum = 0;

        for ($i = 0; $i < count($v); $i++) {
            $sum = $sum + $v[$i]['profit'];
        }
        $profi = $this->getUserWeb();
        $rs = $sum * $profi / 100;
        return $rs;
    }

    //商品详情的属性查看
    function shuxing($s) {
        $hdorder = $s;
        for ($i = 0; $i < count($hdorder); $i++) {
            $order_id = $hdorder[$i]['order_id'];
            $row = M('order_goods')->where("order_id='$order_id'")->find();
            $attr_id = $row['goods_attr_id'];
            $attrcount = explode('-', $attr_id);
            $listshow = "";
            for ($k = 0; $k < count($attrcount); $k++) {
                //echo $k;
                $attr_id = $attrcount[$i];

                $attrrow = M('goods_attr')->where("id='$attr_id'")->find();
                $number = explode('-', $attrrow['attr_id'], -1);
                $attribute = explode('-', $attrrow['attr_value'], -1);
                for ($rsi = 0; $rsi < count($number); $rsi++) {
                    $attr_val = $attribute[$rsi];
                    $attrid = $number[$rsi];
                    $resattr = M('goods_attribute')->where("attr_id='$attrid'")->find();
                    $listshow.="{$resattr['attr_name']}:{$attr_val}" . "<br/>";
                }
            }
            $hdorder[$i]['att'] = $listshow;
        }
        return $hdorder;
    }

    //商品详情属性样式变化
    function typeshuxing($s) {
        //$hdorder=$s;
        //for($i=0;$i<count($hdorder);$i++){
        //$order_id=$hdorder['order_id'];
        //$row=M('order_goods')->where("order_id='$order_id'")->find();
        $attr_id = $s;
        $attrcount = explode('-', $attr_id);
        $listshow = "";
        $showshuxing = "";
        $showalltb = "";
        for ($k = 0; $k < count($attrcount); $k++) {
            //echo $k;				
            $attrrow = M('goods_attr')->where("id='$attr_id'")->find();
            $number = explode('-', $attrrow['attr_id']);
            $attribute = explode('-', $attrrow['attr_value']);
            for ($rsi = 0; $rsi < count($number); $rsi++) {
                $attr_val = $attribute[$rsi];
                $attrid = $number[$rsi];
                $resattr = M('goods_attribute')->where("attr_id='$attrid'")->find();

                $listshow.="<td class='t1'>{$resattr['attr_name']}</td>";
                $showshuxing.="<td class='t1'>{$attr_val}</td>";
            }
            $showtable = "<table><tr>";
            $showtr = "</tr>";
            $showtsr = "<tr>";
            $showtb = "</table>";
            $showalltb = $showtable . $listshow . $showtr . $showtsr . $showshuxing . $showtb;
        }
        //var_dump($showalltb);
        $hdorder = $showalltb;
        //}
//var_dump($hdorder);exit;		 
        return $hdorder;
    }

    //商品详情信息
    function goodsdetail($k) {
        $hdorder = $k;
        foreach ($hdorder as $l => $v) {
            $order = $v['order_id'];
            $hdorder[$l]['goods'] = M()->table(array('lx_order_goods' => 'a', 'lx_goods' => 'b'))->where("a.order_id='$order' and a.goods_id=b.goods_id")->field('b.goods_thumb,b.goods_name,b.goods_id,a.goods_number,a.market_price')->select();
        }
        return $hdorder;
    }

    //所有商品的状态的总数
    public function statusorder($b) {
        $userid = $b;
        $dataorder = array();
        //订单的条数
        $allcount = M('order_info')->where("user_id='$userid'")->count();
        $dataorder['all'] = $allcount;
        //$this->assign('allcount',$allcount);   
        //订单needsend条数
        $allcount1 = M('order_info')->where("user_id='$userid' and pay_status=0 and order_status=0")->count();
        $dataorder['need'] = $allcount1;
        //$this->assign('needcount',$allcount);
        //订单待卖家发货
        $allcount2 = M('order_info')->where("user_id='$userid'  and order_status=1")->count();
        $dataorder['send'] = $allcount2;
        //$this->assign('sendcount',$allcount);
        //订单确认收货
        $allcount3 = M('order_info')->where("user_id='$userid' and  order_status=2")->count();
        $dataorder['confirm'] = $allcount3;
        //$this->assign('confirmcount',$allcount);
        //订单完成
        $allcount4 = M('order_info')->where("user_id='$userid'  and order_status=6")->count();
        $dataorder['finish'] = $allcount4;
        //$this->assign('finishcount',$allcount);
        //需要评论订单总数
        $allcount5 = M('order_info')->where("user_id='$userid' and is_comment=0 and order_status=6")->count();
        $dataorder['comment'] = $allcount5;
        //$this->assign('commentcount',$allcount);
        return $dataorder;
    }

    function uploads() {
        if (!empty($_FILES)) {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'swf', 'avi', 'flv');
            $upload->savePath = './av/';
            $upload->saveName = array('uniqid', '');
            $info = $upload->upload();

            if (!$info) {
                $data['status'] = 0;
                $this->error($upload->getError());
            } else {
                foreach ($info as $file) {
                    $imgpath = $file['savepath'];
                    $imgname = $file['savename'];
                    $path = $file['savepath'] . $file['savename'];
                }
                $data = $path;
                //图像缩略
                $image = new \Think\Image();
                $image->open(APP_PATH . "../Uploads/" . $path); // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg

                $path1 = $file['savepath'] . 't_' . $file['savename'];
                $image->thumb(210, 159)->save(APP_PATH . "../Uploads/" . $path1); //详情图片
            }
            echo $data;
        } else {
            $this->error('上传失败');
        }
    }

    function picchange() {
        $showlist = $this->countlist();
        $this->assign('showcount', $showlist);
        $this->display();
    }

    //商铺的收藏
    public function goodscon() {
        $userid = session("Q_USER"); //var_dump($userid);
        if ($userid) {
            $goodslist = M()->table(array('lx_collect_shop' => 'a', 'lx_shop_config' => 'b'))->where("a.shop_id=b.ghs_id and user_id='$userid'")->select();
            //var_dump($goodslist);   
            $this->assign('goodslist', $goodslist);
        } else {
            $this->redirect("/User/Qtdz/login");
        }
        $this->display();
    }

    //商铺的删除
    public function deletegoods() {
        if (I('post.')) {
            $shopid = I('post.goods');
            $rsut = M('collect_shop')->where("col_shopid='$shopid'")->delete();
            if ($rsut > 0) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

    //商铺的批量删除
    function delete_all() {
        $item = $_POST['cName'];
        if (I('post.type') == 1) {
            $where['col_goodsid'] = array('in', $item);
            $checkdelete = M('collect_goods')->where($where)->delete();
        } else {
            $where['col_shopid'] = array('in', $item);
            $checkdelete = M('collect_shop')->where($where)->delete();
        }
        if ($checkdelete > 0) {
            $data['status'] = 1;
//$this->success('删除成功！');
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    function shopcon() {
        $userid = session("Q_USER");
        if ($userid) {
            $shoplist = M()->table(array('lx_collect_goods' => 'a', 'lx_goods' => 'b'))->where("a.user_id='$userid' and b.goods_id=a.goods_id")->select();
            foreach ($shoplist as $k => $v) {
                $gid = $v['goods_id'];
                $price = $this->getGoodsPrice($gid);
                $shoplist[$k]['market_price'] = $price;
            }
            $this->assign('shoplist', $shoplist);
        } else {
            $this->redirect("/User/Qtdz/login");
        }
        $this->display();
    }

    function deleteshop() {
        if (I('post.delid')) {
            $delid = I('post.delid');
            $rslist = M('collect_goods')->where("col_goodsid='$delid'")->delete();
            if ($rslist > 0) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        }
    }

}

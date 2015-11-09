<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author:念小七
 * Copyright:河南灵秀网络科技有限公司
 */

namespace Home\Controller;

use Think\Controller;

class OrderController extends PublicController {

    //购物车结算
    public function orderinfo() {
        $uid = session("Q_USER");
        $id = explode('_', rtrim(I("post.id"), '_'));

        if (!$id) {
            //$this->redirect("Cart/index");
            $this->ajaxReturn(array('status' => 3));
        }
        $memo = explode('_', rtrim(I("post.memo"), '_'));
        $num = count($id);
        $pids = array();
        $gids = array();
        $order_ids = '';
        //dump($id);
        $admin = M("User");
        $admin_id = $admin->where("id=$uid")->getField("up_id");
        $addr = M("UserAddrs");
        $addr_data = $addr->where("aid=$uid and status='默认'")->find();
        if (!$addr_data) {
            $this->ajaxReturn(array('status' => 4));
        }
        $consignee = $addr_data['name']; //收货人
        $country_p_c = $addr_data['area']; //省市区
        $address = $addr_data['xxxx']; //详细地址
        $tel = $addr_data['lianxi'];
        $pici_sn = 'SN' . date('sidYmH') . mt_rand(0, 9) . $uid;
        for ($i = 0; $i < $num; $i++) {
            $cids = explode('-', rtrim($id[$i], '-'));
            $c_num = count($cids);
            $total_fee = 0.00;
            $total_num = 0;
            $cost_fee = 0.00;
            $pid = 0; //供货商id
            for ($j = 0; $j < $c_num; $j++) {
                $cart = M('Car');
                $c_d = $cart->where("id={$cids[$j]}")->find();
                if (!$c_d) {
                    $this->ajaxReturn(array('status' => 3));
                }
                $cid = $c_d["sp_id"]; //商品id
                $goods_d = M("Goods");
                $g_name = $goods_d->where("goods_id=$cid")->getField("goods_name");
                $g_num = $c_d["num"]; //商品数量
                $pid = $c_d["ghs_id"]; //获取供货商id
                $goods_attr_id = $c_d['goods_attr_id']; //商品属性id
                $goods = M("GoodsAttr");
                $price = $goods->where("id=$goods_attr_id")->getField("market_price"); //售价
                $y_price = $goods->where("id=$goods_attr_id")->getField("shop_price"); //进价
                $stock = $goods->where("id=$goods_attr_id")->getField("goods_count"); //库存
                if (intval($stock) < intval($g_num)) {//库存不足
                    $this->ajaxReturn(array('status' => 2, 'msg' => "商品 " . $g_name . " 库存不足"));
                    //return false;
                }
                $cart->g_price = $price;
                $cart->id = $cids[$j];
                $cart->save();
                $price_num = sprintf("%.2f", $price * $g_num); //单件商品的总价格
                $y_price_num = sprintf("%.2f", $y_price * $g_num); //单件商品的总成本
                $total_fee+=$price_num;
                $total_num+=$g_num;
                $cost_fee+=$y_price_num;
            }
            $total_fee = sprintf("%.2f", $total_fee); //订单总价
            $cost_fee = sprintf("%.2f", $cost_fee); //订单总成本
            // var_dump($gids);exit();
            //生成订单
            //加入订单表
            $order = M("OrderInfo");
            $order->order_sn = 'SN' . date('sidYmH') . mt_rand(0, 9) . $uid;
            $order->provider_id = $pid; //供货商id;
            $order->user_id = $uid;
            $order->agency_id = $admin_id; //推荐人id;
            $order->consignee = $consignee; //收货人姓名
            $order->country_p_c = $country_p_c; //省市区
            $order->address = $address;
            $order->pici_sn = $pici_sn;
            $order->tel = $tel;
            $order->order_status = 0; //提交未支付;
            $order->shipping_status = 0; //未发货
            $order->pay_status = 0; //未付款;
            $order->goods_amount = $total_num; //订单总数量
            $order->order_amount = $total_fee; //订单总金额
            $order->add_time = time(); //下单时间
            $order->cost_fee = $cost_fee;
            $order->profit = $total_fee - $cost_fee;
            $order->postscript = $memo[$i];

            $result = $order->add();
            $order_ids.=$result . '-';
            if ($result) {
                //加入订单详情表
                for ($t = 0; $t < $c_num; $t++) {

                    $cart = M('Car');
                    $c_data = $cart->where("id={$cids[$t]}")->find();
                    $goods_attr_id = $c_data['goods_attr_id']; //商品属性id
                    $g_num = $c_data['num']; //商品数量
                    $gid = $c_data['sp_id']; //商品id
                    $goods_attr = M("GoodsAttr");
                    $price = $goods_attr->where("id=$goods_attr_id")->getField("market_price"); //售价
                    $y_price = $goods_attr->where("id=$goods_attr_id")->getField("shop_price"); //进价
                    $goods = M("Goods");
                    $gname = $goods->where("goods_id=$gid")->getField("goods_name"); //名称
                    $gsn = $goods->where("goods_id=$gid")->getField("goods_sn"); //货号
                    $order_goods = M("OrderGoods");
                    $order_goods->order_id = $result; //订单编号
                    $order_goods->goods_id = $gid;
                    $order_goods->goods_name = $gname;
                    $order_goods->goods_sn = $gsn;
                    $order_goods->goods_number = $g_num;
                    $order_goods->market_price = $price;
                    $order_goods->shop_price = $y_price;
                    $order_goods->is_comment = 0; //没有评论
                    $order_goods->goods_attr_id = $goods_attr_id; //商品属性id
                    $order_goods->add();
                }
            }
        }
        //$this->redirect("Order/pay");
        //购买成功后将购物车删掉
        for ($i = 0; $i < $num; $i++) {
            $cids = explode('-', rtrim($id[$i], '-'));
            $c_num = count($cids);
            for ($j = 0; $j < $c_num; $j++) {
                $cid = $cids[$j];
                $result = M("Car")->where("id=$cid")->delete();
            }
        }
        echo json_encode(array('status' => 1, 'order_ids' => $order_ids));
    }

    public function index() {
        $cid = explode('-', I("get.cid"));
        if (!$cid) {
            $this->redirect("Public/error1");
        }
        // var_dump($cid);
        $this->assign('id', I('get.cid'));
        $uid = session("Q_USER");
        $addr = M("UserAddrs");
        $addr_data = $addr->where("aid=$uid and status='默认'")->find();
        $this->assign("addr", $addr_data);
        //遍历购物车
        $cart = M("Car");
        if (!$uid) {
            $this->redirect("/User/Qtdz/login");
        } else {
            $map['id'] = array('in', $cid);
            $c_data = $cart->where($map)->order("id desc")->select();
            if (!$c_data) {
                $this->redirect("Cart/index");
            }
            $provid_id = array();
            foreach ($c_data as $k => $v) {
                if (in_array($v['ghs_id'], $provid_id)) {
                    continue;
                } else {
                    array_push($provid_id, $v['ghs_id']);
                }
            }
            $num = count($cid);
            $shop_car = array();
            foreach ($provid_id as $key => $value) {
                $shop = M("ShopConfig");
                $s_data = $shop->where("ghs_id=$value")->getField("shop_name"); //获取供货商姓名
                $shop_car[$s_data] = array();
            }

            for ($i = 0; $i < $num; $i++) {
                $cart = M("Car");
                //$c_d=$cart->where("id={$cid[$i]}")->find();
                $c_d = $this->getChildren($cid[$i]);
                //var_dump($c_d);exit();
                $gid = $c_d['ghs_id'];
                $shop = M("ShopConfig");
                $s_data = $shop->where("ghs_id=$gid")->getField("shop_name"); //获取供货商姓名
                array_push($shop_car[$s_data], $c_d);
            }
            //header("Content-type:text/html; charset=utf-8");
            // dump($shop_car);exit();
            $this->assign('cart', $shop_car);
            $this->display();
        }
    }

    public function getChildren($id) {
        $cart = M('Car');
        $s_data = $cart->where("id=$id")->find();
        //var_dump($s_data);
        if (empty($s_data))
            return false;

        $gid = $s_data['sp_id']; //获取商品id
        $goods = M("Goods");
        $thumb = $goods->where("goods_id=$gid")->getField("goods_thumb");
        $name = $goods->where("goods_id=$gid")->getField("goods_name");
        $s_data['goods_thumb'] = $thumb;
        $s_data['goods_name'] = $name;
        $goods_attr_id = $s_data['goods_attr_id'];
        $goods_attr = M("GoodsAttr");
        $g_a = $goods_attr->where("id=$goods_attr_id")->find();
        if (!$g_a['attr_id']) {
            $attr_name = '无属性';
        } else {
            $attr_id = explode('-', rtrim($g_a['attr_id'], '-'));

            $attr_value = explode('-', rtrim($g_a['attr_value'], '-'));
            $num = count($attr_id);
            $attr_name = '';
            for ($i = 0; $i < $num; $i++) {
                $attribute = M("GoodsAttribute");
                $a_n = $attribute->where("attr_id={$attr_id[$i]}")->getField("attr_name");
                $a_v = $attr_value[$i];
                $attr_name.=$a_n . ':' . $a_v . ';';
            }
        }
        $market_price = $g_a['market_price']; //售价
        $shop_price = $g_a['shop_price']; //进价
        $goods_num = $s_data['num'];
        $s_data['g_price'] = $market_price;
        $s_data['amount'] = sprintf("%.2f", $goods_num * $market_price);



        $s_data['attr_name'] = $attr_name;
        $profit = ($market_price - $shop_price) * $num; //单件商品的利润
        if ($profit < 0) {
            $profit = 0;
        }
        $user_bl = $this->getUser();
        $s_data['profit'] = $user_bl * $profit / 100;

        return $s_data;
    }

    public function pay() {
        $order_ids = explode('-', rtrim(I("get.order_ids"), '-'));
        $num = count($order_ids);
        $order_data = array();
        $total = 0.00;
        $profit = 0.00;
        for ($i = 0; $i < $num; $i++) {
            $order_id = $order_ids[$i];
            $order = M("OrderInfo");
            $order = $order->where("order_id=$order_id")->find();
            $pc = $order['pici_sn'];
            $order_data[$i]['order_sn'] = $order['order_sn'];
            $ghs_id = $order['provider_id'];
            $shop = M("ShopConfig");
            $shop_name = $shop->where("ghs_id=$ghs_id")->getField("shop_name");
            $order_data[$i]['shop_name'] = $shop_name;
            $order_data[$i]['order_id'] = $order_id;
            $order_data[$i]['total_num'] = $order['goods_amount'];
            $order_data[$i]['total_fee'] = $order['order_amount'];
            $total+=$order['order_amount'];
            $profit+=$order['order_amount'] - $order['cost_fee'];
            $addr = $order['country_p_c'] . $order['address'] . '&nbsp;&nbsp;&nbsp;&nbsp;(' . $order['consignee'] . ' &nbsp;&nbsp;收)&nbsp;&nbsp;&nbsp;&nbsp;' . $order['tel'];
        }
        //var_dump($order_data);
        $this->assign('pici_sn', $pc);
        $this->assign("order_data", $order_data);
        $total = sprintf("%.2f", $total);
        $this->assign("total", $total);
        $user_bl = $this->getUser();
        if ($profit < 0) {
            $profit = 0;
        }
        $score = $profit * $user_bl / 100;
        $score = sprintf("%.2f", $score);
        $this->assign('score', $score);
        $this->assign('addr', $addr);
        //获取用户的积分
        $uid = session("Q_USER");
        $user_score = M("User")->where("id=$uid")->getField("jf");
        $this->assign("user_score", $user_score);
        $this->display();
    }

    //新地址的添加
    public function changadd() {
        $aid = $_SESSION['Q_USER'];
        //$aid=4;
        $addr = M('user_addrs');
        if (I('post.')) {
            $data = I('post.');
            $changid = $aid; //登录用户Id
            $data['aid'] = $aid; //登录用户Id
            $data['area'] = I('post.province') . I('post.city') . I('post.area');
            $allcount = M('user_addrs')->where("aid='$aid'")->select();
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

                $list['state'] = 1;
                //$this->redirect('Person/pesaddress');
            } else {
                //$this->ajaxReturn('<span style="color:#c09853;">添加失败！ </span>','JSON');
                $list['state'] = 0;
                // $this->error('添加失败！');
            }
            echo json_encode($list);
        }
    }

    //积分支付
    public function score() {
        $ids = explode('-', rtrim(I("post.ids"), '-')); //订单id
        $num = count($ids);
        $total_fee = 0.00;
        //首先判断库存
        for ($i = 0; $i < $num; $i++) {
            $order_id = $ids[$i];
            $o_data = M("OrderGoods")->where("order_id=$order_id")->select();
            foreach ($o_data as $k => $v) {
                $id = $v['goods_attr_id']; //商品属性id
                $goods_attr = M("GoodsAttr")->where("id=$id")->find();
                //$price=$goods_attr[0]['market_price'];//商品库中的价格
                $stock = $goods_attr['goods_count']; //商品的库存

                $shop_num = $v['goods_number']; //购买的商品数量
                if (intval($shop_num) > intval($stock)) {
                    $this->ajaxReturn(array('info' => 0, 'msg' => '商品库存不足'));
                }
            }
            $order_data = M("OrderInfo")->where("order_id=$order_id")->find();
            $total = $order_data['order_amount']; //订单总额
            $total_fee+=$total;
        }
        //判断积分是否不足
        $uid = session("Q_USER");
        // dump($uid);
        $score = M("user")->where("id=$uid")->getField("jf");
        // dump($score.'---'.$total_fee);exit();
        if (intval($score * 100) < intval($total_fee * 100)) {
            $this->ajaxReturn(array('info' => 1, 'msg' => '您的积分余额不足'));
        }

        //减去用户积分
        $sj_score = $score - $total_fee;
        //var_dump($sj_score);
        $user = M("User");
        $user->id = $uid;
        $user->jf = $sj_score;
        $result = $user->save();
        //var_dump($result);exit();
        if ($result) {
            //改变订单状态
            $dj_score = 0.00;
            for ($i = 0; $i < $num; $i++) {
                $order = M("OrderInfo");
                $add['order_status'] = 1;
                $add['shipping_status'] = 0;
                $add['pay_status'] = 1;
                $add['pay_name'] = 2;
                $add['pay_time'] = time();
                $add['score'] = $this->getScore();
                $add1['order_id'] = $ids[$i];
                $order->where($add1)->save($add);
                //获取该订单的积分
                $profit = M("OrderInfo")->where("order_id={$ids[$i]}")->getField("profit");
                $score = $profit * ($this->getUser() / 100) * ($this->getScore() / 100); //冻结积分
                $dj_score+=$score;
                //减去商品的库存
                $o_id=$ids[$i];
                $order_item=M("OrderGoods")->where("order_id=$o_id")->select();
                foreach($order_item as $k=>$v){
                    $id=$v['goods_attr_id'];//属性id
                    $num=$v['goods_number'];
                    $gid=$v['goods_id'];
                    $stock=M("GoodsAttr")->where("id=$id")->getField("goods_count");
                    $sj_stock=$stock-$num;//减掉库存
                    $s_d=M("GoodsAttr")->where("id=$id")->setField("goods_count", $sj_stock);
                    if($s_d){
                        /*库存日志开始*/
                        $kcdata['goods_attr_id'] = $id;
                        $kcdata['endnum'] = $sj_stock;
                        $kcdata['startnum'] = $stock;

                        $kcdata['up_id'] = $uid;
                        $kcdata['sp_id'] = $gid;
                        $kcdata['content'] = "卖出";
                        $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
                        $kuncun = M('user_ghs_gn')->add($kcdata);
                        
                        /*库存日志结束*/
                    }
                }
            }
            //向用户表加入冻结积分
            $dj = M("User")->where("id=$uid")->getField("dj_jf");
            $dj_jf = $dj + $dj_score;
            $data = M("User")->where("id=$uid")->setField("dj_jf", $dj_jf);
        }
        $this->ajaxReturn(array('info' => 2, 'msg' => '支付成功'));
    }

}

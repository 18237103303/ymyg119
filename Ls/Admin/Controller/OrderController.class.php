<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author:念小七
 * Copyright：河南灵秀科技
 */

namespace Admin\Controller;

use Think\Controller;

class OrderController extends PublicController {

    public function order_list() {
        $type = $_GET['type']; //订单详情
        $user_id = $_SESSION['USER'];
        
        if ($type == 'item') {
            $order_id = $_GET['order_id'];
            $page = $_POST['page'] == null ? 1 : $_POST['page'];
            $limit = $_POST['rows'] == null ? 10 : $_POST['rows'];
            $order_id = $_GET['order_id'];
            $order = M('OrderGoods');
            $total = $order->where("order_id=$order_id")->count();
            $count = $total;
            if ($count > 0) {
                $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $data = $order->where("order_id=$order_id")->limit($start,$limit)->select();
            foreach($data as $k=>$v){
                $data[$k]['amount']=sprintf("%.2f",$v['market_price']*$v['goods_number']);
            }
            $ret = array();
            $ret['page'] = $page;
            $ret['rows'] = $data;
            $ret['total'] = $total_pages;
            $ret['records'] = $count;
            $ret['limit'] = $limit;
            echo json_encode($ret);
        } else {
            $page = empty($_POST['page']) ? 1 : $_POST['page'];
            $limit = empty($_POST['rows']) ? 10 : $_POST['rows'];
            //搜索条件
           
            $where = '1=1';
            $fillter = json_decode($_POST['filters'], true);
            if (!empty($fillter)) {
                $groupOp = $fillter['groupOp'];
                $rules = $fillter['rules'];
                foreach ($rules as $v) {
                    $dat = trim($v['data']);
                    if ($v['op'] == 'eq') {
                        if($dat!="''"){
                           $where .= " and {$v['field']}='{$dat}'";
                        }
                    } else if ($v['op'] == 'bw') {
                        if($dat!="''"){
                           $where .= " and {$v['field']} like '%{$dat}%'";
                        }
                    }
                }
            }
            $sidx=I("post.sidx");
            $sord=I("post.sord");
            //判断权限
            $auth=M('Auth');
            $u_a=$auth->where("uid=$user_id")->find();
            $group_id=$u_a['group_id'];
            $group=M('AuthGroup');
            $title=$group->where("id=$group_id")->find();
            if($title){
                if ($title['title']=='送货员') {
                $where.= "  and shipping_id={$user_id}";
                }elseif($title['title']=='供货商'){
                    $where.=" and provider_id={$user_id}";
                }
            }
            
            $order = M('OrderInfo');
            $total = $order->where($where)->order("$sidx $sord")->count();
            $count = $total;
            if ($count > 0) {
                $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $data = $order->where($where)->order("$sidx $sord")->limit($start,$limit)->select();
            foreach ($data as $k => $v) {
                $uid=$v['user_id'];
                $user=M('User');
                $u_data=$user->where("id=$uid")->find();
                if($u_data){
                    $data[$k]['user_name']=$u_data['name'];
                    $data[$k]['user_email']=$u_data['email'];
                    $data[$k]['user_phone']=$u_data['phone'];
                    $data[$k]['user_addr']=$u_data['address'];
                    $data[$k]['user_jf']=$u_data['jf'];
                }
                if (empty($v['add_time'])) {
                    $data[$k]['add_time'] = '';
                } else {
                    $data[$k]['add_time'] = date('Y-m-d H:i:s', $v['add_time']);
                }
                if (empty($v['confirm_time'])) {
                    $data[$k]['confirm_time'] = '';
                } else {
                    $data[$k]['confirm_time'] = date('Y-m-d H:i:s', $v['confirm_time']);
                }
                if (empty($v['pay_time'])) {
                    $data[$k]['pay_time'] = '';
                } else {
                    $data[$k]['pay_time'] = date('Y-m-d H:i:s', $v['pay_time']);
                }
            }
            $ret = array();
            $ret['page'] = $page;
            $ret['rows'] = $data;
            $ret['total'] = $total_pages;
            $ret['records'] = $count;
            $ret['limit'] = $limit;
            echo json_encode($ret);
        }
    }

    public function index() {
        $this->display();
    }
    public function fwlist() {
        quanx("fw_order");
        $this->display();
    }

    public function fw_list() {
        quanx("fw_order");
        $type = $_GET['type']; //订单详情
        $user_id = $_SESSION['USER'];
        if ($type == 'item') {
            $order_id = $_GET['order_id'];
            $page = $_POST['page'] == null ? 1 : $_POST['page'];
            $limit = $_POST['rows'] == null ? 10 : $_POST['rows'];
            $order_id = $_GET['order_id'];
            $order = M('OrderGoods');
            $total = $order->where("order_id=$order_id")->count();
            $count = $total;
            if ($count > 0) {
                $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $data = $order->where("order_id=$order_id")->limit($start,$limit)->select();
            foreach($data as $k=>$v){
                $data[$k]['amount']=sprintf("%.2f",$v['market_price']*$v['goods_number']);
            }
            $ret = array();
            $ret['page'] = $page;
            $ret['rows'] = $data;
            $ret['total'] = $total_pages;
            $ret['records'] = $count;
            $ret['limit'] = $limit;
            echo json_encode($ret);
        } else {
            $page = empty($_POST['page']) ? 1 : $_POST['page'];
            $limit = empty($_POST['rows']) ? 10 : $_POST['rows'];
            //搜索条件
            $where = '1=1';
            $fillter = json_decode($_POST['filters'], true);
            if (!empty($fillter)) {
                $groupOp = $fillter['groupOp'];
                $rules = $fillter['rules'];
                foreach ($rules as $v) {
                    $dat = trim($v['data']);
                    if ($v['op'] == 'eq') {
                        if($dat!="''"){
                           $where .= " and {$v['field']}='{$dat}'";
                        }
                    } else if ($v['op'] == 'bw') {
                        if($dat!="''"){
                           $where .= " and {$v['field']} like '%{$dat}%'";
                           //echo $where;exit();
                        }
                        
                    }
                }
            }
            $sidx=I("post.sidx");
            $sord=I("post.sord");
            //判断推荐人或转交的服务网点
            $where .= "  and (agency_id={$user_id} or fw_id={$user_id})";
            $order = M('OrderInfo');
            $total = $order->where($where)->order("$sidx $sord")->count();
            $count = $total;
            if ($count > 0) {
                $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $data = $order->where($where)->order("$sidx $sord")->limit($start,$limit)->select();
            foreach ($data as $k => $v) {
                $uid=$v['user_id'];
                $user=M('User');
                $u_data=$user->where("id=$uid")->find();
                if($u_data){
                    $data[$k]['user_name']=$u_data['name'];
                    $data[$k]['user_email']=$u_data['email'];
                    $data[$k]['user_phone']=$u_data['phone'];
                    $data[$k]['user_addr']=$u_data['address'];
                    $data[$k]['user_jf']=$u_data['jf'];
                }
                if (empty($v['add_time'])) {
                    $data[$k]['add_time'] = '';
                } else {
                    $data[$k]['add_time'] = date('Y-m-d H:i:s', $v['add_time']);
                }
                if (empty($v['confirm_time'])) {
                    $data[$k]['confirm_time'] = '';
                } else {
                    $data[$k]['confirm_time'] = date('Y-m-d H:i:s', $v['confirm_time']);
                }
                if (empty($v['pay_time'])) {
                    $data[$k]['pay_time'] = '';
                } else {
                    $data[$k]['pay_time'] = date('Y-m-d H:i:s', $v['pay_time']);
                }
            }
            $ret = array();
            $ret['page'] = $page;
            $ret['rows'] = $data;
            $ret['total'] = $total_pages;
            $ret['records'] = $count;
            $ret['limit'] = $limit;
            echo json_encode($ret);
        }
    }

    //服务网点点击发货
    public function send() {
        quanx("fw_order");
        $order_id = $_POST['order_id'];
        $send_id = $_POST['send_id'];
        $type = $_POST['type'];
        if ($type == 'send') {
            $order = M('OrderInfo');
            //改变订单状态
            $order->order_status = 2; //已发货
            $order->order_id = $order_id;
            $order->shipping_id = $send_id;
            $result = $order->save();
            if ($result) {
                echo json_encode(array('msg' => '发货成功'));
            } else {
                echo json_encode(array('msg' => '发货失败'));
            }
        }
        if ($type == 'print') {
            $sql = "select * from __PREFIX__order_info as oi,__PREFIX__order_goods as og where oi.order_id=og.order_id and oi.order_id=$order_id";
            $order = new \Think\Model();
            $data = $order->query($sql);
            //var_dump($data);
            foreach ($data as $k => $v) {
                $gid = $v['goods_id'];
                $data[$k]['amount'] = $v['market_price'] * $v['goods_number'];
                $data[$k]['attr_name'] = getAttrName($v['goods_attr_id']);
            }
            $msg = array();
            $user_id = $data[0]['user_id'];
            $msg['total_fee'] = $data[0]['order_amount'];
            $msg['pay_method'] = $data[0]['pay_name'];
            $msg['create_time'] = date('Y-m-d H:i:s', $data[0]['add_time']);
            $msg['user_id'] = $user_id;
            $msg['receiver_name'] = $data[0]['consignee'];
            $msg['receiver_mobile'] = $data[0]['tel'];
            $msg['addr'] = $data[0]['country_p_c'] . $data[0]['addr'];
            $admin_id = $data[0]['agency_id'];
            $admin = M("User");
            $admin_data = $admin->where("id=$admin_id")->find();
            $msg['admin_user'] = $admin_data[0]['name'];
            $msg['admin_user_phone'] = $admin_data[0]['phone'];
            $cny = $this->cny($data[0]['order_amount']);
            $msg['cny'] = $cny;
            echo json_encode(array('data' => $data, 'msg' => $msg));
        }
        //转交订单
        if($type=='resend'){
            $uid=  session("USER");
            $order=M("OrderInfo");
            $order->order_id=$send_id;
            $order->fw_id=$uid;
            $result=$order->save();
            if($result){
                echo json_encode(array('msg'=>'转交成功'));
            }else{
                echo json_encode(array('msg'=>'转交失败'));
            }
        }
        //确认退货
        if($type=='sure'){
            $order=M("OrderInfo");
            //去掉冻结积分
            $o_d=$order->where("order_id=$order_id")->find();
            $score=$o_d['score'];//积分比例
            $profit=$o_d['profit'];
            $dj_score=$profit*$this->getUser()/100;
            $uid=$o_d['user_id'];
            $dj=M("User")->where("id=$uid")->getField("dj_jf");//获取用户的冻结积分
            $dj_jf=$dj-$dj_score;
            $result=M("User")->where("id=$uid")->setField("dj_jf", $dj_jf);
            if(result){
            $order->order_id=$order_id;
            $order->order_status=5;//已退货
            $order->goods_count=0;//商品总量为0
            $order->order_amount=0;//订单总金额为0
            $order->cost_fee=0;//成本价为0
            $order->profit=0;//利润为0
            $result1=$order->save();
            if($result1){
                //改变订单详情
                $order_id = $_POST['order_id'];
                $order_item=M("OrderGoods");
                $item=$order_item->where("order_id=$order_id")->select();
                foreach($item as $k=>$v){
                    $rec_id=$v['rec_id'];
                    $order_item->rec_id=$rec_id;
                    $order_item->goods_number=0;
                    $order_item->save();
                    //退货加上商品库存
                    $id=$v['goods_attr_id'];//属性id
                    $num=$v['goods_number'];
                    $gid=$v['goods_id'];
                    $stock=M("GoodsAttr")->where("id=$id")->getField("goods_count");
                    $sj_stock=$stock+$num;//减掉库存
                    $s_d=M("GoodsAttr")->where("id=$id")->setField("goods_count", $sj_stock);
                    if($s_d){
                        /*库存日志开始*/
                        $kcdata['goods_attr_id'] = $id;
                        $kcdata['endnum'] = $sj_stock;
                        $kcdata['startnum'] = $stock;

                        $kcdata['up_id'] = $uid;
                        $kcdata['sp_id'] = $gid;
                        $kcdata['content'] = "订单返回";
                        $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
                        $kuncun = M('user_ghs_gn')->add($kcdata);
                        
                        /*库存日志结束*/
                    }
                    
                }
                echo json_encode(array('msg'=>'退货成功'));
            }else{
                echo json_encode(array('msg'=>'退货失败'));
            }
            }
        }
    }

    //打印订单
    public function cny($ns) {
        static $cnums = array("零", "壹", "贰", "叁", "肆", "伍", "陆", "柒", "捌", "玖"),
        $cnyunits = array("圆", "角", "分"),
        $grees = array("拾", "佰", "仟", "万", "拾", "佰", "仟", "亿");
        list($ns1, $ns2) = explode(".", $ns, 2);
        $ns2 = array_filter(array($ns2[1], $ns2[0]));
        $ret = array_merge($ns2, array(implode("", $this->_cny_map_unit(str_split($ns1), $grees)), ""));
        $ret = implode("", array_reverse($this->_cny_map_unit($ret, $cnyunits)));
        return str_replace(array_keys($cnums), $cnums, $ret);
    }

    public function _cny_map_unit($list, $units) {
        $ul = count($units);
        $xs = array();
        foreach (array_reverse($list) as $x) {
            $l = count($xs);
            if ($x != "0" || !($l % 4))
                $n = ($x == '0' ? '' : $x) . ($units[($l - 1) % $ul]);
            else
                $n = is_numeric($xs[0][0]) ? $x : '';
            array_unshift($xs, $n);
        }
        return $xs;
    }

    //分站管理员
    public function fzlist() {
        quanx("fz_order");
        $this->display();
    }

    public function fz_list() {
        quanx("fz_order");
        $type = $_GET['type']; //订单详情
        $user_id = session("USER");
        if ($type == 'item') {
            $order_id = $_GET['order_id'];
            $page = $_POST['page'] == null ? 1 : $_POST['page'];
            $limit = $_POST['rows'] == null ? 10 : $_POST['rows'];
            $order_id = $_GET['order_id'];
            $order = M('OrderGoods');
            $total = $order->where("order_id=$order_id")->count();
            $count = $total;
            if ($count > 0) {
                $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $data = $order->where("order_id=$order_id")->limit($start,$limit)->select();
            foreach($data as $k=>$v){
                $data[$k]['amount']=sprintf("%.2f",$v['market_price']*$v['goods_number']);
            }
            $ret = array();
            $ret['page'] = $page;
            $ret['rows'] = $data;
            $ret['total'] = $total_pages;
            $ret['records'] = $count;
            $ret['limit'] = $limit;
            echo json_encode($ret);
        } else {
            $page = empty($_POST['page']) ? 1 : $_POST['page'];
            $limit = empty($_POST['rows']) ? 10 : $_POST['rows'];
            //搜索条件
            //搜索条件
            $where = '1=1';
            $fillter = json_decode($_POST['filters'], true);
            if (!empty($fillter)) {
                $groupOp = $fillter['groupOp'];
                $rules = $fillter['rules'];
                foreach ($rules as $v) {
                    $dat = trim($v['data']);
                    if ($v['op'] == 'eq') {
                        if($dat!="''"){
                           $where .= " and oi.{$v['field']}='{$dat}'";
                        }
                    } else if ($v['op'] == 'bw') {
                        if($dat!="''"){
                           $where .= " and oi.{$v['field']} like '%{$dat}%'";
                        }
                    }
                }
            }
            $sidx=I("post.sidx");
            $sord=I("post.sord");
            $user = new \Think\Model();
            $sql = "select count(oi.order_id) as total from __PREFIX__order_info as oi inner join __PREFIX__user as u on  oi.user_id=u.id and u.user_up={$user_id} and $where order by $sidx $sord";
            $f_id = $user->query($sql);
            $count = $f_id[0]['total'];
            if ($count > 0) {
                $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $sql = "select oi.*  from __PREFIX__order_info as oi inner join __PREFIX__user as u on  oi.user_id=u.id and u.user_up={$user_id} and $where limit $start,$limit";
            $data = $user->query($sql);
            foreach ($data as $k => $v) {
                $uid=$v['user_id'];
                $user=M('User');
                $u_data=$user->where("id=$uid")->find();
                if($u_data){
                    $data[$k]['user_name']=$u_data['name'];
                    $data[$k]['user_email']=$u_data['email'];
                    $data[$k]['user_phone']=$u_data['phone'];
                    $data[$k]['user_addr']=$u_data['address'];
                    $data[$k]['user_jf']=$u_data['jf'];
                }
                if (empty($v['add_time'])) {
                    $data[$k]['add_time'] = '';
                } else {
                    $data[$k]['add_time'] = date('Y-m-d H:i:s', $v['add_time']);
                }
                if (empty($v['confirm_time'])) {
                    $data[$k]['confirm_time'] = '';
                } else {
                    $data[$k]['confirm_time'] = date('Y-m-d H:i:s', $v['confirm_time']);
                }
                if (empty($v['pay_time'])) {
                    $data[$k]['pay_time'] = '';
                } else {
                    $data[$k]['pay_time'] = date('Y-m-d H:i:s', $v['pay_time']);
                }
            }
            $ret = array();
            $ret['page'] = $page;
            $ret['rows'] = $data;
            $ret['total'] = $total_pages;
            $ret['records'] = $count;
            $ret['limit'] = $limit;
            echo json_encode($ret);
        }
    }

}

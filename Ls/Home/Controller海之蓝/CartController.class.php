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

class CartController extends PublicController {

    public function index() {
        $cart = M("Car");
        $uid = session("Q_USER");
        if (!$uid) {
            $this->redirect("/User/Qtdz/login");
        } else {
            $c_data = $cart->where("up_id=$uid")->order("id desc")->select();
            
            $provid_id = array();
            foreach ($c_data as $k => $v) {
                if (in_array($v['ghs_id'], $provid_id)) {
                    continue;
                } else {
                    array_push($provid_id, $v['ghs_id']);
                }
            }
            $shop_car = array();
            foreach ($provid_id as $key => $value) {

                $c_d = $this->getChildren($value, $uid);
                $shop = M("ShopConfig");
                $s_data = $shop->where("ghs_id=$value")->getField("shop_name"); //获取供货商姓名
                $shop_car[$s_data] = $c_d;
            }
            //dump($shop_car);exit();
            //$c_d1 = $this->getChildren(5, 11);
            //dump($c_d1);exit();
            $this->assign('cart', $shop_car);
            $c_num = $cart->where("up_id=$uid")->count();
            $this->assign('c_num', $c_num);
            //header("Content-type:text/html; charset=utf-8");
           //dump($shop_car);exit();
            //掌柜热卖
            if (!$provid_id) {
                
            } else {
                $pid = $provid_id[0];
                $goods = M("Goods");
                $gdata = $goods->where("user_id={$pid} and is_hot=1")->order("goods_id desc")->limit(0, 5)->select();
                foreach ($gdata as $k=>$v){
                    $gid=$v['goods_id'];
                    $price=$this->getGoodsPrice($gid);
                    $gdata[$k]['market_price']=$price;
                }
                $this->assign("gdata", $gdata);
            }
            //最近浏览过的
            $good_ids=$_SESSION [ 'history_id' ];
            //dump($_SESSION ['history_id']);exit();
            if(!$good_ids){
                
            }else{
            $gids=explode('-',$good_ids);
            $num=count($gids);$history=array();
            //dump($gids);exit();
           if($num>0){
               if($num>5){
                   $num=5;
               }
            for($i=0;$i<$num;$i++){
                $gid=$gids[$i];
                //dump($gid);
                $goods = M("Goods");
                $gdata = $goods->where(" goods_id=$gid")->find(); 
                $price=$this->getGoodsPrice($gid);
                $gdata['market_price']=$price;
                $history[$i]=$gdata;
            }
            $this->assign("history",$history);
           }
            }
            //猜你喜欢的
            $gid = $c_data[0]['sp_id'];
            if($gid){
            $link_good = M(LinkGoods);
            $link_data = $link_good->where("goods_id=$gid")->limit(0, 5)->select();
            //dump($link_data);exit();
            $link = array();
            foreach ($link_data as $k => $v) {
                $goods = M("Goods");
                $g_d = $goods->where("goods_id={$v['link_goods_id']}")->find();
                if(!$g_d){
                    continue;;
                }
                $price=$this->getGoodsPrice($v['link_goods_id']);
                $g_d['market_price']=$price;
                $link[$k] = $g_d;
            }
            $this->assign('link', $link);
            }
            $this->display();
        }
    }

    public function getChildren($id, $uid) {
        $cart = M('Car');
        $s_data = $cart->where("ghs_id=$id and up_id=$uid")->select();
        if (empty($s_data))
            return false;
        foreach ($s_data as $key => $value) {
            $gid = $value['sp_id']; //获取商品id
            $goods = M("Goods");
            $thumb = $goods->where("goods_id=$gid")->getField("goods_thumb");
            $name = $goods->where("goods_id=$gid")->getField("goods_name");
            $dir=  dirname($thumb);
            $b_name=  basename($thumb);
            $s_data[$key]['goods_thumb'] = $dir.'/c_'.$b_name;
            $s_data[$key]['goods_name'] = $name;
            $goods_attr_id=$value['goods_attr_id'];
            $goods_attr=M("GoodsAttr");
            $g_a=$goods_attr->where("id=$goods_attr_id")->find();
            $stock=$g_a['goods_count'];//库存
            $market_price=$g_a['market_price'];//售价
            $cart = M('Car');
            $cart->id=$value['id'];
            $cart->g_price=$market_price;
            $cart->save();
            $s_data[$key]['g_price'] = $market_price;
            /*$attr_id=explode('-',rtrim($g_a['attr_id'],'-'));
            $attr_value=explode('-',rtrim($g_a['attr_value'],'-'));
            $num=count($attr_id);$attr_name='';
            for($i=0;$i<$num;$i++){
                $attribute = M("GoodsAttribute");
                $a_n = $attribute->where("attr_id={$attr_id[$i]}")->getField("attr_name");
                $a_v=$attr_value[$i];
                $attr_name.=$a_n.':'.$a_v.';';
            }*/
            
            $s_data[$key]['attr_name'] = getAttrName($goods_attr_id);
            $s_data[$key]['stock'] = $stock;
            //$attr_list=$this->good_attr_list($gid);
            //$s_data[$key]['attr_list'] = $attr_list;//属性列表
           // $goods_gallery=M("GoodsGallery");
            //$g_g=$goods_gallery->field("img_url")->where("goods_id=$gid")->select();
            //$img=array();
            //foreach($g_g as $k=>$v){
            //    array_push($img,$v['img_url']);
           // }
            //$s_data[$key]['img_list'] = $img;//图集列表
        }
        return $s_data;
    }

    //加入收藏
    public function collect() {
        $gid = I("post.gid");
        $shop = M("CollectGoods");
        $uid = session("Q_USER");
        $s_d = $shop->where("user_id=$uid and goods_id=$gid")->find();
        if ($s_d) {
            $data['status'] = 2;
        } else {
            $shop->user_id = $uid;
            $shop->goods_id = $gid;
            $result = $shop->add();
            if ($result) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
        }
        echo json_encode($data);
    }

    //删除购物车
    public function delete() {
        $id = I("post.id");
        $cart = M("Car");
        $result = $cart->delete($id);
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    public function all_delete() {
        $cid = explode('-', I("post.id"));
        if (!$cid) {
            echo json_encode(array('status' => 2));
        } else {
            $num = count($cid);
            for ($i = 0; $i < $num; $i++) {
                $cart = M('Car');
                $cart->delete($cid[$i]);
            }
            echo json_encode(array('status' => 1));
        }
    }
    public function order(){
        $id=  explode(',',rtrim(I("get.id"),','));
        if(!$id){
            $this->redirect("Public/error1");
        }
        $num=count($id);$c_id='';

        for($i=0;$i<$num;$i++){
            $cart_num=explode('-',$id[$i]);
            $cid=$cart_num[0];//购物车id
            $cnum=$cart_num[1];//购物车数量
            $cart=M("Car");
            $gid=$cart->where("id=$cid")->getField("sp_id");
            $goods_attr_id=$cart->where("id=$cid")->getField("goods_attr_id");
            $goods=M("GoodsAttr");
            $price=$goods->where("goods_id=$gid and attr_id=$goods_attr_id")->getField("market_price");
            $cart->id=$cid;
            $cart->num=$cnum;
            $cart->g_price=$price;
            $cart->c_time=time();
            $cart->save();
            $c_id.=$cid.'-';
        }
        $c_id=  rtrim($c_id,'-');
        //dump($c_id);exit();
        $this->redirect("Order/index",array('cid'=>$c_id));
    }

}

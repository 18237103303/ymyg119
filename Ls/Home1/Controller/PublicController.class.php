<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Home\Controller;

use Think\Controller;

class PublicController extends Controller {

    function __construct() {
        parent::__construct();
        //友情链接模块
        $link = M("FriendLink");
        $data = $link->order("sort desc")->select();
        $link_text=array();$link_pic=array();
        foreach ($data as $k => $v) {
            if (!$v['link_name']) {
                //unset($data[$k]);
                //exit(123);
                $link_pic[$k]['link_pic']=$v['link_pic'];
                $link_pic[$k]['link_url']=$v['link_url'];
            }else{
                $link_text[$k]['link_name']=$v['link_name'];
                $link_text[$k]['link_url']=$v['link_url'];
            }
            if (!$v['link_pic']) {
                $link_text[$k]['link_name']=$v['link_name'];
                $link_text[$k]['link_url']=$v['link_url'];
            }else{
                $link_pic[$k]['link_pic']=$v['link_pic'];
                $link_pic[$k]['link_url']=$v['link_url'];
            }
            
        }
        $this->assign('link_text', $link_text);//文字链接
        $this->assign('link_pic', $link_pic);//图片链接
        
        //公共尾文章遍历
        $article = M("Arctype");
        $a_data = $article->where("pid=0")->order("sort desc")->select();
        $arr = array();
        foreach ($a_data as $k => $v) {
            $ret = $this->get_Children($v['type_id']);
            if (!$ret)
                $ret = '';
            $name = $v['type_name'];
            $arr[$name] = $ret;
        }
        //header("Content-type:text/html; charset=utf-8");
        
        $this->assign('arr', $arr);
        //主页分类查询
        $cate = M('category')->where("path=0 and ctype=0")->order('cat_id asc')->select(); //一级分类
        foreach ($cate as $k => $v) {//查询二级分类
            $id = $v['cat_id'];
            $cate[$k]['children'] = M('category')->where("pid='$id' and ctype=0")->select();
            foreach ($cate[$k]['children'] as $i => $j) { //三级分类
                $cid = $j['cat_id'];
                $cate[$k]['children'][$i]['children'] = M('category')->where("pid='$cid' and ctype=0")->select();
            }
        }
        $this->assign('cate', $cate);
        //主页导航查询
        $nav = M('goods_group')->order("id asc")->select();
        $this->assign('nav', $nav);
        //购物车数量
        $uid=  session("Q_USER");
        if(!$uid){
            $count=0;
        }else{
            $count=M("Car")->where("up_id=$uid")->count();
            if(!$count){
                $count=0;
            }
        }
        $this->assign("car_count",$count);
        //用户图像
        if($uid){
        $pic=M("user")->where("id=$uid")->getField("pic");
        if(!$pic){
            $pic_index="/public/home/assets/images/index_03_03.png";
            $pic="/public/home/assets/images/index_03_03.png";
        }else{
        $dir=  dirname($pic);
        $name=  basename($pic);
        $pic_index=$dir.'/'.$name;
        }
        }else{
            $pic_index="/public/home/assets/images/index_03_03.png";
        }
        $this->assign("index_pic",$pic_index);
        $this->assign("u_pic",$pic);
    }

    public function get_Children($id) {
        $art_cate = M('Arctype');
        $cateData = $art_cate->where("pid=$id")->select();
        if (empty($cateData))
            return false;
        $ret = array();
        foreach ($cateData as $k => $v) {
            //array_push($ret,$v['type_name']);
            $key = $v['type_id'];
            $ret[$key] = $v['type_name'];
        }
        return $ret;
    }

    public function _empty() {
        $this->redirect('Public/error1');
    }

    public function error1() {
        $this->display();
    }

    //获取会员比例
    public function getUser() {
        $config = M("SysConfig");
        $user = $config->where("config_name='MONERY_JF'")->getField("config_value");
        return $user;
    }
    //获取服务网点的佣金比例
    public function getUserWeb(){
        $config=M("SysConfig");
        $user=$config->where("config_name='MONERY_YJ_W'")->getField("config_value");
        return $user;
    }
	//获取转送服务网点的佣金比例
    public function getUserWeb1(){
        $config=M("SysConfig");
        $user=$config->where("config_name='MONERY_YJ_W1'")->getField("config_value");
        return $user;
    }
    //获取积分支付比例
    public function getScore(){
        $config=M("SysConfig");
        $user=$config->where("config_name='MONERY_JF_ZF'")->getField("config_value");
        return $user;
    }
    //购物车中商品属性联动
    public function good_attr_list($id) {
        //dump($id);
        $goods_attr = M("GoodsAttr");
        $g_attr = $goods_attr->where("goods_id=$id")->select();
        $attr_id = explode('-', rtrim($g_attr[0]['attr_id'],'-'));
        //$attr_value=explode('-',$g_attr['attr_value']);
        $num = count($attr_id);
        $attr = array();
        $value = array();
        foreach ($g_attr as $k => $v) {
            //dump($v['attr_value']);
            $attr_value = explode('-', rtrim($v['attr_value'],'-'));
            //dump($attr_value);
            for ($j = 0; $j < $num; $j++) {
                array_push($value[$j], $attr_value[$j]);
            }
        }
        //dump($value);exit();
        for ($i = 0; $i < $num; $i++) {
            $attribute = M("GoodsAttribute");
            $a_n = $attribute->where("attr_id={$attr_id[$i]}")->getField("attr_name");
            $attr[$a_n] = $value[$i];
        }

        return $attr;
    }
    //获取商品的价格---根据商品属性的id判断
    public function getGoodsPrice($id){
        $goods_attr=M("GoodsAttr");
        $price=$goods_attr->where("goods_id=$id")->getField("market_price");
        if(!$price){
            $price=0.00;
        }
        return $price;
    }

}

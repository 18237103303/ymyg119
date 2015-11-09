<?php

// +----------------------------------------------------------------------
// |[ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) All rights reserved.
// +----------------------------------------------------------------------
// | Author: wangdan <962684871@qq.com>
// +----------------------------------------------------------------------

namespace Home\Controller;

use Think\Controller;

class IndexController extends PublicController {

    public function index() {
        if(empty($_SESSION['FZ'])){
             $fz=58;
        }else{
            $fz=$_SESSION['FZ'];
            }
            //dump($fz);exit();
        /* 杨浩清写的模块 开始 */
        //主页大图广告信息
        $ads1 = M('ads')->where("position_id=1 and admin_id='$fz'")->select();
        $this->assign('ads1', $ads1);
        //主页用户信息下广告
        $ads2 = M('ads')->where("position_id=2 and admin_id='$fz'")->find();
        $this->assign('ads2', $ads2);
        //主页中部广告
        $ads3 = M('ads')->where("position_id=3 and admin_id='$fz'")->find();
        $this->assign('ads3', $ads3);
        //主页底部广告
        $ads4 = M('ads')->where("position_id=4 and admin_id='$fz'")->find();
        $this->assign('ads4', $ads4);
        //品牌左侧广告
        $ads6 = M('ads')->where("position_id=6 and admin_id='$fz'")->find();
        $this->assign('ads6', $ads6);
        //品牌右侧广告
        $ads7 = M('ads')->where("position_id=7 and admin_id='$fz'")->find();
        $this->assign('ads7', $ads7);
        
        //主页新增商品查询详情
        //左侧大图商品
        $newgoods = M('goods')->join('lx_goods_attr ON lx_goods.goods_id=lx_goods_attr.goods_id', 'left')->where("lx_goods.is_alone_sale=1 and lx_goods.fz_id='$fz'")->limit(0, 8)->order('sort desc')
                ->field('lx_goods.goods_id,goods_name,goods_thumb,lx_goods_attr.goods_count,market_price,shop_price')->group("lx_goods.goods_id")->select();
        //dump($newgoods);exit();
        $this->assign('newgoods', $newgoods);
        //主页品牌的查询
        $brand0 = M('brand')->where("fz_id='$fz'")->limit(0, 24)->order('sort asc')->select();
        $this->assign('brand', $brand0);
        $brand1 = M('brand')->where("fz_id='$fz'")->limit(24, 48)->order('sort asc')->select();
        if(empty($brand1)){
            $brand1=$brand0;
        }
        $this->assign('brand1', $brand1);
        $brand2 = M('brand')->where("fz_id='$fz'")->limit(48, 72)->order('sort asc')->select();
        if(empty($brand2)){
            $brand2=$brand0;
        }
        $this->assign('brand2', $brand2);
        /* 杨浩清写的模块 结束 */

        //王丹写的首页楼层展示开始
        /* $uid=SESSION[];每个分站未做判断 */
        $g_group = M('goods_group')->field("id,navtype")->select();
        $float_numb = array();
        foreach ($g_group as $keys => $values) {
            foreach ($values as $k => $v) {
                if ($k == 'id') {
                    $group_id = $v;
                } else {
                    $group_title = $v;
                }
            }
            //楼层品牌查找
            $g_brand = M('brand')->where("group_id='$group_id' and fz_id='$fz'")->field("brand_id,brand_name,brand_logo,site_url")->order("sort desc")->limit(10)->select();
            $brand_ids = array();
            //楼层商品
            $g_brands = M('brand')->where("group_id='$group_id' and fz_id='$fz'")->field("brand_id,brand_name,brand_logo,site_url")->order("sort desc")->select();
            foreach ($g_brands as $ks => $vs) {
                foreach ($vs as $kes => $ves) {
                    if ($kes == "brand_id") {
                        $brand_id = $ves;
                    }
                }
                array_push($brand_ids, $brand_id);
            }
            $brand['brand_id'] = array('in', $brand_ids);
            if($brand_ids){
               // $this->redirect("Public/error1");
            //dump($brand);exit();
            $ghs_ids = M('goods')->where("is_best ='1' AND is_on_sale='1' and fz_id='$fz'")->where($brand)->order("sort desc")->field("lx_goods.goods_id,goods_name,goods_thumb")->limit(8)->select();
            foreach($ghs_ids as $k=>$v){
                $price=$this->getGoodsPrice($v['goods_id']);
                $ghs_ids[$k]['market_price']=$price;
            }
			
            //楼层商品结束
            //查找热销
            $rxs = M("order_goods")->join('lx_goods ON lx_order_goods.goods_id = lx_goods.goods_id')->where($brand)->
                            join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->where("lx_order_info.order_status = 6 and lx_goods.fz_id='$fz'")->
                            field('lx_order_goods.goods_id,lx_goods.goods_name,sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')
                            ->order('number desc')->limit(10)->select();
            //查找人气
            $rqs = M("collect_goods")->join('lx_goods ON lx_collect_goods.goods_id = lx_goods.goods_id')->where($brand)->
                    field('lx_collect_goods.goods_id,goods_name,count(col_goodsid) as count')->where("lx_goods.fz_id='$fz'")->group('lx_collect_goods.goods_id')
                    ->select();
			}else{
				$ghs_ids =array();
			}
            //综合输出
            $float_nm = array("group_id" => $group_id, "group_title" => $group_title, "brand" => $g_brand, "goods_zs" => $ghs_ids, "goods_rx" => $rxs, "goods_rq" => $rqs);
            array_push($float_numb, $float_nm);
        }
        $this->assign('floor_goods', $float_numb);
        //王丹写的首页楼层展示结束
        
        $uid=  session("Q_USER");
        //判断首页用户订单情况
        if($uid){
            $order_1=M("OrderInfo")->where("order_status=0 and pay_status=0 and user_id=$uid")->count();
            $order_2=M("OrderInfo")->where("order_status in(1,2) and pay_status=1 and user_id=$uid")->count();
            $order_3=M("OrderInfo")->where("order_status=6 and pay_status=1 and user_id=$uid and is_comment=0")->count();
        }else{
            $order_1=0;
            $order_2=0;
            $order_3=0;
        }
        $this->assign('order_1',$order_1);
        $this->assign('order_2',$order_2);
        $this->assign('order_3',$order_3);
        
        $this->display();
    }
	//广告点击数加1
    public function addclick(){
        $id=$_POST['id'];
        $result=M('ads');
        $result->where("id='$id'")->setInc('click'); 
    }

}

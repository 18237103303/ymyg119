<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class CateController extends PublicController {
    public function index(){
        if(empty($_SESSION['FZ'])){
            $fz=58;
         }else{
            $fz=$_SESSION['FZ'];
         }
    	$pid=$_GET['pid'];
    	cookie('pid', "$pid", 36000);
    	$pid=cookie('pid');
    	$cname=M('category')->where("cat_id='$pid'")->find();
    	$this->assign('cname',$cname);
    	$cate=M('category')->where("pid='$pid'")->select();
    	$this->assign('cate',$cate);
    	$cate1=M('category')->where("pid='$pid'")->order("sort desc")->limit(0,20)->select();
    	$this->assign('cate1',$cate1);
    	$cate2=M('category')->where("pid='$pid'")->order("sort desc")->limit(20,20)->select();
    	$this->assign('cate2',$cate2);
        
    	$good=array();
    	foreach ($cate as $k => $v) {
    		$cid=$v['cat_id'];
    	   array_push($good,$cid);
    	}
            
        $arr=array();
        if(!$good){
            $this->redirect("Public/error1");
        }
        //页面头部广告
        $ads=M('ads')->where("position_id=15 and admin_id='$fz'")->limit(1)->select();
        $this->assign('ads',$ads);
		$good1=array();
        $cats['pid']=array('in',$good);
        $cat=M('category')->where($cats)->select();
        foreach ($cat as $k => $v) {
            $cid=$v['cat_id'];
            // array_push($good1,$cid);
            $good1[]=$cid;
        }
		if(!$good1){
            $this->redirect("Public/error1");
        }
        $result=M('goods');
    	$catid['cat_id']=array('in',$good1);
        $catid['fz_id']=$fz;
        $page=I('page')? :1;
        $count=$result->where($catid)->count();
        $rpage = Page($count, 20, $page);
        $rpage1 = $rpage['page_l'];
        $rpage2 = $rpage['page_r'];
    	$goods=$result->where($catid)->field("goods_id,goods_name,goods_thumb")->limit($rpage1,$rpage2)->select();
        $bl = $this->getUser();
    	foreach ($goods as $k => $v) {
    		        $gid=$v['goods_id'];
    		        //查询商品的价格
                    $result2 = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                    $v['goods_count'] = $result2[0]['goods_count'];
                    $v['market_price'] = $result2[0]['market_price'];
                    $v['shop_price'] = $result2[0]['shop_price'];
                    $jf=($result2[0]['market_price'] - $result2[0]['shop_price'])*$bl/100;
                    $v['jf']=$jf;
                    //查询销量
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');

                    $v['count'] = $result1;

                    //查询商品所对应的供货商铺
                    $uid = $v['user_id'];
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $v['shopname'] = $shopname['shop_name'];
                    $v['qq'] = $shopname['qq'];
                    $v['shop_id']=$shopname['shop_id'];
                    $arr[] = $v;

    	}
            //按人气查询
                 if ($_GET['action'] == 1) {

                $result = M("goods")->join('lx_collect_goods ON lx_goods.goods_id = lx_collect_goods.goods_id', 'left')->where($catid)->
                                field('lx_goods.goods_id,goods_name,lx_collect_goods.user_id,count(col_goodsid) as count')->group('lx_goods.goods_id')->order("count desc")->limit($rpage1,$rpage2)->select();
                $arr = array();
                $bl = $this->getUser();
                foreach ($result as $k => $v) {
                    $gid = $v['goods_id'];
                    $goods = M('goods')->where("goods_id='$gid'")->find();
                    $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                    $v['market_price'] = $price[0]['market_price'];
                    $v['jf']=($price[0]['market_price'] - $price[0]['shop_price'])*$bl/100;
                    $v['goods_thumb'] = $goods['goods_thumb'];
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
                    $v['count'] = $result1;
                    $uid = $goods['user_id'];
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $v['shopname'] = $shopname['shop_name'];
                    $v['qq'] = $shopname['qq'];
                    $v['shop_id']=$shopname['shop_id'];
                    $arr[] = $v;
                }
                //按销量查询
            }else if($_GET['action']==2){

                $goods = M('goods')->where($catid)->limit($rpage1,$rpage2)->select();
                $arr1 = array();
                foreach ($goods as $k => $v) {
                    $gid = $v['goods_id'];
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
                    $arr1[$gid] = $result1;
                }
                arsort($arr1);
                $arr = array();
                $bl = $this->getUser();
                foreach ($arr1 as $k => $v) {
                    $gid = $k;
                    $goods = M('goods')->where("goods_id='$gid'")->find();
                    $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                    $goods['market_price'] = $price[0]['market_price'];
                    $goods['jf']=($price[0]['market_price'] - $price[0]['shop_price'])*$bl/100;
                    $uid = $goods['user_id'];
                    $goods['count'] = $v;
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $goods['shopname'] = $shopname['shop_name'];
                    $goods['qq'] = $shopname['qq'];
                    $goods['shop_id']=$shopname['shop_id'];
                    $arr[] = $goods;
                }

                //按价格排列


            }else if($_GET['action']==3){
                $bl = $this->getUser();
                 $result = M('goods')->where($catid)->join('lx_goods_attr ON lx_goods.goods_id=lx_goods_attr.goods_id')->
                               field('lx_goods.goods_id,goods_name,goods_thumb,goods_count,user_id,admin_id,lx_goods_attr.market_price,shop_price')->order('lx_goods_attr.market_price desc')->group('lx_goods.goods_id')->limit($rpage1,$rpage2)->select();           
                $arr = array();
                foreach ($result as $k => $v) {
                    $gid = $v['goods_id'];
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
                    $v['count'] = $result1;
                    //查询商品所对应的供货商铺
                    $uid = $v['user_id'];
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $v['shopname'] = $shopname['shop_name'];
                    $v['qq'] = $shopname['qq'];
                    $v['shop_id']=$shopname['shop_id'];
                    $v['jf']=($v['market_price'] - $v['shop_price'])*$bl/100;
                    $arr[] = $v;
                }

            }

            if(empty($arr)){
                $this->redirect('Public/error1');
            }
            $this->assign('page', $rpage['page']);
            
            $this->assign('goods',$arr);
           $this->assign("gcount",$count);

        $this->display();
    }
}


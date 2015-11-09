<?php
namespace Home\Controller;
use Think\Controller;
class NavgoodsController extends PublicController {

//导航跳转页面
	public function navgoods(){
        if(empty($_SESSION['FZ'])){
             $fz=3;
        }else{
            $fz=$_SESSION['FZ'];
            }
	$nid=$_GET['id'];
        $navname=M('goods_group')->where("id='$nid'")->find();
        $this->assign('navname',$navname);
		//分类查询
		$cate = M('category')->where("group_id='$nid'")->select(); //一级分类
        foreach ($cate as $k => $v) {//查询二级分类
            $id = $v['cat_id'];
            $cate[$k]['children'] = M('category')->where("pid='$id'")->select();
            foreach ($cate[$k]['children'] as $i => $j) { //三级分类
                $cid = $j['cat_id'];
                $cate[$k]['children'][$i]['children'] = M('category')->where("pid='$cid'")->select();
            }
        }
        $this->assign('cate', $cate);
        //导航跳转页面的广告查询
        //1.导航页面大图广告11
        $ads1=M('ads')->where("position_id=11 and nav_id='$nid' and admin_id='$fz'")->select();
        $this->assign('ads1',$ads1);
       
        //2.导航页面品牌两侧小图广告12
        $ads2=M('ads')->where("position_id=12 and nav_id='$nid' and admin_id='$fz'")->limit(2)->select();
        $this->assign('ads2',$ads2);

        //3.导航页面中的楼层广告13
        $ads3=M('ads')->where("position_id=13 and nav_id='$nid' and admin_id='$fz' ")->limit(4)->field("id,ad_code,ad_link,name")->order('sort desc')->select();

         //该导航页面相关品牌的查询
        $brand1 = M('brand')->where("group_id='$nid'")->field("brand_id,brand_name,brand_logo,site_url")->order("sort desc")->limit(0,5)->select();
        $this->assign('brand1',$brand1);
        $brand2 = M('brand')->where("group_id='$nid'")->field("brand_id,brand_name,brand_logo,site_url")->order("sort desc")->limit(5,10)->select();
        $this->assign('brand2',$brand2);
        $brand3 = M('brand')->where("group_id='$nid'")->field("brand_id,brand_name,brand_logo,site_url")->order("sort desc")->limit(10,15)->select();
        $this->assign('brand3',$brand3);

        //该导航页面的新品展示
        $g_brand=M('brand')->where("group_id='$nid'")->field("brand_id")->select();
        $brand_ids = array();
        foreach ($g_brand as $k => $v) {
            foreach ($v as $kes => $ves) {
                    
                        $brand_id = $ves;
                    
                }
           array_push($brand_ids, $brand_id);
        }
        $brand['brand_id'] = array('in', $brand_ids);
        $newgoods1=M('goods')->where("is_alone_sale = 1")->where($brand)->order('sort desc')->field("lx_goods.goods_id,goods_name,goods_thumb")->limit(1)->select();
        $newgoods=M('goods')->where("is_alone_sale = 1")->where($brand)->order('sort desc')->field("lx_goods.goods_id,goods_name,goods_thumb")->limit(1,5)->select();

        $this->assign('newgoods1',$newgoods1);
        $this->assign('newgoods',$newgoods);

        //导航页面楼层展示
        $cate = M('category')->where("group_id='$nid'")->field("cat_id")->select(); //一级分类
        $catid=array();
        foreach ($cate as $k => $v) {
            foreach ($v as $kes => $ves) {
                        $cat_id=$ves;
            }
            array_push($catid, $cat_id);
        }
        $parent['parent_id']=array('in',$catid);

        $arr=array();
        $cate1=M('category')->where($parent)->order('sort desc')->limit(4)->select();//二级分类
          foreach ($cate1 as $k => $v) {
            $id=$v['cat_id'];
            $cname=$v['cat_name'];
            $arr[$cname]['pid']=$id;
            $arr[$cname]['cat']=M('category')->where("pid='$id'")->field("cat_id,cat_name")->select();
            $arr[$cname]['ads']=$ads3[$k];
        //查询该分类下存在的商品
            $pinp=array();$pp=0;$good=array();
             foreach ($arr[$cname]['cat'] as $i => $j) {
                 $cid=$j['cat_id'];
                 $ccc=M('goods')->where("cat_id='$cid'")->field("goods_id,goods_name,brand_id,goods_thumb")->select(); 
                // var_dump($ccc);
                 // $arr[$cname][$i]['goods']=$ccc;
                 foreach ($ccc as $k1 => $v1) {
                 $pinp[$pp]=$v1['brand_id'];             
                 $pp++;   
                 $good[]=$v1['goods_id']?:'';                 
              }                                  
             }
            
             $pinp1=array_unique($pinp);$pinp2=array();$pp1=0;              
              foreach ($pinp1 as $y => $e) {
                         $pinp2[$pp1]=M('brand')->where("brand_id=$e")->find();
                          $pp1++;
                  }              
                $num= count($pinp2);
                if($num>0){                  
                    $jjj=0;$iii=0;$fy=array();
                    for($w=0;$w<$num;$w++){
                        if($iii>3){
                        $iii=0;  
                        $jjj++;                     
                        }
                       $fy[$jjj][$iii]= $pinp2[$w];
                        $iii++;                     
                    }
                }
                $arr[$cname]['pp']=$fy;
                unset($fy);
        //查找商品
                  $good2=array();$pp2=0;

              foreach ($good as $k => $v) {
                if($pp2<6){
                $good2[$pp2]=M('goods')->join('lx_goods_attr ON lx_goods.goods_id=lx_goods_attr.goods_id', 'left')->where("lx_goods.goods_id='$v'")->field('lx_goods.goods_id,goods_name,goods_thumb,lx_goods_attr.market_price')->find();
                $pp2++;
                        }
              }
               $arr[$cname]['good']=$good2;
               unset($good2);

           
           }
       if(empty($arr)){
            $this->redirect('Public/error1');
            }
        $this->assign('cate1',$arr);
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

}
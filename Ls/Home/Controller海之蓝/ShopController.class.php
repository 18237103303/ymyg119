<?php

namespace Home\Controller;

use Think\Controller;

class ShopController extends PublicController {

    public function shop() {
        if ($_GET['shop_id']) {
            $shop_id = $_GET['shop_id'];
            //查找店铺导航相关信息
            $category = M('category')->where("admin_id='$shop_id'")->field("cat_name,cat_id")->order("sort desc")->select();
            if (empty($category)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('navs', $category);
            $this->assign('shop_id', $shop_id);
            $num = count($category);
            $this->assign('num', $num);
            /*             * 店铺logo开始* */
            $shop_logo = M('shop_config')->where("ghs_id='$shop_id'")->getField('shop_logo');
            $this->assign('shop_logo', $shop_logo);
            /*             * 店铺logo结束* */
            //店铺主页大图广告
            $ads1 = M('ads')->where("position_id=8 and admin_id='$shop_id'")->select();
            $this->assign('ads1', $ads1);
            //店铺主页轮播大图下的图片广告
            $ads2 = M('ads')->where("position_id=9 and admin_id='$shop_id'")->order('sort desc')->limit(1)->select();
            $this->assign('ads2', $ads2);
            //店铺楼层广告图片
            $ads3 = M('ads')->where("position_id=14 and admin_id='$shop_id'")->order('sort desc')->limit($num)->field("id")->select();
            $this->assign('ads3', $ads3);
            //dump($ads3);
            //该页面广告到此结束
            if (empty($category)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('navs', $category);
            //根据不同的导航查找导航展示的商品
            //var_dump($category);
            $new_goods = array();
            foreach ($category as $kve => $va) {
                $type_id = $va['cat_id'];
                //echo $type_id;
                $newgoo = M('goods')->where("cat_id='$type_id' AND user_id='$shop_id' AND is_on_sale = '1'")->order("sort desc")->limit(8)
                                ->field('goods_id,goods_thumb,goods_name')->select();
                //将楼层广告遍历到数组中

                foreach ($newgoo as $kss => $vss) {
                    $gids = $vss['goods_id'];
                    $prices = $this->getGoodsPrice($gids);
                    $newgoo[$kss]['market_price'] = $prices;
                }

                $id = $ads3[$kve]['id'];
                $ad = M('ads')->where("id='$id'")->select();
                $newads = array('newads' => $ad);
                $newgood = array('newgoods' => $newgoo);
                //var_dump($newgood); echo "<br/>";
                array_push($new_goods, $newads,$newgood);
            }

            if (empty($new_goods)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('new', $new_goods);
            //查找四个热卖商品
            $shop_goods = M('goods')->where("user_id = '$shop_id' AND is_on_sale = '1' AND is_hot = '1'")->field('goods_id,goods_name,goods_thumb')->order('sort desc')->limit('4')->select();
            foreach ($shop_goods as $ks => $vs) {
                $gid = $vs['goods_id'];
                $price = $this->getGoodsPrice($gid);
                $shop_goods[$ks]['market_price'] = $price;
            }
            if (empty($shop_goods)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('sale', $shop_goods);
        } else {
            //跳转到错误页面
            $this->redirect('Public/error1', array());
        }
        $this->display();
    }

    public function shop_list() {
        if ($_GET['id']) {
            $id = $_GET['id'];
            //查找供货商id
            $admin_id = M('category')->where("cat_id='$id'")->getField("admin_id");
            if (empty($admin_id)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('shop_id', $admin_id);
            $this->assign('cat_id', $id);
            $category = M('category')->where("admin_id='$admin_id'")->field("cat_name,cat_id")->order("sort desc")->select();
            if (empty($category)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('navs', $category);
            /*             * 店铺logo开始* */
            $shop_logo = M('shop_config')->where("ghs_id='$admin_id'")->getField('shop_logo');
            $this->assign('shop_logo', $shop_logo);
            /*             * 店铺logo结束* */
            //查找商品
              //查找商品 
            $shop_goo = M('goods')->where("user_id = '$admin_id' AND is_on_sale = '1' AND cat_id = '$id'")->field('goods_id,goods_name,goods_thumb')->order('sort desc')->select();
            //商品分页
			$coun = count($shop_goo);
			$page = I('page')? : 1;
			$rpage = Page($coun, 20, $page);
			$rpage1 = $rpage['page_l'];
			$rpage2 = $rpage['page_r'];
			$this->assign('page', $rpage['page']);
			$shop_goods = M('goods')->where("user_id = '$admin_id' AND is_on_sale = '1' AND cat_id = '$id'")->field('goods_id,goods_name,goods_thumb')->order('sort desc')->limit($rpage1,$rpage2)->select();
			//商品分页
            $bl = $this->getUser();
            foreach ($shop_goods as $key => $value) {
                //var_dump($value);
                $gid = $value['goods_id'];
                //销量
                $xl = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->where('order_status = 6')->where("goods_id='$gid'")->
                                field('sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')->select();
                $shop_goods[$key][xl] = $xl[0]['number'];
                //价格
                $jg = M('goods_attr')->where("goods_id='$gid'")->field('market_price,shop_price')->limit(1)->select();
                $shop_goods[$key][jg] = $jg[0]['market_price'];
                //积分
                $jf = ($jg[0]['market_price'] - $jg[0]['shop_price']) * $bl / 100;
                if ($jf < 0) {
                    $jf = 0;
                }
                $shop_goods[$key][jf] = $jf;
            }
            $this->assign('shop_goods', $shop_goods);
        } else {
            //跳转到错误页面
            $this->redirect('Public/error1', array());
        }
        $this->display();
    }

    public function shop_listr() {
        if ($_GET['id']) {
            $id = $_GET['id'];
            //查找供货商id
            $admin_id = M('category')->where("cat_id='$id'")->getField("admin_id");
            if (empty($admin_id)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('shop_id', $admin_id);
            $this->assign('cat_id', $id);
            $category = M('category')->where("admin_id='$admin_id'")->field("cat_name,cat_id")->order("sort desc")->select();
            if (empty($category)) {
                $this->redirect('Public/error1', array());
            }
            $this->assign('navs', $category);
            /*             * 店铺logo开始* */
            $shop_logo = M('shop_config')->where("ghs_id='$admin_id'")->getField('shop_logo');
            $this->assign('shop_logo', $shop_logo);
            /*             * 店铺logo结束* */
            //查找人气商品
            $shop_goo = M('goods')->join('lx_collect_goods ON lx_goods.goods_id = lx_collect_goods.goods_id')
                    ->where("lx_goods.user_id = '$admin_id' AND is_on_sale = '1' AND cat_id = '$id'")->count();
			 //商品分页
			$coun = $shop_goo;
			$page = I('page')? : 1;
			$rpage = Page($coun, 20, $page);
			$rpage1 = $rpage['page_l'];
			$rpage2 = $rpage['page_r'];
			$this->assign('page', $rpage['page']);
			$shop_goods = M('goods')->join('lx_collect_goods ON lx_goods.goods_id = lx_collect_goods.goods_id')
                            ->where("lx_goods.user_id = '$admin_id' AND is_on_sale = '1' AND cat_id = '$id'")->
                            field('lx_goods.goods_id,goods_name,goods_name,goods_thumb,count(col_goodsid) as count')
							->group('lx_goods.goods_id')->limit($rpage1,$rpage2)->order("count desc")->select();
            $bl = $this->getUser();
            foreach ($shop_goods as $key => $value) {
                $gid = $value['goods_id'];
                //销量
                $xl = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->where('order_status = 6')->where("goods_id='$gid'")->
                                field('sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')->select();
                $shop_goods[$key][xl] = $xl[0]['number'];
                //价格
                $jg = M('goods_attr')->where("goods_id='$gid'")->field('market_price,shop_price')->limit(1)->select();
                $shop_goods[$key][jg] = $jg[0]['market_price'];
                //积分
                $jf = ($jg[0]['market_price'] - $jg[0]['shop_price']) * $bl / 100;
                if ($jf < 0) {
                    $jf = 0;
                }
                $shop_goods[$key][jf] = $jf;
            }
            $this->assign('shop_goods', $shop_goods);
        } else {
            //跳转到错误页面
            $this->redirect('Public/error1');
        }
        $this->display();
    }

    public function shop_listx() {
        if ($_GET['id']) {
            $id = $_GET['id'];
            //查找供货商id
            $admin_id = M('category')->where("cat_id='$id'")->getField("admin_id");
            if (empty($admin_id)) {
                $this->redirect('Public/error1');
            }
            $this->assign('shop_id', $admin_id);
            $this->assign('cat_id', $id);
            $category = M('category')->where("admin_id='$admin_id'")->field("cat_name,cat_id")->order("sort desc")->select();
            if (empty($category)) {
                $this->redirect('Public/error1');
            }
            $this->assign('navs', $category);
            /*             * 店铺logo开始* */
            $shop_logo = M('shop_config')->where("ghs_id='$admin_id'")->getField('shop_logo');
            $this->assign('shop_logo', $shop_logo);
            /*             * 店铺logo结束* */
            //查找销量商品
           $shop_goods =  M('goods')->where("lx_goods.user_id = '$admin_id' AND lx_goods.is_on_sale = '1' AND lx_goods.cat_id = '$id'")->field("goods_id,goods_name,goods_thumb")->select();		
			$arr1 = array();
			foreach($shop_goods as $ke =>$va){
				$ggid=$va['goods_id']; 
				$result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                where("lx_order_goods.goods_id='$ggid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
				$arr1[$ke] ['xl']= $result1;
				$arr1[$ke] ['goods_id']= $ggid;
				$arr1[$ke] ['goods_name']= $va['goods_neme'];
				$arr1[$ke] ['goods_thumb']= $va['goods_thumb'];
			}
			arsort($arr1);
            $bl = $this->getUser();
            foreach ($arr1 as $ke => $va) {
                $gid = $va['goods_id'];
                //价格
                $jg = M('goods_attr')->where("goods_id='$gid'")->field('market_price,shop_price')->limit(1)->select();
                $arr1[$ke][jg] = $jg[0]['market_price'];
                //积分
                $jf = ($jg[0]['market_price'] - $jg[0]['shop_price']) * $bl / 100;
                if ($jf < 0) {
                    $jf = 0;
                }
                $arr1[$ke][jf] = $jf;
            }
            $this->assign('shop_goods', $arr1);
        } else {
            //跳转到错误页面
            $this->redirect('Public/error1');
        }
        $this->display();
    }

    public function shop_listj() {
        if ($_GET['id']) {
            $id = $_GET['id'];

            //查找供货商id
            $admin_id = M('category')->where("cat_id='$id'")->getField("admin_id");
            if (empty($admin_id)) {
                $this->redirect('Public/error1');
            }
            $this->assign('shop_id', $admin_id);
            $this->assign('cat_id', $id);
            $category = M('category')->where("admin_id='$admin_id'")->field("cat_name,cat_id")->order("sort desc")->select();
            if (empty($category)) {
                $this->redirect('Public/error1');
            }
            $this->assign('navs', $category);
            /*             * 店铺logo开始* */
            $shop_logo = M('shop_config')->where("ghs_id='$admin_id'")->getField('shop_logo');
            $this->assign('shop_logo', $shop_logo);
            /*             * 店铺logo结束* */
            //按价格查找商品
          //分页
			 $shop_goo = M('goods')->where("user_id = '$admin_id' AND is_on_sale = '1' AND cat_id = '$id'")->count();
			 //商品分页
			$coun =$shop_goo;
			$page = I('page')? : 1;
			$rpage = Page($coun, 20, $page);
			$rpage1 = $rpage['page_l'];
			$rpage2 = $rpage['page_r'];
			$this->assign('page', $rpage['page']);
			//分页
            if ($_GET['lx']) {				
                $shop_goods = M('goods')->where("user_id = '$admin_id' AND is_on_sale = '1' AND cat_id = '$id'")->
                                join('lx_goods_attr ON lx_goods.goods_id = lx_goods_attr.goods_id','left')->field('lx_goods.goods_id,goods_name,goods_thumb,market_price')
                                ->group('lx_goods.goods_id')->order('market_price asc')->limit($rpage1,$rpage2)->select();
            } else {
                $shop_goods = M('goods')->where("user_id = '$admin_id' AND is_on_sale = '1' AND cat_id = '$id'")->
                                join('lx_goods_attr ON lx_goods.goods_id = lx_goods_attr.goods_id','left')->field('lx_goods.goods_id,goods_name,goods_thumb,market_price')
                                ->group('lx_goods.goods_id')->order('market_price desc')->limit($rpage1,$rpage2)->select();			
            }
            $bl = $this->getUser();
            foreach ($shop_goods as $key => $value) {
                $gid = $value['goods_id'];
                //销量
                $xl = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->where('order_status = 6')->where("goods_id='$gid'")->
                                field('sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')->select();
                $shop_goods[$key][xl] = $xl[0]['number'];
                //价格
                $jg = M('goods_attr')->where("goods_id='$gid'")->field('market_price,shop_price')->limit(1)->select();
                $shop_goods[$key][jg] = $jg[0]['market_price'];
                //积分
                $jf = ($jg[0]['market_price'] - $jg[0]['shop_price']) * $bl / 100;
                if ($jf < 0) {
                    $jf = 0;
                }
                $shop_goods[$key][jf] = $jf;
            }
            $this->assign('shop_goods', $shop_goods);
        } else {
            //跳转到错误页面
            $this->redirect('Public/error1');
        }
        $this->display();
    }

    public function seach() {
	
        $ss = $_POST['ss'];
        if ($_POST['shop_id']) {
            $admin_id = $_POST['shop_id'];
            $this->assign('shop_id',$admin_id);

            //$cat_id = $_POST['cat_id'];
            $category = M('category')->where("admin_id='$admin_id'")->field("cat_name,cat_id")->order("sort desc")->select();
			//echo 11;exit;
		  if (empty($category)) {
				
                $this->redirect('Public/error1');
            }
            $this->assign('navs', $category);
            /*             * 店铺logo开始* */
            $shop_logo = M('shop_config')->where("ghs_id='$admin_id'")->getField('shop_logo');
            $this->assign('shop_logo', $shop_logo);
            /*             * 店铺logo结束* */
            $shop_goods = M('goods')->where("user_id = '$admin_id' AND is_on_sale = '1' AND goods_name like '%$ss%'")->field('goods_id,goods_name,goods_thumb')->order('sort desc')->select();
            if (!$shop_goods) {
                $this->redirect('Public/error1');
            }
            $bl = $this->getUser();
            foreach ($shop_goods as $key => $value) {
                //var_dump($value);
                $gid = $value['goods_id'];
                //销量
                $xl = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->where('order_status = 6')->where("goods_id='$gid'")->
                                field('sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')->select();
                $shop_goods[$key][xl] = $xl[0]['number'];
                //价格
                $jg = M('goods_attr')->where("goods_id='$gid'")->field('market_price,shop_price')->limit(1)->select();
                $shop_goods[$key][jg] = $jg[0]['market_price'];
                //积分
                $jf = ($jg[0]['market_price'] - $jg[0]['shop_price']) * $bl / 100;
                if ($jf < 0) {
                    $jf = 0;
                }
                $shop_goods[$key][jf] = $jf;
            }
            $this->assign('shop_goods', $shop_goods);
        } else {
            $this->redirect('Public/error1', array());
        }
        $this->display();
    }

    public function sc() {
        $sc = $_POST['shop_id'];
        $data['user_id'] = session("Q_USER");
        if (!$data['user_id']) {
            $info = 2;
        } else {
			//是否已经收藏过
			$re = M('collect_shop')->where("user_id='$data[user_id]' AND shop_id='$sc'")->select();
			//var_dump($re);exit;
			if($re){
				$info=3;
			}else{
            //$data['user_id'] = 9;
            $data['shop_id'] = $sc;
            $data['add_time'] = date('Y-m-d,H:i:s', time());
            $result = M('collect_shop')->add($data);
            if ($result) {
                $info = 1;
            } else {
                $info = 0;
            }
			}
		}
        echo json_encode(array('info' => $info));
    }

}

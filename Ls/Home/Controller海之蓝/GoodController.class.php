<?php

namespace Home\Controller;

use Think\Controller;

class GoodController extends PublicController {

//主页导航点击三级分类进入的详情页面
    public function index() {
        if (empty($_SESSION['FZ'])) {
            $fz = 58;
        } else {
            $fz = $_SESSION['FZ'];
        }
        $cid = $_GET['cid'];
        cookie('cid', "$cid", 36000);
        $cid = cookie('cid');
        $cname = M('category')->where("cat_id='$cid'")->find();
        $this->assign('cname', $cname);
        $page = I('page')? : 1;
        $count = M('goods')->where("lx_goods.fz_id='$fz'")->join('lx_category ON lx_goods.cat_id=lx_category.cat_id', 'left')->where("lx_category.pid='$cid'")->count();

        $rpage = Page($count, 20, $page);
        $rpage1 = $rpage['page_l'];
        $rpage2 = $rpage['page_r'];
        $goods = M('goods')->where("lx_goods.fz_id='$fz'")->join('lx_category ON lx_goods.cat_id=lx_category.cat_id', 'left')->where("lx_category.pid='$cid'")->limit($rpage1, $rpage2)->select();
        if (!$goods) {
            $this->redirect("Public/error1");
        }
        foreach ($goods as $k => $v) {
            $gid = $v['goods_id'];

            //查询商品的价格
            $result2 = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
            $v['goods_count'] = $result2[0]['goods_count'];
            $v['market_price'] = $result2[0]['market_price'];
            //查询销量
            $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                            where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');

            $v['count'] = $result1;

            //查询商品所对应的供货商铺
            $uid = $v['user_id'];
            $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
            $v['shopname'] = $shopname['shop_name'];
            $v['qq'] = $shopname['qq'];

            $arr[] = $v;
        }
        //按人气查询
        if ($_GET['action'] == 1) {

            $result = M("goods")->where("lx_goods.fz_id='$fz'")->join('lx_collect_goods ON lx_goods.goods_id = lx_collect_goods.goods_id', 'left')->join('lx_category ON lx_goods.cat_id=lx_category.cat_id')->where("lx_category.pid = '$cid'")->
                            field('lx_goods.goods_id,goods_name,brand_id,lx_collect_goods.user_id,count(col_goodsid) as count')->group('lx_goods.goods_id')->order("count desc")->limit($start, $limit)->select();
            $arr = array();
            foreach ($result as $k => $v) {
                $gid = $v['goods_id'];
                $goods = M('goods')->where("goods_id='$gid'")->find();
                $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                $v['market_price'] = $price[0]['market_price'];
                $v['goods_thumb'] = $goods['goods_thumb'];
                $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
                $v['count'] = $result1;
                $uid = $goods['user_id'];
                $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                $v['shopname'] = $shopname['shop_name'];
                $v['qq'] = $shopname['qq'];

                $arr[] = $v;
            }
            //按销量查询
        } else if ($_GET['action'] == 2) {

            $goods = M('goods')->where("lx_goods.fz_id='$fz'")->join('lx_category ON lx_goods.cat_id=lx_category.cat_id')->where("lx_category.pid='$cid'")->limit($start, $limit)->select();
            $arr1 = array();
            foreach ($goods as $k => $v) {
                $gid = $v['goods_id'];
                $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
                $arr1[$gid] = $result1;
            }
            arsort($arr1);
            $arr = array();
            foreach ($arr1 as $k => $v) {
                $gid = $k;
                $goods = M('goods')->where("goods_id='$gid'")->find();
                $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                $goods['market_price'] = $price[0]['market_price'];
                $uid = $goods['user_id'];
                $goods['count'] = $v;
                $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                $goods['shopname'] = $shopname['shop_name'];
                $goods['qq'] = $shopname['qq'];

                $arr[] = $goods;
            }

            //按价格排列
        } else if ($_GET['action'] == 3) {
            $result = M('goods')->where("lx_goods.fz_id='$fz'")->join('lx_goods_attr ON lx_goods.goods_id=lx_goods_attr.goods_id', 'left')->join('lx_category ON lx_goods.cat_id=lx_category.cat_id')->
                            where("lx_category.pid = '$cid'")->field('lx_goods.goods_id,goods_name,brand_id,goods_thumb,goods_count,user_id,lx_goods_attr.market_price')->group('lx_goods.goods_id')->order('lx_goods_attr.market_price desc')->limit($start, $limit)->select();
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
                $v['shop_id'] = $shopname['shop_id'];
                $arr[] = $v;
            }
        }
		//按价格倒序排列
		else if ($_GET['action'] == 4) {
            $result = M('goods')->where("lx_goods.fz_id='$fz'")->join('lx_goods_attr ON lx_goods.goods_id=lx_goods_attr.goods_id', 'left')->join('lx_category ON lx_goods.cat_id=lx_category.cat_id')->
                            where("lx_category.pid = '$cid'")->field('lx_goods.goods_id,goods_name,brand_id,goods_thumb,goods_count,user_id,lx_goods_attr.market_price')->group('lx_goods.goods_id')->order('lx_goods_attr.market_price asc')->limit($start, $limit)->select();
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
                $v['shop_id'] = $shopname['shop_id'];
                $arr[] = $v;
            }
        }
        if (empty($arr)) {
            $this->redirect('Public/error1');
        }
        $this->assign('page', $rpage['page']);
        $this->assign('goods', $arr);
        $this->assign("gcount", $count);
        //顶部品牌查询
        $brand = array();
        foreach ($arr as $k => $v) {
            $bid = $v['brand_id'];
            array_push($brand, $bid);
        }
        //var_dump($brand);exit();
        if (!$brand) {
            $this->redirect("Public/error1");
        }
        $brands['brand_id'] = array('in', $brand);
        $allbrand1 = M('brand')->where($brands)->order('sort desc')->limit(0, 8)->select();
        $this->assign('brand1', $allbrand1);
        $allbrand2 = M('brand')->where($brands)->order('sort desc')->limit(8, 8)->select();
        $this->assign('brand2', $allbrand2);
        //查询的页面底部新品
        $newshop = M('goods')->where("lx_goods.fz_id='$fz'")->join('lx_category ON lx_goods.cat_id=lx_category.cat_id', 'left')->where("lx_category.pid='$cid'")->group('lx_goods.goods_id')->limit(0, 5)->select();
        $arr1 = array();
        foreach ($newshop as $k => $v) {
            $gid = $v['goods_id'];

            //查询商品的价格
            $result2 = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
            $v['goods_count'] = $result2[0]['goods_count'];
            $v['market_price'] = $result2[0]['market_price'];
            //查询销量

            $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                            where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6")->sum('lx_order_goods.goods_number');

            $v['count'] = $result1;
            //查询商品所对应的供货商铺
            $uid = $v['user_id'];
            $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
            $v['shopname'] = $shopname['shop_name'];
            $v['qq'] = $shopname['qq'];
            $v['shop_id'] = $shopname['shop_id'];

            $arr1[] = $v;
        }
        $this->assign('newgoods', $arr1);

        //查询页面底部爆款
        $result3 = M('order_goods')->where("lx_goods.fz_id='$fz'")->join('lx_goods ON lx_order_goods.goods_id=lx_goods.goods_id', 'left')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->join('lx_category ON lx_goods.cat_id=lx_category.cat_id')->
                        where("lx_order_info.order_status=6 and lx_category.pid='$cid' ")->field('lx_order_goods.goods_id,lx_order_goods.market_price,lx_goods.goods_name,sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')->order('number desc')->limit(5)->select();
        $arr2 = array();
        foreach ($result3 as $k => $v) {
            $gid = $v['goods_id'];
            $goods = M('goods')->where("goods_id='$gid'")->find();
            $uid = $goods['user_id'];
            $v['goods_thumb'] = $goods['goods_thumb'];
            $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
            $v['shopname'] = $shopname['shop_name'];
            $v['shop_id'] = $shopname['shop_id'];
            $v['qq'] = $shopname['qq'];

            $arr2[] = $v;
        }
        /* if(empty($arr2)){
          $this->redirect('Public/error1');
          } */
        $this->assign('baogoods', $arr2);

        //查询页面右侧的热门商品

        $name = cookie('name');
        $result4 = M("collect_goods")->join('lx_goods ON lx_collect_goods.goods_id = lx_goods.goods_id')->join('lx_category ON lx_goods.cat_id=lx_category.cat_id')->where("lx_category.pid = '$cid' and lx_goods.fz_id='$fz'")->
                field('lx_collect_goods.goods_id,goods_name,count(col_goodsid) as count')->group('lx_collect_goods.goods_id')->order("count desc")->limit(5)
                ->select();
        $arr3 = array();
        foreach ($result4 as $k => $v) {
            $gid = $v['goods_id'];
            $goods = M('goods')->where("goods_id='$gid'")->find();
            $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
            $v['market_price'] = $price[0]['market_price'];
            $v['goods_thumb'] = $goods['goods_thumb'];
            $v['user_id'] = $goods['user_id'];

            $arr3[] = $v;
        }
        $this->assign('hotgoods', $arr3);
        $this->display();
    }

    public function info() {
        /* 王丹负责的商品详情开始 */
        if ($_GET['id']) {
            $id = $_GET['id'];
            /* 存贮cookie */
            if (isset($_SESSION ['history_id'])) {
                $as = explode('-', rtrim($_SESSION ['history_id'], '-'));
                if (in_array($id, $as)) {
                    
                } else {
                    if (count($as) <= 5) {
                        foreach ($as as $name => $value) {
                            if ($value != $id) {
                                $cookie_id = $id . '-' . $_SESSION ['history_id'];
                                //setcookie("history_id", $cookie_id);
                                $_SESSION ['history_id'] = $cookie_id;
                            }
                        }
                    }
                }
            } else {

                $_SESSION ['history_id'] = $id;
            }
            /* 存贮cookie结束 */
            $goods_info = M('goods')->where("lx_goods.goods_id='$id'")->join('lx_goods_attr ON lx_goods.goods_id = lx_goods_attr.goods_id', 'left')
                            ->field("lx_goods.goods_id,lx_goods_attr.id,lx_goods.cat_id,lx_goods_attr.market_price,lx_goods_attr.shop_price,user_id,goods_name,goods_count,goods_gallery_id,goods_desc")
                            ->group('lx_goods.goods_id')->select();
            if ($goods_info) {
                $this->assign('goods', $goods_info[0]);
                //获得积分
                $bl = $this->getUser();
                $jf = ($goods_info[0][market_price] - $goods_info[0][shop_price]) * $bl / 100;
                if ($jf < 0) {
                    $jf = 0;
                }
                $this->assign('jinf', $jf);
                $shop_moster = $goods_info[0][user_id];
                $this->assign('shop_id', $shop_moster);
                $goods_cate = $goods_info[0][cat_id];
                //查找店铺导航相关信息
                $category = M('category')->where("admin_id='$shop_moster'")->field("cat_name,cat_id")->order("sort desc")->select();

                if (empty($category)) {
                    $this->redirect('Public/error1', array());
                }
                $this->assign('navs', $category);
                //查找店铺的相关信息
                $shop = M('shop_config')->where("ghs_id='$shop_moster'")->join('lx_user ON lx_user.id = lx_shop_config.ghs_id')
                                ->field("ghs_id,shop_name,shop_logo,shop_qq,name")->select();
                //dump($shop);exit();
                if (empty($shop)) {
                    //跳转到错误页面
                    $this->redirect('Public/error1', array());
                }
                $this->assign('shop', $shop);
                $this->assign('shop_logo', $shop[0]['shop_logo']);
                //查找商品图集
                $gallery = M('goods_gallery')->where("goods_id='$id'")->select();
                foreach ($gallery as $k => $v) {
                    $pic = $v['img_url'];
                    $dir = dirname($pic);
                    $name = basename($pic);
                    $gallery[$k]['s_img_url'] = $dir . '/s_' . $name;
                }
                if (empty($gallery)) {
                    //跳转到错误页面
                    $this->redirect('Public/error1', array());
                }
                $this->assign('gallery', $gallery);
                //看了又看--关联是商品
                $see = M('link_goods')->where("goods_id ='$id'")->field('link_goods_id')->order('id desc')->limit(10)->select();
                $sees = array();
                foreach ($see as $k => $v) {
                    $loid = $v['link_goods_id'];
                    //echo $loid;
                    $bt1 = M('goods')->join('lx_goods_attr ON lx_goods.goods_id= lx_goods_attr.goods_id', 'left')->where("lx_goods.goods_id = '$loid'")
                                    ->field('lx_goods.goods_id,lx_goods.goods_thumb,lx_goods.goods_name,lx_goods_attr.market_price')->group('lx_goods.goods_id')->select();
                    if ($bt1) {
                        array_push($sees, $bt1);
                    }
                }
                $this->assign('se', $sees);
                //宝贝推荐--商品10个(销量至上)
              //该商店的商品
                $zuib = M('goods')->where("lx_goods.goods_id!='$id' AND lx_goods.user_id='$shop_moster' AND lx_goods.cat_id ='$goods_cate' AND lx_goods.is_on_sale=1")->
				field('goods_id')->select();
				$idas = array();
				foreach($zuib as $k1=>$v1){
					$g1=$v1['goods_id'];
					array_push($idas, $g1);
				}
				$idass['goods_id']=array('in',$idas);
				//dump($idas);
				if($idas){
					$bt = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->where("lx_order_info.order_status = 6 ")
					->where($idass)->field('lx_order_goods.goods_id,lx_order_goods.goods_name,sum(lx_order_goods.goods_number) as number')
					->group('lx_order_goods.goods_id')->order('number desc')->select();
					foreach($bt as $k2=>$v2){
						$g2=$v2['goods_id'];
						$bt[$k2]['goods_thumb']=M('goods')->where("goods_id='$g2'")->getField('goods_thumb');
						$bt[$k2]['market_price']=M('goods_attr')->where("goods_id='$g2'")->getField('market_price');
					}
				}
                $this->assign('bt', $bt);
                //掌柜推荐--自动设置热销的
                $zt = M('goods')->where("user_id='$shop_moster' AND is_hot='1'")->order('sort desc')->limit(6)->field('goods_id,goods_thumb,goods_name')->select();
                foreach ($zt as $ks => $vs) {
                    $gid = $vs['goods_id'];
                    $price = $this->getGoodsPrice($gid);
                    $zt[$ks]['market_price'] = $price;
                }
                /*              if(empty($zt)){
                  $this->redirect('Public/error1', array());
                  } */
                $this->assign('zt', $zt);
                //还看了 还买了
                $hk = M('goods')->where("goods_id!='$id' AND cat_id='$goods_cate' AND is_on_sale='1' AND user_id='$shop_moster'")
                                ->field('goods_id,goods_name,goods_thumb')->order('sort desc')->limit(8)->select();
                foreach ($hk as $ksss => $vsss) {
                    $gidsss = $vsss['goods_id'];
                    $pricesss = $this->getGoodsPrice($gidsss);
                    $hk[$ksss]['market_price'] = $pricesss;
                }
                /*              if(empty($hk)){
                  $this->redirect('Public/error1', array());
                  } */
                $this->assign('hk', $hk);
                //是否收藏人气
                $uid = session("Q_USER");
                $rq = M("collect_goods")->where("goods_id='$id' AND user_id='$uid'")->field('col_goodsid')->select();
                if ($rq) {
                    $sc = 1;
                } else {
                    $sc = 0;
                }
                $this->assign('sc', $sc);
                //查找收藏数
                $rqs = M("collect_goods")->where("goods_id='$id'")->count('col_goodsid');
                $this->assign('rqs', $rqs);
                //销量
                $xs = M("order_goods")->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')
                                ->where("lx_order_info.order_status = 6 AND goods_id='$id'")->field('lx_order_goods.goods_id,goods_number,goods_attr_id,add_time,user_id')
                                ->order('lx_order_goods.order_id desc')->select();
                $zhh = array();
                foreach ($xs as $keysd => $veysd) {
                    $zhh[$keysd]['number'] = $veysd['goods_number'];

                    $goods_attr_id = $veysd['goods_attr_id'];
                    if ($goods_attr_id) {
                        $gvalue = getAttrName($goods_attr_id);
                        $zhh[$keysd]['attr_value'] = $gvalue;
                    } else {
                        $zhh[$keysd]['attr_value'] = null;
                    }
                    $add_time = $veysd['add_time'];
                    $zhh[$keysd]['add_day'] = date("Y-m-d", $add_time);
                    $zhh[$keysd]['add_time'] = date("H:i:s", $add_time);
                    $ues_id = $veysd['user_id'];
                    $user_name = M('user')->where("id='$ues_id'")->getField('nic');
                    $zhh[$keysd]['user_name'] = $user_name;
                }
                /*              if(empty($zhh)){
                  $this->redirect('Public/error1', array());
                  } */
                $this->assign('zhh', $zhh);
                //评论
                $pl = M('goods_comment')->where("goods_id='$id'")->field('comment_id,goods_id,user_id,user_name,content,show_img,comment_rank,com_time')
                                ->order('com_time desc')->limit($start, $limit)->select();
                foreach ($pl as $kk => $vv) {
                    $users_id = M('user')->where("id='{$vv['user_id']}'")->getField('pic');
                    $pl[$kk]['user_head'] = $users_id;
                }
                $this->assign('pldywr', $pl);
                //无图评论
                $wtpl = M('goods_comment')->where("goods_id='$id'  AND show_img=''")->field('comment_id,goods_id,user_id,user_name,content,comment_rank,com_time')
                                ->order('com_time desc')->limit($start, $limit)->select();
                $wtp = count($wtpl);
                $this->assign('wtpl', $wtp);
                //商品满意度查询
                $my = M('goods_comment')->where("goods_id='$id'")->field('sum(comment_rank) as sum')->select();
                $count = count($pl);
                if ($count) {
                    $manyi = $my[0][sum] / $count;
                }
                $float = number_format($manyi, 2, '.', '');
                $xiaoshu = end(explode('.', $float)) / 100;
                $zhengshu = floor($float);
                $this->assign('qus', $float);
                $this->assign('xiaos', $xiaoshu);
                $this->assign('das', $zhengshu);
                //商品属性联动
                $goods_att = M('goods_attr')->where("goods_id='$id'")->field('attr_id,attr_value')->select();
                if (!$goods_att[0][attr_id]) {
                    $nim = '';
                } else {


                    $goods_att[0][attr_id] = rtrim($goods_att[0][attr_id], '-');
                    $attid = explode('-', $goods_att[0][attr_id]);
                    $shuxing = array();
                    foreach ($attid as $k => $v) {
                        $ats = M('goods_attribute')->where("attr_id='$v'")->getField('attr_name');
                        array_push($shuxing, $ats);
                    }
                    foreach ($goods_att as $kg => $vg) {
                        $vg['attr_value'] = rtrim($vg['attr_value'], '-');
                        $att = explode('-', $vg['attr_value']);
                        foreach ($att as $h => $m) {
                            $arr2[$kg][$h] = $m;
                        }
                    }
                    foreach ($arr2 as $h => $m) {
                        foreach ($m as $v => $n) {
                            $arr3[$v][$h] = $n;
                        }
                    }
                    foreach ($arr3 as $v => &$n) {
                        $n = array_unique($n);
                    }
                    unset($n);
                    $nim = array_combine($shuxing, $arr3);
                }

                $this->assign('nim', $nim);
                //dump($nim);exit();
            } else {
                //跳转到错误页面
                $this->redirect('Public/error1', array());
            }
        } else {
            //跳转到错误页面
            $this->redirect('Public/error1', array());
        }
        $this->display();
    }

    public function goods_ar() {
        //根据属性判断库存积分等
        $id = $_POST['sid'];
        $wd = $_POST['msg'];
        //var_dump($wd);
        $attr = M('goods_attr')->where("goods_id='$id' AND attr_value='$wd'")->order('id desc')->limit(1)->getField("id,goods_count,market_price,shop_price");
        $bl = $this->getUser();
        foreach ($attr as $k => $v) {
            $sl = $v['goods_count'];
            $sj = $v['market_price'];
            $jj = $v['shop_price'];
            $jf = ($v['market_price'] - $v['shop_price']) * $bl / 100;
            $sxid = $v['id'];
            if ($jf < 0) {
                $jf = 0;
            }
        }
        if (!$sxid) {
            $sxid = 0;
        }
        if (!$sl) {
            $sl = 0;
        }
        if (!$sj) {
            $sj = 0;
        }
        echo json_encode(array('sl' => $sl, 'jf' => $jf, 'sj' => $sj, 'sxid' => $sxid));
    }

    public function jrgw() {
        $uid = session("Q_USER");
        if (!$uid) {
            $yy = 3;
        } else {
            $data['sp_id'] = I('post.goodsid');
            $data['num'] = I('post.goodsnum');
            $data['goods_attr_id'] = I('post.gattrid');
            $data['c_time'] = time();
            $data['up_id'] = $uid;
            $data['ghs_id'] = M('goods')->where("goods_id = '$data[sp_id]'")->getField('user_id');
            $data['g_price'] = M('goods_attr')->where("id='$data[goods_attr_id]'")->getField('market_price');
            //查库判断是否有一样的
            $sf = M('car')->where("sp_id='$data[sp_id]' AND up_id='$data[up_id]' AND goods_attr_id='$data[goods_attr_id]'")->field('id,num')->select();
            if ($sf) {
                $id = $sf[0][id];
                $asa['num'] = $data['num'] + $sf[0]['num'];
                $result = M('car')->where("id='$id'")->field('num')->save($asa);
            } else {
                $result = M('car')->add($data);
            }
            if ($result) {
                $yy = 1;
            } else {
                $yy = 2;
            }
        }
        echo json_encode(array('info' => $yy));
    }

    //立即购买
    public function ljgm() {
        $uid = session("Q_USER");
        if (!$uid) {
            $e = 0;
			$yy = 0;
        } else {
            $data['sp_id'] = I('post.goodsid');
            $data['num'] = I('post.goodsnum');
            $data['goods_attr_id'] = I('post.gattrid');
            $data['c_time'] = time();
            $data['up_id'] = $uid;
            $data['ghs_id'] = M('goods')->where("goods_id = '$data[sp_id]'")->getField('user_id');
            $data['g_price'] = M('goods_attr')->where("id='$data[goods_attr_id]'")->getField('market_price');
            //查库判断是否有一样的
            $sf = M('car')->where("sp_id='$data[sp_id]' AND up_id='$data[up_id]' AND goods_attr_id='$data[goods_attr_id]'")->field('id,num')->select();
            //var_dump($sf[0][id]);
            if ($sf) {
                $id = $sf[0][id];
                //var_dump($asa['num']);
                if ($sf[0]['num'] == $data['num']) {
                    $result = 1;
                } else {
                    $asa['num'] = $data['num'];
                    $result = M('car')->where("id='$id'")->field('num')->save($asa);
                }
                $yy = $id;
            } else {
                $result = M('car')->add($data);
                $yy = $result;
            }
            if (!$result) {
                $yy = 0;  
            } 
        }
		echo json_encode(array('info' => $yy,'e' => $e));
    }

    public function plsx() {
        $bs = $_POST['sx'];
        $id = $_POST['sp'];
        //echo $bs;
        //echo $id;
        if ($bs == 'tp') {
            $pl = M('goods_comment')->where("goods_id='$id' AND show_img=''")->field('comment_id,goods_id,user_id,user_name,content,show_img,comment_rank,com_time')
                            ->order('com_time desc')->select();
            foreach ($pl as $kk => $vv) {
                $users_id = M('user')->where("id='{$vv['user_id']}'")->getField('pic');
                $pl[$kk]['user_head'] = $users_id;
            }
            //拼接字符串
            $qbs = '';
            foreach ($pl as $k => $v) {
                if ($v['user_head']) {
                    $a = "<dd><img class='yonghu' src=" . $v['user_head'] . " alt='海之澜'>";
                } else {
                    $a = "<dd><img class='yonghu' src='/public/home/assets/images/index_03_03.png' alt='海之澜'>";
                }
                $b = "<div class='pingjia_text'><span>" . $v['user_name'] . "</span><b>" . $v['content'] . "</b></div>";
                $ca = "<h3 class=\"pingjia_right\">
                          <span>";
                for ($i = 1; $i <= $v['comment_rank']; $i++) {
                    $c = "<img src=\"/public/home/assets/images/xing.jpg\" alt=" . $i . ">";
                    $ca.=$c;
                }
                $d = " <span>" . $v['com_time'] . "</span>
                          </h3>
                          </dd>";
                $qb = $a . $b . $ca . $d;
                $qbs.=$qb;
            }
            $pldywr2 = $qbs;
        }
        if ($bs == 'qb') {
            //全部
            $pldywr2 = 2;
        }
        echo json_encode(array('pldywr2' => $pldywr2));
    }

    /* 王丹负责的商品详情结束 */

    //导航查询商品信息
    public function selgoods() {
        $name = cookie('name');
        if (empty($_POST['goods_name']) && empty($_GET['action'])) {
            $this->redirect('Index/index');
        }

        if (!empty($_POST['goods_name']) || !empty($_GET['action'])) {
            $result = M('goods');
            $name = $_POST['goods_name'];
            cookie('name', "$name", 36000);
            $name = cookie('name');
            $chaxun->goods_name = array("like", "%$name%");
            $selcount = $result->where($chaxun)->count();
            $this->assign('selcount', $selcount);
            if ($_GET['action'] == 1) {

                $result = M("goods")->join('lx_collect_goods ON lx_goods.goods_id = lx_collect_goods.goods_id', 'left')->where("lx_goods.goods_name like '%$name%'")->
                                field('lx_goods.goods_id,goods_name,lx_collect_goods.user_id,count(col_goodsid) as count')->group('lx_collect_goods.goods_id')->order("count desc")->select();


                $arr = array();
                foreach ($result as $k => $v) {
                    $gid = $v['goods_id'];
                    $goods = M('goods')->where("goods_id='$gid'")->find();
                    $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                    $v['market_price'] = $price[0]['market_price'];
                    $v['goods_thumb'] = $goods['goods_thumb'];
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
                    $v['count'] = $result1;
                    $uid = $goods['user_id'];
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $v['shopname'] = $shopname['shop_name'];
                    $v['qq'] = $shopname['qq'];

                    $arr[] = $v;
                }
            } else if ($_GET['action'] == 2) {


                //$result=M('order_goods')->join('lx_goods ON lx_order_goods.goods_id=lx_goods.goods_id', 'right')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->
                //where("lx_order_info.order_status=6 and lx_order_goods.goods_name like '%$name%'")->field('lx_order_goods.goods_id,lx_order_goods.market_price,lx_goods.goods_name,sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')->order('number desc')->select();
                $goods = M('goods')->where("goods_name like '%$name%'")->select();
                $arr1 = array();
                foreach ($goods as $k => $v) {
                    $gid = $v['goods_id'];
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');
                    $arr1[$gid] = $result1;
                }
                arsort($arr1);
                $arr = array();
                foreach ($arr1 as $k => $v) {
                    $gid = $k;
                    $goods = M('goods')->where("goods_id='$gid'")->find();
                    $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                    $goods['market_price'] = $price[0]['market_price'];
                    $uid = $goods['user_id'];
                    $goods['count'] = $v;
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $goods['shopname'] = $shopname['shop_name'];
                    $goods['qq'] = $shopname['qq'];

                    $arr[] = $goods;
                }
            } else if ($_GET['action'] == 3) {
                $result = M('goods')->join('lx_goods_attr ON lx_goods.goods_id=lx_goods_attr.goods_id', 'left')->
                                where("lx_goods.goods_name like '%$name%'")->field('lx_goods.goods_id,goods_name,goods_thumb,goods_count,user_id,admin_id,lx_goods_attr.market_price')->group('lx_goods.goods_id')->order('lx_goods_attr.market_price desc')->select();
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

                    $arr[] = $v;
                }
            } else if ($_GET['action'] == 4) {
                $chaxun->goods_name = array("like", "%$name%");
                $selgoods = $result->where($chaxun)->select();
                $arr = array();
                foreach ($selgoods as $k => $v) {
                    $gid = $v['goods_id'];

                    //查询商品的价格
                    $result2 = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                    $v['goods_count'] = $result2[0]['goods_count'];
                    $v['market_price'] = $result2[0]['market_price'];
                    //查询当前时间以前的销量
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');

                    $v['count'] = $result1;

                    //底部爆款商品查询
                    //查询商品所对应的供货商铺
                    $uid = $v['user_id'];
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $v['shopname'] = $shopname['shop_name'];
                    $v['qq'] = $shopname['qq'];

                    $arr[] = $v;
                }
            } else {
                $chaxun->goods_name = array("like", "%$name%");
				
                $selgoods = $result->where($chaxun)->select();
				
					if (!$selgoods) {
						$this->redirect("Public/error1");
								}
                $arr = array();
                foreach ($selgoods as $k => $v) {
                    $gid = $v['goods_id'];

                    //查询商品的价格
                    $result2 = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                    $v['goods_count'] = $result2[0]['goods_count'];
                    $v['market_price'] = $result2[0]['market_price'];
                    //查询销量
                    $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                    where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 ")->sum('lx_order_goods.goods_number');

                    $v['count'] = $result1;

                    //底部爆款商品查询
                    //查询商品所对应的供货商铺
                    $uid = $v['user_id'];
                    $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                    $v['shopname'] = $shopname['shop_name'];
                    $v['qq'] = $shopname['qq'];

                    $arr[] = $v;
                }
            }



            $this->assign('selgoods', $arr);

            //查询的页面底部新品
            $newgoods = M('goods');
            $name = cookie('name');
            $chaxun1->goods_name = array("like", "%$name%");
            $chaxun1->is_alone_sale = 1;
            $newshop = $newgoods->where($chaxun1)->limit(0, 5)->order('goods_id desc')->select();
            $arr1 = array();
            foreach ($newshop as $k => $v) {
                $gid = $v['goods_id'];

                //查询商品的价格
                $result2 = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                $v['goods_count'] = $result2[0]['goods_count'];
                $v['market_price'] = $result2[0]['market_price'];
                //查询当前时间以前的销量
                $t = time();
                $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                                where("lx_order_goods.goods_id='$gid' and lx_order_info.order_status=6 and lx_order_info.add_time < '$t' ")->sum('lx_order_goods.goods_number');

                $v['count'] = $result1;
                //查询商品所对应的供货商铺
                $uid = $v['user_id'];
                $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                $v['shopname'] = $shopname['shop_name'];
                $v['qq'] = $shopname['qq'];

                $arr1[] = $v;
            }


            $this->assign('newgoods', $arr1);

            //查询页面底部爆款
            $name = cookie('name');
            $result3 = M('order_goods')->join('lx_goods ON lx_order_goods.goods_id=lx_goods.goods_id')->join('lx_order_info ON lx_order_goods.order_id = lx_order_info.order_id')->
                            where("lx_order_info.order_status=6 and lx_order_goods.goods_name like '%$name%'")->field('lx_order_goods.goods_id,lx_order_goods.market_price,lx_goods.goods_name,sum(lx_order_goods.goods_number) as number')->group('lx_order_goods.goods_id')->order('number desc')->limit(5)->select();
            $arr2 = array();
            foreach ($result3 as $k => $v) {
                $gid = $v['goods_id'];
                $goods = M('goods')->where("goods_id='$gid'")->find();
                $uid = $goods['user_id'];
                $v['goods_thumb'] = $goods['goods_thumb'];
                $shopname = M('shop_config')->where("ghs_id='$uid'")->find();
                $v['shopname'] = $shopname['shop_name'];
                $v['qq'] = $shopname['qq'];

                $arr2[] = $v;
            }
            $this->assign('baogoods', $arr2);

            //查询页面右侧的热门商品

            $name = cookie('name');
            $result4 = M("collect_goods")->join('lx_goods ON lx_collect_goods.goods_id = lx_goods.goods_id')->where("lx_goods.goods_name like '%$name%'")->
                    field('lx_collect_goods.goods_id,goods_name,count(col_goodsid) as count')->group('lx_collect_goods.goods_id')->order("count desc")->limit(5)
                    ->select();
            $arr3 = array();
            foreach ($result4 as $k => $v) {
                $gid = $v['goods_id'];
                $goods = M('goods')->where("goods_id='$gid'")->find();
                $price = M('goods_attr')->where("goods_id='$gid'")->limit(0, 1)->select();
                $v['market_price'] = $price[0]['market_price'];
                $v['goods_thumb'] = $goods['goods_thumb'];
                $v['user_id'] = $goods['user_id'];

                $arr3[] = $v;
            }

            $this->assign('hotgoods', $arr3);


            $this->display();
        }
    }

    //店铺搜索
    public function search() {
		//分站搜索
		 if(empty($_SESSION['FZ'])){
             $fz=58;
          }else{
            $fz=$_SESSION['FZ'];
         }
		$provide=M('user')->where("user_up='$fz'")->field('id')->select();
		$ghsid=array();
		for($li=0;$li<count($provide);$li++){
			$ghsid[]=$provide[$li]['id'];
		}
		 $where['ghs_id']=array('in',$ghsid);
		 //dump($ghsid);exit;
		//end
        if (I('post.shopname')) {
            $likenames = I('post.shopname');
        } else {
            $likenames = I('get.shopname');
        }
		if($likenames==""){
		$this->redirect("Public/error1");		
		}else{
        $this->assign('names', $likenames);
        $where['shop_name'] = array('like', "%" . $likenames . "%");
        $total = M('shop_config')->where($where)->count();
        $page = new \Think\Page($total, 8);
        $rsname = M('shop_config')->where($where)->limit($page->firstRow . "," . $page->listRows)->select();
       
        $notime = array();
        $seltime = array();
        /*   foreach($rsname as $key=>$v){
          $notime[$key]=$v['num'];
          } */
        for ($i = 0; $i < count($rsname); $i++) {
            $count = $rsname[$i]['shop_id'];
            $numcount = M('collect_shop')->where("shop_id='$count'")->count();
            $rsname[$i]['num'] = $numcount;
            $notime[] = $numcount;
        }
        if (I('get.type') == 1) {
            //type=1位人气升序          
            array_multisort($notime, SORT_DESC, $rsname);
        } else if (I('get.type') == -1) {
            //type位人气降序
            $rsname = array_multisort($notime, SORT_ASC, $rsname['num']);
        } else if (I('get.type') == 2) {
            //type 为销量升序            
            for ($k = 0; $k < count($rsname); $k++) {
                //var_dump($rsname[$k]['num']);
                $ghs_id = $rsname[$k]['ghs_id'];
                $ordercount = M('order_info')->where("provider_id='$ghs_id' and order_status=6")->count();
                $rsname[$k]['sale'] = $ordercount;
                $seltime[] = $ordercount;
                //var_dump($raname[$k]['num']);
            }
            array_multisort($seltime, SORT_DESC, $rsname);
            //echo "<pre>";var_dump($rsname);
        } else if (I('get.type') == -2) {
            //type 为销量降序
        }
        $pages = $page->show();
        $this->assign('pages', $pages);
        $this->assign('shoplist', $rsname);
		
        $this->display();
        }
        //}  
    }

    public function sc() {
        $sc = $_POST['goods_id'];
        $data['user_id'] = session("Q_USER");
        if (!$data['user_id']) {
            $info = 2;
        } else {
            //是否已经收藏过
            $re = M('collect_goods')->where("user_id='$data[user_id]' AND goods_id='$sc'")->select();
            //var_dump($re);exit;
            if ($re) {
                $info = 3;
            } else {
                //$data['user_id'] = 9;
                $data['goods_id'] = $sc;
                $data['add_time'] = date('Y-m-d,H:i:s', time());
                $result = M('collect_goods')->add($data);
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

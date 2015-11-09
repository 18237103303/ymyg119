<?php

namespace Home\Controller;

use Think\Controller;

class ShopsearchController extends PublicController {

    public function shopsearch() {
        $this->display();
    }

    public function search() {
        
        if (I('post.shopname')) {
            $likenames = I('post.shopname');
        } else {
            $likenames = I('get.shopname');
        }


        $this->assign('names', $likenames);
        $where['shop_name'] = array('like', "%" . $likenames . "%");
        $total = M('shop_config')->where($where)->count();
        $page = new \Think\Page($total, 8);
        $rsname = M('shop_config')->where($where)->limit($page->firstRow . "," . $page->listRows)->select();
        $notime = array();
        $seltime = array();
        /* 	 foreach($rsname as $key=>$v){
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

        //}	 
    }

}

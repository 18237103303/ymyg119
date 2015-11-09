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

class SysController extends PublicController {

    /*系统常量设置*/
    public function sys(){
        $id=session('USER');
        //处理提交
        if($_POST){
        $idd= I('id');
            $sys=M('sys_config');
        I('config_value')?$date['config_value']=I('config_value'):'';
        I('type')?$date['type']=I('type'):'';
        I('h_title')?$date['h_title']=I('h_title'):'';
        I('js')?$date['js']=I('js'):'';
        I('ks')?$date['ks']=I('ks'):'';
            //存在不存在
            if($idd){
                //更新
                $sys->where("id=$idd")->save($date);
            }else{
                //新增
                switch(I('systype')){
                    case 1:
                        $date['config_name']='J_M';
                        break;
                    case 2:
                        $date['config_name']='SC_H';
                        $date['h_type']='2';
                        break;
                    case 3:
                        $date['config_name']='SC_H';
                        $date['h_type']='1';
                        break;
                    case 4:
                        $date['config_name']='SJ_H';
                        $date['h_type']='2';
                        break;
                    case 5:
                        $date['config_name']='SJ_H';
                        $date['h_type']='1';
                        break;
                }
                $date['u_id']=$id;
                $sys->add($date);
            }
            unset($date);
        }
        $rows=  M('sys_config')->where("u_id=$id")->select();
        $row='';$row1='';$row2='';$row3='';$row4='';
        foreach($rows as $v){
            //系统类型的区别
            switch($v['config_name']){
                case 'J_M':
                    $row=$v;
                    break;
                case 'SC_H':
                    switch($v['h_type']){
                        case '代金卷':
                            $row1=$v;
                            break;
                        case '商品':
                            $row2=$v;
                            break;
                    }
                    break;
                case 'SJ_H':
                    switch($v['h_type']){
                        case '代金卷':
                            $row3=$v;
                            break;
                        case '商品':
                            $row4=$v;
                            break;
                    }
                    break;
            }
        }
        $this->assign('rows',$row);
        $this->assign('rows1',$row1);
        $this->assign('rows2',$row2);
        $this->assign('rows3',$row3);
        $this->assign('rows4',$row4);
        $this->display();
    }
    //数据库的导出
    public function db(){
        $this->redirect('bak/index');
    }
    /*开启关闭管理*/



    public function set() {
        quanx("sys");
        $sys = M('SysConfig');
        $data = $sys->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function add() {
        quanx("sys");
        $sys = M('SysConfig');
        if ($sys->create()) {
            $result = $sys->add();
            if ($result) {
                $data['status'] = 1;
                //加入配置文件，动态配置
                $config_name = $_POST['config_name'];
                $config_value = $_POST['confi_value'];
                C($config_name, $config_value);
            } else {
                $data['status'] = 0;
            }
            echo json_encode($data);
        } else {
            $this->error($art_cate->getError());
        }
    }

    public function edit() {
        quanx("sys");
        $sys = M('SysConfig');
        $sys->config_id = $_POST['config_id'];
        $sys->config_name = $_POST['config_name'];
        $sys->config_value = $_POST['config_value'];
        $result = $sys->save();
        if ($result) {
            $data['status'] = 1;
            //动态配置
            C($_POST['config_name'], $_POST['config_value']);
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    public function delete() {
        quanx("sys");
        $id = $_GET['id'];
        $sys = M('SysConfig');
        $sys->delete($id);
        $this->redirect('Sys/set');
    }

    //邮箱服务器设置
    public function email_set() {
        quanx("sys");
        $this->display();
    }

    public function email_add() {
        quanx("sys");
        $data = $_POST;
        foreach ($data as $k => $v) {
            $sys = M('SysConfig');
            //判断是否为第一次设置
            $s_data = $sys->where(array('config_name' => $k))->select();
            if (empty($s_data)) {
                C($k, $v);
                //对邮箱密码进行加密
                if ($k == 'stmp_password') {
                    $v = md5($v);
                }
                $sys->config_name = $k;
                $sys->config_value = $v;
                $sys->add();
            } else {
                C($k, $v);
                $id = $s_data[0]['config_id'];
                //对邮箱密码进行加密
                if ($k == 'stmp_password') {
                    $v = md5($v);
                }
                $sys->config_id = $id;
                $sys->config_name = $k;
                $sys->config_value = $v;
                $sys->save();
            }
        }

        echo json_encode(array('info' => 1));
    }

    //清空所有
    public function delete_all() {
        quanx("sys");
        $id = explode('-', substr(trim($_POST['id']), 0, -1));
        $num = count($id);
        for ($i = 0; $i < $num; $i++) {
            $sys = M('SysConfig');
            $sys->delete($id[$i]);
        }
        echo json_encode(array('info' => 1));
    }

    //友情链接 列表模块
    public function link_list() {
        $f_l = M('FriendLink');
        $data = $f_l->order('link_id desc')->select();
        foreach ($data as $k => $v) {
            if (!empty($v['link_pic'])) {
                $data[$k]['link_pic'] = "<img src='/Uploads/" . $v["link_pic"] . "' width='100' height='30'/>";
            }
        }
        $this->assign('data', $data);
        $this->display();
    }

    //添加友情链接模块
    public function link_add() {
        $this->display();
    }

    //处理上传
    public function upload() {
        if ($_FILES['upload']['error'] === 0) {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'swf', 'avi', 'flv');
            $upload->savePath = './link/';
            $upload->saveName = array('uniqid', '');
            $info = $upload->upload();
            if (!$info) {
                $this->error($upload->getError());
            } else {
                foreach ($info as $file) {
                    $imgpath = $file['savepath'];
                    $imgname = $file['savename'];
                    $path = $file['savepath'] . $file['savename'];
                }
                //$_POST['ad_code'] = $path;
                echo json_encode(array('info' => 1, 'path' => $path));
            }
        } else {
            $this->error('上传失败');
        }
    }

    public function linkadd() {
        $f_l = M('FriendLink');
        $data = array();
            $result = $f_l->add(I("post."));
            if ($result) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
        
        echo json_encode($data);
    }

    public function delete_link() {
        quanx("sys");
        $f_l = M('FriendLink');
        $f_l->delete($_GET['id']);
        $this->redirect("Sys/link_list");
    }

    public function delete_all_link() {
        quanx("sys");

        $id = explode('-', substr(trim($_POST['id']), 0, -1));
        $num = count($id);
        for ($i = 0; $i < $num; $i++) {
            $f_l = M('FriendLink');
            $f_l->delete($id[$i]);
        }
        echo json_encode(array('info' => 1));
    }

    public function link_edit() {
        quanx("sys");
        $id = $_GET['id'];
        $f_l = M('FriendLink');
        $data = $f_l->where("link_id=$id")->select();
        $this->assign('data', $data);
        $this->display();
    }

    public function linkedit() {
        quanx("sys");
        
        $f_l = M('FriendLink');
        if ($f_l->autoCheckToken($_POST)) {
            $result = $f_l->save();
            if ($result) {
                echo json_encode(array('info' => 1));
            } else {
                echo json_encode(array('info' => 0));
            }
        }
    }

    public function code() {
        quanx("sys");
        $this->display();
    }

    public function add_code() {
        quanx("sys");
        $sys = M('SysConfig');
        $data = $_POST;
        foreach ($data as $k => $v) {
            $sys->config_name = $k;
            $sys->config_value = $v;
            $sys->add();
            C($k, $v);
        }
        echo json_encode(array('info' => 1));
    }

    //商店设置
    public function shop() {
        quanx('gshop');
        $shop = M('shop_config');
        $data['ghs_id']=$_SESSION['USER'];
		$id=$_SESSION['USER'];	
		$rs=M('user')->where("id='$id'")->find();
		//if($rs['grand'] == 6){
			
		
        if (I('post.')) {
            $data2 = I('post.');
            $id = I('post.shop_id');
            $data2['shop_shx'] = I('post.s_province') . I('post.s_city') . I('post.s_county');
            $result = $shop->where($data)->save($data2);
            //var_dump($result);exit;
            if ($result) {
                $data1['state'] = 1;
            } else {
                $data1['state'] = 0;
            }
            //}			
            echo json_encode($data1);
        } else {
            
            $count = $shop->where($data)->count();
            if ($count == 0 && $rs['grand'] == 6) {
                $res = $shop->add($data);
				$this->display();
            }else{
                $list = $shop->where($data)->find();
                $this->assign('show', $list);
                $this->display();
                
            }
        }
          $data1['state'] = 2;
    }
	//商店名称唯一检测
  function checkshop(){
	  quanx('gshop');
	  $name=I('post.shop_name');
	  if($name){
		  $rsname=M('shop_config')->where("shop_name='$name'")->count();
		  if($rsname>0){
			 //$data['status']=1 
			 $this->ajaxReturn(array('info'=>1,'msg'=>'<span style="color:#c09853;"> [ 该店铺名已经存在，请选择别的名称！ ]</span>'), 'JSON');
                         
		  }else{
			  $this->ajaxReturn(array('info'=>2,'msg'=>'<span style="color:#c09853;"> [ 该店铺名可以注册！ ]</span>'), 'JSON');
		  }
	  }
  }
  //商店的导航列表页面
    public function navshop(){
        quanx('gshop');
        $aid=$_SESSION['USER'];
        $navshop=M('Category')->where("admin_id='$aid' and ctype=1")->select();
        if($navshop){
           $this->assign('navshop',$navshop); 
       }else{
           $this->error('请添加店铺导航');
       }
        
        $this->display();

    }

    //商品的导航修改
    public function upcate(){
        quanx('gshop');
        $cid=I('post.id');
        $result=M('category')->where("cat_id='$cid'")->save($_POST);
        if($result){
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

}

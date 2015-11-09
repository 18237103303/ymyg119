<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
namespace Home\Controller;
use Think\Controller;

class UserController extends PublicController {
	
    public function Index(){
		$this->assign('current','index');
        $this->display();
    }
	
	/** 用户找回密码 **/
	public function Getpsd(){
		$this->assign('current','getpsd');
		$step=I('get.step');
		if($step==1){
			$this->display('getpsd1');
		}elseif($step==2){
			$this->display('getpsd2');
		}else{
			$this->display();
		}
		
	}
	/** 修改用户头像 **/
	public function EditPic(){
		
		$this->display();
	}
	/** 修改密码 **/
	public function ChangePsd(){
		$this->assign('current','changepsd');
		$this->display();
	}
	
	/** 我的积分展示 **/
	public function Integral(){
		$this->assign('current','integral');
		$this->display();
	}	
	public function Award(){
		$this->assign('current','award');
		$this->display();
	}
	/** 我的收藏展示 **/
	public function Collect(){
		$this->assign('current','collect');
		$this->display();
	}
	
	/**我的代金券信息查看**/
	public function Cooper(){
		$this->assign('current','cooper');
		$this->display();
	}
	/** 申请退货或者换货 **/
	public function Apply(){
		$this->display();
	}
	
	/**售后列表管理**/
	public function Server(){
		$this->assign('current','server');
		$this->display();
	}
	
	/**售后详情查看**/
	public function Serverxq(){
		$status=I('get.status');
		$this->assign('status',$status);
		$this->assign('current','server');
		$this->display();
	}
	
}

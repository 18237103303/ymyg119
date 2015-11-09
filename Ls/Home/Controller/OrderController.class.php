<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 
namespace Home\Controller;
use Think\Controller;

class OrderController extends PublicController {
	
	/**我的订单管理**/
	public function Order(){
		$status=I('get.status');
		if($status==1){
			$this->assign('current','pay');
			$this->display('Orderpay');
		}elseif($status==2){
			$this->assign('current','fh');
			$this->display('Orderfh');
		}elseif($status==3){
			$this->assign('current','com');
			$this->display('Ordercom');
		}elseif($status==4){
			$this->assign('current','done');
			$this->display('Orderdone');
		}else{
			$this->assign('current','all');
			$this->display();
		}
	}
	
	/**订单详情**/
	public function Orderdetail(){
		$status=I('get.status');
		$this->assign('status',$status);
		if($status==1){
			$this->assign('current','pay');
		}elseif($status==2){
			$this->assign('current','fh');
		}elseif($status==3){
			$this->assign('current','com');
		}elseif($status==4){
			$this->assign('current','done');
		}else{
			$this->assign('current','all');
		}
		$this->display();
	}
	
	/** 我的订单评价列表 **/
	public function Comment(){
		$this->assign('current','comment');
		$this->display();
	}
	
	/** 添加订单评价 **/
	public function Addcom(){
		$this->display();
	}
	
	/**提交订单**/
	public function Addorder(){
		$step=I('get.step');
		$this->assign('step',$step);
		$this->display();
	}
	
	
}

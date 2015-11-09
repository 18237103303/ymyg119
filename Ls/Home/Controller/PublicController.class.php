<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;

class PublicController extends Controller {
	
	public function _initialize(){
		//获取网站底部的文章信息
		$article=D('Arctype')->getAllinfos();
		$this->assign('article',$article);
		//获取网站底部的友情链接
		$links=D('friend_link')->field('link_name,link_url')->select();
		$this->assign('links',$links);
		//获取网站底部的版权信息
		
	}
	
	public function Header(){
		
	}
	public function Footer(){
		
	}
	public function Login(){
		$this->display();
	}
	public function Register(){
		
		$this->display();
	}
}

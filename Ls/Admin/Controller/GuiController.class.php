<?php
namespace Admin\Controller;
use Think\Controller;
class GuiController extends PublicController {
    public function config(){
	//主页示例页面
		$this->display();
		
	}
	//列表页示例页面
	public function layout(){
		
		$this->display();
		
	}

}
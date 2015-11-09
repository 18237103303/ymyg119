<?php

// +----------------------------------------------------------------------
// |[ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) All rights reserved.
// +----------------------------------------------------------------------
// | Author: wangdan <962684871@qq.com>
// +----------------------------------------------------------------------
namespace Home\Controller;
use Home\Controller\PublicController;
class ArticleController extends PublicController {
	
	public function Detail(){
		$type_id=I('get.type_id');
		
		//获取指定栏目的名称
		$name=D('arctype')->getName($type_id);
		$this->assign('current',$name);
		
		//获取文章的详细信息
		$res=D('Article')->arcdetail($type_id);
		$this->assign('arcinfo',$res);
		
		$this->display();
	}
	
}

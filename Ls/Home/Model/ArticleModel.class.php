<?php

// +----------------------------------------------------------------------
// |[ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) All rights reserved.
// +----------------------------------------------------------------------
// | Author: wangdan <962684871@qq.com>
// +----------------------------------------------------------------------
namespace Home\Model;
use Think\Model;

class ArticleModel extends Model {
	
	public function arcdetail($type_id){
		$res=$this->where("type_id='$type_id'")->field('arc_title,content,pubtime')->limit('arc_id desc')->find();
		return $res;
		
	}
}

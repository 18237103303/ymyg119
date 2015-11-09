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
class ArctypeModel extends Model {
	
	//获取指定分类的分类名称
	public function getName($id){
		$name=$this->where("type_id='$id'")->getField('type_name');
		return $name;
	}
	
	//获取所有的分类信息
	public function getAllinfos(){
		$arcs=$this->where('pid=0')->field("type_id,type_name")->order('type_id desc')->select();
		foreach($arcs as $key=>$val){
			$arcs[$key]['info']=$this->where("pid='".$val['type_id']."'")->field('type_id,type_name')->select();
		}
		return $arcs;
	}
   
	
}

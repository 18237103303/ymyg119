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

class CategoryController extends PublicController{
    public function index() {
        quanx("gcate");
        $cate=M('Category');
        $data=$cate->where("ctype=0")->order("cat_id  desc")->select();
        $expland=array();
        foreach($data as $k=>$v){
            $data[$k]['s_t']=$v['sort'];
            //查找顶级分类
            if(empty($v['parent_id'])){
                $expland[$k]=$v['cat_id'];
            }
        }
        $data=json_encode($data);
        $expland=json_encode($expland);
        
      $this->assign('data',$data);
      $this->assign('ids',$expland);
      
      $this->display();
    }

    public function addcate(){
        quanx("gcate");
        $cate=M("Category");
        $uid= session('USER');
        $_POST['admin_id']=$uid;
        $_POST['ctype']=0;
        $result=$cate->add($_POST);
        if($result){
               $data['status']=1;
            }else{
               $data['status']=0;
            }
            echo json_encode($data);
        
    }
    //添加下级分类
     public function addcate_child(){
        quanx("gcate");
        $cate=M("Category");
        $uid= session('USER');
        $pid=$_POST['pid'];
        $c_data=$cate->where("cat_id=$pid")->select();
        $group_id=$c_data[0]['group_id'];
        $path=$pid.'-'.$c_data[0]['path'];
        $_POST['group_id']=$group_id;
        $_POST['path']=$path;
        $_POST['admin_id']=$uid;
        $_POST['ctype']=0;
        $result=$cate->add($_POST);
            if($result){
               $data['status']=1;
            }else{
               $data['status']=0;
            }
            echo json_encode($data);
    }
    //编辑
    public function editcate(){
        quanx("gcate");
        $cate=M("Category");
        
        $id=$_POST['cat_id'];
        $cate->cat_id=$id;
        $cate->cat_name=$_POST['cat_name'];
        $cate->sort=$_POST['sort'];
        $cate->keywords=$_POST['keywords'];
        $cate->description=$_POST['description'];
        $cate->ctype=0;
       
        $result=$cate->save();
        if($result){
               $data['status']=1;
            }else{
               $data['status']=0;
            }
            echo json_encode($data);
    }
    public function deletecate(){
        quanx("gcate");
        $sys=M('Category');
        $pid=$_POST['id'];
        $sub=$this->getChildren($pid);
            if(empty($sub)){
                $sub=array($pid);
            }else{
               array_push($sub, $pid);
            }
            foreach ($sub as $key => $value) {
                $sys->delete($value);
            }
            echo json_encode(array('info'=>1));
    }
    public function getChildren($id) {
        if (intval($id) === 0) {
            return null;
        } else {
            $cate = M('Category');
            $_sub=$cate->where("pid=$id")->select();
            if (empty($_sub))
                return array();
            $sub = array();
            foreach ($_sub as $k => $v) {
                array_push($sub, $v['cat_id']);
                $sub = array_merge($sub, $this->getChildren($v['cat_id']));
            }
            return $sub;
        }
    }
}

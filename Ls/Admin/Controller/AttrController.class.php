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

class AttrController extends PublicController{
    public function index() {
        quanx("gcate");
        $cate=M('goods_attr_over');
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
    /*属性区域*/

    public function addcate(){
        quanx("gcate");
        $cate=M("goods_attr_over");
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
        $cate=M("goods_attr_over");
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
        $cate=M("goods_attr_over");
        
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
        $sys=M('goods_attr_over');
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
            $cate = M('goods_attr_over');
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
    /*增加属性组*/
    public function grand(){
        $idd=I('id')?:'';
        if($idd){
           $zhi=I('zhi');$zhi2='';
            $zhi1=explode('|',$zhi);
            if($zhi1[1]){
              $num=count($zhi1)-1;
                for($i=0;$i<$num;$i++){
                    $zhi2.=$zhi1[$i].'|';
                }
            }else{$zhi2=$zhi1[0];}
            $data['rules']=$zhi2;
            $abc= M("category")->where("cat_id=$idd")->save($data);
            if($abc>0){$dat['info']=1;}else{$dat['info']=0;}
            echo json_encode($dat);
            exit;
        }
        $uid=session('USER');
        $rules=M("goods_attr_over")->where("pid=0 and admin_id=$uid")->field('cat_name,cat_id')->select();
        $i='';$i1=0;$arr=array();
        //第一层数据的组装
        $rows=M('category')->where("admin_id=$uid")->select();
        foreach($rows as &$vvv){
            $zhiz=$vvv['rules'];
            if($zhiz){
                $gz= explode('|',$zhiz);
                if($gz[1]){
					//$arr=null;
					foreach($gz as $vvv1){
						if($vvv1){
							$arr[]=Aname($vvv1);
						}
					}
					$vvv['rules1']=join("-",$arr);
				}else{
					$vvv['rules1'] =Aname($gz[0]);
				}
            }
			 unset($arr);
        }
       
            //出类型
    foreach($rules as $k=>$a){
            $i.='<div class="panel-heading"><h3 class="panel-title"><input class="icheck"  type="radio" value="'.$a['cat_id'].'" id="'.$i1.'"><label for="'.$i1.'">'.$a['cat_name'].'</label></h3></div>';
            $i1++;
        }		
		/*龙备份
		foreach($rules as $k=>$a){
			$twoid=$a['cat_id'];
			$tworules=M('goods_attr_over')->where("parent_id='$twoid'")->select();			
			$i.='<div class="panel-heading"><h3 class="panel-title"><label for="'.$i1.'"><input class="icheck"  type="checkbox" value="'.$a['cat_id'].'" id="'.$i1.'" name="one[]">'.$a['cat_name'];
			
			foreach($tworules as $kt=>$b){				
            $i.='<div class="panel-heading"><h3 class="panel-title"><input class="icheck"  type="radio" value="'.$b['cat_id'].'" id="'.$i1.'" name="one'.$a['cat_id'].'"><label for="'.$i1.'">'.$b['cat_name'].'</label></h3></div>';
            $i1++;
			}
			$i.='</label></h3></div>';			
        }*/	
        $this->assign('rows',$rows);
        /*属性调取*/
        $this->assign('i',$i);
        $this->display('grand');
    }
    /*删除属性内容*/
    public function dorp($id){
        $data['rules']='';
        M('category')->where("cat_id=$id")->save($data);
        $this->grand();
    }

}
<?php
namespace Admin\Controller;
use Think\Controller;
class AuthController extends PublicController {
	public function index(){
//        qx_amdin('quanxian');
		$name=I('name');
		$beiz=I('beiz');
		$asd=I('yc');
		$id=I('id');
		if($id&&$asd=='asa'){
			//对权限做出整改
		$quax_rows=M('auth_access')->where('status=1')->select();
		$quanx_jues=M('auth_group')->where('id='.$id)->field('rules')->find();
		//获得要选中的
		//自己的
		$quanx_jues1=explode(',',$quanx_jues['rules']);
		foreach($quax_rows as &$quanx_rows2){
			if($quanx_jues1[0]!=''){
			in_array($quanx_rows2['id'],$quanx_jues1)?$quanx_rows2['checked']='checked':$quanx_rows2['checked']='';
			if($qunax_rows2['id']==$quanx_jues['rules']){$quanx_rows2['checked']='checked';}
			}else{
			$quanx_rows2['checked']='';	
			}
		}
		unset($quanx_rows2);
		
				$this->assign('quax_rows',$quax_rows);
				$this->assign('id',$id);
				$this->display('auth');
		}else{
			if($id&&$asd=='ass'){
			$zhi['status']=-1;	
			M('auth_group')->where('id='.$id)->data($zhi)->save();
			}
			if($name&&$beiz&&$asd=='asd'){
				$group=M('auth_group');
				$date['title']=$name;
				$date['comment']=$beiz;
				if($group->create($date)){   
				$group->add();  
				}
			}
			$rows=M('auth_group')->where('status=1 and id!=99')->select();
			$kk=0;
			foreach($rows as &$row){
				$rules= $row['rules'];
				$rules1=explode(',',$rules);
				$rules4=array();$k=0;
				foreach($rules1 as $k=>$rules2){
				if($rules2==null){$rules4='';}
				if(!is_array($rules2)&&$rules2){
				$where['status']=1;
				$where['id']=$rules2;				
				$rules3=M('auth_access')->where($where)->find();
				if(count($rules3)>0){
				$rules4[$k]=$rules3['title'];
				}
				}				
				}
				$rules5=implode(',',$rules4);
				 $row['quanx']=$rules5;
			}
			unset($row);
			$this->assign('rows',$rows);
			$this->display();
		}
	}
	public function indexexe(){
//        qx_amdin('quanxian');
		$zhi=I('xz');
		$id=I('id');
		$zhi1=substr($zhi,1,strlen($zhi));		
		$zhi2['rules']=$zhi1;
		$status= M('auth_group')->where("id=$id")->save($zhi2);
		$status1=$status?$status:-1;
		echo $status1;
	}
	
	public function grand(){
//        qx_amdin('quanxian');
	//区分角色输出
   $pt_user= M('user')->where('grand=0')->field('id,name')->select();

   $fz_user= M('user')->where('grand=3')->field('id,name')->select();

   $ps_user= M('user')->where('grand=7')->field('id,name')->select();
   
   $xx_user= M('user')->where('grand=8')->field('id,name')->select();

   $cw_user= M('user')->where('grand=8')->field('id,name')->select();

   $kf_user= M('user')->where('grand=8')->field('id,name')->select();


   $this->assign('pt_user',$pt_user);
   $this->assign('fz_user',$fz_user);
   $this->assign('ps_user',$ps_user);
   $this->assign('xx_user',$xx_user);
   $this->assign('cw_user',$cw_user);
   $this->assign('kf_user',$kf_user);


   $this->display();
	}
	
	public function create(){
		$this->display();
		
	}

}
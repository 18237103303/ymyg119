<?php
namespace Admin\Controller;
use Think\Controller;
class NavController extends PublicController {

	//导航添加
	public function addnav(){
		
		 	$this->display();

		

	}

	//导航列表
	public function navlist(){
		if($_POST['sortid']==1){

		 $page = I('page')? : 1;
		$count=M("ads")->count();
		$rpage = Page($count,8,$page);
        $rpage1=$rpage['page_l'];
        $rpage2=$rpage['page_r'];
		$nav=M('navigation')->limit("$rpage1,$rpage2")->order('sort asc')->select();
		$this->assign('nav',$nav);
		$this->assign('link',$rpage['page']);
		$this->display();

		}else{
	    $page = I('page')? : 1;
		$count=M("ads")->count();
		$rpage = Page($count,8,$page);
        $rpage1=$rpage['page_l'];
        $rpage2=$rpage['page_r'];
		$nav=M('navigation')->limit("$rpage1,$rpage2")->select();
		$this->assign('nav',$nav);
		$this->assign('link',$rpage['page']);
		$this->display();
		}
	}

	//导航排序
	public function navsort(){

		$id=$_POST['id'];
		$result=M('navigation')->where("id='$id'")->setField("sort",$_POST['sort']);
		if($result){
			$data['info']=1;
            }else{
            $data['info']=0;
		}
        echo json_encode($data);
	}


	//导航修改
    public function updatenav(){
    	if(!empty($_POST)){
    		$id=$_POST['id'];
    		$result=M('navigation')->where("id='$id'")->save($_POST);
    		if($result){
    			$this->redirect("navlist");
    		}else{
    			$this->error('修改失败');
                            //var_dump(123);
    		}

    	}else{
    		$id=$_GET['id'];
    		$result=M('navigation')->where("id='$id'")->find();
    		$this->assign('result',$result);
    		$this->display();
    	}
    }

    //导航删除
	public function navdelete(){
		$id=$_GET['id'];
		$result=M('navigation')->where("id='$id'")->delete();
		if($result){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
	public function add_nav(){
		
		$data=I('post.');
		
	  $result=M('navigation')->add($data);
	  if($result){
	  	$this->redirect('navlist');
	  }else{
	  	$this->error();
	  }

			
	}

}

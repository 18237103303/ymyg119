<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends PublicController {
    public function index(){
	//主页示例页面
        //查询订单配货的数量
        $order=M("OrderInfo");
        $p=$order->where("order_status=0")->count();
        $this->assign('p_num',$p);
        //查询订单退货的数量
        $t=$order->where('order_status=2')->count();
        $this->assign('t_num',$t);
        //查询已完成的数量
        $f=$order->where('order_status=4')->count();
        $this->assign('f_num',$f);
	$this->display();
                
		
	}
	//列表页示例页面
	public function listv(){
		
		$this->display();
		
	}
	//添加页示例页面
	public function create(){
		
		$this->display();
		
	}
	public function wuxianClass(){
		
		$this->display();
		
	}
	public function createdo(){
		
		    $upload = new \Think\Upload();// 实例化上传类
			$upload->maxSize   =     3145728 ;// 设置附件上传大小
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
			$upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
			$upload->savePath  =     'admin/'; // 设置附件上传（子）目录
			$upload->saveName  = array('uniqid',time().'_'.mt_rand());
			// 上传文件 
			$info   =   $upload->upload();
			if(!$info) {// 上传错误提示错误信息
				$this->ajaxReturn($upload->getError());
			}else{// 上传成功入库
				/* foreach($info as $file){
					echo $file['savepath'].$file['savename'];
				} */
			
			echo $info["fileList"]["savepath"].$info["fileList"]['savename'];	
			}
		
		
	}
	//baidu编辑器
	public function ueditor(){
        $data = new \Org\Util\Ueditor();
        echo $data->output();
    }
}
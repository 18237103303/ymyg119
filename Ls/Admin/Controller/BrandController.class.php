<?php

namespace Admin\Controller;

use Think\Controller;

class BrandController extends PublicController {

    public function index() {
        quanx('qbrand');
		$fzid=$_SESSION['USER'];
        $page = I('page')? : 1;
        $count = M("brand")->where("fz_id='$fzid'")->count();
        $rpage = Page($count, 5, $page);
        $rpage1 = $rpage['page_l'];
        $rpage2 = $rpage['page_r'];
        $brand = M('brand');
        $sql="select * from __PREFIX__brand as b,__PREFIX__goods_group as g where b.group_id=g.id and b.fz_id='$fzid' order by  b.brand_id  desc limit $rpage1,$rpage2";
        $list = $brand->query($sql);
        $this->assign('list', $list);
        $count = $brand->count();
        $this->assign('page', $rpage['page']);

        $this->assign('url_here', '品牌管理');
        $this->display();
    }

    //添加品牌
    public function add() {
        quanx('qbrand');
        if (I('post.')) {
            $data = I('post.');
            //dump($data);
            //dump($_FILES['brand_logo']);
            //处理上传图片
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728; // 设置附件上传大小    
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->rootPath = './Uploads/';
            $upload->savePath = 'brand/'; // 设置附件上传目录   
            // 上传单个文件       
            $info = $upload->upload();
            //添加数据
            $data = I('post.');
			$data['fz_id']=$_SESSION['USER'];
            if (!$info) {
                $data['brand_logo'] = '';
            } else {
                $data['brand_logo'] = $info['brand_logo']['savepath'] . $info['brand_logo']['savename'];
            }
            if (M('brand')->create($data)) {
                M('brand')->add();
                $this->redirect('Brand/index');
            } else {
                $this->error('error');
            }
        }
        $this->display();
    }

    //修改品牌信息
    public function edit() {
        quanx('qbrand');
        $data['brand_id'] = I('get.id');
        //根据id获得相应的记录
       
        $arr = M('Brand')->where($data)->find();
         
        //判断接受过来的post数组
        if (I('post.')) {
            //处理上传的照片
            if(I("post.brand_logo")){
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728; // 设置附件上传大小    
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->rootPath = './Uploads/';
            $upload->savePath = 'brand/'; // 设置附件上传目录      
            $info = $upload->upload();
            if (!$info) {
                // 上传错误提示错误信息       
                $this->error($upload->getError());
            }else{
               $data['brand_logo'] = $info['brand_logo']['savepath'] . $info['brand_logo']['savename']; 
            }
            }
            $data = I('post.');
            
            if (M('brand')->save($data)) {
                    $this->redirect('Brand/index');
            } else {
                    $this->error('error');
                }
            
        }
        $this->assign('arr', $arr);
       
        $this->display();
    }

    //删除信息
    public function delete() {
        quanx('qbrand');
        $id = I('get.id');
        //判断商品表里是否有商品的brand_id
        $smp['brand_id'] = $id;
        $data = M('goods')->where($smp)->select();
        if ($data) {
            $this->error('该品牌下有商品，请更改后再删除');
        } else {
            $str = M('brand')->where($smp)->delete();
            if ($str) {
                $this->redirect('Brand/index');
            } else {
                $this->error('删除失败');
            }
        }
    }

}

<?php

namespace Admin\Controller;
use Think\Controller;

class AdController extends PublicController {

    //广告位置页面
    public function adposition() {
        quanx('adpos');
        $page = I('page')? : 1;
        $count = M("adposition")->count();
        $rpage = Page($count, 8, $page);
        $rpage1 = $rpage['page_l'];
//        dump($rpage1);
        $rpage2 = $rpage['page_r'];
//        dump($rpage2);
        $position = M('adposition')->limit("$rpage1,$rpage2")->select();
        $this->assign('link', $rpage['page']);
        $this->assign('position', $position);
        $this->display();
    }

    //广告位置添加
    public function adposadd() {
        // var_dump($_POST);exit;
        $_POST['admin_id']=$_SESSION['USER'];
        $result = M('adposition')->add($_POST);
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    //广告位置修改
    public function updateadpos() {
        quanx('adpos');
        $id = $_POST['id'];
        $result = M('adposition')->where("position_id='$id'")->save($_POST);
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    /* //删除广告

    public function delad(){

        $id=I('post.id');
         $result = M('adposition')->where("position_id='$id'")->delete();
         if ($result) {
                $msg['status']=1;
            } else {
                $msg['status']=0;
            }

            $this->ajaxReturn($msg);
    } */
    //广告位置删除
    public function adposdel() {
        quanx('adpos');
        $id = $_GET['id'];
        $date = M('ads')->where("position_id='$id'")->count();
        if ($date == 0) {
            $result = M('adposition')->where("position_id='$id'")->delete();
            if ($result) {
                $this->success('删除成功');
            } else {
                $this->error('删除失败');
            }
        } else {
            $this->error('该位置下有广告，请先把广告删除');
        }
    }

    //广告详情列表
    public function adsindex() {
        quanx('ads');
        $admin_id=$_SESSION['USER'];
        $user=M('user')->where("id='$admin_id'")->find();
        $grand=$user['grand'];
        if($grand==99){
            $page = I('page')? : 1;
            $count = M("ads")->count();
            $rpage = Page($count, 15, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];

            $result = M('ads')->order("id desc")->limit("$rpage1,$rpage2")->select();

        }else{
            $admin_id=$_SESSION['USER'];
            $page = I('page')? : 1;
            $count = M("ads")->where("admin_id='$admin_id'")->count();
            $rpage = Page($count, 15, $page);
            $rpage1 = $rpage['page_l'];
            $rpage2 = $rpage['page_r'];

            $result = M('ads')->where("admin_id='$admin_id'")->order("id desc")->limit("$rpage1,$rpage2")->select();
        }
        $date = array();
        foreach ($result as $v) {
            $id = $v['position_id'];
            // $nid = $v['nav_id'];
            // $nav=M('goods_group')->where("id='$nid'")->find();
            // $v['nav_name']=$nav['navtype'];
            $pos = M('adposition')->where("position_id='$id'")->find();
            $v['position_id'] = $pos['position_name'];
            $date[] = $v;
        }
        $this->assign('result', $date);
        $this->assign('link', $rpage['page']);
        $this->display();
    }

    //广告详情添加
    public function adsadd() {
        quanx('ads');
        $position_name = M('adposition')->order('position_id asc')->field("position_name")->select();
        $this->assign('position_name',$position_name);
        if (!empty($_POST)) {

            if ($_FILES['ad_code']['error'] === 0) {
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg', 'swf', 'avi', 'flv');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
                $upload->savePath  =     './ads/'; // 设置附件上传（子）目录

                // 上传文件
                $info   =   $upload->upload();
                if(!$info) {
                    $this->error($upload->getError());
                }else{
                    foreach($info as $file){
                        $path=$file['savepath'].$file['savename'];
                    }

                    $_POST['ad_code'] = $path;

                    $_POST['admin_id']=$_SESSION['USER'];
                    $result = M('ads')->add($_POST);
                    if ($result) {

                        $this->success('添加成功',U("Ad/adsindex"),2);
                    } else {

                        $this->error('添加失败');
                    }

                }
            } else {
                $_POST['admin_id']=$_SESSION['USER'];
                $result = M('ads')->add($_POST);
                if ($result) {
                    $this->success('添加成功',U("Ad/adsindex"),2);
                } else {

                    $this->error('添加失败');
                }
            }
        }  else {
            $aid=$_SESSION['USER'];
            $user=M('user')->where("id='$aid'")->field('grand')->find();
            $grand=$user['grand'];
            switch ($grand){
                case 6:
                    $position = M('adposition')->where("ads_type=1")->select();
                    break;
                case 3:
                    $position = M('adposition')->where("ads_type=0")->select();
                    break;
                case 99:
                    $position = M('adposition')->where("ads_type=2")->select();
                    break;
            }
            $this->assign('position', $position);
            $this->display();
        }
    }

    //广告详情修改
    public function adsupdate() {
        quanx('ads');
        $position_name = M('adposition')->order('position_id asc')->field("position_id,position_name")->select();
        $this->assign('position_name',$position_name);
        if (!empty($_POST)) {
            $id=$_POST['id'];
            if (!empty($_FILES['ad_code'])) {

                if ($_FILES['ad_code']['error'] === 0) {

                    $upload = new \Think\Upload();
                    $upload->maxSize = 3145728;
                    $upload->exts = array('jpg', 'gif', 'png', 'jpeg', 'swf', 'avi', 'flv');
                    $upload->savePath = './ads/';

                    $info = $upload->upload();
                    if (!$info) {
                        $this->error($upload->getError());
                    } else {
                        foreach ($info as $file) {
                            $imgpath = $file['savepath'];
                            $imgname = $file['savename'];
                            $path = $file['savepath'] . $file['savename'];
                        }
                        $_POST['ad_code'] = $path;
                        $result = M('ads')->where('id=%d', $_POST['id'])->save($_POST);
                        if ($result) {
                            $this->success('修改成功',U("Ad/adsindex"),2);
                        } else {
                            $this->error('修改失败');
                        }
                    }
                } else {

                    $result = M('ads')->where('id=%d', $_POST['id'])->save($_POST);
                    // dump($result);
                    //  exit;
                    if ($result) {
                        $this->redirect('adsindex');
                    } else {

                        $this->error('修改失败');
                    }
                }
            } else {

                $result = M('ads')->where('id=%d', $_POST['id'])->save($_POST);
                if ($result) {
                    $this->success('修改成功',U("Ad/adsindex"),2);
                } else {
                    $this->error('修改失败');
                }
            }
        } else {
            $id = $_GET['id'];
            $date = M('ads')->where("id='$id'")->find();
            $pid = $date['position_id'];
            $pos = M('adposition')->where("position_id='$pid'")->find();
            $date['positionid'] = $pos['position_name'];
            $this->assign('date', $date);
            $aid=$_SESSION['USER'];
            $user=M('user')->where("id='$aid'")->field('grand')->find();
            $grand=$user['grand'];
            switch ($grand){
                case 6:
                    $position = M('adposition')->where("ads_type=1")->select();
                    break;
                case 3:
                    $position = M('adposition')->where("ads_type=0")->select();
                    break;
                case 99:
                    $position = M('adposition')->where("ads_type=0")->select();
                    break;
            }
            $this->assign('position', $position);
            $this->display();
        }
    }

    //广告详情删除
    public function adsdelete() {
        quanx('ads');
        $id = $_GET['id'];
        $result = M('ads')->where("id='$id'")->delete();
        if ($result) {
            $this->success('修改成功',U("Ad/adsindex"),2);
        } else {
            $this->error('删除失败');
        }
    }

}

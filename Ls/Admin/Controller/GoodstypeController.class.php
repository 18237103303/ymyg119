<?php

namespace Admin\Controller;

use Think\Controller;

class GoodstypeController extends PublicController {

    //商品类型管理
    public function gtype() {
        quanx('gattr');
        $page = I('page')? : 1;
        $count = M("goods_type")->count();
        $rpage = Page($count, 6, $page);
        $rpage1 = $rpage['page_l'];
        $rpage2 = $rpage['page_r'];
        $gtypelist = M('goods_type')->order("type_id desc")->limit("$rpage1,$rpage2")->select();
        $this->assign('list', $gtypelist);
        $this->assign('page', $rpage['page']);



        $this->display();
    }

    public function gtypeadd() {

        $this->display();
    }

    public function gtypedoadd() {
        quanx('adattr');
        $typedata['type_name'] = $_POST['name'];

        $resdata = M('goods_type')->add($typedata);

        if ($resdata > 0) {
            $data['status'] = 1;
            //$this->success('成功！','gtype');
        } else {
            $data['status'] = 0;
            //$this->error('失败！');
        }
        echo json_encode($data);
    }

    public function gtypedelete() {
        quanx('adattr');
        //删除类型属性表
        $whereatt['cat_id'] = $_GET['id'];
        $gtyattres = M(goods_attribute)->where($whereatt)->delete();

        $where['type_id'] = $_GET['id'];
        $gtypedelete = M('goods_type')->where($where)->delete();
        if ($gtypedelete > 0) {
            $this->success('删除成功！');
        } else {
            $this->error('删除失败！');
        }
    }

    public function gtypeedit() {
        $where['type_id'] = $_GET['id'];
        $editfind = M('goods_type')->where($where)->find();
        $this->assign('findlist', $editfind);
        $this->display();
    }

    public function gtypeupdate() {
        quanx('adattr');
        $whereupdate['type_id'] = $_POST['id'];

        $updatename['type_name'] = $_POST['type_name'];

        $resultupdate = M('goods_type')->where($whereupdate)->save($updatename);
        if ($resultupdate > 0) {
            $data['status'] = 1;
            //$this->success('更新成功！','gtype');
        } else {
            $data['status'] = 0;
            //$this->error('更新失败！');
        }
        echo json_encode($data);
    }

    public function gtypedeleteall() {
        quanx('attr');
        $where['type_id'] = array('in', $_POST['cName']);

        $checkdelete = M('goods_type')->where($where)->delete();

        if ($checkdelete > 0) {
            $this->success('删除成功！');
        } else {
            $this->error('删除失败！');
        }
    }

    public function gtypeatt() {
        quanx('gattr');
        $where['cat_id'] = $_GET['id'];
        $gtypeattlist = M('goods_attribute')->order('sort_order')->where($where)->select();
        $this->assign('list', $gtypeattlist);
        $this->display();
    }

    public function gtypeattradd() {
        quanx('gattr');
        $where['type_id'] = I('get.id');
        $where['provider_id']=  session("USER");
        $attrselect = M('goods_type')->where($where)->find();
        $this->assign('attrselect', $attrselect);
        $this->display();
    }

    public function gtypeattdoadd() {
        quanx('gattr');
        $uid = session("USER");
        unset($_POST['tname']);
        $gtypedoadd['cat_id'] = $_POST['type'];
        $gtypedoadd['attr_name'] = $_POST['name'];
        $gtypedoadd['attr_input_type'] = $_POST['attr_input_type'];
        //正则判断
        $attr_values = I("post.attr_values");
        preg_match_all("/-/", $attr_values, $match);
        //dump($match[0]);exit();
        if ($match[0]) {

            $this->error("可选值列表不能输入‘-’");
        }
        $gtypedoadd['provider_id'] = $uid;
        $gtypedoadd['attr_values'] = str_replace(" ", "", $_POST['attr_values']);
        //$gtypedoadd['attr_values']=trim($_POST['attr_values']);

        $gtypedoadd['sort_order'] = $_POST['sort'];
        $attraddres = M('goods_attribute')->add($gtypedoadd);
        if ($attraddres > 0) {
            $this->redirect('Goodstype/gtypeatt', array('id' => $_POST['type']));
            //$this->success('添加成功！');	
        } else {
            $this->error('添加失败！');
        }
    }

    public function gtypeattdelete1() {
        quanx('gattr');
        $id = $_GET['id'];
        $pid = I('get.pid');
        $attresult = M('goods_attribute')->where("attr_id='$id'")->delete();
        if ($attresult > 0) {
            $this->redirect('gtypeatt', array('id' => $pid));
        } else {
            $this->error('删除失败！');
        }
    }

    public function gtypeattedit() {
        quanx('gattr');
        $where['attr_id'] = $_GET['id'];
        $attedit1 = M('goods_attribute')->where($where)->find();
        $tid = $attedit1['cat_id'];
        $this->assign('attedit', $attedit1);
        $resulttype = M('goods_type')->where("type_id='$tid'")->select();
        $this->assign('type', $resulttype);
        $this->display();
    }

    public function gtypeattdoedit1() {
        quanx('gattr');
        unset($_POST['tname']);
        $editwhere['attr_id'] = $_POST['keyid'];
        $editdata['cat_id'] = $_POST['type'];
        $editdata['attr_name'] = $_POST['name'];
        $editdata['attr_input_type'] = $_POST['attr_input_type'];
        //$editdata['attr_values']=str_replace("\n",",",$_POST['attr_values']);
        $editdata['attr_values'] = trim($_POST['attr_values']);

        $editdata['sort_order'] = $_POST['sort'];
        $type = $_POST['type'];
        $rsatt = M('goods_attribute')->where($editwhere)->save($editdata);
        if ($rsatt > 0) {
            $this->redirect('Goodstype/gtypeatt', array('id' => $type));
        } else {

            $this->error('编辑失败！');
        }
    }

    public function gtypeattdel() {
        quanx('gattr');
		if(!$_POST['cName']){
            $this->error('你还没有勾选！');
        }
        $where['attr_id'] = array('in', $_POST['cName']);

        $attdelres = M('goods_attribute')->where($where)->delete();

        if ($attdelres > 0) {
            $this->success('删除成功！');
        } else {
            $this->error('删除失败！');
        }
    }

}

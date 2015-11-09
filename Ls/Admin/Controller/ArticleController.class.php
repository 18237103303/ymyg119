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

class ArticleController extends PublicController {

    public function artlist() {
        $art_cate = M("Arctype");
        $data = $art_cate->order("type_id desc")->select();
        $expland = array();
        foreach ($data as $k => $v) {
            $data[$k]['s_t'] = $v['sort'];

            //查找顶级分类
            if (empty($v['parent_id'])) {
                $expland[$k] = $v['type_id'];
                $data[$k]['is_p'] = 1;
            } else {
                $data[$k]['is_p'] = 0;
            }
        }
        $data = json_encode($data);
        //var_dump($data);
        $expland = json_encode($expland);
        $this->assign('data', $data);
        $this->assign('ids', $expland);
        $this->display();
    }

    public function addcate() {
        quanx("article");
        $art_cate = M("Arctype");
        $_POST['type_name']=I("post.type_name");
        $result = $art_cate->add($_POST);
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);

    }

    public function editcate() {
        quanx("article");
        $art_cate = M("Arctype");
        $id = $_POST['type_id'];
        $art_cate->type_id = $id;
        $art_cate->type_name = $_POST['type_name'];
        $art_cate->sort = $_POST['sort'];
        $result = $art_cate->save();
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    public function drop() {
        quanx("article");
        $sys = M('Arctype');
        $pid = $_POST['id'];
        $sub = $this->getChildren($pid);
        if (empty($sub)) {
            $sub = array($pid);
        } else {
            array_push($sub, $pid);
        }
        foreach ($sub as $key => $value) {
            $sys->delete($value);
        }
        echo json_encode(array('info' => 1));
    }

    //删除文章
    public function drop_art() {
        quanx("article");
        $id = $_GET['id'];
        $art_cate = M('Article');
        $art_cate->delete($id);
        $this->redirect('Article/article');
    }

    public function addarticle() {
        quanx("article");
        //添加文章分类
        $art_cate = M('Arctype');
        $cateData = $art_cate->where('pid=0')->select();
        $str = '<select class="form-control" id="sboxit-2"><option value="">请选择</option>';
        foreach ($cateData as $v) {
            $str .= "<option disabled='disabled' value='{$v['type_id']}'>{$v['type_name']}</option>" . $this->getsub($v['type_id']);
        }
        $str .= '</select>';
        //return new Response($str);
        $this->assign('data', $str);
        $this->display();
    }

    public function add_art() {
        quanx("article");
        //添加文章
        $article = M('Article');
        $type_id = I("post.type_id");
        /*  $a_d = $article->where("type_id=$type_id")->find(); */
        //var_dump($a_d);exit();
        /*   if (!$a_d) { */
        $result = $article->data($_POST)->add();
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        /* }else{
            $data['msg']='该分类下的文章已经存在';
        } */
        echo json_encode($data);
    }

    public function getsub($id) {
        quanx("article");
        $art_cate = M('Arctype');
        $cateData = $art_cate->where("pid=$id")->select();
        if (empty($cateData))
            return false;
        $ret = '';
        foreach ($cateData as $k => $v) {
            $num = count(explode('-', $v['path'])) - 1;
            $sp = '';
            for ($i = 0; $i < $num; $i++) {
                $sp.='&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $ret .= "<option value='{$v['type_id']}'>{$sp}|_{$v['type_name']}</option>";
            $sub = $this->getsub($v['type_id']);
            if ($sub !== false) {
                $ret.=$sub;
            }
        }
        return $ret;
    }

    //文章列表
    public function article() {
        quanx("article");
        $article = M('Article');
        $cid = I("get.cid");
        if ($cid) {
            $data = $article->where("type_id=$cid")->select();
        } else {
            $where['type_id']=array('neq',-99);
            $data = $article->where($where)->select();
        }

        foreach ($data as $k => $v) {
            $id = $v['type_id'];
            $cate = M('Arctype');
            $c_data = $cate->where("type_id=$id")->select();
            $data[$k]['type_name'] = $c_data[0]['type_name'];
        }

        //添加文章分类
        $art_cate = M('Arctype');
        $cateData = $art_cate->where('pid=0')->select();
        $str = '<select id="sboxit-2"><option value="">请选择</option>';
        foreach ($cateData as $v) {
            $str .= "<option value='{$v['type_id']}'>{$v['type_name']}</option>" . $this->getsub($v['type_id']);
        }
        $str .= '</select>';

        //return new Response($str);
        $this->assign('str', $str);
        $this->assign('data', $data);
        $this->display();
    }

    //进入编辑页面
    public function edit() {
        quanx("article");
        $article = M('Article');
        $id = $_GET['id'];
        $data = $article->where("arc_id=$id")->select();

        $type_id = $data[0]['type_id'];
        $cate = M('Arctype');
        $c_data = $cate->where("type_id=$type_id")->select();
        $data[0]['type_name'] = $c_data[0]['type_name'];
        //添加文章分类
        $art_cate = M('Arctype');
        $cateData = $art_cate->where('pid=0')->select();
        $str = '<select class="form-control" id="sboxit-2"><option value="' . $type_id . '">' . $c_data[0]['type_name'] . '</option>';
        foreach ($cateData as $v) {
            $str .= "<option value='{$v['type_id']}'>{$v['type_name']}</option>" . $this->getsub($v['type_id']);
        }
        $str .= '</select>';
        $this->assign('str', $str);
        $this->assign('data', $data);
        $this->display();
    }

    //编辑页面点击修改按钮
    public function editarticle() {
        quanx("article");
        $art_cate = M("Article");
        $result = $art_cate->data($_POST)->save();
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        echo json_encode($data);
    }

    //清空文章
    public function delete_all() {
        quanx("article");
        $id = explode('-', substr(trim($_POST['id']), 0, -1));
        $num = count($id);
        for ($i = 0; $i < $num; $i++) {
            $sys = M('Article');
            $sys->delete($id[$i]);
        }
        echo json_encode(array('info' => 1));
    }

    //清空分类
    public function delete_all_cate() {
        quanx("article");
        $id = explode('-', substr(trim($_POST['id']), 0, -1));
        $num = count($id);
        $sub = array();
        for ($i = 0; $i < $num; $i++) {
            $sys = M('Arctype');
            $pid = $id[$i];
            $sub = $this->getChildren($pid);
            if (empty($sub)) {
                $sub = array($pid);
            } else {
                array_push($sub, $pid);
            }
            foreach ($sub as $key => $value) {
                $sys->delete($value);
            }
        }
        echo json_encode(array('info' => 1));
    }

    public function getChildren($id) {
        quanx("article");
        if (intval($id) === 0) {
            return null;
        } else {
            $cate = M('Arctype');
            $_sub = $cate->where("pid=$id")->select();
            if (empty($_sub))
                return array();
            $sub = array();
            foreach ($_sub as $k => $v) {
                array_push($sub, $v['type_id']);
                $sub = array_merge($sub, $this->getChildren($v['type_id']));
            }
            return $sub;
        }
    }
    //发布公告
    public function bulletin(){

        $this->display();
    }
    //公告列表
    public function bulist(){
        $article = M('Article');
        $data = $article->where("type_id=-99")->select();
        $this->assign('data', $data);
        $this->display('bulist');
    }
    //修改公告
    public function editbulist() {
        $article = M('Article');
        $id1=I('get.id');
        if($id1){
            $rows=$article->where("arc_id=$id1")->select();
            $this->assign('data',$rows);
            $this->display();
        }else{
            $id = I('id');
            $data['arc_title'] = I('arc_title');
            $data['content'] = I('content');
            $article->where("arc_id=$id")->save($data);
            echo json_encode(array('status' => 1));
        }
    }
    /*删除公告*/
    public function scgg($id){
        M('Article')->where("arc_id=$id")->delete();
        $this->bulist();
    }
}

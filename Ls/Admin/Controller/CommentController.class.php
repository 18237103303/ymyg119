<?php

namespace Admin\Controller;

use Think\Controller;

class CommentController extends Controller {

    function comment() {
        if (!empty($_POST)) {
            if (!empty($_POST['content'])) {
                $name = $_POST['content'];
                $where['content'] = array('like', '%' . $name . '%');
                $count = M('goods_comment')->where($where)->count();
                $page = new \Think\Page($count, 2);
                $show = $page->show();
                $listcom = M('goods_comment')->order('comment_id desc')->where($where)->limit($page->firstRow . "," . $page->listRow)->select();
            } elseif (!empty($_POST['rank'])) {
                $rank = $_POST['rank'];
                $count = M('goods_comment')->where("comment_rank='$rank'")->count();
                $page = new \Think\Page($count, 2);
                $show = $page->show();
                $listcom = M('goods_comment')->order('comment_id desc')->where("comment_rank='$rank'")->limit($page->firstRow . "," . $page->listRow)->select();
            } else {
                $id = $_POST['id'];
                $count = M('goods_comment')->where("goods_id='$id'")->count();
                $page = new \Think\Page($count, 2);
                $show = $page->show();
                $listcom = M('goods_comment')->order('comment_id desc')->where("goods_id='$id'")->limit($page->firstRow . "," . $page->listRow)->select();
            }
        } else {
            $count = M('goods_comment')->count();
            $page = new \Think\Page($count, 2);
            $show = $page->show();
            $user_id = $_SESSION['USER'];
            $user = M('user')->where("id='$user_id'")->find();
            if ($user['grand'] == 3) {
                $listcom = M('goods_comment')->join('lx_goods ON lx_goods_comment.goods_id=lx_goods.goods_id')->where("lx_goods.user_id='$user_id'")->order('comment_id desc')->limit($page->fistRow . "," . $page->listRow)->select();
            } else if ($user['grand'] == 2) {
                $listcom = M('goods_comment')->join('lx_goods ON lx_goods_comment.goods_id=lx_goods.goods_id')->where("lx_goods.fz_id='$user_id'")->order('comment_id desc')->limit($page->fistRow . "," . $page->listRow)->select();
            }
        }
        $this->assign('pages', $show);
        $this->assign('list', $listcom);
        $this->display();
    }

    function delete() {
        quanx('pshop');
        $id = $_GET['id'];
        $rs = M('goods_comment')->where("comment_id='$id'")->delete();
        if ($rs > 0) {
            $this->redirect('comment');
        } else {
            $this->error('删除失败！');
        }
    }

    function deleteall() {
        quanx('pshop');
        $where['comment_id'] = array('in', $_POST['cName']);
        $alldel = M('goods_comment')->where($where)->delete();
        if ($alldel > 0) {
            $this->redirect('comment');
        } else {
            $this->error('删除失败！');
        }
    }

    function detail() {
        $comment_id = $_GET['id'];
        $rsdetail = M('goods_comment')->where("comment_id='$comment_id'")->find();
        $this->assign('rsdetail', $rsdetail);
        $usid = $rsdetail['goods_id'];
        $udetail = M('goods')->where("goods_id='$usid'")->find();
        $this->assign('uinfo', $udetail);
        $this->display();
    }

}

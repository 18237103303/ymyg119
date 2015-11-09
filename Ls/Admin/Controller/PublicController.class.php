<?php

namespace Admin\Controller;

use Think\Controller;

class PublicController extends Controller {

    function __construct() {
        parent::__construct();
        // session('HTQX',null);
        $HTQX = session('HTQX');
        if ($HTQX != 'xdz') {
            header("Content-type:text/html; charset=utf-8");
            die('进入非法');
            //
        }
    }

    public function error1() {
        layout(false);
        $this->display();
    }

    public function _empty() {
        $this->redirect('Public/error1');
    }
    //获取会员比例
    public function getUser() {
        $config = M("SysConfig");
        $user = $config->where("config_name='MONERY_JF'")->getField("config_value");
        return $user;
    }

}

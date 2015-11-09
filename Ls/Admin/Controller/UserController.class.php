<?php

namespace Admin\Controller;
use Think\Controller;
class UserController extends PublicController {
    /* 会员列表页 */
    public function mlist($type1_1='') {	
        /*进行拓展变形  type 1 配送合作商 2财务 3线下专员  4 普通会员 8 400客服 5停封  加入搜索状态7 */
        $page = I('page')? : 1;
        $type1 = I('type')? : '';
		//进行缓冲带处理 1 2 3 4   7为搜索 6为全部  5是停封
        $type1 == 7 or session('type', $type1);
        $type = $type1 ? $type1 : session('type');
        $type == 6 || $type1_1==6? $type = null : $type = $type;
        /* 详情判断 */
        $xq = I('xq')?:'';//xq详情
        $xq_id = I('xq_id')?:'';
        /*默认状态 进行分站查询*/
        $user= session('USER');
        //xq详情进入口
        if ($xq == 9) {
            //角色
            $js_type = M('user')->where("id=$xq_id")->field('grand')->find();
            $js_type1 = $js_type['grand'];
            //1位普通会员 3财务 4配送合作商 5是线下专员 6是全部
            switch ($js_type1) {
                case 0:$js_type2 = 1;break;
//                case 3:$js_type2 = 2;break;
                case 9:$js_type2 = 3;break;
                case 7:$js_type2 = 4;break;
                case 8:$js_type2 = 5;break;
                case 10:$js_type2 = 6;break;

                default:$js_type2=-9;break;}
            //传入值  进行判断身份 id详情处理
            $this->user_xq(0, $js_type2, $xq_id);
        } else {
//            quanx("yhgl");
            switch ($type) {
                case 1:
                    // echo '配送合作商';
                    $count = M('user')->where("status=1 and grand=7 and user_up=$user")->count();
                    $rpage = Page($count, 9, $page);
                    $rpage1 = $rpage['page_l'];
                    $rpage2 = $rpage['page_r'];
                    $rows = M('user')->where("status=1 and grand=7 and user_up=$user")->limit("$rpage1,$rpage2")->select();
                    break;
                case 2:
                    // echo '财务';
                    $count = M('user')->where("status=1 and grand=9 and user_up=$user")->count();
                    $rpage = Page($count, 9, $page);
                    $rpage1 = $rpage['page_l'];
                    $rpage2 = $rpage['page_r'];
                    $rows = M('user')->where("status=1 and grand=9 and user_up=$user")->limit("$rpage1,$rpage2")->select();
                    break;
                case 3:
                    // echo '线下专员';
                    $count = M('user')->where("status=1 and grand=8 and user_up=$user")->count();
                    $rpage = Page($count, 9, $page);
                    $rpage1 = $rpage['page_l'];
                    $rpage2 = $rpage['page_r'];
                    $rows = M('user')->where("status=1 and grand=8 and user_up=$user")->limit("$rpage1,$rpage2")->select();
                    break;
                case 4:
                    // echo '普通会员';
                    $count = M('user')->where("status=1 and grand=0 and user_up=$user")->count();
                    $rpage = Page($count, 9, $page);
                    $rpage1 = $rpage['page_l'];
                    $rpage2 = $rpage['page_r'];
                    $rows = M('user')->where("status=1 and grand=0 and user_up=$user")->limit("$rpage1,$rpage2")->select();
                    break;
                case 8:
                    // echo '400电话';
                    $count = M('user')->where("status=1 and grand=10 and user_up=$user")->count();
                    $rpage = Page($count, 9, $page);
                    $rpage1 = $rpage['page_l'];
                    $rpage2 = $rpage['page_r'];
                    $rows = M('user')->where("status=1 and grand=10 and user_up=$user")->limit("$rpage1,$rpage2")->select();
                    break;
                case 7:
                    //查询模块                                 ++++++++++++++
                    $cxn = I('cxn');
                    //当做id处理
                    $da_ta['status'] =array(1,2,'or');
                    $da_ta['id'] = $cxn;
                    $da_ta['user_up'] = $user;
                    $count = M('user')->where($da_ta)->count();
                    switch ($count) {
                        case 1:
                            $rpage = Page($count, 9, $page);
                            $rpage1 = $rpage['page_l'];
                            $rpage2 = $rpage['page_r'];
                            $rows = M('user')->where($da_ta)->limit("$rpage1,$rpage2")->select();
                            break;
                        default:
                            $map['name'] = array('like', "%$cxn%");
                            $map['status'] = array(1,2,'or');
                            $map['user_up'] = $user;
                            $count = M('user')->where($map)->count();
                            if ($count > 0) {
                                $rpage = Page($count, 9, $page);
                                $rpage1 = $rpage['page_l'];
                                $rpage2 = $rpage['page_r'];
                                $rows = M('user')->where($map)->limit("$rpage1,$rpage2")->select();
                            }
                            break;
                    }
                    break;
                case 5:
                    // echo '停封';
                    $count = M('user')->where("status=2")->count();
                    $rpage = Page($count, 9, $page);
                    $rpage1 = $rpage['page_l'];
                    $rpage2 = $rpage['page_r'];
                    $rows = M('user')->where("status=2 and user_up=$user")->limit("$rpage1,$rpage2")->select();
                    $this->assign('tf', 'kq');
                    break;
                default:
                    // echo '默认查询状态';
                    $userwhere['status']=1;
                    $userwhere['user_up']=$user;
                    $userwhere['grand']=array('not in',array('99','3'));
                    $count = M('user')->where($userwhere)->order("id desc")->count();
                    $rpage = Page($count, 9, $page);
                    $rpage1 = $rpage['page_l'];
                    $rpage2 = $rpage['page_r'];
                    $rows = M('user')->where($userwhere)->order("id desc")->limit("$rpage1,$rpage2")->select();
                    break;
            }
            $rows = $this->user_xq($rows);
            $this->assign('rows', $rows);
            $this->assign('rpage', $rpage['page']);
            $this->display('mlist');
        }//详情
    }
    /* 会员的操作 2修改 3删除 4停封 5启用 */
    public function userexe() {
        quanx("yhgl");
        $id = I('id');
        $name = I('name');
        $phone = I('phone');
        $email = I('email');
        $jues = I('jues');
        $type = I('type');
        $data = array();
        switch ($type) {
            case 2 :
                $data['name'] = $name;
                $data['phone'] = $phone;
                $data['email'] = $email;
                $data['grand'] = $jues;
                $data1['group_id'] = $jues;
                $data1['uid'] = $id;
                M()->startTrans();
                $a = M('user')->where("id=$id")->save($data);
                //进行组写入
                $a1 = M('auth')->where("uid=$id")->count();
                switch ($a1) {
                    case 1:
                        $a2 = M('auth')->where("uid=$id")->save($data1);
                        break;
                    default:
                        $a3 = M('auth')->data($data1)->add();
                        break;
                }
                if ($a2 || $a3 || $a) {
                    M()->commit();
                    $a = 1;
                } else {
                    M()->rollback();
                    $a = 0;
                }
                $a = $a ? 1 : 0;
                die("$a");
                break;
            case 3:
                $data['status'] = '-1';
                M('user')->where("id=$id")->save($data);
                $this->mlist(6);
//                前一步跳转
//                echo '<script>history.go(-1);</script>';
                break;
            case 4:
                $data['status'] = '2';
                M('user')->where("id=$id")->save($data);
                $this->mlist(6);
                break;
            case 5:
                $data['status'] = '1';
                M('user')->where("id=$id")->save($data);
                $this->mlist(6);
                break;
        }
    }

    /* 详情 是否为详细 type 1位普通会员 2是分站 3是供货商 4是送货员 5是服务网点 */
    /* 第一个属性为数组的传入
     *第二个为角色 第三个为传入的id判断
     * $this->user_xq(0,1,$id);
     */

    public function user_xq($rows = '', $type = '', $id = '') {
        switch ($type) {
            case 1:
                //此为查询的详细  基本信息  送货地址的详情信息
                $id_2['id'] = $id;
                $rows = M('user')->where($id_2)->find();
                $this->assign('row',$rows);
                //地址区域的处理
                $address= $rows['address'];
                $address1=explode('-',$address);
                $this->assign('address',$address1);
                $this->assign('rowss',Name($rows['up_id']));
                $this->display('xiangq');
                //我是谁呢
                break;
            case -9:
                header("Content-type: text/html; charset=utf-8");
                echo '权限没有进行分配无法进行操作';
                break;
            case 3:
                $rows = M('user')->where("id=$id")->find();
                $this->assign('row',$rows);
                $this->display('g_xiangq');
//                echo 'who2 供货商';
                break;
            case 4:
                $id_2['id'] = $id;
                $rows = M('user')->where($id_2)->find();
                $this->assign('row',$rows);
                $this->display('s_xiangq');
//                echo 'who3 送货员';
                break;
            case 5:
                $rows = M('user')->where("id=$id")->find();
                $address= $rows['address'];
                $address1=explode('-',$address);
                $this->assign('address',$address1);
                $this->assign('row',$rows);
                $this->display('w_xiangq');
//              echo '服务网点';
                break;
            default:
                foreach ($rows as &$row) {
                    $id1['id'] = $row['grand'];
                    if ($id1['id']) {
                        $case = M('auth_group')->where($id1)->field('id,title')->find();
                        $row['grand2'] = $case['id'];
                        $row['grand1'] = $case['title'];
                    } else {
                        $row['grand2'] = '0';
                        $row['grand1'] = '--普通会员--';
                    }
                    $select = '<select name="grand"><option checked="checked" value="' . $row['grand2'] . '">' . $row['grand1'] . '</option>';
                    $id4 = $id1['id'];
                    if ($id4) {
//                       优化 把分站和主站考虑入内  把权限剔除
                        $zfyh['id']= array('not in',array('3','99',$id4));
//                        $zfyh['id']   = array('neq',$id4);
                        $rows_1 = M('auth_group')->where($zfyh)->field('title,id')->select();
                    } else {
//                        把普通会员和管理员分离
//                        $rows_1 = M('auth_group')->where("id<>3")->field('title,id')->select();
                        $rows_1=array();
                    }
                    foreach ($rows_1 as $rows_11) {
                        $select.='<option value="' . $rows_11['id'] . '">' . $rows_11['title'] . '</option>';
                    }
                    $select.='</select>';
                    $row['grand'] = $select;
                    switch ($row['status']) {
                        case 1:
                            $row['status'] = '正常';
                            break;
                        case 2:
                            $row['status'] = '停用';
                            break;
                        default:
                            $row['status'] = '未知';
                            break;
                    }
                    $row['l_time'] = date('Y-m-d H/i', $row['l_time']);
                    $id3['id'] = $row['up_id'];
                    $case1 = M('user')->where($id3)->field('name')->find();
                    $row['up_id'] = $case1['name'];
                }
                unset($row);
                return $rows;
                break;
        }
    }

    //新增
    public function user_add() {
        quanx("yhgl");
        $name = I('name');
        $pas = I('pas');
        $type = I('type')? : '';
        /*进行拓展的区域*/
        $wd=I('wd');
        if ($type == 1) {
            $data['name'] = $name;
            $a = M('user')->where($data)->count();
            $a1 = $a ? 1 : 0;
            echo $a1;
        } else {
            header("location:/User/index/adduser/name/$name/pas/$pas/wd/$wd");
        }
    }
    //判断服务网点存在
    public function pdwd(){
        quanx("yhgl");
        $id= I('wdid');
       $where['grand']=8;
        $where['status']=1;
        $where['_query']="id=$id&name=$id&_logic=or";
        $num=M('user')->where($where)->field('id')->find();
        $num1=$num['id']?:-1;
        echo $num1;
    }
    /*开始区域1 */
    //密码修改界面
    public function user_edt(){
        // mm mm1 id
        $mm = I('mm');
        $id = I('id');

    header("location:/User/index/edt/mm/$mm/id/$id");
    }
    //管理员密码修改 1111
    public function admin_edt(){
        // mm mm1 id
        $id = I('zhi');
        $name=Name($id);
        $mm = I('zhi1');
        $yzm= $this->yzm($mm,$name);
        $yzm1=M('user')->where("id=$id")->field('password')->find();
        $yzm2= strcmp($yzm,$yzm1['password']);
        $yzm3=$yzm2==0?1:0;
        echo $yzm3;
    }
    function yzm($data, $key, $expire = 0) {$key  = md5($key);$data = base64_encode($data);$x    = 0;$len  = strlen($data);$l    = strlen($key);$char =  '';for ($i = 0; $i < $len; $i++) {if ($x == $l) $x=0;$char  .= substr($key, $x, 1);$x++;}$str = sprintf('%010d', $expire ? $expire + time() : 0);for ($i = 0; $i < $len; $i++) {$str .= chr(ord(substr($data,$i,1)) + (ord(substr($char,$i,1)))%256);}return str_replace('=', '', base64_encode($str));}
        //    1111
    //    退出
    public function tc(){
        header("location:/User/index/tc");
    }
    //地址区域
    public function diz(){
//user id -aid   addr wwd
        $wwd=I('wwd');
        $data['shr']=I('shr');
        $data['xxxx']=I('xxxx');
        $data['lianxi']=I('phone');
        $data['ts']=I('ts');
        $zt=I('zt')?:9;
        $zt==9?'':$data['status']=I('zt');
        if($wwd){
             $sts= M('user_addrs')->where("id=$wwd")->save($data);
        }
            $id=I('id');
            $rows=M('user_addrs')->where("aid=$id and status!=1")->select();
            $this->assign('id',$id);
            $this->assign('rows',$rows);
            $this->display();
    }
//    订单区域
    public function dingd(){
        $wwd=I('wwd');
        $zt=I('zt')!=null?I('zt'):9;
        $zt==9?'':$data['order_status']=I('zt');
        if($wwd && $zt!=9){
            $sts= M('order_info')->where("order_id=$wwd")->save($data);

        }
//        `order_status`订单状态 `pay_time` 付款时间  `consignee` 收货人  `order_sn` 订单编号  `order_id`订单id  money_paid 金额  lx_order_info表名  integral积分使用状态  更换 金额为arder_amount 支付方式代替积分使用状态
        $id=I('id');
        $rows=M('order_info')->where("user_id=$id")->field('order_status,pay_time,consignee,order_sn,order_id,order_amount,pay_name')->select();
//        var_dump($rows);
        foreach($rows as &$row){
           $row['time']=date('Y/m/d H:i:s',$row['pay_time']);
            switch($row['order_status']){case 0:$row['status']='提交未支付';case 1:$row['status']='配货中';break;case 0:$row['status']='提交未支付';break;case 2:$row['status']='已发货';break;case 3:$row['status']='已取消';break;case 4:$row['status']='退货中';break;case 5:$row['status']='已退货';break;case 6:$row['status']='已完成';break;}
            switch($row['pay_name']){case 2:$row['jf']='是';break;default:$row['jf']='否';break;}}
        unset($row);

        $this->assign('rows',$rows);
        $this->assign('id',$id);
        $this->display();
    }
//积分操作
public function jfexe(){
    $id=I('id');
//`order_status`订单状态 `pay_time` 付款时间 `consignee` 收货人 --  `order_sn` 订单编号   order_amount 金额 lx_order_info表明  pay_name支付方式,profit,利润
    //准备进行积分详细入口
    $type=I('type')?:'';
    switch($type){
        case 'jf':
            $rows=M('order_info')->where("user_id=$id and order_status=6")->field('order_status,pay_time,order_sn,order_id,order_amount,pay_name,profit')->select();
            break;
        case 'dj_jf':
            $data['user_id']=$id;
            $data['order_status']=array(1,2,3,4,5,'or');
            $rows=M('order_info')->where($data)->field('order_status,pay_time,order_sn,order_id,order_amount,pay_name,profit')->select();
            break;
        default:
            $rows=M('order_info')->where("user_id=$id and order_status!=0")->field('order_status,pay_time,order_sn,profit,order_id,order_amount,pay_name')->select();
            break;
    }
    $rows= $this->jf_exe($rows);
    $this->assign('rows',$rows);
//    var_dump($rows);
    $this->display('jf');
}
//    附加函数
private  function jf_exe(array $rows){
    //    准备积分比例
    $rowss=M('sys_config')->where('config_name="MONERY_JF"')->field('config_value')->find();
    $jfbl=$rowss['config_value']/100;
    foreach($rows as &$row){
        $row['time']=date('Y/m/d H:i:s',$row['pay_time']);
        //金钱状态
        switch($row['pay_name']){
            //            积分只是一个展示区域
            case 2:
                switch($row['order_status']){
                    case 6:
                        $row['jf']=$row['profit']*$jfbl;
                        break;
                    case 0:
                        $row['jf']=0;
                        $row['dj_jf']=0;
                        break;
                    default:
                        $row['dj_jf']=$row['profit']*$jfbl;
                        break;
                }
                $row['dj_jf']= $row['dj_jf']?:0;
                $row['jf']=(-$row['jf'])?$row['jf']:0;
                $row['jf_sy']='是';
                break;
          default:
                switch($row['order_status']){
                    case 1:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                        $row['dj_jf']=$row['profit']*$jfbl;
                        break;
                    case 6:
                        $row['jf']=$row['profit']*$jfbl;
                        break;
                }
                $row['dj_jf']= $row['dj_jf']?:0;
                $row['jf']=$row['jf']?:0;
                //金钱状态
                $row['jf_sy']='否';
                break;

        }

    }
    unset($row);
    return $rows;
}

  //分角色进行拓展 `order_sn` 订单编号 `order_id`订单id `agency_id`推荐人id   `order_status`订单状态  `consignee` 收货人  order_amount  总金额 lx_order_info表名
//    佣金部分
public  function  yjexe(){
$type=I('type')?:'';
$id=I('id');
                //            佣金的比例
    switch($type){
        case 'jf':
            $where['shipping_id']=$id;
            $where['order_status']=6;
            $rows=M('order_info')->where($where)->field('order_status,pay_time,consignee,order_sn,order_amount,agency_id,profit,fw_id')->select();
            $rows= $this->yj_exe($rows);
            $this->assign('rows',$rows);
            $this->display('s_yj');
//            echo 'jf';
            break;
        case 'dj_jf':
            $where['shipping_id']=$id;
            $where['order_status']=array(1,2,3,4,5,'or');
            $rows=M('order_info')->where($where)->field('order_status,pay_time,consignee,order_sn,order_amount,agency_id,profit,fw_id')->select();
            $rows= $this->yj_exe($rows);
            $this->assign('rows',$rows);
            $this->display('s_yj');
//            echo 'dj_jf';
            break;
        default:
//        1    定义一个状态查询 佣金的
            $rows=M('order_info')->where("shipping_id=$id")->field('order_status,pay_time,consignee,order_sn,order_amount,profit,agency_id,fw_id')->select();
            $rows= $this->yj_exe($rows);
            $this->assign('rows',$rows);
            $this->display('s_yj');
//            1
            break;
    }
}
//    佣金附加函数
    private function yj_exe(array $rows,$type=''){
        switch($type){
            case 1:
                $rowss=M('sys_config')->where('`config_name`="MONERY_YJ_W"')->field('config_value')->find();
                break;
            case 2:
                $rowss=M('sys_config')->where('`config_name`="MONERY_YJ_G"')->field('config_value')->find();
                break;
            default:
                $rowss=M('sys_config')->where('`config_name`="MONERY_YJ_S"')->field('config_value')->find();
                break;
        }
        $yjbl=$rowss['config_value']/100;
        foreach($rows as &$row) {
            $row['time'] = date('Y/m/d H:i:s', $row['pay_time']);
            switch ($row['order_status']) {case 0:$row['status'] = '提交未支付';break;case 1:$row['status'] = '配货中';break;case 2:$row['status'] = '已发货';break;case 3:$row['status'] = '已取消';break;case 4:$row['status'] = '退货中';break;case 5:$row['status'] = '已退货';break;case 6:$row['status'] = '已完成';break;}
            switch($row['order_status']){case 0:case 2:case 3:case 4:case 5:$row['dj_yj']=$row['profit']*$yjbl;break;case 6:$row['yj']=$row['profit']*$yjbl;break;}
            $row['dj_yj']= $row['dj_yj']?:0;$row['yj']=$row['yj']?:0;$row['fw_id']=$row['fw_id']?:$row['agency_id'];$row['name']=Name($row['fw_id']);
        }
        unset($row);
        return $rows;

    }
//服务网点进行地址修改 联动
public function wddz(){
    if(I('one3')){
        $data['address']= I('one1').'-'.I('one2').'-'.I('one3');
    }else{
        $data['address']= I('one1').'-'.I('one2');
    }
    $id=I('id');
    $num= M('user')->where("id=$id")->save($data);
    if($num==1){}else{$num=$num==0?$num=9:-1;echo $num; }
}
//    网点佣金  未测试
public function wdyj(){
    $type=I('type')?:'';
    $id=I('id');
    //            佣金的比例
    switch($type){
        case 'jf':
            $where['agency_id']=$id;
            $where['order_status']=6;
            $rows=M('order_info')->where($where)->field('order_status,pay_time,consignee,order_sn,shipping_id,profit,pay_name,agency_id')->select();
            $rows= $this->yj_exe($rows,1);
            $this->assign('rows',$rows);
            /*开始第二套*/
            $where1['fw_id']=$id;
            $where1['order_status']=6;
            $rows1=M('order_info')->where($where1)->field('order_status,pay_time,consignee,order_sn,shipping_id,profit,pay_name,agency_id')->select();
            $rows1= $this->yj_exe($rows1,1);
            $this->assign('rows1',$rows1);
            /*开始第二套*/
            $this->display('w_yj');
//            echo 'jf';
            break;
        case 'dj_jf':
            $where['agency_id']=$id;
            $where['order_status']=array(1,2,3,4,5,'or');
            $rows=M('order_info')->where($where)->field('order_status,pay_time,consignee,order_sn,shipping_id,profit,pay_name,agency_id')->select();
            $rows= $this->yj_exe($rows,1);
            $this->assign('rows',$rows);
            /*开始第二套*/
            $where1['fw_id']=$id;
            $where1['order_status']=array(1,2,3,4,5,'or');
            $rows1=M('order_info')->where($where1)->field('order_status,pay_time,consignee,order_sn,shipping_id,profit,pay_name,agency_id')->select();
            $rows1= $this->yj_exe($rows1,1);
            $this->assign('rows1',$rows1);
            /*开始第二套*/
            $this->display('w_yj');
//            echo 'dj_jf';
            break;
        default:
//        1    定义一个状态查询 佣金的
            $rows=M('order_info')->where("agency_id=$id")->field('order_status,pay_time,consignee,order_sn,shipping_id,profit,pay_name,agency_id')->select();
            $rows= $this->yj_exe($rows,1);
            $this->assign('rows',$rows);
            /*开始第二套*/
            $rows1=M('order_info')->where("fw_id=$id")->field('order_status,pay_time,consignee,order_sn,shipping_id,profit,pay_name,agency_id')->select();
            $rows1= $this->yj_exe($rows1,1);
            $this->assign('rows1',$rows1);
            /*开始第二套*/
            $this->display('w_yj');
//            1
            break;
    }
}
//    网点的负责人员
public function wdxj(){
    $id=I('id');
    $user= session('USER');
    $rows = M('user')->where("status=1 and user_up=$user and up_id=$id")->select();
//    11
    foreach ($rows as &$row) {
        switch ($row['status']) {case 1:$row['status'] = '正常';break;case 2:$row['status'] = '停用';break;default:$row['status'] = '未知';break;}
        $row['l_time'] = date('Y-m-d H/i', $row['l_time']);
        switch($row['grand']){case 0:$row['grand']='普通会员';break;default:break;}
    }
    unset($row);
//    11
    $this->assign('rows', $rows);
    $this->display('w_xj');
}
//   供货商开始
//商品列表
public function gh_sp(){
    switch($sp_id=I('sp_id')?:1){
        case 1:
            $id=I('id');
            $rows=M('goods')->where("user_id=$id")->field('goods_id,goods_name')->select();
            foreach($rows as &$v11){
                $spid= $v11['goods_id'];
                $num=M('goods_attr')->where("goods_id=$spid")->sum('goods_count');
                $v11['num']=$num?:0;
            }
            unset($v11);
            $this->assign('rows',$rows);
            $this->display('g_sp');
            break;
            default:
        $rows=M('user_ghs_gn')->where("sp_id=$sp_id")->select();
        foreach($rows as &$v){
            $name=$this->Gname($v['sp_id']);
            $v['name']=$name;
            $v['num']=abs($v['endnum']-$v['startnum']);
            $attr1=$v['goods_attr_id'];
            $attr2= M('goods_attr')->where("id=$attr1")->field('attr_value')->find();
            $v['attr']=$attr2['attr_value'];
        }
        unset($v);
        $this->assign('rows',$rows);
        $this->display('g_kc');
            break;
    }
}
//    供货商订单操作
public function gdd(){
$id=I('id');
    $rows=M('goods')->where("user_id=$id")->field('goods_id')->select();
    $arr=array();$k=0;
    foreach ($rows as $v) {
        $wh['goods_id']=$v['goods_id'];
        $rows1= M('order_goods')->where($wh)->field('goods_name,goods_number,goods_price,order_id')->select();
        $as=array();
        foreach($rows1 as $vv){
            if($as['name']=$vv['goods_name']){
//                echo 1;
            $where1['id']=$vv['order_id'];
            $rows2= M('order_info')->where($where1)->field('pay_time,order_status')->select();
            foreach($rows2 as $vvv){
                switch($vvv['order_status']){
                    case 6:
                        $vv['sy']=$vv['goods_price']*$vv['goods_number'];
                        $as['st']='完结';
                        //                    成功
                        break;
                    case 1:
                        $as['st']='配货中';
                    case 2:
                        $as['st']='已发货';
                    case 4:
                        $vv['dj_sy']=$vv['goods_price']*$vv['goods_number'];
                        $as['st']='退货中';
                        //                    冻结
                        break;

                }
                $as['sy']=$vv['sy']?:0;
                $as['dj_sy']=$vv['dj_sy']?:0;
                $as['sj']=  date('Y-m-d H:i:s',$vvv['pay_time']);
            }
                $as['num']=$vv['goods_number'];
                $as['g_p']=$vv['goods_price'];
            }
            $arr[$k]=$as;
            $k++;
        }
    }
    $this->assign('rows',$arr);
    $this->display('g_dd');
}
//    供货商 商品名字查询
public function Gname($id){
    $name=M('goods')->where("goods_id=$id")->field('goods_name')->find();
    return $name['goods_name'];
}


    /*开始区域1 */
    /*增加用户设置页面*/
    public function config(){
       $this->display();
    }
    public function grade() {

        $this->display();
    }
    public function auth() {

        $this->display();
    }

    public function create() {

        $this->display();
    }

}

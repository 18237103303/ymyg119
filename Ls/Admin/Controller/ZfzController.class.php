<?php
namespace Admin\Controller;
use Think\Controller;
class ZfzController extends PublicController {
    /*展示*/
    public function index($tis=''){
        $tis=  $tis==1?$tis='该地址区域下面的多仓库已经存在不能重新添加，如果需要请删除原来的。':'';
        $this->assign('tis',$tis);
//        qx_amdin('xzfz');
        $rows=M('user')->where('grand=3 and status=1')->field('id,name,address')->group('address3')->select();
//        $arr=array();
        foreach($rows as &$v){
            $dz= explode('-',$v['address']);
            if($dz[2]){
                $v['dz']='0,'.$dz[0].','.$dz[1];
                $v['dz1']=$dz[2];
            }else{
            $v['dz']='0,'.$dz[0];
            $v['dz1']=$dz[1];
            }
//            $arr['a']='<a href="/Admin/Zfz/dz/id/"'.$v['id'].' class="btn btn-secondary btn-sm btn-icon icon-left">'.$v['name'];
        }
        unset($v);
//        var_dump($arr);
        $this->assign('rows',$rows);
//         <a href='+a+' class="btn xiug btn-secondary btn-sm btn-icon icon-left">'+a+"-"+ b+'</a>
//        <a href='/Admin/Zfz/dz/id/$id' class="btn btn-secondary btn-sm btn-icon icon-left">$dq-mingz</a>
//        header("location:/User/index/adduser/name/$name/pas/$pas/wd/$wd");
		$this->display('index');
	}
    /*新增会员*/
    public function adduser($type=0){
//        qx_amdin('xzfz');
        $User= M('user');
        if($type==1){    
			$where1['name']=I('ym');
			$num=$User->where($where1)->count();
			echo $num?1:-1;
		}else{
        if (!$User->autoCheckToken($_POST)){
//        重复提交
        }else{
       $where['name']=I('ym');
            $where['password']=lx_ucenter_encrypt(I('ymm'),I('ym'));
            if(I('c3')){
               $ces= $where['address']=I('c1').'-'.I('c2').'-'.I('c3');
                $where['address3']=I('c3');
            }else{
                $ces= $where['address']=I('c1').'-'.I('c2');
            }
            $where['address2']=I('c2');
            $where['address1']=I('c1');
            $where['r_time']=time();
            $where['user_addr']=I('xx');
            $where['grand']=3;
            $where['status']=1;
            //保证区域存在一个、、、、
            $num=$User->where("address=$ces and grand=3")->count();
            if($num>0){
                $this->index(1);
            }else{
              $didi=$User->add($where);
               $auth1['uid']=$didi;
               $auth1['group_id']=3;
               M('auth')->add($auth1);
                $this->index();
            }
        }
        $this->display('xz');}
    }
    public function sc(){
//        qx_amdin('xzfz');
        $id=I('id');
        $data['status'] = '-1';
        M('user')->where("id=$id")->save($data);
        $this->index();
    }
    /*区域切换*/
    public function dz(){
//        qx_amdin('xzfz');
        $id=I('id');
        $rows=M('user')->where("id=$id")->find();
        $dq=explode('-',$rows['address']);
        $this->assign('dq',$dq);
        $this->assign('row',$rows);
        $this->display('xiangq');
    }
    /*下级*/
    public function xj(){
//        qx_amdin('xzfz');
        $user= I('id');
        $rows = M('user')->where("status=1 and user_up=$user")->select();
//    11
        foreach ($rows as &$row) {
            switch ($row['status']) {case 1:$row['status'] = '正常';break;case 2:$row['status'] = '停用';break;default:$row['status'] = '未知';break;}
            $row['l_time'] = date('Y-m-d H/i', $row['l_time']);
            switch($row['grand']){case 0:$row['grand']='普通会员';break;case 6:$row['grand']='供货商';break;case 7:$row['grand']='送货员';break;case 8:$row['grand']='服务网点';break;default:$row['grand']='角色未分配';break;}
        }
        unset($row);
//    11
        $this->assign('rows', $rows);
        $this->display('xj');
    }
/*佣金*/
    public function yj(){
//        qx_amdin('xzfz');
        $type=I('type')?:'';
        $id=I('id');
        $r_u=M('user')->where("user_up=$id and grand=8")->field('id')->select();    $arr=array();
        foreach($r_u as $v){
            switch($type){case 1:$where['agency_id']=$v[id];$where['order_status']=6;break;case 2:$where['agency_id']=$v[id];$where['order_status']=array(1,2,3,4,5,'or');break;default:$where['agency_id']=$v[id];break;}
            $rows=M('order_info')->where($where)->field('order_status,pay_time,consignee,order_sn,shipping_id,profit,pay_name,agency_id')->select();
            $arr=array_merge($rows,$arr);
        }
        $rows= $this->yj_exe($arr,1);
        $this->assign('rows',$rows);
        $this->display('yj');
    }
    private function yj_exe(array $rows){
        $rowss=M('sys_config')->where('`config_name`="MONERY_YJ_FZ"')->field('config_value')->find();
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
/*登陆模拟*/
public function dl(){
//    qx_amdin('xzfz');
    //进行超级管理写入
    $id=I('id');
    session('USER',NUll);
    session("USER",$id);
    header("location:/admin");
}

    public function dqps($id=''){
        $zfz=M('zfz');
            //xinz
            $xinz= I('xinz')?:'';
            switch($xinz){
                case 'xinz':
                    $zhi=I('zhi2');
                    $zhi1=explode('-',$zhi);
                    $pd=$zhi1['0'];
                    switch($pd){
                        case 'id':
                            $zz['u_id']=$zhi1[4];
                            $zz['dq']=$zhi1[1];
                            $zz['h_p']=$zhi1[2];
                            $zz['p_p']=$zhi1[3];
                            $zfz->data($zz)->add();
                            echo 1;
                            exit;
                        default:
                            $zz['u_id']=$zhi1[4];
                            $zz['dq']=$zhi1[1];
                            $zz['h_p']=$zhi1[2];
                            $zz['p_p']=$zhi1[3];
                            $zfzid=$zhi1[0];
                            $zfz->where("id=$zfzid")->save($zz);
                            echo 1;
                            exit;
                    }
                break;
                case 'sc':
                    $index=I('index');
                    $zfz->where("id=$index")->delete();
                    echo 1;
                    exit;
                case 'xg1':
                    $zhi=I('zhi2');
                    $zhi1=explode('|',$zhi);
                    foreach($zhi1 as $zzz){
                        if(strlen($zzz)>5){
                        $zhi3=explode('-',$zzz);
                        $zz1['u_id']=$zhi3[4];
                        $zz1['dq']=$zhi3[1];
                        $zz1['h_p']=$zhi3[2];
                        $zz1['p_p']=$zhi3[3];
                        $zfzid=$zhi3[0];
                        $zfz->where("id=$zfzid")->save($zz1);
                        }
                    }
                    echo 1;
                    exit;
                case 'sc1':
                    $zhi=I('zhi2');
                    $zhi1=explode('|',$zhi);
                    foreach($zhi1 as $zzz){
                        $zfz->where("id=$zzz")->delete();
                        }
                    echo 1;
                    exit;
            }
            //xinz结束
        $zfz_id=I('id')?:session('zfz_id')?:"";
        $zfz_page=I('page')?:session('zfz_page')?:1;
        $sous=I('sous')?:session('sous')?:"";
        //进行缓解处理
        $zfz_id?session('zfz_id',$zfz_id):"";
        $zfz_page?session('zfz_page',$zfz_page):"";
        $sous?session('sous',$sous):"";
        //重置
        I('chongz')?session('sous',null):'';
        //搜索处理
        if($sous){
            $where['u_id']=$zfz_id;
            $where['dq']=array('like',"%$sous%");
        }else{
            $where['u_id']=$zfz_id;
        }
        $count=$zfz->where($where)->count();
        $rpage= Page($count,9,$zfz_page);
        $rpage1=$rpage['page_l'];
        $rpage2=$rpage['page_r'];
        $row=$zfz->where($where)->limit("$rpage1,$rpage2")->select();

        $this->assign('rpage', $rpage['page']);
        $this->assign('sous', $sous);
        $this->assign('zfz_id',$zfz_id);
        $this->assign('row',$row);
        $this->display('dqps');
    }
}
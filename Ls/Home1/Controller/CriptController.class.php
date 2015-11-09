<?php
namespace Home\Controller;
use Think\Controller;
class CriptController extends PublicController {
    public function index(){
        $rows=M('user')->where('grand=3 and status=1')->field('id,address')->select();
        foreach($rows as &$v){$dz= explode('-',$v['address']);$v['dz']=$dz[0];$v['dz1']='0,'.$dz[0];$v['dz2']=$dz[1];}  unset($v);
//        var_dump($rows);
        $this->assign('rows',$rows);
        $this->display();
    }
    public function dengl($id='',$dz=''){
            session("FZ",$id);
            session('Dz',$dz);
            header("location:/");
    }
     
}
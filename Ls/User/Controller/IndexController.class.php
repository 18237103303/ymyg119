<?php
namespace User\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
	//session('HTQX',null);
	if(session('HTQX')=='xdz'){
	header("location:/admin");}else{
		$username=I('username');
		$passwd=I('passwd');
		if($username && $passwd){
		/*对身份的基本信息进行查询*/
        $user=M('user');
        if (!$user->autoCheckToken($_POST)){
        session('HTQX',null);$this->assign('jg','请勿重复提交');$this->display();exit;
        }else {
            $where['name'] = $username;
            $rows = $user->where($where)->select();
        }
	if($rows){
	$password=$rows[0]['password'];
	if($password==lx_ucenter_encrypt($passwd,$username)){			
	//当前用户id  -- 获取 暂时性写在user里
    $uid=$rows[0]['id'];	
	$Auth= new\Think\Auth();
    //需要验证的规则列表,支持逗号分隔的权限规则或索引数组
    $name='htdl';
    //执行check的模式
    if($Auth->check($name,$uid)) {
        if($rows[0]['grand']==99){session('QX_ADMIN',$uid);session('USER',$uid);}else{session('USER',$uid);}

    	 session('HTQX','xdz');
	 //登陆用户的id
	 //对时间的更改
	 $time['l_time']=time();
	 M('user')->where("id=$uid")->save($time);
     header("location:/admin");
    }else{session('HTQX',null);$pand=1231;	$this->assign('pand',$pand);$this->display(); }
	
	}else{session('HTQX',null);$pand=1230;	$this->assign('pand',$pand);$this->display();}
	}else{session('HTQX',null);$pand=123;	$this->assign('pand',$pand);$this->display();}
	}else{$this->display();}
	}
    }
//验证码	
	public function verify($code=''){
		$code=I('code');
		if(!$code){
		$verify = new \Think\Verify();
		$verify->entry(2);}else{		
		$verify = new \Think\Verify();
	    $verify1= $verify->check($code, 2);
		$verify2=$verify1?1:2;
		echo  $verify2;
		}
	}
	#code..
//会员列表的新增
	public function adduser(){
	   $user=I('name');
	   $pas=I('pas');
	   $wd=I('wd');
	  $password=lx_ucenter_encrypt($pas,$user);
      $data['user_up']=session('USER');
//        $data['up_id']=
	  $data['name']=$user;
	  $data['password']=$password;
	  $data['status']=1;
      $data['r_time']=time();
        switch($wd){
            case -9:
                $data['grand']=9;
                break;
            default:
                $data['grand']=0;
                $data['up_id']=$wd;
                break;
        }
        $User1=M("user");
        $where['name']=$user;
        $username=$User1->where($where)->count();
    if($username>0){ echo '<script>history.go(-1);</script>';}else{$User1->add($data);echo '<script>history.go(-1);</script>';}
	}
 //密码修改
    public function edt(){
        $mm=I('mm');
        $id=I('id');
        //获取当前的管理员
        $admin=session("USER")?:'';
        $name=Name($id);
        $password=lx_ucenter_encrypt($mm,$name);
        $data['password']=$password;
        $User = M("user");
        $User->where("id=$id")->save($data);
            if($admin!=$id){
//           header("location:/Admin/User/mlist");
                echo '<script>history.go(-1);</script>';
                }else{
           $this->tc();
            }

    }
    //退出功能
    public function tc(){
        session_destroy();
        header("location:/user");
    }
}
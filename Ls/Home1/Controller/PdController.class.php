<?php
namespace Home\Controller;
use Org\Alipay\Zf\Zf;
use Think\Controller;
class PdController extends PublicController {
    public function index(){
        var_dump(Org_PATH);
        exit;
        import("Org.Alipay.Zf.Zf");
        $a=new Zf();
        $a->index();
    }
}

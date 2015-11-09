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

class GoodsController extends PublicController {

    public function index() {
       quanx('spin');
        $this->display();
    }
    public function finish() {
        session('goods_id', null);
        echo json_encode(array('msg' => '商品添加完成'));
    }
    /*实验性的列表规则*/
    public function ceshi($qingk=''){
        $uid=session('USER');
        $page=I('page')?:1;
        /*搜索开始*/
        if($qingk==1){session('sous',null);session('leix',null);}
        if(I('sous'))session('sous',I('sous'));
        $sous=session('sous')?:'';
        //-----
        /*类型接受*/
        if(I('leix'))session('leix',I('leix'));
        $leix=session('leix')?:'';
        //----
        //组织查询
        if($sous && $leix){
            $where['fz_id']=$uid;
            $where['goods_name']=array('like',"%$sous%");
            $where['cat_id']=$leix;
            $count=M('goods')->where($where)->count();
            $rpage= Page($count,15,$page);
            $rpage1=$rpage['page_l'];
            $rpage2=$rpage['page_r'];
            $rows= M('goods')->where($where)->limit("$rpage1,$rpage2")->select();
        }else if($sous || $leix){
                if($sous){
                    $where['fz_id']=$uid;
                    $where['goods_name']=array('like',"%$sous%");
                    $count=M('goods')->where($where)->count();
                    $rpage= Page($count,15,$page);
                    $rpage1=$rpage['page_l'];
                    $rpage2=$rpage['page_r'];
                    $rows= M('goods')->where($where)->limit("$rpage1,$rpage2")->select();
                    if(count($rows)==0){
                    $where1['fz_id']=$uid;
                    $where1['goods_sn']=array('like',"%$sous%");
                    $count1=M('goods')->where($where)->count();
                    $rpagew= Page($count1,15,$page);
                    $rpage1_1=$rpagew['page_l'];
                    $rpage1_2=$rpagew['page_r'];
                    $rows= M('goods')->where($where1)->limit("$rpage1_1,$rpage1_2")->select();
                    }
                }else if($leix){
                    $where['fz_id']=$uid;
                    $where['cat_id']=$leix;
                    $count=M('goods')->where($where)->count();
                    $rpage= Page($count,15,$page);
                    $rpage1=$rpage['page_l'];
                    $rpage2=$rpage['page_r'];
                    $rows= M('goods')->where($where)->limit("$rpage1,$rpage2")->select();
                }
        }else{
            $count=M('goods')->where("fz_id=$uid")->count();
            $rpage= Page($count,15,$page);
            $rpage1=$rpage['page_l'];
            $rpage2=$rpage['page_r'];
            $rows= M('goods')->where("fz_id=$uid")->limit("$rpage1,$rpage2")->select();
        }
        $this->assign('leixht',$leix?:-1);
        $this->assign('sous',$sous);
        $this->assign('rpage', $rpage['page']);
        $leixmc='';
        foreach($rows as &$v){
            /*库存*/
            $gid= $v['goods_id'];
            $rows1= M('goods_attr')->where("goods_id=$gid")->sum("goods_count");
            $v['count']=$rows1;
            /*类型*/
            $cid= $v['cat_id'];
            $rows2= M('category')->where("cat_id=$cid")->getField('cat_name');
            $v['cid']=$rows2;
        }
        unset($v);
        /*类型名称读取*/
        $r_leix=M('category')->field('cat_id,cat_name')->select();
        foreach($r_leix as $row){
            $leixmc[$row['cat_id']]=$row['cat_name'];
        }
        $this->assign('leix',$leixmc);
        $this->assign('rows',$rows);
        $this->display('ceshi');
    }
    //属性 库存的查询  loading
    public function ceshi1(){
        layout(false);
        if($id=I('id')){
            session('atid',I('id'));
        }else{
            $id=session('atid');
        }
        //属性进入
        $attr = M("Goods_attr");$Kc = M("User_ghs_gn");
        $attr1 = $attr->where("goods_id=$id")->select();
        foreach($attr1 as $v){
            $idd= $v['id'];
            //对属性进行
            $att=$v['attr_value'];
            $att1=explode("|",$att);
             $shux=   $this->ceshisxx($att1);
            //进行分组变形
            $kkk= $Kc->where("goods_attr_id=$idd")->select();

            foreach($kkk as $vv){
                $vv['shux']=$shux;
                $vv['kc']=$vv['endnum']-$vv['startnum'];
                $Kc1[] = $vv;
            }
        }
        //库存
//        $attr2=$attr1['id'];0
        $this->assign('data',$attr1);
        $this->assign('data1',$Kc1);
        $this->display();
    }
    //属性的调取
    public function ceshisx(){
        $d= I('d');
        $i='<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'.
        '<td>属性</td>'.
        '<td>库存</td>'.
        '<td>价格列表</td>'.
        '</tr>';
        $rows=M('goods_attr')->where("goods_id=$d")->field('attr_value,goods_count,shop_price')->select();
        foreach($rows as $v){
           $rows1= explode('|',$v['attr_value']);
            $attr=$this->ceshisxx($rows1);
            $i.= '<tr>'.
                '<td>'.$attr.'</td>'.
                '<td>'.$v['goods_count'].'</td>'.
                '<td>'.$v['shop_price'].'</td>'.
                '</tr>';
        }
       $i.= '</table>';
        echo $i;
    }
    //属性的遍历
    public function ceshisxx(array $rows1){
        $attr='';
        foreach($rows1 as $vv){
            $attr= $attr?$attr.'|'.Aname($vv):Aname($vv);
        }
        return $attr;
    }
    public function glist() {
        $page = empty($_POST['page']) ? 1 : $_POST['page'];
        $limit = empty($_POST['rows']) ? 10 : $_POST['rows'];
        //搜索条件
        $where = '1=1';
        $fillter = json_decode($_POST['filters'], true);
        if (!empty($fillter)) {
            $groupOp = $fillter['groupOp'];
            $rules = $fillter['rules'];
            foreach ($rules as $v) {
                $dat = trim($v['data']);
                if ($v['op'] == 'eq') {
                    if ($dat != "''") {
                        $where .= " and {$v['field']}='{$dat}'";
                    }
                } else if ($v['op'] == 'bw') {
                    if ($dat != "''") {
                        if ($v['field'] == 'id') {
                            $where .= " and goods_id like '%{$dat}%'";
                        } else {
                            $where .= " and {$v['field']} like '%{$dat}%'";
                        }
                    }
                }
            }
        }
        $uid=  session("USER");
        $sidx = I("post.sidx");
        $sord = I("post.sord");$count=0;$data=array();
        //判断权限
        $auth=M('Auth');
        $u_a=$auth->where("uid=$uid")->find();
        //dump($u_a);exit();
        $group_id=$u_a['group_id'];
        $group=M('AuthGroup');
        $title=$group->where("id=$group_id")->find();
        //dump($title);exit();
            if($title){
//            if ($title['title']=='分站管理员') {
            if ($title['title']=='分站管理员') {
            $sql="select count(*) as total from __PREFIX__goods as g,__PREFIX__user as u where g.user_id=u.id and user_up=$uid and $where order by $sidx $sord";
            $count=M()->query($sql);
            $count=$count[0]['total'];
            
            if ($count > 0) {
            $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $sql="select g.* from __PREFIX__goods as g,__PREFIX__user as u where g.user_id=u.id and user_up=$uid and $where order by $sidx $sord limit $start,$limit";
            $data = M()->query($sql);
            }elseif($title['title']=='供货商'){
            $sql="select count(*) as total from __PREFIX__goods as g where g.user_id=$uid and $where order by $sidx $sord";
            $count=M()->query($sql);
            $count=$count[0]['total'];
            if ($count > 0) {
            $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $sql="select g.*  from __PREFIX__goods as g where g.user_id=$uid and $where order by $sidx $sord limit $start,$limit";
            $data = M()->query($sql);
                }else {
                   $sql="select count(*) as total from __PREFIX__goods as g  where $where order by $sidx $sord";
            $count=M()->query($sql);
            $count=$count[0]['total'];
            if ($count > 0) {
            $total_pages = ceil($count / $limit);
            } else {
                $total_pages = 0;
            }
            $start = $limit * ($page - 1);
            $sord = $_POST['sord'];
            $sql="select g.*  from __PREFIX__goods as g where $where order by $sidx $sord limit $start,$limit";
            $data = M()->query($sql);  
                
            }
            }
    
        foreach ($data as $k => $v) {
            $data[$k]['id'] = $v['goods_id'];
            if (empty($v['goods_desc'])) {
                $data[$k]['goods_desc'] = "";
            }
            //获取分类id
            $cat_id = $v['cat_id'];
            $cate = M('Category');
            $c_name = $cate->where("cat_id=$cat_id")->getField('cat_name');
            $data[$k]['cat_name'] = $c_name;
            //获取品牌id
            $b_id = $v['brand_id'];
            $brand = M('Brand');
            $b_name = $brand->where("brand_id=$b_id")->getField('brand_name');
            $data[$k]['brand_name'] = $b_name;
        }
        $ret = array();
        $ret['page'] = $page;
        $ret['rows'] = $data;
        $ret['total'] = $total_pages;
        $ret['records'] = $count;
        $ret['limit'] = $limit;
        echo json_encode($ret);
    }

    //在列表页面获取商品分类
    //商品信息删除
    public function delete() {
		quanx('spin');
        $id = I("post.id");
        //删除该商品的属性值
        $result1 = M('goods_attr')->where("goods_id='$id'")->delete();
        $imgpath = M('goods_gallery')->where("goods_id='$id'")->select();
        $result2 = M('goods_gallery')->where("goods_id='$id'")->delete();

        if ($result2) {
            foreach ($imgpath as $v) {
                $field = "./Uploads/" . $v['img_url'];
                unlink($field);
                $dir=  dirname($field);
                $s_name=  basename($field);
        
                unlink($dir."/s_".$s_name);
                unlink($dir."/c_".$s_name);
            }
        }
        //删除购物车中的商品
        $c_da=M("Car")->where("sp_id=$id")->delete();
        //删除收藏的商品
        $cl_da=M("CollectGoods")->where("goods_id=$id")->delete();
        if ($result1 >= 0 && $result >= 0) {
            $result3 = M('goods')->where("goods_id='$id'")->delete();
            if ($result3) {
                /* 库存日志开始 */
                $beforenum = M('user_ghs_gn')->where("sp_id='$id'")->order("id desc")->getField("endnum");
                $kcdata['startnum'] = $beforenum;
                $kcdata['endnum'] = 0;
                $uid = session('USER');
                $kcdata['up_id'] = $uid;
                $kcdata['sp_id'] = $id;
				$kcdata['c_time'] = date('Y-m-d,H:i:s', time());
                $kcdata['content'] = "删除商品";
                $kuncun = M('user_ghs_gn')->add($kcdata);
                /* 库存日志结束 */
                $this->success();
            } else {
                $this->error();
            }
        }
    }

    //商品添加页面
    public function addgoods() {
//

        if(I('lx')){
            $lx=I('lx');
        $goodlist = M('goods');
        if($lx!=-9 && $lx) {
            $where['cat_id']= $lx;
        }
            $rows= $goodlist->where($where)->order('goods_id desc')->select();$arra='';

            foreach($rows as $vv){
                $arra.='<label style="cursor:pointer;"><input name="nd" value='.$vv['goods_id'].' type="checkbox">'.$vv['goods_id'].':'.$vv['goods_name'].'</label>';
            }
            echo $arra?:'<label style="cursor:pointer;"><input value="" type="checkbox">-:-</label>';exit;
        }

        $cateData = M('category')->where('pid=0')->select();
        $str = '<select class="form-control" id="sboxit-2" name="cat_id"><option value="">全部</option>';
        foreach ($cateData as $v) {
            $str .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>";
        }
        $str .= '</select>';
        $this->assign('data', $str);
        $this->display();
    }

    public function getsub($id) {
        //类型列表获取页面
        $cateData = M('category')->where("pid=$id")->select();
        $path=explode('-',$cateData[0]['path']);
        $uid=session("USER");
        if(count($path)==4){
            $cateData = M('category')->where("pid=$id and admin_id=$uid")->select();
        }
        if (empty($cateData))
            return false;
        $ret = '';
        foreach ($cateData as $k => $v) {
            $num = count(explode('-', $v['path'])) - 1;
            $sp = '';
            for ($i = 0; $i < $num; $i++) {
                $sp.='&nbsp;&nbsp;&nbsp;&nbsp;';
            }
            $ret .= "<option value='{$v['cat_id']}'>{$sp}|--{$v['cat_name']}</option>";
            $sub = $this->getsub($v['cat_id']);
            if ($sub !== false) {
                $ret.=$sub;
            }
        }
        return $ret;
    }

    //商品属性弹框
    public function getmsg() {
//        quanx('spin');
       /* $id = $_POST['id'];
        $gid = $_SESSION['goods_id'];
        if (!$gid) {
            return;
        }*/
        $arrslist = M('goods_attribute')->where("cat_id='$id'")->select();
        $i = 0;
        foreach ($arrslist as $value) {

            if ($value['attr_input_type'] == 0) {

                $a = "<label for='field-1'class='control-label' >" . $value['attr_name'] . "
                    :</label><input type='hidden' name='attr_id' id='attr_id_{$i}' value='$value[attr_id]'><input id='attr_value_{$i}' type='text' name='attr_value' class='form-control'><br/>";
            } else {

                $val = $value['attr_values'];
                $vals = explode("\n", $val);
                foreach ($vals as $k => $v) {
                    $op = "
                         <option value='$v'>" . $v . "</option>
                         ";
                    $vs.=$op;
                }
                $a = "<label for='field-1'class='control-label' >" . $value['attr_name'] . ":</label><input type='hidden' name='attr_id' id='attr_id_{$i}' value='$value[attr_id]'><select class='form-control' id='attr_value_{$i}' name='attr_value'> " . $vs . "</select><br/>";
            }
            $as=$a;
            $i++;
            $vs = "";
        }
        $as.="<label for='field-1'class='control-label' >商品库存:</label><input id='goods_count' type='text' name='goods_count' class='form-control col-sm-10'><br/>
              <label for='field-1'class='control-label' >商品售价:</label><input id='market_price' type='text' name='market_price' class='form-control col-sm-10' ><br/>
              <label for='field-1'class='control-label' >商品进价:</label><input id='shop_price' type='text' name='shop_price' class='form-control col-sm-10'><br/>
              <input id='type_id_hidd' type='hidden'  class='form-control col-sm-10' value='{$id}'><br/>";
        $this->ajaxReturn($as);
    }

    //添加商品的控制器
    public function addaction() {
//        var_dump($_POST);exit;
//        quanx('spin');
        $uid = $_SESSION['USER'];
//        $add['cat_id']=$cateid=I('cat_id');
//        $cat=M('category')->where("cat_id='$cateid'")->find();
//        if($cat){
        /*关联 图集 tp:tp, zhi1:zhi1*/
             //图集处理
        $tp=explode('|',I('tp'));
//var_dump($tp);
//var_dump($zhi);
//        exit;
        //事务处理
        M()->startTrans(); $ttpp='';
            /*基础信息*/
            $add['goods_thumb']=$tp[0];
            $add['cat_id']=I('cat_id');
            $add['admin_id']=$add['user_id']=$add['fz_id']=$uid;
            $add['goods_name']=I('goods_name');
            $add['goods_sn']=I('goods_sn');
            $add['sort']=I('sort');
            $add['goods_desc']=I('goods_desc');
            $res=M('goods')->data($add)->add();
            $res_1=$res?'':1;
            $ttpp=$ttpp?:$res_1;
        //属性操作
            $att=I('att');
            foreach($att as $s){
            //对单条属性进行
            $array=explode('^',$s);
            foreach($array as $ss){
                $ss1=substr($ss,0,-1);
                switch(substr($ss,-1)){
                    case '%':
                        $att=$ss1;
                        break;
                    case '$':
                        $num=$ss1;
                        break;
                    case '#':
                        $porce=$ss1;
                        break;
                }
                    //数量
            }
            //属性 数量  价格区间
            $kcdata['endnum']=$add1['goods_count']=$num?:'';
            $add1['shop_price']=$porce?:'';
            $add1['attr_value']=$att?:'';
                $add1['goods_id']=$res;
                $res1=M('goods_attr')->data($add1)->add();
                $res1_1=$res1?'':1;
                $ttpp=$ttpp?:$res1_1;
                $kcdata['goods_attr_id'] = $res1;
            $kcdata['up_id'] = $uid;
                $kcdata['sp_id'] = $res;
            $kcdata['content'] = "添加商品";
            $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
              $res2=  M('user_ghs_gn')->add($kcdata);
                $res2_1=$res2?'':1;
                $ttpp=$ttpp?:$res2_1;
        }
        /*库存的修改*/
            /*图集*/
            $add3['goods_id']=$add2['goods_id']=$res;
            foreach($tp as $wv){
                $add2['img_url']=$wv;
               $res3= M('goods_gallery')->data($add2)->add();
                $res3_1=$res3?'':1;
                $ttpp=$ttpp?:$res3_1;
            }
            /*关联商品*/
        $add3['admin_id']=$uid;

       $zhi=explode('|',I('zhi1'));
        if($zhi[1]){
        foreach($zhi as $wv1){
            if($wv1!='undefined')
            {$add3['link_goods_id']=$wv1;
          $res4=  M('link_goods')->data($add3)->add();
                $res4_1=$res4?'':1;
                $ttpp=$ttpp?:$res4_1;
            }
        }
        }else{
            $add3['link_goods_id']=I('zhi1');
           $res5= M('link_goods')->data($add3)->add();
            $res5_1=$res5?'':1;
            $ttpp=$ttpp?:$res5_1;
        }

            if (!$ttpp) {
                M()->commit();
                $data = 1;
            } else {
                M()->rollback();
                $data = 0;
            }
            echo $data;
//        }
    }
    //最新添加商品属性的存储
    public function addgattr() {
		quanx('spin');
        $result = M('goods_attr');
        $gid = $_SESSION['goods_id'];
        $typeid = $_POST['type_id'];
        if (!$gid) {
            echo json_encode(array('info' => 3, 'msg' => '请先去添加商品吧！'));
            return;
        }
		$attr_value=$_POST['attr_value'];
        $goods =$result->where("goods_id='$gid' and attr_value='{$attr_value}'")->find();
        if($goods){
            echo json_encode(array('info' => 3, 'msg' => '该属性已经添加过！'));
            return;
        }
        $type_id = M('goods')->where("goods_id='$gid'")->getField("type_id"); //获取商品表的类型id
        if ($type_id) {
            if ($type_id != $typeid) {
                echo json_encode(array('info' => 4, 'msg' => '商品只能添加一种类型的属性'));
                return;
            }
        }

        $goods = M('goods')->where("goods_id='$gid'")->setField('type_id', $typeid);
        $result->goods_id = $_SESSION['goods_id'];
        $result->attr_id = $_POST['attr_id'];
        $result->attr_value = $_POST['attr_value'];
        $result->type_id = $typeid;
        $result->goods_count = $_POST['goods_count'];
        $mprice = sprintf("%.2f", $_POST['market_price']);
        $result->market_price = $mprice;
        $sprice = sprintf("%.2f", $_POST['shop_price']);
        $result->shop_price = $sprice;
        $results = $result->add();
        if ($results) {
            /* 库存日志添加 */
            $uid = $_SESSION['USER'];
            $kcdata['goods_attr_id'] = $results;
            $kcdata['endnum'] = $_POST['goods_count'];
            $kcdata['up_id'] = $uid;
            $kcdata['sp_id'] = $gid;
            $kcdata['content'] = "添加商品";
            $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
            $kuncun = M('user_ghs_gn')->add($kcdata);
            /* 库存日志结束 */
            echo json_encode(array('info' => 1));
        } else {
            echo json_encode(array('info' => 0));
        }
    }

    //商品编辑
    public function edit() {
//        quanx('spin');
        $uid=  session("USER");
        $id = $_GET['id'];
        if (!empty($_POST)) {
            $eid = $_POST['goods_id'];
            $result = M('goods')->where("goods_id='$eid'")->save($_POST);
            if ($result) {
                $data['info'] = 1;
            } else {
                $data['info'] = 0;
            }
            echo json_encode($data);
        } else {
            $data = M('goods')->where("goods_id='$id' and user_id=$uid")->find();
            if(!$data){
                $this->redirect("Public/error1");
            }
            $cid = $data['cat_id'];
            $this->assign('data', $data);
            //商品属性
            $attr = M('goods_attr')->where("goods_id='$id'")->select();
                foreach($attr as &$v){
                    $attv= $v['attr_value'];
                    $rows1= explode('|',$attv);
                    $attr1=$this->ceshisxx($rows1);
                    $v['attr']=$attr1;
                }
                unset($v);
            $this->assign('attr', $attr);
            //商品分类
            $cateData = M('category')->where('pid=0')->select();
            $cateData1 = M('category')->where("cat_id='$cid'")->find();
            $str = "<select class='form-control' id='sboxit-2' name='cat_id'><option value='{$cateData1['cat_id']}'>{$cateData1['cat_name']}</option>";
            foreach ($cateData as $v) {
                $str .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>" . $this->getsub($v['cat_id']);
            }
            $str .= '</select>';
            $this->assign('cat', $str);
            $this->assign('iidd',$id);
            $this->display();
        }
    }

    /*属性修改*/

    //属性操作
    public function sxxg(){
        $att=I('att');
        $id=I('id');
        //表进行操作
        foreach($att as $s) {
            //对单条属性进行
            $array = explode('^', $s);
            foreach ($array as $ss) {
                $ss1 = substr($ss, 0, -1);
                $attid='';
                switch (substr($ss, -1)) {
                    case '%':
                        $att = $ss1;
                        break;
                    case '$':
                        $num = $ss1;
                        break;
                    case '#':
                        $porce = $ss1;
                        break;
                    default:
                        $attid=$ss;
                        break;
                }
            }
//            进行属性的更新或者是新增。
            $rows['goods_id']=$id;
            $rows['attr_value']=$att;
            $rows['goods_count']=$num;
            $rows['shop_price']=$porce;
            $attr=M('goods_attr');
            if($attid){
            $gnum=$attr->where("id=$attid")->getField('goods_count');
            $pdz= $attr->where("id=$attid")->save($rows);
                //查询之前值
            }else{
            $attid= $attr->add($rows);
                $pdz=1;
            }
//      ---------------------------------
            /* 库存日志添加 */
            if($pdz>0){
            $uid = $_SESSION['USER'];
            $kcdata['goods_attr_id'] = $attid;
            $kcdata['endnum'] = $num;
            $kcdata['startnum'] =$gnum?:0;
            $kcdata['up_id'] = $uid;
            $kcdata['sp_id'] = $id;
            $kcdata['content'] = 3;
            $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
            M('user_ghs_gn')->add($kcdata);
            }
            /* 库存日志结束 */
//      ---------------------------------
        }
        echo 1;
    }

    /*商品修改*/
    public function edita(){
        $att=I('att');
        $res=I('id');
        $uid=session('user');
        $g_a=M('goods_attr');
        $g_a_n=M('user_ghs_gn');
//
        foreach($att as $s) {
            //对单条属性进行
            $array = explode('^', $s);
            foreach ($array as $ss) {
                $ss1 = substr($ss, 0, -1);
                switch (substr($ss, -1)) {
                    case '%':
                        $att = $ss1;
                        break;
                    case '$':
                        //$num = ;
                        $num1=explode('>',$ss1);
                        $attid=$num1[1];
                        $num=$num1[0];
                        //属性id拆除
                        break;
                    case '#':
                        $porce = $ss1;
                        break;
                }
                //数量
            }
            //进行单条更新入库
                    if($attid){

                    }else{

                    }

        }
//
    }
    //商品属性修改弹框
    public function getmsgs() {
		quanx('spin');
        $id = $_POST['id'];
        $arrslist = M('goods_attr')->where("id='$id'")->find();
        $attr_id = explode('-', $arrslist['attr_id'], -1);
        $attr_value = explode('-', $arrslist['attr_value'], -1);
        $num = count($attr_id);
        $arr = array();
        for ($i = 0; $i < $num; $i++) {
            $aid = $attr_id[$i];
            $avalue = $attr_value[$i];
            $arr[$aid] = $avalue;
        }
        foreach ($arr as $k => $v) {
            $aid = $k;
            $attrs = M('goods_attribute')->where("attr_id='$aid'")->find();
            if ($attrs['attr_input_type'] == 0) {
                $a = "<label for='field-1'class='control-label' >" . $attrs['attr_name'] . ":</label><input type='text' name='$k' value='$v' class='ty form-control'><br/> ";
            } else {

                $val = $attrs['attr_values'];
                $vals = explode("\n", $val);
                foreach ($vals as $i => $j) {
                    $op = " <option>" . $j . "</option>";
                    $vs.=$op;
                }
                $a = "<label for='field-1'class='control-label' >" . $attrs['attr_name'] . ":</label> <select class='ty form-control'><option selected='selected'>" . $v . "</option> " . $vs . "</select><br/>";
            }
            $as.=$a;
            $vs = "";
        }
        $as.="<input type='hidden' name='id' id='aid' value=" . $id . "><label for='field-1'class='control-label ' >商品库存:</label>
        <input type='text' name='goods_count' id='goods_count' class='form-control col-sm-10' value=" . $arrslist['goods_count'] . "><br/><br/>
        <label for='field-1'class='control-label' >商品售价:</label><input type='text' name='market_price' id='market_price' class='form-control col-sm-4' value=" . $arrslist['market_price'] . "><br/><br/>
        <label for='field-1'class='control-label' >商品进价:</label><input type='text' name='shop_price' id='shop_price'  class='form-control col-sm-10' value=" . $arrslist['shop_price'] . "><br/><br/>";
       $this->ajaxReturn($as);
    }
    //商品属性的添加

    public function addgattrs() {
        quanx('spin');
        $result = M('goods_attr');
        $gid = $_POST['goods_id'];
        $goods = M('goods')->where("goods_id='$gid'")->find();
        $typeid = $goods['type_id'];
        if (!$gid) {
            echo json_encode(array('info' => 3, 'msg' => '请先去添加商品吧！'));
            return;
        }
        $attr_value=$_POST['attr_value'];
        $goods =$result->where("goods_id='$gid' and attr_value='{$attr_value}'")->find();
        if($goods){
            echo json_encode(array('info' => 3, 'msg' => '该属性已经添加过！'));
            return;
        }
        $result->goods_id = $_POST['goods_id'];
        $result->attr_id = $_POST['attr_id'];
        $result->attr_value = $_POST['attr_value'];
        $result->type_id = $typeid;
        $result->goods_count = $_POST['goods_count'];
        $mprice = sprintf("%.2f", $_POST['market_price']);
        $result->market_price = $mprice;
        $sprice = sprintf("%.2f", $_POST['shop_price']);
        $result->shop_price = $sprice;
        $result->warn_number = $_POST['warn_number'];
        $results=$result->add();
        if ($results) {
			/*添加商品库存日志开始*/
			$uid = $_SESSION['USER'];
            $kcdata['goods_attr_id'] = $results;
            $kcdata['endnum'] = $_POST['goods_count'];
            $kcdata['up_id'] = $uid;
            $kcdata['sp_id'] = $gid;
            $kcdata['content'] = "修改商品";
            $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
            $kuncun = M('user_ghs_gn')->add($kcdata);
			/*添加商品库存日志结束*/
            echo json_encode(array('info' => 1));
        } else {
            echo json_encode(array('info' => 0));
        }
    }

    //商品属性的删除

    public function delattr() {
		quanx('spin');
        $aid = $_GET['id'];
        $data = M('goods_attr')->where("id='$aid'")->find();
        $id = $data['goods_id'];
        $result = M('goods_attr')->where("id='$aid'")->delete();
        if ($result) {
            /* 库存日志添加 */
            $beforenum = M('user_ghs_gn')->where("sp_id='$id' AND goods_attr_id='$aid'")->order("id desc")->getField("endnum");
            $kcdata['startnum'] = $beforenum;
            $kcdata['endnum'] = 0;
            $uid = session('USER');
            $kcdata['up_id'] = $uid;
            $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
            $kcdata['sp_id'] = $id;
            $kcdata['content'] = "删除属性";
            $kcdata['goods_attr_id'] = $aid;
            $kuncun = M('user_ghs_gn')->add($kcdata);
            /* 库存日志结束  */
            $this->redirect('Goods/edit', array('id' => $id));
        } else {
            $this->redirect('Public/error1', array());
        }
    }

//商品属性的添加

    public function getmsgup() {
		quanx('spin');
        $id = $_POST['id'];
        $arrslist = M('goods_attribute')->where("cat_id='$id'")->select();
        $i = 0;
        $kid = array();
        foreach ($arrslist as $value) {
            if ($value['attr_input_type'] == 0) {
                $a = "<label for='field-1'class='control-label' >" . $value['attr_name'] . ":</label><input type='hidden' name='attr_id' id='attr_id_{$i}' value='$value[attr_id]'>
                    <input id='attr_value_{$i}' type='text' name='attr_value' class='form-control'><br/>";
            } else {

                $val = $value['attr_values'];
                $vals = explode("\n", $val);
                foreach ($vals as $k => $v) {
                    $op = "<option value='$v'>" . $v . "</option>";
                    $vs.=$op;
                }

                $a = "<label for='field-1'class='control-label' >" . $value['attr_name'] . ":</label><input type='hidden' name='attr_id' id='attr_id_{$i}' value='$value[attr_id]'>  
                    <select class='form-control' id='attr_value_{$i}' name='attr_value'> " . $vs . "</select><br/>";
            }
            $as.=$a;
            $i++;
            $vs = "";
        }
        $as.="<input type='hidden' name='id' id='aid' value=" . $id . "><label for='field-1'class='control-label' >商品库存:</label>
        <input type='text' name='goods_count' id='goods_count_1' class='form-control col-sm-10' value=" . $arrslist['goods_count'] . "><br/>
        <label for='field-1'class='control-label ' >商品售价:</label><input type='text' name='market_price' id='market_price_1' class='form-control col-sm-10' value=" . $arrslist['market_price'] . "><br/>
        <label for='field-1'class='control-label ' >商品进价:</label><input type='text' name='shop_price' id='shop_price_1'  class='form-control col-sm-10' value=" . $arrslist['shop_price'] . "><br/>";
        $this->ajaxReturn($as);
    }

    //对于商品图集单个图片的修改
    public function updateimg() {
        quanx('spin');
        $id = $_POST['gallery_id'];
        $result = M('goods_gallery')->where("gallery_id='$id'")->setField('img_title', $_POST['img_title']);
        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        echo json_encode($data);
    }

//商品属性的修改

    public function upattr() {
		quanx('spin');
        $id = $_POST['aid'];
        unset($_POST['aid']);
        /* 库存日志添加--判断是否改变库存 */
        $eids = M('goods_attr')->where("id='$id'")->field("goods_id,goods_count")->select();
        $eid = $eids[0]['goods_id'];
        $firstcount = $eids[0]['goods_count'];
        /* 库存日志结束 */
        $result = M('goods_attr')->where("id='$id'")->save($_POST);

        if ($result) {
            /* 库存日志添加 */
            if ($firstcount != $_POST['goods_count']) {
                $beforenum = M('user_ghs_gn')->where("sp_id='$eid' AND goods_attr_id='$id'")->order("id desc")->getField("endnum");
                //var_dump($beforenum);
                $kcdata['startnum'] = $beforenum;
                $kcdata['endnum'] = $_POST['goods_count'];
                $uid = session('USER');
                $kcdata['up_id'] = $uid;
                $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
                $kcdata['sp_id'] = $eid;
                $kcdata['content'] = "修改商品";
                $kcdata['goods_attr_id'] = $id;
                $kuncun = M('user_ghs_gn')->add($kcdata);
            }
            /* 库存日志结束  */
            echo json_encode(array('info' => 1));
        } else {
            echo json_encode(array('info' => 0));
        }
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

    // 点击商品列表×、√
    public function is_edit() {
		quanx('spin');
        $col = I("get.col");
        $gid = I("get.id");
        switch ($col) {
            case 6:
                $goods = M("Goods");
                $v = 0;
                $is_on_sale = $goods->where("goods_id=$gid")->getField("is_on_sale");
                //上架
                if (intval($is_on_sale) == 0) {
                    $goods->goods_id = $gid;
                    $goods->is_on_sale = 1;
                    $result = $goods->save();
                    if ($result) {
                        $v = 1;
                    }
                } else {
                    //下架
                    $goods->goods_id = $gid;
                    $goods->is_on_sale = 0;
                    $result = $goods->save();
                    $goods_attr = M("GoodsAttr");
                    $g_a = $goods_attr->where("goods_id=$gid")->setField("goods_count", 0); //下架库存就为0
                    if ($result && $g_a) {
                        /* 库存日志开始 */
                        $time = M('user_ghs_gn')->where("sp_id='$gid'")->distinct(true)->field("goods_attr_id")->select();
                        foreach ($time as $key => $valu) {
                            foreach ($valu as $k => $va) {
                                $beforenum = M('user_ghs_gn')->where("sp_id='$gid' AND goods_attr_id='$va'")->order("id desc")->getField("endnum");
                                $kcdata['startnum'] = $beforenum;
                                $kcdata['endnum'] = 0;
                                $uid = session('USER');
                                $kcdata['up_id'] = $uid;
                                $kcdata['sp_id'] = $gid;
                                $kcdata['goods_attr_id'] = $va;
                                $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
                                $kcdata['content'] = "单独下架";
                                $kuncun = M('user_ghs_gn')->add($kcdata);
                            }
                        }
                        /* 库存日结束 */
                        $v = 0;
                    }
                }
                echo json_encode(array('info' => 1, 'colname' => 'is_on_sale', 'data' => $v));
                break;
            case 8:
                $goods = M("Goods");
                $v = 0;
                $is_on_sale = $goods->where("goods_id=$gid")->getField("is_new");
                if (intval($is_on_sale) == 0) {
                    $goods->goods_id = $gid;
                    $goods->is_new = 1;
                    $goods->save();
                    $v = 1;
                } else {
                    $goods->goods_id = $gid;
                    $goods->is_new = 0;
                    $goods->save();
                    $v = 0;
                }
                echo json_encode(array('info' => 1, 'colname' => 'is_new', 'data' => $v));
                break;
            case 9:
                $goods = M("Goods");
                $v = 0;
                $is_on_sale = $goods->where("goods_id=$gid")->getField("is_hot");
                if (intval($is_on_sale) == 0) {
                    $goods->goods_id = $gid;
                    $goods->is_hot = 1;
                    $goods->save();
                    $v = 1;
                } else {
                    $goods->goods_id = $gid;
                    $goods->is_hot = 0;
                    $goods->save();
                    $v = 0;
                }
                echo json_encode(array('info' => 1, 'colname' => 'is_hot', 'data' => $v));
                break;
        }
    }

    //商品批量上架和下架列表页
    public function automatic() {
	quanx('spin');
        $user_id=$_SESSION['USER'];
        $user=M('user')->where("id='$user_id'")->find();
        $ugrand=$user['grand'];
        $userup=$user['user_up'];
        if($ugrand==3){
        $page = I('page')? : 1;
        $count = M("goods")->where("user_id='$user_id'")->count();
        $rpage = Page($count, 9, $page);
        $rpage1 = $rpage['page_l'];
        $rpage2 = $rpage['page_r'];
        $goodlist = M('goods')->where("user_id='$user_id'")->limit("$rpage1,$rpage2")->order('goods_id desc')->select();
        $this->assign('goods', $goodlist);
        $this->assign('rpage', $rpage['page']);
        }else if ($ugrand==2) {

        $page = I('page')? : 1;
        $count = M("goods")->where("fz_id='$user_id'")->count();
        $rpage = Page($count, 9, $page);
        $rpage1 = $rpage['page_l'];
        $rpage2 = $rpage['page_r'];
        $goodlist = M('goods')->where("fz_id='$user_id'")->limit("$rpage1,$rpage2")->order('goods_id desc')->select();
        $this->assign('goods', $goodlist);
        $this->assign('rpage', $rpage['page']);
        //总站
        }
        /* 遍历商品列表结束 */
        $this->display();
    }

    //商品批量上架
    public function all_on_sale() {
		quanx('spin');
        $id = explode('-', substr(trim($_POST['id']), 0, -1));
        // var_dump($id);exit;
        $num = count($id);
        $sub = array();
        for ($i = 0; $i < $num; $i++) {
            $result = M('goods')->where("goods_id='$id[$i]'")->setField("is_on_sale", 1);
        }
        echo json_encode(array('info' => 1));
    }

    //商品批量下架
    public function all_down_sale() {
		quanx('spin');
        $id = explode('-', substr(trim($_POST['id']), 0, -1));
        // var_dump($id);exit;
        $num = count($id);
        $sub = array();
        for ($i = 0; $i < $num; $i++) {
            $data['is_on_sale'] = 0;
            $data1['goods_count'] = 0;
            $result = M('goods')->where("goods_id='$id[$i]'")->setField($data);
            $result1 = M('goods_attr')->where("goods_id='$id[$i]'")->setField($data1);
            /* 库存日志开始 */
            $time = M('user_ghs_gn')->where("sp_id='$id[$i]'")->distinct(true)->field("goods_attr_id")->select();
            foreach ($time as $key => $valu) {
                foreach ($valu as $k => $va) {
                    $beforenum = M('user_ghs_gn')->where("sp_id='$id[$i]' AND goods_attr_id='$va'")->order("id desc")->getField("endnum");
                    $kcdata['startnum'] = $beforenum;
                    $kcdata['endnum'] = 0;
                    $uid = session('USER');
                    $kcdata['up_id'] = $uid;
                    $kcdata['sp_id'] = $id[$i];
                    $kcdata['goods_attr_id'] = $va;
                    $kcdata['c_time'] = date('Y-m-d,H:i:s', time());
                    $kcdata['content'] = "批量下架";
                    $kuncun = M('user_ghs_gn')->add($kcdata);
                }
            }
            /* 库存日结束 */
        }
        echo json_encode(array('info' => 1));
    }

    //商品图片集
    public function image_edit() {
//        quanx('spin');
        if (empty($_FILES['fileList'])) {
            $id = $_GET['id'];
			$uid=session("USER");
            $data = M('goods')->where("goods_id='$id' and user_id=$uid")->find();
            if(!$data){
            $this->redirect("Public/error1");
            }
            $this->assign("goods_id",$id);
            session('goods_id_up', $id);
            $img = M('goods_gallery')->where("goods_id='$id'")->select();
            foreach($img as $k=>$v){
                if(substr($v['img_url'],0,1)=='/'){
                    $img[$k]['img_url']=$v['img_url'];
                    $img[$k]['pd']=1;
                }else{
                $dir=  dirname($v['img_url']);
                $name=  basename($v['img_url']);
                $img[$k]['img_url']=$dir.'/s_'.$name;
                }
            }
            $this->assign('img', $img);
            $this->display();
        } else {

            $upload = new \Think\Upload(); // 实例化上传类
            $upload->maxSize = 3145728; // 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = 'images/'; // 设置附件上传（子）目录
            $upload->saveName = array('uniqid', time() . '_' . mt_rand());
            // 上传文件 
            $info = $upload->upload();

            if (!$info) {// 上传错误提示错误信息
                $this->ajaxReturn($upload->getError());
            } else {// 上传成功入库
                foreach ($info as $file) {

                    $imgpath = $file['savepath'];
                    $imgname = $file['savename'];
                    $path = $file['savepath'] . $file['savename'];
                    // var_dump($path);exit;

                    $date['goods_id'] = $_SESSION['goods_id_up'];
                    $date['img_url'] = $path;
                    $image = new \Think\Image(); 
                    $image->open(APP_PATH."../Uploads/".$path);// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                    $path1= $file['savepath'].'s_'.$file['savename'];
                    $image->thumb(422, 422)->save(APP_PATH."../Uploads/".$path1);//详情图片
                    $path2=$file['savepath'].'c_'.$file['savename'];
                    $image->thumb(100, 80)->save(APP_PATH."../Uploads/".$path2);//购物车图片
                    // var_dump($date);exit;
                    $result = M('goods_gallery')->add($date);
                    $id=$_SESSION['goods_id_up'];
                    $img=M('goods')->where("goods_id='$id'")->find();
                    if(empty($img['goods_thumb'])){
                         M('goods')->where("goods_id='$id'")->setField('goods_thumb',$path);
                    }
                }
            }
        }
    }

    //商品图集删除
    public function deleteimg() {
		quanx('spin');
        $id = $_POST['gallery_id'];
        $imgpath = M('goods_gallery')->where("gallery_id='$id'")->find();
        $field = "./Uploads/" . $imgpath['img_url'];
        $gid=$imgpath['goods_id'];
        unlink($field);
        $dir=  dirname($field);
        $s_name=  basename($field);
        
        unlink($dir."/s_".$s_name);
        unlink($dir."/c_".$s_name);
        $result = M('goods_gallery')->where("gallery_id='$id'")->delete();
        if ($result) {
            $path=M("GoodsGallery")->where("goods_id=$gid")->getField("img_url");
            if(!$path){
                $path='';
            }
            $re=M("Goods")->where("goods_id=$gid")->setField("goods_thumb",$path);
            if($re){
                $data['status'] = 1;
            }
        } else {
            $data['status'] = 0;
        }

        echo json_encode($data);
    }

    //删除商品所有图集
    public function delete_all_img() {
		quanx('spin');
        $id = explode('-', substr(trim($_POST['id']), 0, -1));
        $num = count($id);
        $sub = array();
        for ($i = 0; $i < $num; $i++) {
            $sys = M('goods_gallery');
            $sys->delete($id[$i]);
            $gid=$sys->where("gallery_id={$id[$i]}")->getField("goods_id");
            $goods_thumb=M("Goods")->where("goods_id=$gid")->getField("goods_thumb");
            if($goods_thumb){
               $re=M("Goods")->where("goods_id=$gid")->setField("goods_thumb",''); 
            }
        }
        echo json_encode(array('info' => 1));
    }

    //查看销量统计图
    public function salecount() {
		quanx('spin');

        if (empty($_POST['stime'])) {
            $id = $_GET['id'];
            $time1 = strtotime('20150101');
            $time2 = strtotime('20150401');
            $time3 = strtotime('20150701');
            $time4 = strtotime('20151001');
            $time5 = strtotime('20151231');
        } else {

            $id = $_GET['id'];
            $t = intval($_POST['stime']);

            $time1 = "$t" . '0101';
            $time1 = strtotime("$time1");
            $time2 = "$t" . '0401';
            $time2 = strtotime("$time2");
            $time3 = "$t" . '0701';
            $time3 = strtotime("$time3");
            $time4 = "$t" . '1001';
            $time4 = strtotime("$time4");
            $time5 = "$t" . '1231';
            $time5 = strtotime("$time5");
        }


        $result1 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                        where("lx_order_goods.goods_id='$id' and lx_order_info.order_status=6 and lx_order_info.add_time between '$time1' and '$time2' ")->sum('lx_order_goods.goods_number');
        $result2 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                        where("lx_order_goods.goods_id='$id' and lx_order_info.order_status=6 and lx_order_info.add_time between '$time2' and '$time3' ")->sum('lx_order_goods.goods_number');

        $result3 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                        where("lx_order_goods.goods_id='$id' and lx_order_info.order_status=6 and lx_order_info.add_time between '$time3' and '$time4' ")->sum('lx_order_goods.goods_number');

        $result4 = M('order_goods')->join('lx_order_info ON lx_order_goods.order_id=lx_order_info.order_id', 'left')->
                        where("lx_order_goods.goods_id='$id' and lx_order_info.order_status=6 and lx_order_info.add_time between '$time4' and '$time5' ")->sum('lx_order_goods.goods_number');
//var_dump($result1.'---'.$result2.'---'.$result3.'---'.$result4);exit();
        $result1 = empty($result1) ? 0 : $result1;
        $result2 = empty($result2) ? 0 : $result2;
        $result3 = empty($result3) ? 0 : $result3;
        $result4 = empty($result4) ? 0 : $result4;
        $data = array();
        $arr = array();
        $arr['day'] = '第一季度';
        $arr['sales'] = intval($result1);
        array_push($data, $arr);
        $arr = array();
        $arr['day'] = '第二季度';
        $arr['sales'] = intval($result2);
        array_push($data, $arr);
        $arr = array();
        $arr['day'] = '第三季度';
        $arr['sales'] = intval($result3);
        array_push($data, $arr);
        $arr = array();
        $arr['day'] = '第四季度';
        $arr['sales'] = intval($result4);
        array_push($data, $arr);
        $data = json_encode($data);

        $this->assign('data', $data);
        $this->display();
    }

    public function gselect() {
        $cate = M("Category");
        $data = $cate->where("pid=0")->select();
        $str = '<select><option value="">请选择</option>';
        foreach ($data as $v) {
            $sub = $this->getsub($v['cat_id']);
            $str .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>" . $sub;
        }
        $str .= '</select>';
        echo $str;
    }

    public function bselect() {
        $brand = M("Brand");
        $data = $brand->select();
        $str = '<select><option value="">请选择</option>';
        foreach ($data as $v) {
            $str .= "<option value='{$v['brand_id']}'>{$v['brand_name']}</option>";
        }
        $str .= '</select>';
        echo $str;
    }

    public function attr() {
		quanx('spin');
        $page = empty($_POST['page']) ? 1 : $_POST['page'];
        $limit = empty($_POST['rows']) ? 100 : $_POST['rows'];
        $good_id = I('get.id');
        //var_dump($good_id);exit();
        $attr = M("GoodsAttr");
        $attr = $attr->where("goods_id=$good_id")->select();
        foreach ($attr as $k => $v) {
            if(!$v['attr_id']){
                $attr[$k]['attr_name'] = '暂无属性数据';
            }else{
            $a_id = explode('-', rtrim($v['attr_id'], '-'));
            $a_value = explode('-', rtrim($v['attr_value'], '-'));
            $num = count($a_id);
            $attr_name = '';
            for ($i = 0; $i < $num; $i++) {
                $attribute = M("GoodsAttribute");
                $a_n = $attribute->where("attr_id={$a_id[$i]}")->getField("attr_name");
                $a_v = $a_value[$i];
                $attr_name.=$a_n . ':' . $a_v . ';';
            }
            //$attr_name=str_replace(' ','',$attr_name);
            //var_dump($attr_name);exit();
            $attr[$k]['attr_name'] = rtrim($attr_name, ';');
            }
        }
        //var_dump($attr);exit();
        $ret = array();
        $ret['page'] = $page;
        $ret['rows'] = $attr;
        $ret['total'] = $total_pages;
        $ret['records'] = $count;
        $ret['limit'] = $limit;
        echo json_encode($ret);
    }

    //商品关联修改页面
    public function gabout_edit() {
		quanx('spin');
        $id = I('get.id');
		$uid=session("USER");
        $data2 = M('goods')->where("goods_id='$id' and user_id=$uid")->find();
        if(!$data2){
            $this->redirect("Public/error1");
        }
        session('upgid', $id);
        $data1 = M('link_goods')->where("goods_id='$id'")->select();
        $this->assign('data1', $data1);
        foreach ($data1 as $k => $v) {
            $cid = $v['link_goods_id'];
            $arr = M('goods')->where("goods_id=$cid")->find();
            $data[$k]['gname'] = $arr['goods_name'];
            $data[$k]['gid'] = $arr['goods_id'];
        }


        if (empty($_POST)) {
            $cateData = M('category')->where('pid=0')->select();
            $str = '<select class="col-sm-3 form-control" id="sboxit-2" name="cat_id" ><option value="">选择商品类别</option>';
            foreach ($cateData as $v) {
                $str .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>" . $this->getsub($v['cat_id']);
            }
            $str .= '</select>';
            $this->assign('data', $str);

            //商品的品牌
            $brand = M('brand')->select();
            $this->assign('brand', $brand);
            $data = json_encode($data);
            $this->assign('result', $data);
            $this->display();
        } else {

            $id = $_SESSION['upgid'];
            $data1 = M('link_goods')->where("goods_id='$id'")->select();
            $this->assign('data1', $data1);
            foreach ($data1 as $k => $v) {
                $cid = $v['link_goods_id'];
                $arr = M('goods')->where("goods_id=$cid")->find();
                $data[$k]['gname'] = $arr['goods_name'];
                $data[$k]['gid'] = $arr['goods_id'];
            }

            $goodlist = M('goods');
            if (!empty($_POST['goods_name'])) {
                $name = $_POST['goods_name'];
                $chaxun->goods_name = array("like", "%$name%");
            } elseif (!empty($_POST['cat_id'])) {
                $chaxun->cat_id = $_POST['cat_id'];
            } elseif (!empty($_POST['brand_id'])) {
                $chaxun->brand_id = $_POST['brand_id'];
            }

            $goods = $goodlist->where($chaxun)->order('goods_id desc')->select();
            $this->assign('goods', $goods);
            //商品分类信息
            $cateData = M('category')->where('pid=0')->select();
            $str = '<select class="col-sm-3 form-control" id="sboxit-2" name="cat_id" ><option value="">选择商品类别</option>';
            foreach ($cateData as $v) {
                $str .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>" . $this->getsub($v['cat_id']);
            }
            $str .= '</select>';
            $this->assign('data', $str);

            //商品的品牌
            $uid=  session("USER");
            $fz_id=M("User")->where("id=$uid")->getField("user_up");//分站id
            $brand = M('brand')->where("fz_id=$fz_id")->select();
            $this->assign('brand', $brand);
            $data = json_encode($data);
            $this->assign('result', $data);

            $this->display();
        }
    }

    //关联商品修改
    public function upgabout() {
		quanx('spin');
        $data = explode(',', substr($_POST['gid'], 0, -1));
        $id = $_SESSION['upgid'];
        $del = M('link_goods')->where("goods_id='$id'")->delete();

        $result = M('link_goods');
        foreach ($data as $k => $v) {
            $a_data = explode('-', $v);
            $lid = $a_data;
			if($lid){
				foreach ($lid as $v) {
					$result->link_goods_id = $v;
					$result->goods_id = $_SESSION['upgid'];
					$result->admin_id = $_SESSION['USER'];
					$result->add();
					if($result){
					$ainfo=1;
					}else{
						$ainfo=0;
					}
				}
			}else{
				$ainfo=0;
			}
        }
        echo json_encode(array('info' => 1));
    }

    //关联商品添加页面

    public function gabout() {
//		quanx('spin');
        //商品分类信息
        if (empty($_POST)) {
            $cateData = M('category')->where('pid=0')->select();
            $str = '<select class="col-sm-3 form-control" id="sboxit-2" name="cat_id" ><option value="">选择商品类别</option>';
            foreach ($cateData as $v) {
                $str .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>" . $this->getsub($v['cat_id']);
            }
            $str .= '</select>';
            $this->assign('data', $str);

            //商品的品牌
            $brand = M('brand')->select();
            $this->assign('brand', $brand);
            $this->display();
        } else {

            $goodlist = M('goods');
            if (!empty($_POST['goods_name'])) {
                $name = $_POST['goods_name'];
                $chaxun->goods_name = array("like", "%$name%");
            } elseif (!empty($_POST['cat_id'])) {
                $chaxun->cat_id = $_POST['cat_id'];
            } elseif (!empty($_POST['brand_id'])) {
                $chaxun->brand_id = $_POST['brand_id'];
            }

            $goods = $goodlist->where($chaxun)->order('goods_id desc')->select();
            $this->assign('goods', $goods);



            //商品分类信息
            $cateData = M('category')->where('pid=0')->select();
            $str = '<select class="col-sm-3 form-control" id="sboxit-2" name="cat_id" ><option value="">选择商品类别</option>';
            foreach ($cateData as $v) {
                $str .= "<option value='{$v['cat_id']}'>{$v['cat_name']}</option>" . $this->getsub($v['cat_id']);
            }
            $str .= '</select>';
            $this->assign('data', $str);

            //商品的品牌
            $uid=  session("USER");
            $fz_id=M("User")->where("id=$uid")->getField("user_up");//分站id
            $brand = M('brand')->where("fz_id=$fz_id")->select();
            $this->assign('brand', $brand);

            $this->display();
        }
    }

//添加关联商品
    public function addgabout() {
		quanx('spin');
        $gid = $_SESSION['goods_id'];
        if (!$gid) {
            echo json_encode(array('info' => 3, 'msg' => '请先去添加商品吧！'));
            return;
        }
        $data = explode(',', substr($_POST['gid'], 0, -1));
        $result = M('link_goods');
        foreach ($data as $k => $v) {
           $a_data = explode('-', $v);
            $lid = $a_data;
			if($lid){
				foreach ($lid as $v) {
                $result->link_goods_id = $v;
                $result->goods_id = $_SESSION['goods_id'];
                $result->admin_id = $_SESSION['USER'];
                $result->add();
				if($result){
					$ainfo=1;
				}else{
					$ainfo=0;
				}
				}
			}else{
				$ainfo=0;
			}   
        }
        echo json_encode(array('info' => 1));
    }

    public function addpcat() {
		quanx('spin');
        $cid = I('post.cat_id');
        $name = I('post.cname');
        $data = M('category')->where("cat_id='$cid'")->find();
        if($data['ctype']==1){
               echo json_encode(array('status' => 2));
            return;                                          
        }else{
        $path=$data['path'];
        $a_path=explode('-', $path);
            $pcount=count($a_path);
        if($pcount-1==2){
        $aid=$_SESSION['USER'];
        $cat['pid'] = $cid;
        $cat['parent_id'] = $cid;
        $cat['cat_name'] = $name;
        $cat['path'] = $cid . '-' . $data['path'];
        $cat['ctype'] = 1;
        $cat['admin_id']=$aid;
        $result = M('category')->add($cat);

        if ($result) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
    }else{
            $data['status'] =3; 
            } 
        }

        echo json_encode($data);
    }

    //商品库存
    public function log() {
		quanx('spin');
        $page = empty($_POST['page']) ? 1 : $_POST['page'];
        $limit = empty($_POST['rows']) ? 10 : $_POST['rows'];
        $gid = I("get.id");
        $log = M("UserGhsGn");

        $sidx = I("post.sidx");
        $sord = I("post.sord");

        $total = $log->where("sp_id=$gid")->order("$sidx $sord")->count();
        $count = $total;
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        $start = $limit * ($page - 1);
        $data = $log->where("sp_id=$gid")->order("$sidx $sord")->select();
        foreach ($data as $k => $v) {
            $up_id = $v['up_id'];
            $user = M("User");
            $u_data = $user->where("id=$up_id")->find();
            $data[$k]['up_name'] = $u_data['name'];
        }
        $ret = array();
        $ret['page'] = $page;
        $ret['rows'] = $data;
        $ret['total'] = $total_pages;
        $ret['records'] = $count;
        $ret['limit'] = $limit;
        echo json_encode($ret);
    }

    //商品属性添加页面
    public function addattrs() {
//		quanx('spin');
        $typelist = M('goods_type')->select();
        foreach ($typelist as $k => $v) {
            $type_id = $v['type_id'];
            $goods_attribute = M("GoodsAttribute");
            $d = $goods_attribute->field("attr_name")->where("cat_id=$type_id")->select();
            if (!$d) {
                unset($typelist[$k]);
            }
        }
        $this->assign('type', $typelist);
        $this->display();
    }

    //商品图片集添加页面
    public function addimage() {
		quanx('spin');
        $this->display();
    }

    //商品首页展示
    public function index_sys() {
        quanx('index_sys');
        $user=session("USER");
        $goods = M("Goods");
        $g_data = $goods->where("(is_alone_sale=1 or is_best=1) and fz_id=$user")->select();
        $this->assign('data', $g_data);
        $this->display();
    }

    //商品首页展示操作
    public function sys() {
//        quanx('index_sys');
        $type = I("post.type");
        $uid=  session("USER");
        if ($type == 'add') {
            $gid = trim(I("post.id"));
            $fz_id=M('Goods')->where("goods_id=$gid")->getField("fz_id");
            if($uid!=$fz_id){
                echo json_encode(array('info' => 2));//没有权限
            }
            $is_alone_sale = I("post.is_alone_sale");
            $is_best = I("post.is_best");
            //dump($gid);exit();
            $goods = M("Goods");
            $goods->goods_id = $gid;
            $goods->is_alone_sale = $is_alone_sale;
            $goods->is_best = $is_best;
            $result = $goods->save();
            //dump($result);exit();
            if ($result) {
                echo json_encode(array('info' => 1));
            } else {
                echo json_encode(array('info' => 0));
            }
        } else if ($type == 'edit') {
            $gid = trim(I("post.id"));
            $is_alone_sale = I("post.is_alone_sale");
            $is_best = I("post.is_best");
            $goods = M("Goods");
            $goods->goods_id = $gid;
            $goods->is_alone_sale = $is_alone_sale;
            $goods->is_best = $is_best;
            $result = $goods->save();
            if ($result) {
                echo json_encode(array('info' => 1));
            } else {
                echo json_encode(array('info' => 0));
            }
        } else if ($type == 'delete_all') {
            $gid = explode('-', rtrim(I("post.id"), '-'));
            $num = count($gid);
            for ($i = 0; $i < $num; $i++) {
                $g_id = $gid[$i];
                $goods = M("Goods");
                $goods->goods_id = $g_id;
                $goods->is_alone_sale = 0;
                $goods->is_best = 0;
                $result = $goods->save();
            }
            echo json_encode(array('info' => 1));
        }
        if (I("get.type") == 'delete') {
            $gid = I("get.gid");
            $goods = M("Goods");
            $goods->goods_id = $gid;
            $goods->is_alone_sale = 0;
            $goods->is_best = 0;
            $result = $goods->save();
            $this->redirect("Goods/index_sys");
        }
    }
    /*属性增加对象*/
    public function Catt(){
        $i='';$id=I('id');
        //第一层数据的组装
        $rows=M('category')->where("cat_id=$id")->select();
        //单条属性
        foreach($rows as $vvv){
            $zhiz=$vvv['rules'];
            if($zhiz){
                if($zhiz[1]){$zhiz=substr($zhiz,0,strlen($zhiz)-1);}
                $gz= explode('|',$zhiz);
//1
                foreach($gz as $k=>$a){
                    $i.='<div class="panel-heading"><h3 class="panel-title lbt">'.Aname($a).'</h3></div>';
                    $i.='<div class="panel-body"><div class="col-sm-10">';
                     $rules=M("goods_attr_over")->where("pid=$a")->field('cat_name,cat_id')->select();
                    //出属性
                    foreach($rules as $k1=>$a1){
                        $i.='<input class="icheck" name="'.$k.'" type="radio" value="'.$a1['cat_id'].'" id="$k.$k1"><label for="'.$k.$k1.'">'.$a1['cat_name'].'</label>';
                    }
                    $i.='</div></div></div>';
                }
//1
            }
        }
        echo $i;
        }


}

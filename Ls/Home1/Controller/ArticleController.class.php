<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class ArticleController extends PublicController {
    public function index(){
        $name=trim(I("get.name"));
        /*$atype=M("Arctype");
        $type_id=$atype->where("type_id='{$name}'")->getField("type_id");*/
        $article=M("Article");
        $article=$article->where("type_id=$name")->find();
        $index=I("get.index");
        $this->assign('index',$index);
        $this->assign('adata',$article);
        $this->display();
    }
     
}

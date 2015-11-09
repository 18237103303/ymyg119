<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class CeckController extends Controller {
   public function _initialize(){
       if(empty($_SESSION['Q_user'])){
		 $this->redirect('User/Qtdz/login'); 
	   }
    }
    
}

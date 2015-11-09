<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends PublicController {
    public function login(){
        $this->display();
    }
    public function register(){
        $this->display();
    }
}

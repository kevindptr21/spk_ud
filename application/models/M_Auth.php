<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model {
    
    public function isLogin($uname,$pass){
        return $this->db
        ->select("*")
        ->from("user")
        ->where("username",$uname)
        ->where("password",$pass)
        ->get()->result_array();
    }
}

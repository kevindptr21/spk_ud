<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Auth extends CI_Model{
    
    public function isLogin($uname,$pass){
        $this->db->select("*");
        $this->db->from("user");
        $this->db->where("username = '$uname' AND password = '$pass'");
        $valid = $this->db->get()->result_array();
        return $valid;
    }
}

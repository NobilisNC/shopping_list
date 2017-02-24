<?php

class ShopList_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function getShops(){
        $query = $this->db->get('shop');
        return $query->result();
    }
}
?>

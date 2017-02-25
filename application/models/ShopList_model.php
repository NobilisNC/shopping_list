<?php

class ShopList_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function getShops(int $id_user){
        $this->db->from('shop');
        $this->db->join('user_shops','shop.id=user_shops.id_shop');
        $this->db->where('user_shops.id_user',$id_user);
        $this->db->where('shop.etat','approved');
        $query = $this->db->get();
        return $query->result();
    }
}
?>

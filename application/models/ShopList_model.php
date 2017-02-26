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

    public function getAllShops(){
        $query = $this->db->get('shop');
        return $query->result();
    }

    public function getShopIn(string $in){
        $this->db->select('name,location')
                 ->from('shop')
                 ->where("name LIKE '".$in."%'")
                 ->where('etat','approved')
                 ->order_by('name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function addShopToUser($user_id,$shop_name){

        $shop_information = explode(" - ",$this->input->post('name_shop_to_add'));
        $name = $shop_information[0];
        $location = $shop_information[1];

        $this->db->select('id');
        $this->db->from('shop');
        $this->db->where('name',$name);
        $this->db->where('location',$location);

        $query = $this->db->get();
        $shop_id = $query->result();

        $data = array (
                'id_shop' => $shop_id[0]->id,
                'id_user' => $user_id
        );

        $query = $this->db->get_where('user_shops', $data);

        if ($query->num_rows() > 0 ) {
            //On fait rien
        } else {
                    $this->db->insert('user_shops', $data);
        }
    }
}
?>

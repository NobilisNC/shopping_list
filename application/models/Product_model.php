<?php

class Product_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function getProduct(){
        $query = $this->db->get('product');
        return $query->result();
    }

    public function addproduct($name,$exp,$weight,$vol){
      $data = array(
        'name' => $name ,
        'coldness' => $exp,
        'weight' => $weight,
        'volume' => $vol
      );

        return $this->db->insert('product',$data);
    }

    public function supprproduct($name){
      return $this->delete('product',$name);
    }
}
?>

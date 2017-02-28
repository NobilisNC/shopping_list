<?php

class Product_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

    public function getProduct(){
        $query = $this->db->get('product');
        return $query->result();
    }

    public function addproduct($product_data){
        return $this->db->insert('product',$product_data);
    }

    public function deleteProduct($id_product){
      return $this->db->where('id',$id_product)
                    ->delete('product');
    }
}
?>

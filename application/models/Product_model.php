<?php

class Product_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

   /** @brief Gets product
    *
    *
    */
    public function getProduct(){
        $query = $this->db->get('product');
        return $query->result();
    }

    /** @brief Creates and adds a product in the database
     *
     * @param $name - The product's name
     * @param $exp - A value to indicate if the product is cold
     * @param $weight - The product's weight
     * @param $vol - The product's volume
     */
     public function addproduct($product_data){
         return $this->db->insert('product',$product_data);
     }

    /** @brief Deletes a specified product
     *
     * @param $name - The products name
     */
     public function deleteProduct($id_product){
       return $this->db->where('id',$id_product)
                     ->delete('product');
    }
}
?>

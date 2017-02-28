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
    public function add_product($name, $exp, $weight, $vol){
      $data = array(
        'name' => $name ,
        'coldness' => $exp,
        'weight' => $weight,
        'volume' => $vol
      );

        return $this->db->insert('product',$data);
    }

    /** @brief Deletes a specified product
     *
     * @param $name - The products name
     */
    public function delete_product($name){
      return $this->delete('product',$name);
    }
}
?>

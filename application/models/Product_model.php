<?php

class Product_model extends CI_Model{
    public function __construct(){
        $this->load->database();
    }

   /** @brief Gets all products
    *
    * @return The list of all products in the database
    */
    public function getAllProduct(){
        $query = $this->db->get('product');
        return $query->result();
    }

    public function getProductById($id){
        return $this->db->get_where('product', array('id' => $id))->result()[0];
    }

    /** @brief Creates and adds a product in the database
     *
     * @param $name - The product's name
     * @param $exp - A value to indicate if the product is cold
     * @param $weight - The product's weight
     * @param $vol - The product's volume
     */
     public function addproduct($product_data){
       ///@todo Doit renvoyer un booléen
         return $this->db->insert('product',$product_data);
     }

    /** @brief Deletes a specified product
     *
     * @param $name - The products name
     */
     public function deleteProduct($id_product){
       ///@todo Doit renvoyer un booléen
       return $this->db->where('id',$id_product)
                     ->delete('product');
    }


    public function name_exist($name) {
      $query = $this->db->get_where('product', array('name' => $name));

      if($query->num_rows() > 0)
          return TRUE;
      else
          return FALSE;

    }

    public function setName($id_product,$new_name){
        $this->db->where('id',$id_product);
        $this->db->update('product',array('name' => $new_name));
    }
}
?>

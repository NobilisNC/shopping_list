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

    /** @brief Returns the product with the specified id
    *
    * @param $id - A product id
    *
    * @return The product with the specified id
    */
    public function getProductById($id){
        return $this->db->get_where('product', array('id' => $id))->result()[0];
    }

    /** @brief Creates and adds a product in the database
     *
     * @param $product_data - All the data about a product : id, name, coldness and weight
     */
     public function addproduct($product_data){
       ///@todo Doit renvoyer un booléen
        if ($this->db->insert('product',$product_data) == TRUE) {
          return TRUE;
        } else {
          return FALSE;
        }
     }

    /** @brief Deletes a specified product
     *
     * @param $id_product - The product id
     */
     public function deleteProduct($id_product){
       ///@todo Doit renvoyer un booléen
       return $this->db->where('id',$id_product)
                     ->delete('product');
    }

    /** @brief Verifies if
    *
    *
    *
    */
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

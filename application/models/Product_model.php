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

    /** @brief Verifies if the specified name exists in the database
    *
    * @detail When you try to add a product in the database, verifies
    *       if it already exists.
    *
    * @param $name - A product name
    *
    * @return Boolean - TRUE if the name doesn't exist (and the product is added)
    *                   FALSE if the name already exists (and the product isn't added)
    */
    public function name_exist($name) {
      $query = $this->db->get_where('product', array('name' => $name));

      if($query->num_rows() > 0)
          return TRUE;
      else
          return FALSE;

    }

    /** @detail Changes the name of a specified product
    *
    * @param $id_product - A specified product id
    * @param $new_name - The new name for the specified product
    */
    public function setName($id_product,$new_name){
        $this->db->where('id',$id_product);
        $this->db->update('product',array('name' => $new_name));
    }

    public function setColdness($id_product,$new_coldness){
        $this->db->where('id',$id_product);
        $this->db->update('product',array('coldness' => $new_coldness));
    }

    public function setWeight($id_product,$new_weight){
        $this->db->where('id',$id_product);
        $this->db->update('product',array('weight' => $new_weight));
    }
}
?>

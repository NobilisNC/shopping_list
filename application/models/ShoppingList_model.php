<?php

class ShoppingList_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    /**
    * Create an empty List for a specified user
    *
    *
    */
    public function createEmptyList(int $id_user) {
      $data = array(
          'name' => 'Empty List',
          'date' => date('Y/m/d'),
          'id_user' => $id_user
      );

      return $this->db->insert('list', $data);

    }

    /**
    * Get all lists of a specified user(id)
    *
    */
    public function getLists(int $id){
      $query = $this->db->get_where('list', array('id_user' => $id));

      return $query->result();

    }

    /**
    * Get a list by giving it id
    *
    *
    */
    public function getListById(int $id) {
      $query = $this->db->get_where('list', array('id' => $id));
      return $query->result()[0];
    }

    /**
    * Set name of a specified list
    *
    *
    */
    public function setName(int $id, string $name) {
      $data = array (
        'name' => $name
      );

        $this->db->where('id', $id);
        $this->db->update('list', $data );
    }


    public function getProducts(int $id) {
        $this->db->select('name, amount, id')
                 ->from('product')
                 ->join('list_product', 'list_product.id_product = product.id')
                 ->where('list_product.id_list = '.$id);

        $query = $this->db->get();
        return $query->result();
    }

    public function getProductsLike(string $name) {
        $this->db->select('name')
                 ->from('product')
                 ->where("name LIKE '".$name."%'");

        $query = $this->db->get();
        $products = array();
        foreach($query->result() as $p)
          $products[] = $p->name;

        return $products;
      }

      /**
      * Add a product to a specidied list
      *
      * Return True/false if insered or not
      */
      public function addProductToList(int $id_list, string $product_name ) {
          $result = $this->db->get_where('product', array('name'=> $product_name));
          if($result->num_rows() == 0)
            return false;

           $id_product = $result->result()[0]->id;

           $data = array(
             'id_list' => $id_list,
             'id_product' => $id_product,
             'amount' => 1
           );

           $this->db->insert('list_product', $data);
           return true;
      }

      public function deleteProductFromList(int $id_list, int $id_product) {
          $this->db->where(array('id_list' => $id_list, 'id_product' => $id_product))
                   ->delete('list_product');
      }



}

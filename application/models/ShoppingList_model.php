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

    /** Delete a list with a specified id
      *
      */
    public function deleteList(int $id_list) {
      $this->db->delete('list', array( 'id' => $id_list));
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

    /** Return products of a specified list
      *
      *
      */
    public function getProducts(int $id_list) {
        $this->db->select('name, amount, id')
                 ->from('product')
                 ->join('list_product', 'list_product.id_product = product.id')
                 ->where('list_product.id_list = '.$id_list);

        $query = $this->db->get();
        return $query->result();
    }

    /** Return names of product like param.
      * Used from Ajax request
      *
      *
      */
    public function getProductsLike(string $name) {
        $this->db->select('id, name')
                 ->from('product')
                 ->where("name LIKE '".$name."%'")
                 ->order_by('name', 'asc');

        $query = $this->db->get();

        return $query->result();
      }

      /**
      * Add a product to a specidied list
      *
      * Return True/false if insered or not
      */
      public function addProductToList(int $id_list, string $id_product ) {

           $data = array(
             'id_list' => $id_list,
             'id_product' => $id_product,
             'amount' => 1
           );

           $this->db->insert('list_product', $data);
           return true;
      }

      /** Delete a product for a specidied list
        *
        *
        */
      public function deleteProductFromList(int $id_list, int $id_product) {
          $this->db->where(array('id_list' => $id_list, 'id_product' => $id_product))
                   ->delete('list_product');
          return true;
      }

      /** Return Product by it ID.
        *
        *
        *
        */
      public function getProductById(int $id_prod) {
        return $this->db->get_where('product', array('id' => $id_prod))->result()[0];
      }


      /** Set the amount of a product in a specified list and specified product
        *
        *
        */
        public function setAmount(int $id_list, int $id_product, int $amount) {
          $this->db->set('amount', $amount)
                   ->where('id_list', $id_list)
                   ->where('id_product', $id_product)
                   ->update('list_product');

          return true;
        }

        /** Get amount of a product in a specified list and specified product
          *
          *
          */
          public function getAmount(int $id_list, int $id_product) {
            return $this->db->select('amount')
                            ->from('list_product')
                            ->where('id_product', $id_product)
                            ->where('id_list', $id_list)
                            ->get()->result()[0]->amount;
          }


      public function updateNote(int $id_list, string $note) {
        $this->db->set('note', $note)
                 ->where('id', $id_list)
                 ->update('list');
      }
}

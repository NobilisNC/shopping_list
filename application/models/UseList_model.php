<?php

class UseList_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    /** @brief Creates a useList
     *
     * @param $id_list - The id for the list to be created
     *
     **/
    public function useList(int $id_list) {
      //Create instance of `use_list`
      $this->db->insert('use_list', array('id_list' => $id_list));
      $id_use_list = $this->db->get_where('use_list', array('id_list' => $id_list))->result()[0]->id;

      $products = $this->db->get_where('list_product', array('id_list' => $id_list))->result();

      foreach ($products as $p) {
        $this->db->insert('use_list_product', array(
            'id_list' => $id_use_list,
            'id_product' => $p->id_product
        ));
      }

      return $id_use_list;
    }

    /** @brief Deletes the specified useList
    *
    * @param $id - The id of the list to be deleted
    */
    public function deleteList(int $id) {
      $this->db->where(array('id' => $id))
               ->delete('use_list');
    }

    /** @brief Gets the products in the specified useList
    *
    * @param $id - A specified useList id
    *
    * @return $results - An array with all the information about each product
    */
    public function getProducts(int $id) {
      $this->db->select(array('id', 'name', 'amount', 'checked', 'modif', 'weight', 'coldness'))
               ->from('use_list_product')
               ->join('list_product', 'use_list_product.id_product = list_product.id_product')
               ->join('product', 'use_list_product.id_product = product.id')
               ->where('use_list_product.id_list = '.$id );

      $results = $this->db->get()->result();
      return $results;
    }

    /** @brief Checks a product as "taken" in the specified useList
    *
    * @param $id_product - The checked product id
    * @param $id_list - The list id
    */
    public function check(int $id_product, int $id_list) {
      return $this->db->set('checked', true)
                      ->where(array('id_list' => $id_list, 'id_product' => $id_product))
                      ->update('use_list_product');
    }

    /** @brief Unchecks a checked product in the specified useList
    *
    * @param $id_product - The checked product id
    * @param $id_list - The list id
    */
    public function uncheck(int $id_product, int $id_list) {
      return $this->db->set('checked', false)
                      ->where(array('id_list' => $id_list, 'id_product' => $id_product))
                      ->update('use_list_product');
    }

    public function isOwner(int $id_list, int $id_user) {
      $this->db->select(array('user.id'))
              ->from('use_list')
              ->join('list', 'use_list.id_list = list.id')
              ->join('user', 'list.id_user = user.id')
              ->where('user.id = '.$id_user);

      $result = $this->db->get();

      if($result->num_rows() > 0)
        return true;
      else
        return false;
    }
    
}

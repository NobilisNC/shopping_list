<?php

class UseList_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    /**
     *
     *
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


    public function deleteList(int $id) {
      $this->db->where(array('id' => $id))
               ->delete('use_list');
    }


    public function getProducts(int $id) {
      $this->db->select(array('id', 'name', 'amount', 'checked', 'modif', 'weight', 'coldness'))
               ->from('use_list_product')
               ->join('list_product', 'use_list_product.id_product = list_product.id_product')
               ->join('product', 'use_list_product.id_product = product.id')
               ->where('use_list_product.id_list = '.$id );

      $results = $this->db->get()->result();
      return $results;
    }

    public function check(int $id_product, int $id_list) {
      return $this->db->set('checked', true)
                      ->where(array('id_list' => $id_list, 'id_product' => $id_product))
                      ->update('use_list_product');
    }

    public function uncheck(int $id_product, int $id_list) {
      return $this->db->set('checked', false)
                      ->where(array('id_list' => $id_list, 'id_product' => $id_product))
                      ->update('use_list_product');
    }
}

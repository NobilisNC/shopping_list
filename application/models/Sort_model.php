<?php

class Sort_model extends CI_Model {

    public function __construct() {
            $this->load->database();
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
     */
    public function getListById(int $id) {
      $query = $this->db->get_where('list', array('id' => $id));
      return $query->result()[0];
    }

    /**
     * Return products of a specified list
     *
     */
    public function getProducts(int $id_list) {
        $this->db->select('name, amount, id, weight, coldness')
                 ->from('product')
                 ->join('list_product', 'list_product.id_product = product.id')
                 ->where('list_product.id_list = '.$id_list);

        $query = $this->db->get();
        return $query->result();
    }
}

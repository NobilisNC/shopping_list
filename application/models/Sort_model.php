<?php

class Sort_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    /** @brief Gets all lists of a specified user (id)
     *
     * @param $id - A specified user's id
     *
     * @return All the specified user's lists
     */
    public function getLists(int $id){
      $query = $this->db->get_where('list', array('id_user' => $id));

      return $query->result();

    }

    /** @brief Gets a list by its id
     *
     * @param $id - A specified list id
     *
     * @return If found, the list with the specified id
     */
    public function getListById(int $id) {
      $query = $this->db->get_where('list', array('id' => $id));
      return $query->result()[0];
    }

    /** @brief Gets all the products of a specified list
     *
     * @param $id_list - A specified list id
     *
     * @return All the products from the list
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

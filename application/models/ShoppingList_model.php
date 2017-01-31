<?php

class ShoppingList_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    public function createEmptyList(int $id_user) {
      $data = array(
          'name' => 'Empty List',
          'date' => date('Y/m/d'),
          'id_user' => $id_user
      );

      return $this->db->insert('list', $data);

    }

    public function getLists(int $id){
      $query = $this->db->get_where('list', array('id_user' => $id));

      return $query->result();

    }



}

<?php

class Accueil_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    public function valid_login($str) {
        $query = $this->db->get_where('utilisateur',array('pseudo' => strtolower($str)));
        if($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function valid_email($str) {
        $query = $this->db->get_where('utilisateur',array('mail' => strtolower($str)));
        if($query->num_rows() > 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }


}

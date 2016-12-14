<?php

class Utilisateurs_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    public function ajouter_Utilisateur() {

        $data = array(
            'pseudo' => $this->input->post('login'),
            'mot_de_passe' => sha1($this->input->post('password')),
            'mail' => $this->input->post('mail'),
            'nom' => $this->input->post('nom'),
            'prenom' => $this->input->post('prenom')
        );

        return $this->db->insert('utilisateur', $data);
    }

}

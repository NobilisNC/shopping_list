<?php

class Utilisateurs_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    public function ajouter_Utilisateur($user) {

        $data = array(
            'pseudo' => $user['login'],
            'mot_de_passe' => $user['password'],
            'mail' =>$user['mail'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom']
        );

        return $this->db->insert('utilisateur', $data);
    }

    public function valid_infos_connexion($login, $password) {
        $query = $this->db->get_where('utilisateur' ,array('pseudo' => $login, 'mot_de_passe' => sha1($password)));
        if($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function valid_login($str) {
        $query = $this->db->get_where('utilisateur',array('pseudo' => $str));
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


    public function infos($login) {
        $query = $this->db->get_where('utilisateur', array('pseudo' => $login));
        $result = $query->result()[0];
        $personnal_infos = array (
                'login' => $result->pseudo,
                'mail' => $result->mail,
                'nom' => $result->nom,
                'prenom' => $result->prenom
        );
        return $personnal_infos;
        }

    public function modifier_mdp($login, $password) {
        $this->db->set('mot_de_passe', sha1($password));
        $this->db->where('pseudo', $login);
        $this->db->update('utilisateur');
    }



}

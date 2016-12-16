<?php

class Utilisateurs_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    public function id($login) {
        $query = $this->db->get_where('utilisateur', array('pseudo' => $login));
        return $query->result()[0]->id;
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

    public function login_existe($str) {
        $query = $this->db->get_where('utilisateur',array('pseudo' => $str));
        if($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function email_existe($str) {
        $query = $this->db->get_where('utilisateur',array('mail' => strtolower($str)));
        if($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
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

    public function ajouter_ami($login_donne_acces, $login_a_acces) {
        #$query = $this->db->get_where('utilisateur', array('pseudo' => $login_donne_acces));
        $id_1 = $this->id($login_donne_acces);
        #$query = $this->db->get_where('utilisateur', array('pseudo'=> $login_a_acces));
        $id_2 = $this->id($login_a_acces);#$query->result()[0]->id;


        $data = array (
                'id_donne_acces' => $id_1,
                'id_a_acces' => $id_2,
                'a_accepte' => 'attente'
        );

        $query = $this->db->get_where('ami', $data);
        //Si le lien existe déjà on change en 'accepte'
        if ($query->num_rows() > 0 ) {
            $data['a_accepte'] = 'accepte';
            $this->db->replace('ami',$data);

        } else { // Sinon on créer le lien avec l'état 'attente'
                    $this->db->insert('ami', $data);

        }
    }

    public function obtenir_amis($login, $a_accepter = FALSE) {
        $id = $this->id($login);
        if ($a_accepter == TRUE) {
            $sql = "SELECT pseudo,a_accepte FROM `ami` JOIN utilisateur ON ami.id_a_acces=utilisateur.id WHERE ami.id_donne_acces=$id  UNION SELECT pseudo,a_accepte FROM `ami` JOIN utilisateur ON ami.id_donne_acces=utilisateur.id WHERE ami.id_a_acces=$id AND a_accepte = 'accepte' ORDER BY a_accepte";
        } else {
            $sql = "SELECT pseudo,a_accepte FROM `ami` JOIN utilisateur ON ami.id_a_acces=utilisateur.id WHERE ami.id_donne_acces=$id  UNION SELECT pseudo,a_accepte FROM `ami` JOIN utilisateur ON ami.id_donne_acces=utilisateur.id WHERE ami.id_a_acces=$id ORDER BY a_accepte";
        }

        $query = $this->db->query($sql);
        $amis = array();
        foreach($query->result() as $name)
            $amis[$name->pseudo] = $name->a_accepte;

        return $amis;
    }

    public function obtenir_notifications($login) {
        $sql = "SELECT pseudo FROM ami JOIN utilisateur ON utilisateur.id=ami.id_donne_acces WHERE id_a_acces=(SELECT id FROM utilisateur WHERE pseudo = '".$login."') AND a_accepte = 'attente'";
        $query = $this->db->query($sql);

        $notifications = array();
        foreach($query->result() as $name)
            $notifications[] = $name->pseudo;

        return $notifications;
    }

    public function supprimer_ami($login1, $login2) {
        $id_1 = $this->id($login1);
        $id_2 = $this->id($login2);
        $this->db->delete('ami', array('id_donne_acces' => $id_1, 'id_a_acces' => $id_2));
        $this->db->delete('ami', array('id_donne_acces' => $id_2, 'id_a_acces' => $id_1));
    }

    public function sont_amis($login1, $login2, $accepte = FALSE) {
        $id1 = $this->id($login1);
        $id2 = $this->id($login2);

        $sql = "SELECT * FROM ami WHERE (( id_donne_acces=$id1 AND id_a_acces = $id2 ) OR (id_donne_acces = $id2 AND id_a_acces = $id1)) ";

        if($accepte == TRUE) {
            $sql .= " AND a_accepte = 'accepte' ";

        }

        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
            return $query->result()[0]->a_accepte;
        else
            return FALSE;
    }

}

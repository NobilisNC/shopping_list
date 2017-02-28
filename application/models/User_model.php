<?php

class User_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }


    /** \brief Returns user id
     * @param $login - login of a specified user
     *
     * @return 
     */
    public function id($login) {
        $query = $this->db->get_where('user', array('login' => $login));

       return $query->result()[0]->id;
    }

    /** \brief Adds the specified user in the database
     * @param $user - an array containing all the information of the user
     */
    public function addUser($user) {

        $data = array(
            'login' => $user['login'],
            'password' => $user['password'],
            'mail' =>$user['mail'],
            'name' => $user['name'],
            'fname' => $user['fname']
        );

        return $this->db->insert('user', $data);
    }

    /** \brief Verifies the login information of the user.
     *
     * @param $login - login typed by the user
     * @param $password - password typed by the user
     *
     * @return Boolean - TRUE if the information is valid, FALSE if it is not
     */
    public function valid_infos_connexion($login, $password) {
        $query = $this->db->get_where('user', array('login' => $login, 'password' => sha1($password)));
        if($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** \brief Verifies if the specified string matches a login in the database
     *
     * @param $str - a specified string
     *
     * @return - Boolean : TRUE if this login exists, FALSE if it doesn't
     */
    public function login_exists($str) {
        $query = $this->db->get_where('user',array('login' => $str));
        if($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** \brief Verifies if the specified string matches an email in the database
     *
     * @param $str - a specified string
     *
     * @return - Boolean : TRUE if this email exists, FALSE if it doesn't
     */

    public function email_existe($str) {
        $query = $this->db->get_where('user',array('mail' => strtolower($str)));
        if($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** \brief Gets the information of the user with the specified login
     *
     * @param $login - a specified login
     *
     * @return -
     */
    public function infos($login) {
        $query = $this->db->get_where('user', array('login' => $login));
        $result = $query->result()[0];
        $personnal_infos = array (
                'login' => $result->login,
                'mail' => $result->mail,
                'nom' => $result->name,
                'prenom' => $result->fname
        );
        return $personnal_infos;
        }

      /**
       * Function used to change the user's password.
       */
    public function modifier_mdp($login, $password) {
        $this->db->set('password', sha1($password));
        $this->db->where('login', $login);
        $this->db->update('user');
    }

    /**
     * Adds a friend.
     * More precisely, the second specified user gets access to the first specified
     * user's lists.
     */
    public function ajouter_ami($login_donne_acces, $login_a_acces) {
        #$query = $this->db->get_where('user', array('login' => $login_donne_acces));
        $id_1 = $this->id($login_donne_acces);
        #$query = $this->db->get_where('user', array('login'=> $login_a_acces));
        $id_2 = $this->id($login_a_acces);#$query->result()[0]->id;


        $data = array (
                'id_give' => $id_1,
                'id_get' => $id_2,
                'state' => 'waiting'
        );

        $query = $this->db->get_where('friend', $data);
        //Si le lien existe déjà on change en 'access'
        if ($query->num_rows() > 0 ) {
            $data['state'] = 'access';
            $this->db->replace('friend',$data);

        } else { // Sinon on crée le lien avec l'état 'waiting'
                    $this->db->insert('friend', $data);

        }
    }

    /**
     * Accept or delete a "friend invitation".
     */
    public function obtenir_amis($login, $a_accepter = FALSE) {
        $id = $this->id($login);
        if ($a_accepter == TRUE) {
            $sql = "SELECT login, state FROM `friend` JOIN user ON friend.id_get=user.id WHERE friend.id_give=$id  UNION SELECT login,state FROM `friend` JOIN user ON friend.id_give=user.id WHERE friend.id_get=$id AND state = 'access' ORDER BY state";
        } else {
            $sql = "SELECT login, state FROM `friend` JOIN user ON friend.id_get=user.id WHERE friend.id_give=$id  UNION SELECT login,state FROM `friend` JOIN user ON friend.id_give=user.id WHERE friend.id_get=$id ORDER BY state";
        }

        $query = $this->db->query($sql);
        $friends = array();
        foreach($query->result() as $name)
            $friends[$name->login] = $name->state;

        return $friends;
    }

    public function obtenir_notifications($login) {
        $sql = "SELECT login FROM friend JOIN user ON user.id=friend.id_give WHERE id_get=(SELECT id FROM user WHERE  login = '".$login."') AND state = 'waiting'";
        $query = $this->db->query($sql);

        $notifications = array();
        foreach($query->result() as $name)
            $notifications[] = $name->login;

        return $notifications;
    }

    /**
    * Delete friend.
    */
    public function supprimer_ami($login1, $login2) {
        $id_1 = $this->id($login1);
        $id_2 = $this->id($login2);
        $this->db->delete('friend', array('id_give' => $id_1, 'id_get' => $id_2));
        $this->db->delete('friend', array('id_give' => $id_2, 'id_get' => $id_1));
    }

    /**
     * Returns TRUE if the specified users are friends.
     */
    public function sont_amis($login1, int $id2, $access = false) {
        $id1 = $this->id($login1);

        $sql = "SELECT * FROM friend WHERE (( id_give=$id1 AND id_get = $id2 ) OR (id_give = $id2 AND id_get = $id1)) ";

        if($access == TRUE) {
            $sql .= " AND state = 'access' ";

        }

        $query = $this->db->query($sql);

        if($query->num_rows() > 0)
            return $query->result()[0]->state;
        else
            return FALSE;
    }

}
